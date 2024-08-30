<?php
 
namespace App\Http\Controllers\Web;
use Storage;

use Validator;
use App\Models\Web\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function skills(){
        $data['years_eperiances'] = DB::table('years_eperiances')->get();
        $data['study_levels'] = DB::table('study_levels')->get();
        $id = Auth()->user()->id;
        $data['skill'] = DB::table('skills')->where('user_id', $id)->first();
        return view('web.employee.skills', $data);
    }

    public function update(Request $request){
     
        $request->validate([
            "name" => 'required|max:255',
            "studies_level" => 'required',
            "years_of_experiance" => 'required',
            "computer_skills" => 'nullable',
            "mastered_languages" => 'nullable',
            "linkedin_account" => 'nullable|url',
        ]);
        
        $date = date('Y-m-d H:i:s');
        $id = Auth()->user()->id;
        DB::table('skills')->where('user_id', $id)->update([
            'name'=>$request->name, 
            'studies_level_id'=>$request->studies_level, 
            'years_of_experiance_id'=>$request->years_of_experiance, 
            'computer_skills'=>$request->computer_skills, 
            'mastered_languages'=>$request->mastered_languages, 
            'linkedin_account'=>$request->linkedin_account,
            'created_at'=>$date,
            'updated_at'=>$date
        ]);
        $request->session()->flash('skillSuccess','Your Skills has been updated');
        return redirect()->back();
    }

    public function cv(Request $request){
        $request->validate(["cv" => 'required|mimes:pdf,docx|max:10000']);
        $date = date('Y-m-d H:i:s');
        $id = Auth()->user()->id;

        $cv = $request->file('cv');
        $cv_ext = $cv->extension();
        $cv_new_name = time().'_cv.'.$cv_ext;
        $cv->storeAs('/public/cvs', $cv_new_name);

        DB::table('skills')->where('user_id', $id)->update([
            'cv'=>$cv_new_name,
            'updated_at'=>$date
        ]);
        $request->session()->flash('cvSuccess','Your CV has benn upload');
        return redirect()->back();
    }
}
