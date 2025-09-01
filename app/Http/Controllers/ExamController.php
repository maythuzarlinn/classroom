<?php

namespace App\Http\Controllers;

use App\Http\Libs\ExamLib;
use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;

class ExamController extends Controller
{
    private $exam_lib;

    public function __construct(ExamLib $exam_lib)
    {
        $this->exam_lib = $exam_lib;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = $this->exam_lib->index();
        return view('exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = $this->exam_lib->getGrades();
        $subjects = $this->exam_lib->getSubjects();
        return view('exams.create', compact('grades', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamRequest $request)
    {
        $this->exam_lib->store($request);
        return redirect()->route('exams.index')->with('success', 'Exam has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function result(Exam $exam)
    {
        return view('exams.result');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $grades = $this->exam_lib->getGrades();
        $subjects = $this->exam_lib->getSubjects();
        return view('exams.edit', compact('exam', 'grades', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreExamRequest $request, Exam $exam)
    {
        $request->validated();
        $this->exam_lib->update($request->all(), $exam);

        return redirect()->route('exams.index')->with('success', 'Exam has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $this->exam_lib->destroy($id);
        return redirect()->route('exams.index')->with('success', 'Exam has been deleted successfully');
    }
}
