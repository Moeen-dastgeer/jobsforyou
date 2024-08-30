<?php

namespace App\Http\Controllers\Admin;
use Storage;
use Validator; 
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin\JobCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['jobcategories'] = DB::table('job_categories')->get();
        return view('admin.jobcategories.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobcategories.create');
    }

    // generate unique slug
    public function createSlug($name){
            if (JobCategory::whereSlug($slug = Str::slug($name))->exists()) {
                $max = JobCategory::where('name_en',$name)->latest('id')->skip(1)->value('slug');
                if (isset($max[-1]) && is_numeric($max[-1])) {
                    return preg_replace_callback('/(\d+)$/', function ($mathces) {
                        return $mathces[1] + 1;
                    }, $max);
                }
                return "{$slug}-2";
            }
            return $slug;
        }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|max:100|string|unique:job_categories',
            'name_fr' => 'required|max:100|string',
            'img' => 'required|image|dimensions:max_width=50,max_height=50'
        ]);

        $date = date('Y-m-d H:i:s');
        
        if($request->hasFile('img')){
            $img = $request->file('img');
            $img_ext = $img->extension();
            $img_new_name = time().'_profile.'.$img_ext;
            $img->storeAs('/public/images/jobcategories', $img_new_name);
        }
        $result = DB::table('job_categories')->insert([
            'name_en' => $request->name_en,
            'name_fr' => $request->name_fr,
            'slug'=>$this->createSlug($request->name_en),
            'img_path' => $img_new_name,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if ($result) {
            $request->session()->flash('success','Job Category has been created!');
        } else {
            $request->session()->flash('error','Job Category not created!');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function show(JobCategory $jobCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(JobCategory $jobcategory)
    {
        return view('admin.jobcategories.edit', ['jobcateogry'=>$jobcategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobCategory $jobcategory)
    {
        $request->validate([
            'name_fr' => 'required|max:100|string',
            'name_en' => ['required','max:100', Rule::unique('job_categories')->ignore($jobcategory->id)],
            'img' => 'nullable|image|dimensions:max_width=50,max_height=50'
        ]);

        $date = date('Y-m-d H:i:s');
        
        if($request->hasFile('img')){
            $img = $request->file('img');
            $img_ext = $img->extension();
            $img_new_name = time().'_profile.'.$img_ext;
            $img->storeAs('/public/images/jobcategories', $img_new_name);
            DB::table('job_categories')->where('id', $jobcategory->id)->update(['img_path' => $img_new_name,]);
        }
        $result = DB::table('job_categories')->where('id', $jobcategory->id)->update([
            'name_en' => $request->name_en,
            'name_fr' => $request->name_fr,
            'slug'=>$this->createSlug($request->name_en),
            'status' => 1,
            'updated_at' => $date
        ]);

        if ($result) {
            $request->session()->flash('success','Job Category has been updated!');
        } else {
            $request->session()->flash('error','Job Category not updated!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobCategory $jobcategory)
    {
        $jobcategory->delete();
        session()->flash('success','Job category has been deleted!');
        return redirect()->back();
    }
}
