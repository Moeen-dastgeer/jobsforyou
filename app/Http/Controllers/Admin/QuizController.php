<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Validator;
use Storage;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['quizzes'] = DB::table('quizzes')->get();
        return view('admin.quizzes.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:quizzes|max:255',
            'level' => 'required|max:255',
            'duration' => 'required|max:255',
            'desc'=>'required|max:255',
            'img' => 'required|image',
            'question.*' => 'required|max:255',
            'first_option.*' => 'required|max:255',
            'second_option.*' => 'required|max:255',
            'third_option.*' => 'nullable|max:255',
            'fourth_option.*' => 'nullable|max:255',
            'answer.*' => 'required|max:255',
        ]);
 
        if ($validator->fails()) {
            return response()->json(['status'=>'error','error'=>$validator->errors()->toArray()]);
        }else{
            if($request->hasFile('img')){
                $img = $request->file('img');
                $img_ext = $img->extension();
                $img_new_name = time().'_quiz'.$img_ext;
                $img->storeAs('/public/images', $img_new_name);
            }
            $date = date('Y-m-d H:i:s');
            $id = DB::table('quizzes')->insertGetId([
                'name'=>$request->name,
                'slug'=>$this->createSlug($request->name),
                'level'=>$request->level,
                'duration'=>$request->duration,
                'img_path'=>$img_new_name,
                'description'=>$request->desc,
                'status'=>'active',
                'created_at'=>$date,
                'updated_at'=>$date
            ]);
            $end_value = count($request->question);
            for ($i=0; $i < $end_value; $i++) { 
                DB::table('questions')->insert([
                    'quiz_id' => $id,
                    'question' => $request->question[$i],
                    'option1' => $request->first_option[$i],
                    'option2' => $request->second_option[$i],
                    'option3' => $request->third_option[$i],
                    'option4' => $request->fourth_option[$i],
                    'answer'  => $request->answer[$i],
                    'created_at' => $date,
                    'updated_at' => $date
                ]);
            }
            if (0<$end_value) {
                return response()->json(['status'=> 'success', 'message'=>'Quiz has been save successfully!']);
            } else {
                return response()->json(['status'=> 'fail', 'message'=>'Quiz not added!']);
            }
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        $data['quiz'] = $quiz;
        $data['questions'] = DB::table('questions')->where('quiz_id', $quiz->id)->get();
        return view('admin.quizzes.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        // return response()->json($request->all());
        $id = $quiz->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'level' => 'required|max:255',
            'duration' => 'required|max:255',
            'desc'=>'required|max:255',
            'img' => 'nullable|image',
            'question.*' => 'required|max:255',
            'first_option.*' => 'required|max:255',
            'second_option.*' => 'required|max:255',
            'third_option.*' => 'nullable|max:255',
            'fourth_option.*' => 'nullable|max:255',
            'answer.*' => 'required|max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['status'=>'error','error'=>$validator->errors()->toArray()]);
        }else{
            if($request->hasFile('img')){
                $img = $request->file('img');
                $img_ext = $img->extension();
                $img_new_name = time().'_quiz'.$img_ext;
                $img->storeAs('/public/images', $img_new_name);
                DB::table('quizzes')->where('id', $id)->update([ 'img_path'=>$img_new_name]);
            }
            $date = date('Y-m-d H:i:s');
            DB::table('quizzes')->where('id', $id)->update([
                'name'=>$request->name,
                'slug'=>$this->createSlug($request->name),
                'level'=>$request->level,
                'duration'=>$request->duration,
                'description'=>$request->desc,
                'status'=>'active',
                'updated_at'=>$date
            ]);
            $end_value = count($request->question);
            for ($i=0; $i < $end_value; $i++) { 
                if ($request->question_status[$id] == 'old' AND 0< $request->id[$i] ) {
                    DB::table('questions')->where('id',$request->id[$i])->update([
                        'question' => $request->question[$i],
                        'option1' => $request->first_option[$i],
                        'option2' => $request->second_option[$i],
                        'option3' => $request->third_option[$i],
                        'option4' => $request->fourth_option[$i],
                        'answer'  => $request->answer[$i],
                        'updated_at' => $date
                    ]);
                } else {
                    DB::table('questions')->insert([
                        'quiz_id' => $id,
                        'question' => $request->question[$i],
                        'option1' => $request->first_option[$i],
                        'option2' => $request->second_option[$i],
                        'option3' => $request->third_option[$i],
                        'option4' => $request->fourth_option[$i],
                        'answer'  => $request->answer[$i],
                        'created_at' => $date,
                        'updated_at' => $date
                    ]);
                } 
            }
            return response()->json(['status'=> 'success', 'message'=>'Quiz has been save successfully!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        //
    }

    public function quiz_delete($id)
    {
        DB::table('questions')->where('id', $id)->delete();
        return response()->json(['status'=>'success','message'=>'deleted']);
    }

    // generate unique slug
    public function createSlug($name){
        if (Quiz::whereSlug($slug = Str::slug($name))->exists()) {
            $max = Quiz::whereName($name)->latest('id')->skip(1)->value('slug');
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
