<?php

namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index(){

        $data['jobcategories'] = DB::table('job_categories as j')
        ->leftJoin('post_jobs as p', 'j.id', '=', 'p.job_category_id')
        ->select(DB::raw('COUNT(p.job_category_id) as jobs, j.id, j.name_en, j.name_fr, j.slug,j.img_path'))
        ->groupBy('j.id','j.name_en','j.name_fr','j.slug','j.img_path')->get();
        
        $data['jobs'] = DB::table('post_jobs as j')
        ->join('users as u', 'j.user_id','=','u.id')
        ->join('job_categories as c', 'j.job_category_id','=','c.id')
        ->join('job_types as t', 'j.job_type_id','=','t.id')
        ->orderBy('created_at')
        ->select('j.*','u.company_name', 'c.name_en as category_en', 'c.name_fr as category_fr', 't.name_en as type_en', 't.name_fr as type_fr')
        ->where('u.status','Active')->offset(0)->limit(8)->orderByDesc('created_at')->get();
        $data['companies'] = DB::table('users')->where([['role_id','=',2],['status','=','Active']])->orderByDesc('created_at')->get();
        $data['users'] = DB::table('users')->where([['role_id','=',1],['status','=','Active'],['profile_image','!=','']])->orderByDesc('created_at')->take(7)->get();

        $data['total_employers'] = DB::table('users')->where([['role_id','=',2],['status','=','Active']])->count();
        $data['total_employes'] = DB::table('users')->where([['role_id','=',1],['status','=','Active']])->count();
        $data['total_posts'] = DB::table('post_jobs')->count();
        return view('web.pages.index', $data);
    }

    public function companies(Request $request)
    {
        $q = $request->get('q');
        $query = DB::table('users as u');
        $query->leftJoin('post_jobs as p', 'u.id', '=', 'p.user_id');
        $query->select(DB::raw('COUNT(p.user_id) as jobs, u.id, u.slug, u.company_name, u.cover_image, u.profile_image,u.about'));
        $query->groupBy('u.id','u.slug','u.company_name','u.cover_image','u.profile_image','u.about');
        $query->where([['role_id','=',2],['status','=','Active']]);
        if ( $q !== null ) {
            $query->where('u.company_name', 'like', '%'.$q.'%');  
        }
        $data['companies'] = $query->paginate(24);
        return view('web.pages.companies', $data);
    }

    public function jobs(){
        $data['jobs'] = DB::table('post_jobs as j')
        ->join('users as u', 'j.user_id','=','u.id')
        ->join('job_categories as c', 'j.job_category_id','=','c.id')
        ->join('job_types as t', 'j.job_type_id','=','t.id')
        ->orderByDesc('created_at')
        ->select('j.*','u.company_name', 'u.id as company_id', 'c.name_en as category_en','c.name_fr as category_fr', 't.name_en as type_en', 't.name_fr as type_fr')
        ->where('u.status','Active')->paginate(10);
        return view('web.pages.jobs', $data);
    }

    public function job_details($slug)
    {
        $data['job'] = DB::table('post_jobs as p')
        ->join('job_categories as c', 'p.job_category_id','=','c.id')
        ->join('job_types as j', 'p.job_type_id','=','j.id')
        ->join('salary_types as s', 'p.salary_type_id','=','s.id')
        ->join('experiances as e', 'p.experiance_id','=','e.id')
        ->select('p.*', 'c.name_en as category_en','c.name_fr as category_fr', 'j.name_en as type_en' , 'j.name_fr as type_fr', 's.name as salarytype', 'e.name as experiance')
        ->where('p.slug', $slug)->first();
        return view('web.pages.job-details', $data);
    }

    public function news()
    {
        $data['news'] = DB::table('news as n')
        ->join('users as u', 'n.user_id','=','u.id')
        ->select('n.*','u.profile_image', 'u.slug', 'u.id as user_id', 'u.company_name')
        ->where('u.status','Active')
        ->orderByDesc('id')->paginate(10);
        $data['comments'] = DB::table('comments as c')
        ->join('users as u', 'c.user_id','=','u.id')
        ->select('c.*','u.profile_image',  'u.slug', 'u.id as user_id', 'u.company_name', 'u.first_name', 'u.last_name','role_id')
        ->orderByDesc('id')->get();
        return view('web.pages.news', $data);
    }
    
    public function quiz()
    {
        $data['quizzes'] = DB::table('quizzes')->orderByDesc('created_at')->paginate(10);
        return view('web.pages.quiz', $data);
    }


    public function guides()
    {
        return view('web.pages.guides');
    }


    //company profile
    public function compnay_profile($slug){
        $data['company'] = DB::table('users')->where([['slug','=',$slug],['status','=','Active'],['role_id','=','2']])->first();
        return view('web.pages.company.company_profile', $data);
    }

    //company profile
    public function company_news($slug){
        // $user = DB::table('users')->where('slug',$slug)->first();
        // $id = $user->id;
        // dd($id);
        $data['news'] = DB::table('news as n')
        ->join('users as u', 'n.user_id','=','u.id')
        ->select('n.*','u.profile_image','u.slug', 'u.id as user_id', 'u.company_name')
        ->where([['u.status','=','Active'],['u.slug','=',$slug]])
        ->orderByDesc('id')->paginate(10);
        $data['comments'] = DB::table('comments as c')
        ->join('users as u', 'c.user_id','=','u.id')
        ->select('c.*','u.profile_image','u.slug', 'u.id as user_id', 'u.company_name', 'u.first_name', 'u.last_name','role_id')
        ->where([['u.status','=','Active'],['u.slug','=',$slug]])->orderByDesc('c.id')->get();
        $data['company'] = DB::table('users')->where([['status','=','Active'],['u.slug','=',$slug]])->where('role_id','2')->first();
        return view('web.pages.company.company_news', $data);
    }

    //company profile
    public function company_offers($slug){
        $data['company'] = DB::table('users')->where('slug',$slug)->where('role_id','2')->first();
        $data['offers'] = DB::table('post_jobs as j')
        ->join('users as u', 'j.user_id','=','u.id')
        ->join('job_categories as c', 'j.job_category_id','=','c.id')
        ->join('job_types as t', 'j.job_type_id','=','t.id')
        ->orderBy('created_at')
        ->select('j.*','u.company_name', 'c.name_en as category_en', 't.name_en as type_en', 'c.name_fr as category_fr', 't.name_fr as type_fr')
        ->where('u.slug', $slug)->paginate(10);
        return view('web.pages.company.company_offers', $data);
    }

    public function search(Request $request)
    {
        $data['category'] = '';
        $data['city'] = '';
        $data['q'] = '';
        $category_slug = $request->job_category;
        $city = $request->city;
        $q = $request->q;
        $query = DB::table('post_jobs as j');
        $query->join('users as u', 'j.user_id','=','u.id');
        $query->join('job_categories as c', 'j.job_category_id','=','c.id');
        $query->join('job_types as t', 'j.job_type_id','=','t.id');
        $query->orderByDesc('created_at');
        if (isset($category_slug) && !empty($category_slug)) {
            $data['category'] = $category_slug;
            $query->where('c.slug', $category_slug);
        }
        if (isset($city) && !empty($city)) {
            $data['city'] = $city;
            $query->where('j.city', $city);
        }
        if (isset($q) && !empty($q)) {
            $data['q'] = $q;
            $query->where('j.name', 'like' ,'%'.$q.'%');
        }
        $query->where('u.status','Active');
        $query->select('j.*','u.company_name', 'u.id as company_id', 'c.name_en as category_en', 't.name_en as type_en', 'c.name_fr as category_fr', 't.name_fr as type_fr');
        $data['jobs'] = $query->paginate(10);
        return view('web.pages.search', $data);
    }
}
