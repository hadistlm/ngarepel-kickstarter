<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HookCheckAccess
{   
    /**
     * get status user is can access the method?
     *
     * @param  \Illuminate\Http\Request $request
     * @return $next
     */
    public function handle($request, Closure $next)
    {   
        if (Auth::check() !== true) return $next($request);

        // prepare variable
        $controllerName = class_basename(Route::current()->controller);
        $method         = $request->method();
        $permissions    = Auth::user()->roles()->first()->permissions;
        $whitelist      = array(
            "LoginController", "ForgotPasswordController", "RegisterController", "ResetPasswordController", "VerificationController", "HomeController"
        );
        // proceed request ASAP when controller within whitelist
        if (in_array($controllerName, $whitelist) OR empty($controllerName)) :
            return $next($request);
        endif;

        // checking if user has access to the controller
        if (array_key_exists($controllerName, $permissions) !== false) :
            // checking method access permissions
            if (in_array($method, $permissions[$controllerName])) :

                // if user has access to current method then proceed
                return $next($request);
            endif;
        endif;

        header("Location: ". url('/home'));exit;
    }
}