<?php

namespace App\Http\Controllers\Api;

use App\Bill;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillController extends Controller
{

//    public function makeUserBill($name,$amount,User $user,)
//    {
//
//    }
    private function createBill($name,$amount)
    {
        $bill=Bill::create([
            "name"=>$name,
            "code"=>"",
            "reference_code"=>"",
            "amount"=>$amount
        ]);
        $bill->billsWaiting()->create();


        return $bill;
    }
}
