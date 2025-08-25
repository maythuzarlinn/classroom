<?php

namespace App\Http\Libs;

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
        return Student::orderBy('id', 'asc')->paginate(3);
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
                    'date_of_birth' => $data['date_of_birth'],
                    'parent_name' => $data['parent_name'],
                    'contact' => $data['contact']
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
            $student = Student::find($id);
            $student->forceDelete();
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }
}
