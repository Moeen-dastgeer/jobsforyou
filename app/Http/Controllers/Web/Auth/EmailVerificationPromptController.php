<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        // return $request->user()->hasVerifiedEmail()
        //             ? redirect()->intended(RouteServiceProvider::HOME)
        //             : view('web.auth.verify-email');
        if ($request->user()->hasVerifiedEmail()) {
            switch (Auth::user()->role_id) {
                case 1:
                    return redirect()->intended(RouteServiceProvider::EMPLOYEE_HOME.'?verified=1');
                    break;
                case 2:
                    return redirect()->intended(RouteServiceProvider::EMPLOYER_HOME.'?verified=1');
                        break;
                default:
                    break;
            }
        }else{
            return view('web.auth.verify-email');
        }
    }
}
