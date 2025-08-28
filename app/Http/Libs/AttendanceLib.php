<?php

namespace App\Http\Libs;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;

class AttendanceLib
{
    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function index($request): object
    {
        $attendance_list = DB::table('attendances')
        ->when($request->date, function ($query, $date) {
            $query->where('attendances.date', 'like', "%$date%");
        })
        ->when($request->grade, function ($query, $grade) {
            $query->where('grade.title', 'like', "%$grade%");
        })
        ->whereNull('attendances.deleted_at')
        ->join('grades as grade', 'attendances.grade_id', '=', 'grade.id')
        ->join('students as student', 'attendances.student_id', '=', 'student.id')
        ->select('attendances.*', 'grade.title as grade', 'student.full_name as student')
        ->orderBy('attendances.id', 'asc')
        ->paginate(6);

    return $attendance_list;
    }

    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function getGrades(): object
    {
        return Grade::orderBy('id', 'asc')->paginate(7);
    }

    public function getStudentByGrade($grade_id): object
    {
        $student_list_by_grade = Student::where('grade_id', $grade_id)
            ->orderBy('id', 'asc')   // optional, for consistent ordering
            ->paginate(5);          // 10 students per page

        return $student_list_by_grade;
    }

    /**
     * Store resource.
     * 
     * @return object
     */
    public function store($request)
    {
        $date = $request->input('date'); // attendance date
        $statuses = $request->input('status'); // array: [ student_id => status ]

        foreach ($statuses as $studentId => $attendanceStatus) {
            Attendance::updateOrCreate(
                [
                    'date' => $date,
                    'student_id' => $studentId,
                ],
                [
                    'grade_id' => $request->grade, // make sure you pass grade_id in form or detect it
                    'status' => $attendanceStatus,
                ]
            );
        }
    }

    /**
     * Update data.
     * 
     * @return void
     */
    public function update($data, $attendance): void
    {
        try {
            DB::beginTransaction();
            Attendance::where('id', $attendance->id)
                ->update([
                    'date' => $data['date'],
                    'grade_id' => $data['grade_id'],
                    'student_id' => $data['student_id'],
                    'status' => $data['status'],
                ]);
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }

    /**
     * Delete resource.
     * 
     * @return void
     */
    public function destroy($id): void
    {
        try {
            DB::beginTransaction();
            Attendance::where('id', $id)->delete();
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }
}
