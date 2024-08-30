<?php

namespace App\Http\Controllers\Admin;
use Storage;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){
        $data['companies'] = DB::table('users')->where('role_id','2')->orderByDesc('updated_at')->get();

        $data['total_companies'] = DB::table('users')->where('role_id','2')->count();
        $data['total_candidates'] = DB::table('users')->where('role_id','1')->count();
        $data['total_categories'] = DB::table('job_categories')->count();
        $data['total_quiz'] = DB::table('quizzes')->count();
        return view('admin.dashboard', $data);
    }

    // candidate
    public function candidates(Request $request)
    {
        $data['candidates'] = DB::table('users')->where('role_id','1')->orderByDesc('updated_at')->get();
        return view('admin.candidates.list', $data);
    }

    public function candidate_list($id)
    {
        $data['applys'] = DB::table('apply_nows as a')
        ->join('users as u', 'a.user_id','=','u.id')
        ->select('a.cv_path', 'a.message', 'u.first_name', 'u.last_name','u.email','u.phone','u.profile_image')
        ->where('a.job_id',$id)->orderByDesc('a.created_at')->paginate(20);
        return view('admin.companies.candidate-list', $data);

    }


    public function candidate_status(Request $request, $id, $status)
    {
        $newStatus ='';
        if ($status == "Active") {
            $newStatus ='Block';
        } else {
            $newStatus ='Active';
        }
        DB::table('users')->where('id',$id)->update(['status'=>$newStatus]);
        $request->session()->flash('success', 'Candidate has been updated!');
        return redirect(route('admin.candidates'));
    }


    // company
    public function companies(Request $request)
    {
        $data['companies'] = DB::table('users')->where('role_id','2')->orderByDesc('updated_at')->get();
        return view('admin.companies.list', $data);
    }

    public function delete_company($id)
    {
        DB::table('users')->where('id',$id)->delete();
        DB::table('post_jobs')->where('user_id',$id)->delete();
        DB::table('news')->where('user_id',$id)->delete();
        return redirect()->back()->with('success','Company Has been Deleted Successfully....'); 
    }

    public function view_company($id)
    {
        $data['jobs'] = DB::table('post_jobs as j')
        ->leftJoin('apply_nows as a', 'j.id','=','a.job_id')
        ->select(DB::raw('COUNT(a.job_id) as total_candidate ,j.id,j.name,j.slug,j.cover_img'))
        ->where('j.user_id',$id)
        ->groupBy('j.id','j.name','j.slug','j.cover_img')
        ->paginate(10);
        return view('admin.companies.jobs', $data);

    }

    public function company_status(Request $request, $id, $status)
    {
        $newStatus ='';
        if ($status == "Active") {
            $newStatus ='Block';
        } else {
            $newStatus ='Active';
        }
        DB::table('users')->where('id',$id)->update(['status'=>$newStatus]);
        // $request->session()->flash('success', 'Company has been updated!');
        return redirect()->back()->with('success', 'Company has been updated!');
    }
}

