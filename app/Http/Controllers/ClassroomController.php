<?php

namespace App\Http\Controllers;

use App\Http\Libs\ClassroomLib;
use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;

class ClassroomController extends Controller
{
    private $classroom_lib;

    public function __construct(ClassroomLib $classroom_lib)
    {
        $this->classroom_lib = $classroom_lib;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = $this->classroom_lib->index();
        return view('classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request)
    {
        $data = $request->validated();
        $this->classroom_lib->store($data);

        return redirect()->route('classrooms.index')->with('success', 'Classroom has been created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClassroomRequest $request, Classroom $classroom)
    {
        $request->validated();
        $this->classroom_lib->update($request->all(), $classroom);

        return redirect()->route('classrooms.index')->with('success', 'Classroom has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $this->classroom_lib->destroy($classroom);

        return redirect()->route('classrooms.index')->with('success', 'Classroom has been deleted successfully');
    }
}
