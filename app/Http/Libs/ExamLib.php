<?php

namespace App\Http\Libs;

use App\Models\Assignment;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\DB;

class ExamLib
{
    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function index(): object
    {
        $exam_list = DB::table('exams')
            ->when(request('search'), function ($query) {
                $query->where('exams.date', 'like', '%' . request('search') . '%')
                    ->orWhere('exams.description', 'LIKE', '%' . request('search') . '%');
            })
            ->whereNull('exams.deleted_at')
            ->join('subjects as subject', 'exams.subject_id', '=', 'subject.id')
            ->join('grades as grade', 'exams.grade_id', '=', 'grade.id')
            ->select('exams.*', 'subject.title as subject', 'grade.title as grade')
            ->orderBy('id', 'asc')
            ->paginate(7);
        return $exam_list;
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
        $subjects = Subject::selectRaw('MIN(id) as id, title, MIN(grade_id) as grade_id')
            ->groupBy('title')
            ->get();

        return $subjects;
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
            ->get();          // 10 students per page

        return $student_list_by_grade;
    }

    public function getSelectedAssignment($assignment_id): object
    {
        return DB::table('exams')
            ->where('exams.id', $assignment_id)
            ->whereNull('exams.deleted_at')
            ->join('teachers as teacher', 'exams.teacher_id', '=', 'teacher.id')
            ->join('subjects as subject', 'exams.subject_id', '=', 'subject.id')
            ->join('grades as grade', 'exams.grade_id', '=', 'grade.id')
            ->select(
                'exams.*',
                'teacher.name as teacher',
                'subject.title as subject',
                'grade.title as grade'
            )
            ->first();
    }

    /**
     * Store resource.
     * 
     * @return object
     */
    public function store($request)
    {
        // Save assignment
        try {
            DB::beginTransaction();
            DB::commit();
            return Exam::create([
                'date'    => $request->date,       
                'subject_id'  => $request->subject_id,
                'grade_id'    => $request->grade_id,
                'description' => $request->description ?? null,
            ]);
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }

    /**
     * Store resource.
     * 
     * @return object
     */
    public function store_assignment_status($request, $assignment_id)
    {
        // Save assignment
        try {
            DB::beginTransaction();
            DB::commit();
            return  Assignment::where('id', $assignment_id)
                ->update([
                    'status' => json_encode($request['status']),
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
    public function update($data, $exam)
    {
        try {
            DB::beginTransaction();

            Exam::where('id', $exam->id)
                ->update([
                    'date' => $data['date'],
                    'subject_id' => $data['subject_id'],
                    'grade_id' => $data['grade_id'],
                    'description' => $data['description'],
                ]);
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
            return false;
        }
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
            Exam::where('id', $id)->delete();
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }
}
