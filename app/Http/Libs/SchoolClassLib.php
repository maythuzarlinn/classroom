<?php

namespace App\Http\Libs;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\DB;

class SchoolClassLib
{
    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function index($request): object
    {
        $school_class_list = DB::table('school_classes')
            ->whereNull('school_classes.deleted_at')

            // Filter by grade_id if provided
            ->when($request->filled('grade_id'), function ($query) use ($request) {
                $query->where('school_classes.grade_id', $request->grade_id);
            })

            // Filter by day_of_week if provided (partial match)
            ->when($request->filled('day_of_week'), function ($query) use ($request) {
                $query->where('school_classes.day_of_week', 'LIKE', '%' . $request->day_of_week . '%');
            })

            // Joins
            ->join('teachers as teacher', 'school_classes.teacher_id', '=', 'teacher.id')
            ->join('classrooms as classroom', 'school_classes.classroom_id', '=', 'classroom.id')
            ->join('subjects as subject', 'school_classes.subject_id', '=', 'subject.id')
            ->join('grades as grade', 'school_classes.grade_id', '=', 'grade.id')

            // Select fields
            ->select(
                'school_classes.*',
                'teacher.name as teacher',
                'classroom.name as classroom',
                'subject.title as subject',
                'grade.title as grade'
            )

            // Order and paginate
            ->orderBy('id', 'asc')
            ->paginate(7);

        return $school_class_list;
    }

    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function getClassroom(): object
    {
        return Classroom::all();
    }

    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function getSubject(): object
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

    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function getGrades(): object
    {
        return Grade::all();
    }

    public function getEditedClass($class_id): object
    {
        return  SchoolClass::where('id', $class_id)
            ->get();
    }

    /**
     * Store resource.
     * 
     * @return object
     */
    public function store($request)
    {
        try {
            DB::beginTransaction();

            // Loop through each subject input
            foreach ($request->input('subjects') as $subjectData) {
                SchoolClass::create([
                    'grade_id'     => $request->input('grade_id'),
                    'classroom_id' => $request->input('classroom_id'),
                    'day_of_week'  => $request->input('day_of_week'),
                    'start_time'   => $subjectData['start_time'],
                    'end_time'     => $subjectData['end_time'],
                    'subject_id'   => $subjectData['subject_id'],
                    'teacher_id'   => $request->input('teacher_id'), // use the main request teacher_id
                ]);
            }

            DB::commit();
            return redirect()->back()->with('status', 'Timetable created successfully!');
        } catch (\Exception $error) {
            DB::rollBack();
            report($error);
            return redirect()->back()->withErrors('Failed to create timetable.');
        }
    }

    /**
     * Update data.
     * 
     * @return void
     */
    public function update($data, $class): void
    {
        try {
            DB::beginTransaction();
            SchoolClass::where('id', $class->id)
                ->update([
                    'classroom_id' => $data['classroom_id'],
                    'day_of_week' => $data['day_of_week'],
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                    'subject_id' => $data['subject_id'],
                    'teacher_id' => $data['teacher_id'],
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
    public function destroy($class_id): void
    {
        try {
            DB::beginTransaction();
            SchoolClass::where('id', $class_id)->delete();
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }
}
