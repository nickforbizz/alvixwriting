<?php

namespace App\Http\Controllers\Api;

use App\Codes;
use App\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Validator;

class ProfileController extends Controller
{

    public function update(Request $request){

            $data=json_decode($request->getContent(),true);
            $validator = Validator::make($data, [
                'device_code' => 'required',
                'password' => 'required|integer|digits:8',
                'name' => 'sometimes',
                'email' => 'sometimes|email',
                'phone' => 'sometimes|digits:12|regex:/(254)[0-9]{9}/',
                'new_password' => 'sometimes|integer|digits:8',
                'gender' => 'sometimes|required|in:MALE,FEMALE',
            ]);

            if ($validator->fails()) {
                $output['tag']=-1;
                $output['message'][]=trans('messages.validation_error');
                $output['errors']=$validator->errors();
                return $output;
            }


            DB::beginTransaction();

            try {
                $user=$request->user;

                if (Auth::attempt(['id' => $user->id, 'password' => $data['password']])) {
                    $device = Device::where('name', $data['device_code'])->first();

                    if ($device) {
                        $f_msg="The Following Details have being changed: ";
                        if (isset($data['name'])) {
                            $user->name = $data['name'];
                            $f_msg=$f_msg." | NAME";
                        }
                        if (isset($data['email'])) {
                            $user->email = $data['email'];
                            $f_msg=$f_msg." | EMAIL";
                        }
                        if (isset($data['phone'])) {
                            $user->pphone_number = $data['phone'];
                            $f_msg=$f_msg." | PHONE";
                        }
                        if (isset($data['new_password'])) {
                            $user->password = Hash::make($data['new_password']);
                            $f_msg=$f_msg." | NEW_PASSWORD";
                        }
                        if (isset($data['gender'])) {
                            $user->gender = $data['gender'];
                            $f_msg=$f_msg." | GENDER";
                        }
                        $user->update();

                        $output['tag']=0;
                        $output['code']=Codes::$SUCCESS;
                        $output['message'][]="Success";
                        $output['message'][]=$f_msg;

                    } else {
                        throw new \Exception("Unknown Device ID");
                    }

                }else{
                    $output['tag']=0;
                    $output['code']=Codes::$INVALID_PASSWORD;
                    $output['message'][]="Invalid Password Passed";
                }

                DB::commit();
            } catch (\Exception $e) {
                throw $e;
                report($e);
                DB::rollBack();
                $output=[];
                $output['tag']=1;
                $output['code']=$e->getCode();
                $output['message'][]=$e->getMessage();
            }

            return $output;



    }


}
