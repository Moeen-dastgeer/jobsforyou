<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AttemptQuiz;
use DB;

class AttemptQuizController extends Controller
{
    public function starting_quiz_intro($slug){

        $data['quiz'] = DB::table('quizzes')->where('slug',$slug)->first();
        return view('web.pages.quiz.starting-quiz-intro', $data);
    }

    public function start_quiz($slug){

        $data['quiz'] = $quiz = DB::table('quizzes')->where('slug',$slug)->first();
        $data['questions'] = DB::table('questions')->where('quiz_id',$quiz->id)->get();
        // id user_id quiz_id status(pass/fail) marks created_at updated_at
        $result = DB::table('attempt_quizzes')->where([['user_id','=',Auth()->user()->id],['quiz_id', '=', $quiz->id]])->orderByDesc('created_at')->first();
        if ($result) {
            $date2 = date('Y-m-d H:i:s', strtotime('+15 day', strtotime($result->created_at)));
                if (date('Y-m-d H:i:s') <= $date2) {
                    $date1 = date('Y-m-d H:i:s');
                    $date1=date_create($date1);
                    $date2=date_create($date2);
                    $diff = date_diff($date1,$date2);
                    // echo $diff->format("%a days"); exit();
                    session()->flash('message','Sorry, You have already attemt. Please try again after '.$diff->format("%R%a days"));
                    return redirect()->back();
                } else {
                    $date = date('Y-m-d H:i:s');
                    $data['attmid'] = DB::table('attempt_quizzes')->insertGetId([
                        'user_id' => Auth()->user()->id,
                        'quiz_id' => $quiz->id,
                        'status' => 'fail',
                        'marks' => '0',
                        'created_at' => $date,
                        'updated_at' => $date
                    ]);
                    return view('web.pages.quiz.start-quiz', $data);
                }
        } else {
            $date = date('Y-m-d H:i:s');
                    $data['attmid'] = DB::table('attempt_quizzes')->insertGetId([
                        'user_id' => Auth()->user()->id,
                        'quiz_id' => $quiz->id,
                        'status' => 'fail',
                        'marks' => '0',
                        'created_at' => $date,
                        'updated_at' => $date
                    ]);
                    return view('web.pages.quiz.start-quiz', $data);
        }
    }

    public function submit_quiz(Request $request){
        $correct_aswer = 0; 
        $wrong_answer = 0;
        foreach ($request->q as $key => $value) {
            $result = DB::table('questions')->where('id',$key)->first();
            if ($value == $result->answer) {
                $correct_aswer += 1;
            } else {
                $wrong_answer += 1;
            }    
        }
        $total = count($request->q);
        $avg = ($correct_aswer/$total)*100;
        $status = '';
        if (60<$avg) {
            $status = 'Passed';
        } else {
            $status = 'Failed';
        }
        $date = date('Y-m-d H:i:s');
        DB::table('attempt_quizzes')->where('id',$request->attmid)->update([
            'status' => $status,
            'marks' => $correct_aswer.'/'.$total,
            'updated_at' => $date
        ]);
        return response()->json(['status'=>$status,'marks'=>$correct_aswer.'/'.$total]);
    }
}
