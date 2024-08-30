<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ChangePasswordController extends Controller
{
    
    public function show()
    {
        return view('admin.auth.change-password');
    }
    public function store(Request $request){
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8','required_with:password_confirmation','same:password_confirmation'],
            'password_confirmation' => ['required', 'string', 'min:8'],  
        ]);
        
        $id = Auth()->user()->id;
        $user = DB::table('admins')->where('id',$id)->first();
    
        if(Hash::check($request->current_password,$user->password)){
            $password = Hash::make($request->post('password'));
            DB::table('admins')->where('id',$id)->update(['password'=>$password]);
            return redirect()->back()->withSuccess('Password Updated !!!');
        }else{
            return redirect()->back()->withFail('Current Password is not correct !!!');
        } 
        // 'password' => Hash::make($request->password),
    }
}
