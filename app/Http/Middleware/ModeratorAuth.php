<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ModeratorAuth
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
        if(Auth::check()){
            if (Auth::user()->role == 'moderator' || Auth::user()->role == 'admin'){
                return $next($request);
            }else{
                Auth::logout();
                return redirect('/login');
            }
        }else{
            return redirect('/');
        }
    }
}
