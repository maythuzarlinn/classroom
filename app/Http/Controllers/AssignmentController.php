<?php

namespace App\Http\Controllers;

use App\Http\Libs\AssignmentLib;
use App\Models\Assignment;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;

class AssignmentController extends Controller
{
    private $assignment_lib;

    public function __construct(AssignmentLib $assignment_lib)
    {
        $this->assignment_lib = $assignment_lib;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = $this->assignment_lib->index();
        return view('assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = $this->assignment_lib->getGrades();
        $subjects = $this->assignment_lib->getSubjects();
        $teachers = $this->assignment_lib->getTeachers();
        return view('assignments.create', compact('grades', 'subjects', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssignmentRequest $request)
    {
        $this->assignment_lib->store($request);
        return redirect()->route('assignments.index')->with('success', 'Assignment has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment, $assignment_data)
    {
        dd($assignment_data);
        $students_by_grade = $this->assignment_lib->getStudentByGrade($grade_id);
        return view('assignments.grade', compact('students_by_grade', 'grade_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        $grades = $this->assignment_lib->getGrades();
        $subjects = $this->assignment_lib->getSubjects();
        $teachers = $this->assignment_lib->getTeachers();
        return view('assignments.edit', compact('assignment', 'grades', 'subjects', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(storeAssignmentRequest $request, Assignment $assignment)
    {
        $request->validated();
        $this->assignment_lib->update($request->all(), $assignment);

        return redirect()->route('assignments.index')->with('success', 'Assignment has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
         $this->assignment_lib->destroy($id);

        return redirect()->route('assignments.index')->with('success', 'Assignment has been deleted successfully');
    }
}
