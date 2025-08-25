<?php

namespace App\Http\Libs;

use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\DB;

class TeacherLib
{
    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function index(): object
    {
        return Teacher::orderBy('id', 'asc')->paginate(3);
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
            return Teacher::create($data);
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
    public function update($data, $teacher): void
    {
        try {
            DB::beginTransaction();
            Teacher::where('id', $teacher->id)
                ->update([
                    'name' => $data['name'],
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
    public function destroy($teacher): void
    {
        try {
            DB::beginTransaction();
            $delete_teacher = Teacher::find($teacher);
            $delete_teacher->each->delete();
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }
}
