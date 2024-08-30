<?php

namespace App\Http\Controllers\Web;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['news'] = DB::table('news as n')
        ->join('users as u', 'n.user_id','=','u.id')
        ->select('n.*','u.profile_image', 'u.id as user_id', 'u.company_name')
        ->where('user_id', Auth()->user()->id)
        ->orderByDesc('id')->paginate(10);
        $data['comments'] = DB::table('comments as c')
        ->join('users as u', 'c.user_id','=','u.id')
        ->select('c.*','u.profile_image', 'u.id as user_id', 'u.company_name', 'u.first_name', 'u.last_name','role_id')
        ->orderByDesc('id')->get();
        return view('web.employer.news-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.employer.post-news');
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
            'description' => 'required',
            'cover_image' => 'nullable|image'
        ]);
        $date = date('Y-m-d H:i:s');
        // Upload signature
        $cover_img_new_name = null;
        if($request->hasFile('cover_image')){
            $cover_img = $request->file('cover_image');
            $cover_img_ext = $cover_img->extension();
            $cover_img_new_name = time().'_cover_image.'.$cover_img_ext;
            $cover_img->storeAs('/public/images', $cover_img_new_name);
        }
        $result = DB::table('news')->insert([
            'user_id' => Auth()->user()->id,
            'post' => $request->description,
            'img_path' => $cover_img_new_name,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        if ($result) {
            $request->session()->flash('newsSuccess','News has been created!');
        } else {
            $request->session()->flash('newsDanger','News has not been created!');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function editnews($id)
    {
        $data['news'] = DB::table('news')->where('id',$id)->first();
        return view('web.employer.edit-news', $data);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            "description" => "required"
        ]);
        $date = date('Y-m-d H:i:s');
         // Upload signature
        if($request->hasFile('cover_image')){
            $cover_img = $request->file('cover_image');
            $cover_img_ext = $cover_img->extension();
            $cover_img_new_name = time().'cover_img.'.$cover_img_ext;
            $cover_img->storeAs('/public/images', $cover_img_new_name);
            DB::table('news')->where('id', $request->id)->update(["img_path" => $cover_img_new_name]);
        }
        
    
        $result = DB::table('news')->where('id', $request->id)->update(["post" => $request->description,"updated_at" => $date]);
        if ($result) {
            $request->session()->flash('newsSuccess','News has been Updated Successfully...');
        } else {
            $request->session()->flash('newsDanger','News has not been Updated!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
