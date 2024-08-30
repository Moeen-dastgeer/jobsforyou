<?php

namespace App\View\Components\Front;

use Illuminate\View\Component;
use DB;
class Recruiting extends Component
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
        $data['recuritings'] = DB::table('users')->where('role_id',2)->get();
        return view('web.widgets.recruiting', $data);
    }
}
