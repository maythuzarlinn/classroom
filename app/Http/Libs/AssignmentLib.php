<?php

namespace App\Http\Libs;

use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\DB;

class AssignmentLib
{
    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function index(): object
    {
        $assignment_list = DB::table('assignments')
            ->when(request('search'), function ($query) {
                $query->where('assignments.title', 'like', '%' . request('search') . '%')
                    ->orWhere('assignments.description', 'LIKE', '%' . request('search') . '%');
            })
            ->whereNull('assignments.deleted_at')
            ->join('teachers as teacher', 'assignments.teacher_id', '=', 'teacher.id')
            ->join('subjects as subject', 'assignments.subject_id', '=', 'subject.id')
            ->join('grades as grade', 'assignments.grade_id', '=', 'grade.id')
            ->select('assignments.*', 'teacher.name as teacher', 'subject.title as subject', 'grade.title as grade')
            ->orderBy('id', 'asc')
            ->paginate(7);
        return $assignment_list;
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
    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function getSubjects(): object
    {
        return Subject::all();
    }
    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */

    public function getTeachers(): object
    {
        return Teacher::all();
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
        // Calculate days left until deadline
        $dayLeft = max(0, now()->diffInDays(\Carbon\Carbon::parse($request->deadline), false));

        // Save assignment
        try {
            DB::beginTransaction();
            DB::commit();
            return Assignment::create([
                'title'       => $request->title,
                'description' => $request->description ?? null,
                'deadline'    => $request->deadline,
                'day_left'    => $dayLeft,
                'grade_id'    => $request->grade_id,
                'subject_id'  => $request->subject_id,
                'teacher_id'  => $request->teacher_id,
                'status'      => null, // default status if you want
            ]);
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }

    /**
     * Update data.
     * 
     * @return void
     */
    public function update($data, $attendance): void
    {
        try {
            // DB::beginTransaction();
            // Attendance::where('id', $attendance->id)
            //     ->update([
            //         'date' => $datadate,
            //         'grade_id' => $datagrade_id,
            //         'student_id' => $datastudent_id,
            //         'status' => $datastatus,
            //     ]);
            // DB::commit();
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
