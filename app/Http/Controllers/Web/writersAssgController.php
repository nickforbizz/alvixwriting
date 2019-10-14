<?php

namespace App\Http\Controllers\Web;

use App\Models\Chat;
use App\Models\Writer;
use App\Models\ChatsUser;
use App\Models\Assignment;
use App\Models\OrderComment;
use Illuminate\Http\Request;
use App\Events\TakeOrderEvent;
use App\Models\ReviewRevision;
use App\Models\AdminMediaProfile;
use App\Events\OrderProgressEvent;
use App\Models\OnreviewAssignment;
use Illuminate\Support\Facades\DB;
use App\Models\Completedassignment;
use App\Http\Controllers\Controller;
use App\Models\OnprogressAssignment;
use App\Models\OnrevisionAssignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class writersAssgController extends Controller
{
    //

    public function theLogout()
    {

        Auth::logout();
        return view('web.root');
    }


    public function onProgressAssg()
    {
        // for bid page
        $page = "";
        return view('web.onProgress', compact('page'));
    }

    public function order($id)
    {
        $page = "";
        $assg_id = Onprogressassignment::find($id)->assg_id;
        $assg = Assignment::find($assg_id);
        return view('web.misc.order', compact('page', 'assg'));
    }

    public function uploadAssg($type='', $id)
    {
        $page = "";
        $onprogress = 0;
        $onrevision = 0;
        $order ='';


        if ($type == 'onrevision') {
            
            $order = OnrevisionAssignment::find($id)->onreviewassignment->onprogressassignment->assignment;
            $onrevision = OnrevisionAssignment::find($id)->id;
            

        }

        if ($type == 'onprogress') {
            $order = Assignment::find($id);
            $onprogress =  OnprogressAssignment::where('active', 1)
               ->where('assg_id', $id)
               ->where('status', 1)
               ->where('returned', 0)
               ->first()->id;
        }

            


        // return $order;
        return view('web.uploadAssg', compact('page', 'order', 'onprogress', 'onrevision'));
    }

    public function reviewAssg()
    {

        
        $page = "";
        return view('web.onreview', compact('page'));
    }

 
    public function revisionreviewAssg()
    {
        $page = "";
        $revisionreview = ReviewRevision::where('status', 1)
                                            ->where('active', 1)
                                            ->where('writer_id', Auth::guard('web')->user()->id)
                                            ->get();


        return view('web.revisionreview', compact('page', 'revisionreview'));

    }

    public function revision()
    {
        $page = "";
        $revisions = OnrevisionAssignment::where('status', 1)
                        ->where('active', 1)
                        ->where('writer_id', Auth::guard('web')->user()->id)
                        ->get();


        return view('web.revision', compact('page', 'revisions'));
    }

    public function pendingAssg()
    {
        $page = "";
        return view('web.pendingPayment', compact('page'));
    }

public function rejectedAssg()
    {
        $page = "";
        return view('web.test', compact('page'));
    }

    public function completedAssg()
    {
        $page = "";
        return view('web.completedAssg', compact('page'));
    }

    public function settings()
    {
        $page = "";

        $pf = "public/";
        $userFile = '';

        if(!empty(Auth::user()->writerMediaProfiles->first())){
            $userFile = str_replace($pf, '', Auth::user()->writerMediaProfiles()->first()->media_link);

        }else{
            $userFile= str_replace($pf, '','public/writerProfileImg/default.png'); 
        }

        // return $userFile;

        return view('web.settings', compact('page', 'userFile'));
    }

    public function viewOrders()
    {
        $page = "ordersPage";
        return view('web.orders', compact('page'));
    }

    public function viewOrderFile($id)
    {
        $assg = Assignment::find($id);
        $comments = OrderComment::where('active', 1)
                                ->where('order_id', $id)
                                ->latest()
                                ->limit(10)
                                ->get();
        $page = "";
        $pf = "public/";
        $userprofile = '';
        $adminprofile = '';

        if(!empty(Auth::guard('web')->user()->writerMediaProfiles->first())){
            $userprofile = str_replace($pf, '', Auth::user()->writerMediaProfiles()->first()->media_link);

        }else{
            $userprofile= str_replace($pf, '','public/writerProfileImg/default.png'); 
        }

        if(!empty(AdminMediaProfile::where('admin_id', $assg->admin_id)->first() )){
            $adminprofile = str_replace($pf, '', AdminMediaProfile::where('admin_id', $assg->admin_id)->first()->media_link);

        }else{
            $adminprofile= str_replace($pf, '','public/adminProfileImg/default.png'); 
        }



        return view('web.orderfile', compact('page', 'assg', 'comments', 'userprofile', 'adminprofile'));
    }

    public function cancelOrder($id)
    {
        try {
            DB::beginTransaction();
            OnprogressAssignment::where('id', $id)->update([
                'active'=> 0,
                'status'=> 0,
                'returned'=> 1
            ]);
            $on_assg = OnprogressAssignment::find($id);

            $a = Assignment::where('id', $on_assg->assg_id)->update([
                'active' => 1,
                'status' => 1,
                'returned' => 1,
                'taken' => 0
            ]);
            DB::commit();
            return [
                'code' => 1,
                'status' => 'success',
                'data' => $on_assg
            ];
        } catch (\Exeption $th) {
            DB::rollback();
            report($th);
            return [
                "code"=>-1,
                "status"=>"failed",
                "data"=>$th->getMessage()
            ];
        }
    }

    public function takeOrder(Request $request, $id, $writer_id)
    {
        

        try {
            DB::beginTransaction();

                $validate = Validator::make([
                    'id' => (int)$id,
                    'writer_id' =>(int)($writer_id)
                ],[
                    'id' => "required|exists:assignment,id",
                    'writer_id' => "required|exists:writers,id",
                ]);


                if ($validate->fails()) {
                    return ([
                        'code'=> -1,
                        'errs'=>$validate->errors()
                    ]);
                } 


                $order = Assignment::find($id);

                
                if ($order->active == 1 && $order->status == 1) {
                    # code...
    
                    $on_progress_assg = new OnprogressAssignment([
                        'assg_id' => $id,
                        'writer_id' => $writer_id
                    ]);
    
                    $on_progress_assg->save();
                }

                $order->active = 0;
                $order->status = 0;
                $order->taken = 1;
                $order->update();

            $writer = Writer::find($writer_id);

            event(new TakeOrderEvent($order, $writer));

            return ;
            DB::commit();
                return [
                    'code' => 1,
                    'status' => 'success',
                    
                ];
                // return back('onProgress');
        } catch (\Exeption $th) {
            DB::rollback();
                report($th);
                return back()->with([ 'error'=>$th->getMessage()]);
                return [
                    "code"=>-1,
                    "status"=>"failed",
                    "data"=>$th->getMessage()
                ];
        }



        // return $order;

        // return [
        //     "order-id"=>$id,
        //     "writer-id"=>$writer_id
        // ];
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function submitAssg(Request $request)
    {
        try {
            $page = "";
            DB::beginTransaction();
            $validate = Validator::make($request->all(), [
                'writer_id' => 'required|exists:writers,id',
                // 'onprogress_id' => 'required|exists:onprogressassignment,id',
                'docs' => 'required|array|min:1',
                'docs.*' => 'required|file',
                'upload_comment' => 'required',
            ]);
            if ($validate->fails()) {
                $errors = ([
                    'code'=> -1,
                    'errors'=>$validate->errors()
                ]);

                //  return $errors;
                 return back()->with(['warning'=>$validate->errors()]); 
            }

            // return $request->all();

            if ((int)$request->onrevision_id > 0) {
                # code for revision
                $order_revision = Onrevisionassignment::where('active', 1)
                                    ->where('id', (int)$request->onrevision_id)->first();
                $order_id = $order_revision->onreviewassignment->onprogressassignment->assignment->id;

                // return $order_revision;
                $order_revision->update([
                    'active' => 0,
                    'status' => 0,
                    'revised' => 1,

                ]);

                $review = new ReviewRevision([
                    'writer_id' => $request->writer_id,
                    'on_revision_assg_id' => $request->onrevision_id,
                    //'doc_link' => $path,
                    'upload_comment' => $request->upload_comment,
    
                ]);

                $review->saveOrFail();                
                foreach ($request->file('docs') as $doc){
                    $review->writerMediaFilesRevisions()->create([
                        'writer_id'=>Auth::guard('web')->user()->id,
                        'assg_id' =>$order_id,
                        'onreviewrevision_id'=>$review->id,
                        'name'=>$doc->getClientOriginalName(),
                        'media_link'=>Storage::putFile('public/writer_docs', $doc),
                        'type'=>$doc->getClientOriginalExtension()
                    ]);
                }
            }


            if ((int)$request->onprogress_id > 0) {
                # code for onprogress
                /** @var OnprogressAssignment $order_progress */
                $order_progress = OnprogressAssignment::where('id',$request->onprogress_id)
                                                      ->where('active', 1)
                                                      ->where('status', 1)
                                                      ->where('returned', 0)
                                                      ->first();
                $order_progress->active = 0;
                $order_progress->status = 0;
                $order_progress->active = 0;
                $order_progress->completed = 1;
                $order_progress->update();

                /** @var OnreviewAssignment $review */
                $review = new OnreviewAssignment([
                    'writer_id' => $request->writer_id,
                    'on_progress_assg_id' => $request->onprogress_id,
                    //'doc_link' => $path,
                    'upload_comment' => $request->upload_comment,
    
                ]);
    
                $review->saveOrFail();
                foreach ($request->file('docs') as $doc){
                    $review->writerMediaFilesAssgs()->create([
                        'writer_id'=>Auth::guard('web')->user()->id,
                        'onreview_id'=>$review->id,
                        'name'=>$doc->getClientOriginalName(),
                        'media_link'=>Storage::putFile('public/writer_docs', $doc),
                        'type'=>$doc->getClientOriginalExtension()
                    ]);
                }
            }




           $writer = $review->writer()->first();
           $order = $review->onprogressassignment->assignment->first(); 
           $admin = $review->onprogressassignment->assignment->admin->first();

            event(new OrderProgressEvent($writer, $order, $admin));

            DB::commit();    
            $success_data =  [
                "code" => 1, 
                "status" => "success",
                "data" => $review
            ];
            // return $review;
            $success = "The data was posted";
            return redirect()->route('Web.home')->with(compact('page', 'success'));
            // return "pages";

        } catch (\Exeption $e) {
            DB::rollback();
            report($e);

            return back()->with(['errors'=>$e->getMessage()]);

            return [
                "code" => 0,
                "status" => "failed",
                "data" => $e->getMessage()
            ];

        }
        // return view('web.test', compact('page'));
    }

    public function orderDetails($id)
    {
        $order = Assignment::where('status', 1)
                            ->where('active', 1)
                            ->find($id);
        $page = "ordersPage";

        return view('Web.orderDetails', compact('page', 'order'));
    }

















}

//end of class

//{{--this website was made by Wainaina Nicholas Waruingi of Mombex Ent contact him through +254707722247 or email nickforbiz@gmail.com--}}