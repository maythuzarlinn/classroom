<?php

namespace App\Http\Controllers;

use App\Http\Libs\TeacherLib;
use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;

class TeacherController extends Controller
{
    private $teacher_lib;

    public function __construct(TeacherLib $teacher_lib)
    {
        $this->teacher_lib = $teacher_lib;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = $this->teacher_lib->index();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();
        $this->teacher_lib->store($data);

        return redirect()->route('teachers.index')->with('success', 'Teacher has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTeacherRequest $request, Teacher $teacher)
    {
        $request->validated();
        $this->teacher_lib->update($request->all(), $teacher);

        return redirect()->route('teachers.index')->with('success', 'Teacher has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $this->teacher_lib->destroy($teacher);

        return redirect()->route('teachers.index')->with('success', 'Teacher has been deleted successfully');
    }
}
