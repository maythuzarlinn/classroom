<?php

namespace App\Http\Libs;

use App\Models\Grade;
use App\Models\Subject;
use Exception;
use Illuminate\Support\Facades\DB;

class SubjectLib
{
    /**
     * Get list of resource by ascending order.
     * 
     * @return object
     */
    public function index(): object
    {
        $subject_list = DB::table('subjects')
            ->when(request('search'), function ($query) {
                $query->where('subjects.name', 'like', '%' . request('search') . '%');
            })
            ->whereNull('subjects.deleted_at')
            ->join('grades as grade', 'subjects.grade_id', '=', 'grade.id')
            ->select('subjects.*', 'grade.title as grade')
            ->orderBy('id', 'asc')
            ->paginate(7);
        return $subject_list;
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
        try {
            DB::beginTransaction();
            DB::commit();
            return Subject::create($data);
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
            Subject::where('id', $classroom->id)
                ->update([
                    'title' => $data['title'],
                    'grade_id' => $data['grade_id'],
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
            $classroom = Subject::find($classroom);
            $classroom->each->delete();
            DB::commit();
        } catch (Exception $error) {
            report($error);
            DB::rollBack();
        };
    }
}
