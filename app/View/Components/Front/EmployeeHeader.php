<?php

namespace App\View\Components\Front;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use DB;
class EmployeeHeader extends Component
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
        $data['user'] = DB::table('users')->where('id',$id)->first();
        return view('web.widgets.employee-header', $data);
    }
}