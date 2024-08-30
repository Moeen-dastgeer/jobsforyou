<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Web\ApplyNow;
use Illuminate\Http\Request;
use DB;

class ApplyNowController extends Controller
{
    public function apply_now(Request $request, $slug)
    {
        $data['job'] = $job=  DB::table('post_jobs as j')
        ->join('users as u', 'j.user_id','=','u.id')
        ->join('job_types as t', 'j.job_type_id','=','t.id')
        ->select('j.*','u.company_name')
        ->where('j.slug',$slug)->where('u.role_id',2)->first();
        if ($request->post()) {
            $request->validate([
                'cv' => 'required|mimes:pdf,docx,doc|max:10000',
                'message' => 'required|min:20|max:500|string'
            ]);
            $user_id = Auth()->user()->id;
            if (!DB::table('apply_nows')->where(['job_id'=>$job->id,'user_id'=>$user_id])->exists()) {
                $date = date('Y-m-d H:i:s');
                // cv upload
                $cv = $request->file('cv');
                $cv_ext = $cv->extension();
                $cv_new_name = time().'_cv.'.$cv_ext;
                $cv->storeAs('/public/cvs', $cv_new_name);

                $result = DB::table('apply_nows')->insertGetId([
                    'user_id' => $user_id,
                    'company_id' => $job->user_id,
                    'job_id' => $job->id,
                    'cv_path' => $cv_new_name,
                    'message' => $request->message,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
                if (0<$result) {
                    $request->session()->flash('success','You have applied for this job');
                }else{
                    $request->session()->flash('fail','Sorry, please try again.');
                }
            } else {
                $request->session()->flash('fail','Sorry, You have already applied for this job.');
            }
            
            return redirect()->back();
        }
        return view('web.pages.apply-now', $data);
    }
}
