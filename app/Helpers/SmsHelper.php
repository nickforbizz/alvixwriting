<?php
namespace App\Helpers;



use App\Models\Smse;
use App\Models\User;

class SmsHelper
{

    /** @var \App\Models\User $user */
    private $user;
   function __construct($user)
   {
       $this->user=$user;
       # code...
   }

   public function sendSms($message){
        $s=new Smse([
            "user_id"=>$this->user->id,
            "message"=>$message
        ]);
        $s->save();

        //send SMS
   }

    /** @var \App\Models\User $user */
    public static function init($user){
        return new SmsHelper($user);
   }
}


?>
