<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisteredCompanyController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('web.auth.company-register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'company_name' => ['required', 'string', 'max:100', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'max:15'],
            'password' => ['required', 'string', 'min:8','required_with:password_confirmation','same:password_confirmation'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'terms' => ['required']
        ]);
        
        $user = User::create([
            'company_name' => $request->company_name,
            'slug'=>$this->createSlug($request->company_name),
            'phone'=> $request->phone,
            'city'=> $request->city,
            'status' => 'Pending',
            'email' => $request->email,
            'role_id'=>'2',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);
        return redirect("/login")->withSuccess('Your account has been created please check your email for verification !!!');
    }

    // generate unique slug
    public function createSlug($name){
        if (User::whereSlug($slug = Str::slug($name))->exists()) {
            $max = User::where('company_name',$name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}
