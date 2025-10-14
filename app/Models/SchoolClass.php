<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['grade_id','classroom_id', 'day_of_week', 'start_time', 'end_time', 'subject_id', 'teacher_id','created_at','updated_at','deleted_at'];
    
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'grade_id');
    }
}
