<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAuthenticateWriter
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
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login')->with('status_ridirect','Cannot Access the page. Login to get access');
        }else {
            $response=$next($request);
            return $response;
        }
    }
}
