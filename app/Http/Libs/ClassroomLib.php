<?php

namespace App\Http\Libs;

use App\Models\Classroom;
use Exception;
use Illuminate\Support\Facades\DB;

class ClassroomLib
{
    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function index(): object
    {
        return Classroom::orderBy('id', 'asc')->paginate(7);
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
            return Classroom::create($data);
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
            Classroom::where('id', $classroom->id)
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
            $classroom = Classroom::find($classroom);
            $classroom->each->delete();
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }
}
