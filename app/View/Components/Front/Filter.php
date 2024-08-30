<?php

namespace App\View\Components\Front;

use Illuminate\View\Component;
use DB;
class Filter extends Component
{
    public $category;
    public $city;
    public $q;
    /**  
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category ='', $city='', $q='')
    {
        $this->category = $category;
        $this->city = $city;
        $this->q = $q;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['total_jobs'] = DB::table('post_jobs')->count();
        $data['categories'] = DB::table('job_categories')->get();
        $data['cities'] = DB::table('post_jobs')->distinct()->get(['city']);
        return view('web.components.filter', $data);
    }
}
