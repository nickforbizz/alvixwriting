<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use App\User;

class AdminMiddleware
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

        if (!Auth::guard('admin')->check()) {
            return redirect()->route('Admin')->with('status_ridirect','Cannot Access the page. Login to get access');
        }else {
            $response=$next($request);
            return $response;
        }
    }
}
