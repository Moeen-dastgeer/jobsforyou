<?php

namespace App\Http\Controllers\Web;
use Storage;
use Validator;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Web\Employer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    public function my_account(){
        $id = Auth()->user()->id;
        $data['user'] = DB::table('users')->where('id',$id)->first();
        return view('web.employer.myaccount', $data);
    }
    
    

    public function update_profile(Request $request)
    {
        $request->validate([
            // dimensions:min_width=100,min_height=200,max_width=100,max_height=200 file|size:512
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|dimensions:min_width=300,min_height=200,max_width=489,max_height=242',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg',
            'company_name' => 'required|max:255',
            'industry' => 'nullable|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|phone',
            'street_address' => 'nullable|max:255',
            'zip_code' => 'nullable|max:5',
            'city' => 'nullable|max:255',
            'about' => 'nullable'
        ]);
        $id = Auth()->user()->id;
        // Upload profile
        if($request->hasFile('profile_image')){
            $profile_img = $request->file('profile_image');
            $profile_img_ext = $profile_img->extension();
            $profile_img_new_name = time().'_profile.'.$profile_img_ext;
            $profile_img->storeAs('/public/images', $profile_img_new_name);
            DB::table('users')->where('id', $id)->update([
                'profile_image' => $profile_img_new_name,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        // Upload signature
        if($request->hasFile('cover_image')){
            $cover_img = $request->file('cover_image');
            $cover_img_ext = $cover_img->extension();
            $cover_img_new_name = time().'_cover_image.'.$cover_img_ext;
            $cover_img->storeAs('/public/images', $cover_img_new_name);
            DB::table('users')->where('id', $id)->update([
                'cover_image' => $cover_img_new_name,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        
        DB::table('users')->where('id', $id)->update([
            'company_name' => $request->company_name,
            'slug'=>$this->createSlug($request->company_name),
            'industry' => $request->industry,
            'email' => $request->email,
            'phone' => $request->phone,
            'street_address' => $request->street_address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'about' => $request->about,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $request->session()->flash('profileStatus', 'Profile has been updated');
        return redirect()->back();
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
