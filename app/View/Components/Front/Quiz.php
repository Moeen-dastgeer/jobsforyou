<?php

namespace App\View\Components\Front;

use Illuminate\View\Component;
use DB;
class Quiz extends Component
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
        $data['quizzes'] = DB::table('quizzes')->orderByDesc('created_at')->take(6)->get();
        return view('web.widgets.quiz', $data);
    }
}
