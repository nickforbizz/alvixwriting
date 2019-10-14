<?php

namespace App\Http\Controllers\Api;

use App\SystemWalletConfig;
use App\UsersWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\OauthAccessToken;
use Carbon\Carbon;


class UtilsController extends Controller
{

    
    public function generateRegisterTemporalToken($user)
    {

          $accessTokens=OauthAccessToken::where('user_id',$user->id)->get();
          foreach($accessTokens as $key=>$value){
            $value->delete();
          }

          $tokenResult = $user->createToken('API_TEMPORAL_PORTAL');
          $token = $tokenResult->token;
          $token->expires_at =
                  Carbon::now()->addHours(env('WEB_PORTAL_TOKEN_EXPIRY_HOURS','3600'));
          
          $token->save();

          return $tokenResult->accessToken;
    }

    public function getTempEmail($device_code)
    {
        return $device_code."@chukabiz.com";
    }

    public function getTempPhoneNumber($device_code)
    {
        return "000".$device_code."000";

    }

    public function afterUserRegister($user)
    {

        $sys_config=SystemWalletConfig::all();

        foreach ($sys_config as $item) {
            $wallet=UsersWallet::create([
                "user_id"=>$user->id,
                "type"=>$item->type,
                "value"=>$item->amount,
            ]);

        }

    }


}