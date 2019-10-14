<?php

namespace App\Http\Controllers\Web;

use Validator;
use App\Models\Chat;
use App\Models\ChatsUser;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\AnonymousFeedback;
use App\Models\AssgPendingPayment;
use App\Models\Onreviewassignment;
use App\Models\WriterMediaProfile;
use Illuminate\Support\Facades\DB;
use App\Models\Completedassignment;
use App\Http\Controllers\Controller;
use App\Models\Onprogressassignment;
use App\Models\Onrevisionassignment;
use App\Models\WriterMediaFilesAssg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class webController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function webDashboard()
    {
        $page = "";
        $totalorders = Assignment::where('status', 1)->count();
        $totalusercomments = ChatsUser::where('status', 1)
                                        ->where('active', 1)
                                        ->where(['writer_id'=>
                                                Auth::guard('web')
                                                    ->user()->id])
                                        ->count();
        $allchat = Chat::where('status', 1)->count();
        $totalassgonprogress = Onprogressassignment::where('writer_id',
                                Auth::guard('web')->user()->id)
                                ->where('status',1)
                                ->where('active',1)
                                ->count();

        $totalrevisionassg = Onrevisionassignment::where('writer_id',
                            Auth::guard('web')->user()->id)
                            ->where('status',1)
                            ->where('active',1)
                            ->count();

        $pendingpayassg = AssgPendingPayment::where(['writer_id'=>
                    Auth::guard('web')->user()->id])
                    ->where('status',1)
                    ->where('active',1)
                    ->count();

        $neworders = Assignment::where('status', 1)->where('active', 1)->count();


        $completedorders  = Completedassignment::where(['id'=>
                            Auth::guard('web')->user()->id])
                            ->get()
                            ->count();


        $revise_assg = Onrevisionassignment::where('status', 1)->where('active', 1)->count();
        $review_assg = Onreviewassignment::where('status', 1)->where('active', 1)->count();

        if ($neworders > 0) {
            $neworders = round(($neworders / $totalorders) * 100);
        }else {
            $neworders = 0;
        }

        if ($totalusercomments>0 && $allchat>0) {
            $totalusercomments = round(($totalusercomments/$allchat)*100);
        }
        

        // return $totalassgonprogress;
        return view("web.dashboard", compact(
            'page', 'neworders', 'totalusercomments', 
            'pendingpayassg', 'totalrevisionassg', 'totalorders', 'allchat',
            'totalassgonprogress', 'revise_assg', 'completedorders','review_assg'
        ));
    }

    public function getordersCount()
    {
        $totalorders = Assignment::where('status', 1)
                                    ->where('active', 1)
                                    ->count();
        return $totalorders;
    }


    /**
     * @param Request $request
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function anonymousMsg(Request $request)
    {
       try {
           DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'title'=>'required|string|max:255',
                'email'=>'required|email',
                'comments'=>'required',
            ]);

            $anonymusMsg = new AnonymousFeedback([
                'email'=>$request->email,
                'title'=>$request->title,
                'message'=>$request->comments
            ]);
            $anonymusMsg->save();
            DB::commit();

            $userData =  [
                "code"=>"0",
                "message"=>"Success",
                "data"=>$anonymusMsg
            ];

            return back()->with($userData);

       } catch (\Exeption $e) {
           DB::rollback();
           report($e);

           return [
            "code"=>"-1",
            "message"=>$e->getMessage()
        ];
       }
    }


    /**
     * @param Request $request
     * @return array|string
     */
    public function saveWriterImg(Request $request){

        
        $validate = Validator::make($request->all(), [

            'img_prf.*' => 'required|file',

        ]);


        
        if ($validate->fails()) {
            $errors = ([
                'code'=> -1,
                'errs'=>$validate->errors() 
            ]);
            return $errors;
        }

        $doc = $request->img_prf;

        // return Storage::putFile('public/writerProfileImg', $doc);

         
        
        if (WriterMediaProfile::where('writer_id', Auth::guard('web')->user()->id)->first() != null ){


            WriterMediaProfile::where('id', Auth::guard('web')->user()->id )
                ->where('status', 1)
                ->update([
                    'writer_id' => Auth::guard('web')->user()->id,
                    'name' => $doc->getClientOriginalName(),
                    'media_link' =>Storage::putFile('public/writerProfileImg', $doc),
                    'type' => $doc->getClientOriginalExtension()
            ]);


            return [
                'code' => 1,
                'message' => "profile updated"
            ];

        }else{
            WriterMediaProfile::create([
                'writer_id' => Auth::guard('web')->user()->id,
                'name' => $doc->getClientOriginalName(),
                'media_link' => Storage::putFile('public/writerProfileImg', $doc),
                'type' => $doc->getClientOriginalExtension()
            ]);

            return [
                'code' => 1,
                'message' => "profile created"
            ];

        }

    }
}
