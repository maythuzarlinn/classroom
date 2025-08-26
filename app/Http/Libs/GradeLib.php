<?php

namespace App\Http\Libs;

use App\Models\Grade;
use Exception;
use Illuminate\Support\Facades\DB;

class GradeLib
{
    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function index(): object
    {
        return Grade::orderBy('id', 'asc')->paginate(7);
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
            return Grade::create($data);
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
    public function update($data, $grade): void
    {
        try {
            DB::beginTransaction();
            Grade::where('id', $grade->id)
                ->update([
                    'title' => $data['title'],
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
    public function destroy($grade): void
    {
        try {
            DB::beginTransaction();
            $grade = Grade::find($grade);
            $grade->each->delete();
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }
}
