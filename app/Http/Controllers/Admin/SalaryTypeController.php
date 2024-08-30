<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use DB; 
use Validator;
use Storage;

use App\Models\Admin\SalaryType;
use Illuminate\Http\Request;

class SalaryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\SalaryType  $salaryType
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryType $salaryType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\SalaryType  $salaryType
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryType $salaryType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\SalaryType  $salaryType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryType $salaryType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\SalaryType  $salaryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryType $salaryType)
    {
        //
    }
}
