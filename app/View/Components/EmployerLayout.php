<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use DB;
class EmployerLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $id = Auth()->user()->id;
        $data['user'] = DB::table('users')->where('id',$id)->first();
        return view('web.employer.layout', $data);
    }
}
