<?php

namespace App\Http\Controllers;

use App\Http\Libs\SchoolClassLib;
use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;

class SchoolClassController extends Controller
{
        private $class_lib;

    public function __construct(SchoolClassLib $class_lib)
    {
        $this->class_lib = $class_lib;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = $this->class_lib->index();
        return view('schoolclasses.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = $this->class_lib->getClassroom();
        $subjects = $this->class_lib->getSubject();
        $teachers = $this->class_lib->getTeachers();
        return view('schoolclasses.create', compact('classrooms', 'subjects', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassRequest $request)
    {
         $data = $request->validated();
        $this->class_lib->store($data);

        return redirect()->route('schoolclasses.index')->with('success', 'Class has been created successfully.');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Class $class)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateClassRequest $request, Class $class)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Class $class)
    // {
    //     //
    // }
}
