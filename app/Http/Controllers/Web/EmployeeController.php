<?php

namespace App\Http\Controllers\Web;
use Storage;
use Validator;
use App\Models\Web\Employee;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function my_account(){
        $id = Auth()->user()->id;
        $data['user'] = DB::table('users')->where('id',$id)->first();
        return view('web.employee.my-account', $data);
    }

    public function applied_jobs()
    {
        $id = Auth()->user()->id;
        $data['jobs'] = DB::table('apply_nows as a') 
        ->join('post_jobs as j', 'a.job_id','=','j.id')
        ->join('users as u', 'a.user_id','=','u.id')
        ->join('job_categories as c', 'j.job_category_id','=','c.id')
        ->join('job_types as t', 'j.job_type_id','=','t.id')
        ->orderByDesc('created_at')
        ->select('j.*','u.company_name', 'u.id as company_id', 'c.name_en as category_en', 't.name_en as type_en', 'c.name_fr as category_fr', 't.name_fr as type_fr')
        ->where('u.id', $id)
        ->paginate(10);
        return view('web.employee.applied-jobs', $data);
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            // dimensions:min_width=100,min_height=200,max_width=100,max_height=200 file|size:512
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|dimensions:min_width=300,max_width=489,min_height=100,max_height=242',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'zip_code' => 'nullable|max:5'
            
        ]);
        
        // Upload profile
        $profile_img_new_name = null;
        if($request->hasFile('profile_image')){
            $profile_img = $request->file('profile_image');
            $profile_img_ext = $profile_img->extension();
            $profile_img_new_name = time().'_profile.'.$profile_img_ext;
            $profile_img->storeAs('/public/images', $profile_img_new_name);
        }
        // Upload signature
        $cover_img_new_name = null;
        if($request->hasFile('cover_image')){
            $cover_img = $request->file('cover_image');
            $cover_img_ext = $cover_img->extension();
            $cover_img_new_name = time().'_cover_image.'.$cover_img_ext;
            $cover_img->storeAs('/public/images', $cover_img_new_name);
        }

        $id = Auth()->user()->id;
        DB::table('users')->where('id', $id)->update([
            'cover_image' => $cover_img_new_name,
            'profile_image' => $profile_img_new_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'street_address' => $request->street_address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $request->session()->flash('profileStatus', 'Profile has been updated');
        return redirect()->back();
    }
}
