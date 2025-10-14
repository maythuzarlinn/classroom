<?php

namespace App\Http\Controllers;

use App\Http\Libs\ExamLib;
use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Models\ExamResult;
use Illuminate\Http\Request;

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
        $classrooms = $this->exam_lib->getClassrooms();
        $grades = $this->exam_lib->getGrades();
        $subjects = $this->exam_lib->getSubjects();
        return view('exams.create', compact('classrooms', 'grades', 'subjects'));
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
    public function result(Request $request)
    {
        $grades = \App\Models\Grade::orderBy('title')->get();

        $grade_id = $request->input('grade_id');
        $yearMonth = $request->input('year_month');
        $student_id = $request->input('student_id');
        $exam_title = $request->input('exam_title');

        // ✅ Check if all search inputs are empty
        if (!$grade_id && !$yearMonth && !$student_id && !$exam_title) {
            // Return empty results
            $results = collect(); // empty collection
            return view('exams.result', compact('results', 'grades'));
        }

        // ✅ Only run the query if at least one filter is provided
        $query = \Illuminate\Support\Facades\DB::table('exam_results')
            ->join('exams', 'exam_results.exam_title', '=', 'exams.exam_title')
            ->join('students', 'exam_results.student_id', '=', 'students.id')
            ->join('subjects', 'exam_results.subject_id', '=', 'subjects.id')
            ->select(
                'exam_results.student_id',
                'students.full_name as student_name',
                'students.id',
                'exam_results.subject_id',
                'subjects.title as subject_name',
                'exam_results.mark',
                'exam_results.status',
                'exams.date'
            );

        if ($grade_id) {
            $query->where('exam_results.grade_id', $grade_id);
        }

        if ($yearMonth) {
            $query->whereRaw("DATE_FORMAT(exams.date, '%Y-%m') = ?", [$yearMonth]);
        }

        if ($student_id) {
            $query->where('exam_results.student_id', $student_id);
        }

        if ($exam_title) {
            $query->where('exam_results.exam_title', $exam_title);
        }

        $results = $query->get()->groupBy('student_id');

        return view('exams.result', compact('results', 'grades'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $classrooms = $this->exam_lib->getClassrooms();
        $grades = $this->exam_lib->getGrades();
        $subjects = $this->exam_lib->getSubjects();
        return view('exams.edit', compact('exam', 'classrooms', 'grades', 'subjects'));
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

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Exam $exam, $exam_id, $subject_id)
    {
        $grade_id =  $this->exam_lib->getStudentGrade($exam_id);
        $students_by_grade = $this->exam_lib->getStudentByGrade($grade_id);
        $exam = $this->exam_lib->getSelectedExam($exam_id, $subject_id);
        $results = Exam::where('exam_title', $exam_id)
            ->where('grade_id', $grade_id)
            ->where('subject_id', $subject_id)
            ->get()
            ->keyBy('student_id');

        if ($request->isMethod('post')) {
            $this->exam_lib->store_exam_status($request, $exam->grade_id, $exam->subject_id, $exam_id);
            return redirect()->route('exams.index')->with('success', 'Exam Result has been filled successfully.');
        }

        return view('exams.assign', compact('exam', 'students_by_grade', 'grade_id', 'exam_id', 'subject_id', 'results'));
    }

    public function getSubjectsView($gradeId)
    {
        $subjects = \App\Models\Subject::where('grade_id', $gradeId)->get();

        if ($subjects->isEmpty()) {
            return '<div class="alert alert-warning text-center">No subjects found for this grade.</div>';
        }

        return view('partials.subjects_form', compact('subjects'))->render();
    }
}
