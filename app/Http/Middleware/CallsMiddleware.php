<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use App\User;

use Closure;

class CallsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Auth::guard('api')->check()){
            $response=$next($request);
   
        }else{
            $response=response()->json(['tag' => '-5','message'=>'Unauthenticated Request']);
        }

        return $response;
    }
}