<?php

namespace App\Http\Controllers\Api;

use App\Codes;
use App\Device;
use App\User;
use App\UsersDevice;
use App\UsersLoginActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

class AccessController extends Controller
{

    public function temporal(Request $request){

            $data=json_decode($request->getContent(),true);
            $validator = Validator::make($data, [
                'device_code' => 'required',
            ]);

            if ($validator->fails()) {
                $output['tag']=-1;
                $output['message'][]=trans('messages.validation_error');
                $output['errors']=$validator->errors();
                return $output;
            }


            DB::beginTransaction();

            try {

                $utilsCtrl=new UtilsController();
                $email=$utilsCtrl->getTempEmail($data['device_code']);
                $phone_number=$utilsCtrl->getTempPhoneNumber($data['device_code']);


                $user=User::where('email',$email)->first();
                if(!$user){
                    $user=User::create([
                        "name"=>"Test User",
                        "email"=>$email,
                        "phone_number"=>$phone_number,
                        "password"=>Hash::make("12345678"),
                    ]);

                    $device=Device::create([
                        "name"=>$data['device_code'],
                        "description"=>"Device Created at temporal_register",
                    ]);

                    $r=new UsersDevice();
                    $r->device_id=$device->id;
                    $r->user_id=$user->id;
                    $r->saveOrFail();


                    $user->usersNotRegistereds()->create();
                    $output['tag']=0;
                    $output['message'][]="You have being Registered and logged in successfully";
                    (new UtilsController())->afterUserRegister($user);
                }else{
                    $output['tag']=0;
                    $output['message'][]="You have being logged in successfully";

                }

                $output['user']=$this->getUserData($user);
                $output['token']=(new UtilsController())->generateRegisterTemporalToken($user);

                DB::commit();
            } catch (\Exception $e) {
                report($e);
                DB::rollBack();
                $output=[];
                $output['tag']=1;
                $output['code']=$e->getCode();
                $output['message'][]=$e->getMessage();
            }

            return $output;



    }

    public function register(Request $request)
    {

        $data=json_decode($request->getContent(),true);
        $validator = Validator::make($data, [
            'device_code' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:12|regex:/(254)[0-9]{9}/',
            'password' => 'required|integer|digits:8',
            'gender' => 'required|in:MALE,FEMALE',
        ]);

        if ($validator->fails()) {
            $output['tag']=-1;
            $output['message'][]=trans('messages.validation_error');
            $output['errors']=$validator->errors();
            return $output;
        }


        DB::beginTransaction();

        try {


            $user=User::where('email',$data['email'])->first();
            if($user){
                $output['tag']=0;
                $output['code']=Codes::$USER_EXISTS;
                $output['message'][]="User Exists";

            }else {

                $email = (new UtilsController())->getTempEmail($data['device_code']);
                $temp_user = User::where('email', $email)->first();

                if ($temp_user) {
                    $temp_user->email = $data['email'];
                    $temp_user->phone_number = $data['phone'];
                    $temp_user->gender = $data['gender'];
                    $temp_user->saveOrFail();
                    $user = $temp_user;

                    $user->usersNotRegistereds()->delete();
                    $user->usersRegistereds()->create();
                    $output['tag'] = 0;
                    $output['message'][] = "You have Upgraded from Temporal and Registered successfully";
                    $output['code'] = Codes::$SUCCESS;

                } else {

                    $user = User::create([
                        "name" => "Test User",
                        "email" => $data['email'],
                        "phone_number" => $data['phone'],
                        "gender" => $data['gender'],
                        "password" => Hash::make($data['password']),
                    ]);

                    $device = Device::create([
                        "name" => $data['device_code'],
                        "description" => "Device Created at temporal_register",
                    ]);

                    $r = new UsersDevice();
                    $r->device_id = $device->id;
                    $r->user_id = $user->id;
                    $r->saveOrFail();


                    $user->usersRegistereds()->create();
                    $output['tag'] = 0;
                    $output['message'][] = "You have being Registered and logged in successfully";
                    (new UtilsController())->afterUserRegister($user);

                }

                $output['user']=$this->getUserData($user);
                $output['token']=(new UtilsController())->generateRegisterTemporalToken($user);

                $device=Device::where('name',$data['device_code'])->first();
                $user->usersLoginActivities()->where('device_id',$device->id)->delete();
                $ula=UsersLoginActivity::create(
                    [
                        "user_id"=>$user->id,
                        "device_id"=>$device->id,
                    ]
                );

            }

            DB::commit();
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            $output=[];
            $output['tag']=1;
            $output['code']=$e->getCode();
            $output['message'][]=$e->getMessage();
        }

        return $output;


    }

    public function login(Request $request)
    {

        $data=json_decode($request->getContent(),true);
        $validator = Validator::make($data, [
            'device_code' => 'required',
            'email' => 'email',
            'phone' => 'digits:12|regex:/(254)[0-9]{9}/',
            'password' => 'required|integer|digits:8',
        ]);

        if ($validator->fails()) {
            $output['tag']=-1;
            $output['message'][]=trans('messages.validation_error');
            $output['errors']=$validator->errors();
            return $output;
        }


        DB::beginTransaction();

        try {


            if (isset($data['phone'])){
                    $user = User::Where('phone_number', $data['phone'])->first();
            } else if (isset($data['email'])){
                    $user = User::Where('email', $data['email'])->first();
            } else {
                $output['tag']=-1;
                $output['message'][]="Provide Either the phone Number|Email";
                return $output;

            }



            if(!$user){
                $output['tag']=0;
                $output['code']=Codes::$USER_UKNOWN;
                $output['message'][]="User Is Not Registered";

            }else {

                if (Auth::attempt(['id' => $user->id, 'password' => $data['password']])) {

                    $device=Device::where('name',$data['device_code'])->first();
                    if(!$device){
                        $device=Device::create([
                            "name"=>$data['device_code'],
                            "description"=>"Device Created at temporal_register",
                        ]);

                        $r=new UsersDevice();
                        $r->device_id=$device->id;
                        $r->user_id=$user->id;
                        $r->saveOrFail();


                    }

//                    $user->usersLoginActivities()->where('device_id',$device->id)->delete();

                    $ula=UsersLoginActivity::create(
                        [
                            "user_id"=>$user->id,
                            "device_id"=>$device->id,
                        ]
                    );



                    $output['tag']=0;
                    $output['code']=Codes::$SUCCESS;
                    $output['user']=$this->getUserData($user);
                    $output['token']=(new UtilsController())->generateRegisterTemporalToken($user);
                    $output['message'][]="You have being logged in successfully";
                    DB::commit();
                }else{
                    $output['tag']=0;
                    $output['code']=Codes::$INVALID_PASSWORD;
                    $output['message'][]="Invalid Password";
                    $output['reset_url'][]=route('password.request');

                }


            }

            DB::commit();
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            $output=[];
            $output['tag']=1;
            $output['code']=$e->getCode();
            $output['message'][]=$e->getMessage();
        }

        return $output;


    }

    private function getUserData($user)
    {

        if($user->usersRegistereds->first()){
            $state=Codes::$FULLY_REGISTERED;
        }else if($user->usersNotRegistereds->first()){
            $state=Codes::$TEMPORAL_REGISTERED;

        }

        return collect($user)
            ->except(['password','email_verified_at','remember_token','status','updated_at','users_registereds','users_not_registereds'])
            ->put('state',$state);
    }

}
