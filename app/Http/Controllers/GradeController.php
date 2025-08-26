<?php

namespace App\Http\Controllers;

use App\Http\Libs\GradeLib;
use App\Models\Grade;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;

class GradeController extends Controller
{
    private $grade_lib;

    public function __construct(GradeLib $grade_lib)
    {
        $this->grade_lib = $grade_lib;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = $this->grade_lib->index();
        return view('grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request)
    {
        $data = $request->validated();
        $this->grade_lib->store($data);

        return redirect()->route('grades.index')->with('success', 'Grade has been created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        return view('grades.edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGradeRequest $request, Grade $grade)
    {
        $request->validated();
        $this->grade_lib->update($request->all(), $grade);

        return redirect()->route('grades.index')->with('success', 'Grade has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $this->grade_lib->destroy($grade);

        return redirect()->route('grades.index')->with('success', 'Grade has been deleted successfully');
    }
}
