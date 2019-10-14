<?php

namespace App\Http\Controllers\Calls;

use App\Http\Controllers\Api\TransactionController;
use App\InPayment;
use App\SystemWalletConfig;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;

class InPaymentsController extends Controller
{

    public function processInPayment(Request $request){

            $data=json_decode($request->getContent(),true);
            $validator = Validator::make($data, [
                'TRANS_ID' => 'required',
                'TRANS_AMOUNT' => 'required',
                'MSISDN' => 'required|digits:12|regex:/(254)[0-9]{9}/',
                'NAME' => 'required',
                'PAYMENT_METHOD' => 'required',
            ]);

            if ($validator->fails()) {
                $output['tag']=-1;
                $output['message'][]=trans('messages.validation_error');
                $output['errors']=$validator->errors();
                return $output;
            }


            DB::beginTransaction();

            try {

                $inPayment=InPayment::where('code',$data['TRANS_ID'])->first();
                if(!$inPayment){
                    $inPayment=InPayment::create([
                        'payment_method'=>$data['PAYMENT_METHOD'],
                        'code'=>$data['TRANS_ID'],
                        'name'=>$data['NAME'],
                        'msisdn'=>$data['MSISDN'],
                        'amount'=>$data['TRANS_AMOUNT']
                    ]);
                    $t=new TransactionController();
                    $t->loadSystem($data['TRANS_AMOUNT']);

                    $inPayment->inPaymentsQueues()->create();

                    $this->tryPayments($data,$inPayment);
                    $output['tag']=0;
                    $output['message'][]="You have being logged in successfully";

                }else{
                    throw new \Exception("Transaction ID Already Recorded");
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                report($e);
//                throw $e;
                $output=[];
                $output['tag']=1;
                $output['code']=$e->getCode();
                $output['message'][]=$e->getMessage();
            }

            return $output;



    }


    private function tryPayments($data,InPayment $inPayment){

            $this->tryPaymentsBill($data,$inPayment);

    }

    private function tryPaymentsBill($data,InPayment $inPayment)
    {
        try{
            $user=User::where('phone_number',$data['MSISDN'])->first();

            if($user){
                //user Exists
                $t=new TransactionController();
                $systemWalletConfig=SystemWalletConfig::where('type','CASH')->first();

                $t->loadUser($systemWalletConfig,$user,$data['AMOUNT']);
                $inPayment->inPaymentsConfirmeds()->create(['response'=>'RECEIEVED SUCCESSFULLY']);
            }else{
                throw new \Exception("Unknow User. Funds Remain in The System");
            }


        }catch (\Exception $exception){
            $inPayment->inPaymentsFaileds()->create(['reason'=>$exception->getMessage()]);
//            report($exception);

            return;
        }

    }




}
