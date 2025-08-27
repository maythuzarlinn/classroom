<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Libs\StudentLib;
use App\Http\Requests\StudentSave;
use Illuminate\Http\RedirectResponse;
use App\Models\Student;

class StudentController extends Controller
{
    private $student_lib;

    public function __construct(StudentLib $student_lib)
    {
        $this->student_lib = $student_lib;
    }

    /**
     * Display a listing of the student.
     *
     * @return View
    */
    public function index(): View
    {
        $students = $this->student_lib->index();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     *
     * @return View
     */
    public function create(): View
    { 
        $grades = $this->student_lib->getGrades();
        return view('students.create', compact('grades'));
    }  
   
    /**
     * Store a newly created student in storage.
     *
     * @param StudentSave  $request
     * @return RedirectResponse
     */
    public function store(StudentSave $request): RedirectResponse
    {
        $data = $request->validated();
        $this->student_lib->store($data);

        return redirect()->route('students.index')->with('success', 'Student has been created successfully.');
    }   
  
    /**
     * Show the form for editing the student resource.
     *
     * @param \App\Student  $Student
     * @return View
     */
    public function edit(Student $student): View
    { 
        $grades = $this->student_lib->getGrades();
        return view('students.edit', compact('student', 'grades'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param StudentSave $request
     * @param \App\student  $student
     * @return RedirectResponse
     */
    public function update(StudentSave $request, Student $student): RedirectResponse
    {
        $request->validated();
        $this->student_lib->update($request->all(), $student);

        return redirect()->route('students.index')->with('success', 'Student has been updated successfully');
    }  
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Student  $student
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $this->student_lib->destroy($id);

        return redirect()->route('students.index')->with('success', 'Student has been deleted successfully');
    }   
}
