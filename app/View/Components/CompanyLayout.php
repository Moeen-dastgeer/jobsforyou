<?php

namespace App\View\Components;

use Illuminate\View\Component;
class CompanyLayout extends Component
{
    public $coverimg;
    public $profileimg;
    public $companyid;

    public function __construct($coverimg, $profileimg, $companyid)
    {
        $this->coverimg = $coverimg;
        $this->profileimg = $profileimg;
        $this->companyid = $companyid;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render() 
    {
        return view('web.pages.company.layout');
    }
}
