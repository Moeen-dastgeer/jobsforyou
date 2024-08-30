<?php

namespace App\View\Components\Front;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use DB;
class MatchSkills extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $id = Auth()->user()->id;
        $data['quizzes'] = DB::table('attempt_quizzes as a')
        ->join('quizzes as q', 'a.quiz_id', '=', 'q.id')
        ->select('a.*', 'q.name as quiz_name')
        ->where('a.user_id', $id)->get();
        return view('web.widgets.match-skills', $data);
    }
}
