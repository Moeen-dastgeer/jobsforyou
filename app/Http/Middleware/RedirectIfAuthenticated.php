<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if ($guard == 'admin' && Auth::guard($guard)->check()) {
                return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
            }
            if (Auth::guard($guard)->check()) {
                switch (Auth::user()->role_id) {
                    case 1:
                        return redirect()->intended(RouteServiceProvider::EMPLOYEE_HOME);
                        break;
                    case 2:
                        return redirect()->intended(RouteServiceProvider::EMPLOYER_HOME);
                        break;
                    default:
                        break;
                }

            }
        }
        return $next($request);
    }
}
