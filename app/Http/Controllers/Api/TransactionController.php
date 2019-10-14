<?php

namespace App\Http\Controllers\Api;

use App\SystemFinance;
use App\SystemWalletConfig;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{

    public function transfer(SystemWalletConfig $systemWalletConfig,User $initiatorUser,User $recepientUser, $amount)
    {
        $output=$this->withDrawUser($systemWalletConfig,$initiatorUser,$amount);
        if($output['tag']!=0){
            throw new \Exception($output['message']);
        }

        $output=$this->loadUser($systemWalletConfig,$recepientUser,$amount);
        if($output['tag']!=0){
            throw new \Exception($output['message']);
        }


        return [
            "tag"=>0,
            "message"=>"Success. Transfer Made",
        ];


    }

    public function paySystem(SystemWalletConfig $systemWalletConfig,User $user, $amount)
    {
        $output=$this->withDrawUser($systemWalletConfig,$user,$amount);
        if($output['tag']!=0){
            throw new \Exception($output['message']);
        }

        $output=$this->systemTransfer($amount,"SYSTEM_CASH","SYSTEM_PROFIT");
        if($output['tag']!=0){
            throw new \Exception($output['message']);
        }


        return [
            "tag"=>0,
            "message"=>"Success. System Payment Made",
        ];


    }

    public function loadUser(SystemWalletConfig $systemWalletConfig,User $user, $amount)
    {
        $usersWallet=$user->usersWallets()
            ->where('type',$systemWalletConfig->type)
            ->first();

        $output=$this->systemTransfer($amount,"SYSTEM_CASH","WALLET");

        if($output['tag']!=0){
            throw new \Exception($output['message']);
        }


        $from_amount=$usersWallet->value;
        $to_amount=$usersWallet->value+$amount;

        $usersWallet->value=$to_amount;
        $usersWallet->update();


        $this->recordWalletTransaction("LOAD","WALLET_LOAD",
            "SYSTEM_CASH",
            "WALLET",
            $usersWallet,
            $amount,
            $from_amount,
            $to_amount
        );

        return [
            "tag"=>0,
            "message"=>"Success. User Loaded",
        ];


    }
    public function loadSystem($amount)
    {


        $sys=SystemFinance::where('type',"SYSTEM_CASH")->first();

//        Log::channel('testing')->debug($sys_from);

            $from_amount=$sys->amount;
            $to_amount=$from_amount+$amount;

            $sys->amount=$to_amount;

            $this->recordSystemTransaction("LOAD",
                "_",
                "SYSTEM_CASH",
                $sys,
                $amount,
                $from_amount,
                $to_amount
            );
            $sys->update();



            return [
                "tag"=>0,
                "message"=>"Success. System Loaded",
            ];


    }

    private function withDrawUser(SystemWalletConfig $systemWalletConfig,User $user, $amount)
    {
        $usersWallet=$user->usersWallets()
            ->where('type',$systemWalletConfig->type)
            ->first();


        if($usersWallet->value>=$amount){
            $output=$this->systemTransfer($amount,"WALLET","SYSTEM_CASH");
            if($output['tag']!=0){
                throw new \Exception($output['message']);
            }


            $from_amount=$usersWallet->value;
            $to_amount=$usersWallet->value-$amount;

            $usersWallet->value=$to_amount;
            $usersWallet->update();



            $this->recordWalletTransaction("WITHDRAW","WALLET_WITHDRAW",
                "WALLET",
                "SYSTEM_CASH",
                $usersWallet,
                $amount,
                $from_amount,
                $to_amount
            );


            return [
                "tag"=>0,
                "message"=>"Success. User Loaded",
            ];

        }else{
            return [
                "tag"=>1,
                "message"=>"User Has Insufficient Funds",
            ];

        }


    }

    private function systemTransfer($amount,$from,$to)
    {


        $sys_from=SystemFinance::where('type',$from)->first();
        $sys_to=SystemFinance::where('type',$to)->first();

//        Log::channel('testing')->debug($sys_from);

        if($sys_from->amount>=$amount){
            $from_amount=$sys_from->amount;
            $to_amount=$from_amount-$amount;

            $sys_from->amount=$to_amount;

                $this->recordSystemTransaction("WITHDRAW",
                    $to,
                    $from,
                    $sys_from,
                    $amount,
                    $from_amount,
                    $to_amount
                );
            $sys_from->update();


            $from_amount=$sys_to->amount;
            $to_amount=$from_amount+$amount;

            $sys_to->amount=$to_amount;
                $this->recordSystemTransaction("LOAD",
                    $from,
                    $to,
                    $sys_to,
                    $amount,
                    $from_amount,
                    $to_amount
                );

            $sys_to->update();


            return [
                "tag"=>0,
                "message"=>"Success. System Loaded",
            ];

        }else {
            return [
                "tag" => 1,
                "message" => "System Has Insufficient Funds",
            ];
        }


    }

    private function recordWalletTransaction($type,$tag,$initiator, $receipient, $usersWallet, $amount, $from_amount, $to_amount)
    {
        $transaction=Transaction::create([
            'tag'=>$tag,
            'type'=>$type,
            'amount'=>$amount,
            'initiator'=>$initiator,
            'receipient'=>$receipient,
        ]);

        $transaction->walletTransactions()->create([
            'wallet_id'=>$usersWallet->id,
            'transaction_id'=>$transaction->id,
            'tag'=>$tag,
            'amount'=>$amount,
            'value_change_from'=>$from_amount,
            'value_change_to'=>$to_amount
        ]);

    }

    private function recordSystemTransaction($type,$initiator, $receipient, SystemFinance $systemFinance, $amount, $from_amount, $to_amount)
    {

        $tag="SYSTEM_".$type."_".$initiator."_".$receipient;
        $transaction=Transaction::create([
            'tag'=>$tag,
            'type'=>$type,
            'amount'=>$amount,
            'initiator'=>$initiator,
            'receipient'=>$receipient,
        ]);

        $transaction->systemFinanceTransactions()->create([
            'system_finance'=>$systemFinance->id,
            'transaction_id'=>$transaction->id,
            'remarks'=>$tag,
            'amount'=>$amount,
            'sys_value_change_from'=>$from_amount,
            'sys_value_change_to'=>$to_amount
        ]);

    }


}
