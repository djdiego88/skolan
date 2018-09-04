<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard($guard)->user()->enabled()){
            return $next($request);
        }else {
            Auth::logout();
            abort(401);
        }
    }
}
