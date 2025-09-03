<?php

namespace App\Http\Controllers;

use App\Http\Libs\SchoolClassLib;
use App\Http\Requests\StoreClassRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\SchoolClass;

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
    public function edit(SchoolClass $schoolclass)
    {
        $schoolclass->load('classroom.grade');
        $classrooms = $this->class_lib->getClassroom();
        $subjects = $this->class_lib->getSubject();
        $teachers = $this->class_lib->getTeachers();
        $grades = $this->class_lib->getGrades();
        return view('schoolclasses.edit', compact('schoolclass', 'classrooms', 'subjects', 'teachers', 'grades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClassRequest $request, SchoolClass $schoolclass)
    {
        $request->validated();
        $this->class_lib->update($request->all(), $schoolclass);

        return redirect()->route('schoolclasses.index')->with('success', 'Class schedule has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id): RedirectResponse
    {;
        $this->class_lib->destroy($id);
        return redirect()->route('schoolclasses.index')->with('success', 'Class has been deleted successfully');
    }
}
