<?php

namespace App\Http\Libs;

use App\Models\Grade;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;

class StudentLib
{
    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function index(): object
    {
        $student_list = DB::table('students')
            ->when(request('search'), function ($query) {
                $query->where('students.name', 'like', '%' . request('search') . '%')
                    ->orWhere('students.contact', 'LIKE', '%' . request('search') . '%');
            })
            ->whereNull('students.deleted_at')
            ->join('grades as grade', 'students.grade_id', '=', 'grade.id')
            ->select('students.*', 'grade.title as grade')
            ->orderBy('id', 'asc')
            ->paginate(7);
        return $student_list;
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

    /**
     * Store resource.
     * 
     * @return object
     */
    public function store($data): object
    {
        $data['grade_id'] = (int) $data['grade_id'];
        try {
            DB::beginTransaction();
            DB::commit();
            return Student::create($data);
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
    public function update($data, $Student): void
    {
        try {
            DB::beginTransaction();
            Student::where('id', $Student->id)
                ->update([
                    'full_name' => $data['full_name'],
                    'grade_id' => $data['grade_id'],
                    'date_of_birth' => $data['date_of_birth'],
                    'parent_name' => $data['parent_name'],
                    'contact' => $data['contact'],
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
            Student::where('id', $id)->delete();
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };      
    }
}
