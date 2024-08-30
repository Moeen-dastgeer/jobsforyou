<?php

namespace App\Http\Controllers\Web;

use App\Models\Web\PostJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
  
class PostJobController extends Controller{

    public function post_your_job(){
        $data['job_categories'] = DB::table('job_categories')->get();
        $data['job_types'] = DB::table('job_types')->get();
        $data['salary_types'] = DB::table('salary_types')->get();
        $data['experiances'] = DB::table('experiances')->get();
        return view('web.employer.post-your-job', $data);
    }

    public function view_job_details($slug){
        $data['job'] = DB::table('post_jobs as p')
        ->join('job_categories as c', 'p.job_category_id','=','c.id')
        ->join('job_types as j', 'p.job_type_id','=','j.id')
        ->join('salary_types as s', 'p.salary_type_id','=','s.id')
        ->join('experiances as e', 'p.experiance_id','=','e.id')
        ->select('p.*','c.name_en as category_en', 'j.name_en as type_en','c.name_fr as category_fr', 'j.name_fr as type_fr', 's.name as salarytype', 'e.name as experiance')
        ->where('p.slug', $slug)->first();
        // dd($data['job']);
        return view('web.employer.view-job-details', $data);
    }

    public function posted_jobs_list(){
        $data['post_jobs'] = DB::table('post_jobs as j')
        ->leftJoin('apply_nows as a', 'j.id','=','a.job_id')
        ->select(DB::raw('COUNT(a.job_id) as total_candidate ,j.id,j.name,j.slug,j.cover_img'))
        ->where('j.user_id', Auth()->user()->id)
        ->groupBy('j.id','j.name','j.slug','j.cover_img')
        ->paginate(10);
        return view('web.employer.posted-jobs-list', $data);
    }

    public function candidate_list($id){
        $data['applys'] = DB::table('apply_nows as a')
        ->join('users as u', 'a.user_id','=','u.id')
        ->select('a.cv_path', 'a.message', 'u.first_name', 'u.last_name','u.email','u.phone','u.profile_image')
        ->where('a.job_id',$id)->orderByDesc('a.created_at')->paginate(20);
        // dd($data['applys']);
        return view('web.employer.candidate-list', $data);
    }

    public function editjob($id){
        $data['job_categories'] = DB::table('job_categories')->get();
        $data['job_types'] = DB::table('job_types')->get();
        $data['salary_types'] = DB::table('salary_types')->get();
        $data['experiances'] = DB::table('experiances')->get();
        $data['post_job'] = DB::table('post_jobs')->where('id',$id)->first();
        return view('web.employer.edit-post-your-job', $data);
    }

    

    public function updatejob(Request $request, $id){
        $request->validate([
            "cover_img" => "nullable|image",
            "job_category" => "required",
            "job_type" => "required",
            "name" => "required|max:255",
            "job_description" => "required",
            "country" => "required|max:255",
            "city" => "required|max:255",
            "zipcode" => "required|max:5",
            "min_salary" => "required|numeric",
            "max_salary" => "required|numeric",
            "salary_type" => "required",
            "experiance" => "required",
            "min_experiance_year" => "required",
            "job_functions" => "required",
            "terms" => "required"
        ]);
        $date = date('Y-m-d H:i:s');
         // Upload signature
        if($request->hasFile('cover_img')){
            $cover_img = $request->file('cover_img');
            $cover_img_ext = $cover_img->extension();
            $cover_img_new_name = time().'cover_img.'.$cover_img_ext;
            $cover_img->storeAs('/public/images', $cover_img_new_name);
            DB::table('post_jobs')->where('id', $id)->update(["cover_img" => $cover_img_new_name]);
        }
        $data = [
            "job_category_id" => $request->job_category,
            "job_type_id" => $request->job_type,
            "name" => $request->name,
            'slug'=>$this->createSlug($request->name),
            "job_description" => $request->job_description,
            "country" => $request->country,
            "city" => $request->city,
            "zipcode" => $request->zipcode,
            "min_salary" => $request->min_salary,
            "max_salary" => $request->max_salary,
            "salary_type_id" => $request->salary_type,
            "experiance_id" => $request->experiance,
            "min_experiance_year" => $request->min_experiance_year,
            "job_functions" => $request->job_functions,
            "updated_at" => $date
        ];
        DB::table('post_jobs')->where('id', $id)->update($data);
        $request->session()->flash('created','Your job has been updated successfully!');
        return redirect()->back();
    }

    public function createjob(Request $request){
        // $request->validate([
        //     "cover_img" => "required|image",
        //     "job_category" => "required",
        //     "job_type" => "required",
        //     "title" => "required|max:255",
        //     "job_description" => "required",
        //     "country" => "required|max:255",
        //     "city" => "required|max:255",
        //     "zipcode" => "required|max:5",
        //     "min_salary" => "required|numeric",
        //     "max_salary" => "required|numeric",
        //     "salary_type" => "required",
        //     "experiance" => "required",
        //     "min_experiance_year" => "required",
        //     "job_functions" => "required",
        //     "terms" => "required"
        // ]);
        $date = date('Y-m-d H:i:s');
         // Upload signature
        $cover_img_new_name = null;
        if($request->hasFile('cover_img')){
            $cover_img = $request->file('cover_img');
            $cover_img_ext = $cover_img->extension();
            $cover_img_new_name = time().'cover_img.'.$cover_img_ext;
            $cover_img->storeAs('/public/images', $cover_img_new_name);
        }
        $data = [
            "user_id" => Auth()->user()->id,
            "cover_img" => $cover_img_new_name,
            "job_category_id" => $request->job_category,
            "job_type_id" => $request->job_type,
            "name" => $request->title,
            'slug'=>$this->createSlug($request->title),
            "job_description" => $request->job_description,
            "country" => $request->country,
            "city" => $request->city,
            "zipcode" => $request->zipcode,
            "min_salary" => $request->min_salary,
            "max_salary" => $request->max_salary,
            "salary_type_id" => $request->salary_type,
            "experiance_id" => $request->experiance,
            "min_experiance_year" => $request->min_experiance_year,
            "job_functions" => $request->job_functions,
            "created_at" => $date,
            "updated_at" => $date
        ];
        $result = DB::table('post_jobs')->insert($data);
        if($result){
            $request->session()->flash('created','Your job has been submitted successfully!');
        }else{
            $request->session()->flash('notcreated','Error, You job not subbmited!');
        }
        return redirect()->back();
    }

    public function deletejob(Request $request, $id){
        DB::table('post_jobs')->where('id',$id)->delete();
        $request->session()->flash('deletedjob','Job Deleted Successfully!');
        return redirect()->back();
    }

    // generate unique slug
    public function createSlug($name){
        if (PostJob::whereSlug($slug = Str::slug($name))->exists()) {
            $max = PostJob::whereName($name)->latest('id')->skip(1)->value('slug');
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
