<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminMiddelware
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
        // if(Auth::guard('staff')->check())
        // {
        //     $staff = Auth::guard('staff')->user();
        //     if($staff->role == 0)
        //     {
        //         return $next($request);
        //     }
        //     else
        //     {
        //         return redirect()->route('select_login');
        //     }
        // }
        // else
        // {
        //     return redirect()->route('home');
        // }

    }
}
