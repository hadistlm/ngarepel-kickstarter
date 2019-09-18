<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HookCheckAuth
{   
    /**
     * get status user is authenticated?
     *
     * @param  \Illuminate\Http\Request $request
     * @return $next
     */
    public function handle($request, Closure $next)
    {   
        // checking if user not login
        if(Auth::check() !== true):
            redirect('/');
        endif;

        return $next($request);
    }
}