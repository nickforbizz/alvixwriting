<?php

namespace App\Http\Controllers\Web;

use App\Models\Chat;
use App\Models\ChatsUser;
use App\Models\Assignment;
use App\Models\OrderComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class chatsUserController extends Controller
{
    public function webMsg(Request $request)
    {
        try{
            DB::beginTransaction();

            $validate = Validator::make($request->all(), [
                'chatUser'=> 'required|string'
            ]);
            if ($validate->fails()){
                return [
                    'code'=>-1,
                    'data'=>$validate->errors()
                ];
            }

            $sms = new Chat([
                'body'=> $request->chatUser
            ]);

            $sms->save();

            $user_sms = new ChatsUser([
                'chat_id'=> $sms->id,
                'user_id'=> Auth::guard('web')->user()->id
            ]);

            $user_sms->save();

            DB::commit();
            return [
                'code'=>1,
                'data'=>$sms
            ];
        }catch (\Exception $e){
            DB::rollBack();
            report($e);
            return [
                'code'=>-1,
                'data'=>$e->getMessage()
            ];
        }

//        return $request->all();
    }



    public function orderComments(Request $request){

        $order=  Assignment::find((int) $request->order_id);

        $writer_id = $order->onprogressassignments
        ->where("returned",0)->first()->writer_id;

        $comment = OrderComment::create([
            'comment' => $request->addComment,
            'media' => $request->uploadMedia,
            'order_id' => $request->order_id,
            'admin_id' => $order->admin_id,
            'writer_id' => $writer_id,
            'name' => $order->title,
            'posted_by' => $request->posted_by
            ]);
        if ($comment ) {
            return back()->with(['success'=> 'comment posted']);
        }
        return back()->with(['error'=> 'Error while posting']);
    }
}
