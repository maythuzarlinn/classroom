<?php

namespace App\Http\Libs;

use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamResult;
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
            ->join('classrooms as classroom', 'exams.classroom_id', '=', 'classroom.id')
            ->join('subjects as subject', 'exams.subject_id', '=', 'subject.id')
            ->join('grades as grade', 'exams.grade_id', '=', 'grade.id')
            ->select('exams.*', 'classroom.name as room', 'subject.title as subject', 'grade.title as grade')
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

    public function getClassrooms(): object
    {
        return Classroom::all();
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

    public function getSelectedExam($exam_id): object
    {
        return DB::table('exams')
            ->where('exams.id', $exam_id)
            ->whereNull('exams.deleted_at')
            ->join('subjects as subject', 'exams.subject_id', '=', 'subject.id')
            ->join('grades as grade', 'exams.grade_id', '=', 'grade.id')
            ->select(
                'exams.*',
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
                'start_time'    => $request->start_time,
                'end_time' => $request->end_time,
                'date'    => $request->date,
                'classroom_id' => $request->classroom_id,
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
    public function store_exam_status($request, $grade_id, $subject_id, $exam_id)
    {
        try {
            DB::beginTransaction();

            foreach ($request['mark'] as $student_id => $mark) {
                $status = $request['status'][$student_id] ?? null;

                ExamResult::updateOrCreate(
                    [
                        'exam_id' => $exam_id,
                        'grade_id' => $grade_id,
                        'subject_id' => $subject_id,
                        'student_id' => $student_id,
                    ],
                    [
                        'mark'   => $mark,
                        'status' => $status,
                    ]
                );
            }

            DB::commit();
            return true;
        } catch (\Exception $error) {
            DB::rollBack();
            report($error);
            return false;
        }
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
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                    'classroom_id' => $data['classroom_id'],
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
