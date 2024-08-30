<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            switch (Auth::user()->role_id) {
                case 1:
                    return redirect()->intended(RouteServiceProvider::EMPLOYEE_HOME.'?verified=1')->withSuccess('Your account has been verified !!!');
                    break;
                case 2:
                    return redirect()->intended(RouteServiceProvider::EMPLOYER_HOME.'?verified=1')->withSuccess('Your account has been verified !!!');
                        break;
                default:
                    break;
            }
            // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        } 

        switch (Auth::user()->role_id) {
            case 1:
                return redirect()->intended(RouteServiceProvider::EMPLOYEE_HOME.'?verified=1')->withSuccess('Your account has been verified !!!');
                break;
            case 2:
                return redirect()->intended(RouteServiceProvider::EMPLOYER_HOME.'?verified=1')->withSuccess('Your account has been verified !!!');
                    break;
            default:
                break;
        }
        // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
