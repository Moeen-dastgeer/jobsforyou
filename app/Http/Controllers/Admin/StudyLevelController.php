<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use DB; 
use Validator;
use Storage;
use App\Models\Admin\StudyLevel;
use Illuminate\Http\Request;

class StudyLevelController extends Controller
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
     * @param  \App\Models\admin\StudyLevel  $studyLevel
     * @return \Illuminate\Http\Response
     */
    public function show(StudyLevel $studyLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\StudyLevel  $studyLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(StudyLevel $studyLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\StudyLevel  $studyLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudyLevel $studyLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\StudyLevel  $studyLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudyLevel $studyLevel)
    {
        //
    }
}
