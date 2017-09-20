<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $userType = 'Buyer')
    {
        $check = strtolower($userType);
        if(!Auth::check() ){
            return redirect(route('login.'.$userType));
        }
        if (!auth()->user()->$check()->count()) {
            return redirect(route('login.'.$userType));
        }

        return $next($request);
    }
}
