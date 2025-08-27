<?php

namespace App\Http\Libs;

use App\Models\Classroom;
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
    public function index(): object
    {
        $school_class_list = DB::table('school_classes')
            ->when(request('search'), function ($query) {
                $query->where('school_classes.id', 'like', '%' . request('search') . '%');
            })
            ->whereNull('school_classes.deleted_at')
            ->join('teachers as teacher', 'school_classes.teacher_id', '=', 'teacher.id')
            ->join('classrooms as classroom', 'school_classes.classroom_id', '=', 'classroom.id')
            ->join('subjects as subject', 'school_classes.subject_id', '=', 'subject.id')
            ->select('school_classes.*','teacher.name as teacher', 'classroom.name as classroom', 'subject.title as subject')
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

    /**
     * Store resource.
     * 
     * @return object
     */
    public function store($data): object
    {
        try {
            DB::beginTransaction();
            DB::commit();
            return SchoolClass::create($data);
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
    public function update($data, $classroom): void
    {
        try {
            DB::beginTransaction();
            SchoolClass::where('id', $classroom->id)
                ->update([
                    'name' => $data['name'],
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
    public function destroy($classroom): void
    {
        try {
            DB::beginTransaction();
            $classroom = SchoolClass::find($classroom);
            $classroom->each->delete();
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }
}
