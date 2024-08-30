<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('web.auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('web.auth.password'),
            ]);
        }

        $request->session()->put('web.auth.password_confirmed_at', time());
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
        // return redirect()->intended(RouteServiceProvider::HOME);
    }
}
