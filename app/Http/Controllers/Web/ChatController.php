<?php

namespace App\Http\Controllers\Web;

use App\Events\UserEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function ChatView(){
        return view('web.test');
    }


    public function send(Request $request){

        $user = Auth::guard('web')->user();
        event(new UserEvent($user, $request->message));
        return $request->all;
    }

//    public function send(){
//        $message = "hello pusher am here";
//        $user = Auth::guard('web')->user();
//        event(new UserEvent($user, $message) );
//
//    }


}
