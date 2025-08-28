<?php

namespace App\Http\Controllers;

use App\Http\Libs\AttendanceLib;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttendanceRequest;
use Illuminate\Http\RedirectResponse;

class AttendanceController extends Controller
{
    private $attendance_lib;

    public function __construct(AttendanceLib $attendance_lib)
    {
        $this->attendance_lib = $attendance_lib;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $attendances = $this->attendance_lib->index($request);
        $search_term = $request->query('search');
        if (empty($attendances->items())) {
            $post_list = "No data available in table";
            return view('attendances.index',  [
        'attendances' => $attendances,
        'grade' => $request->grade,
        'date' => $request->date,
    ]);
        } else {
            return view('attendances.index',  [
        'attendances' => $attendances,
        'grade' => $request->grade,
        'date' => $request->date,
    ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = $this->attendance_lib->getGrades();
        return view('attendances.create', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {
        $this->attendance_lib->store($request);
        return redirect()->route('attendances.index')->with('success', 'Attendance has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance, $grade_id)
    {
        $students_by_grade = $this->attendance_lib->getStudentByGrade($grade_id);
        return view('attendances.grade', compact('students_by_grade', 'grade_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance) {
        $grades = $this->attendance_lib->getGrades();
        return view('attendances.edit', compact('attendance', 'grades'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $success = $this->attendance_lib->update($request->all(), $attendance);
        return redirect()->route('attendances.index')->with('success', 'Attendance has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Student  $student
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $this->attendance_lib->destroy($id);

        return redirect()->route('attendances.index')->with('success', 'Attendance has been deleted successfully');
    }   
}
