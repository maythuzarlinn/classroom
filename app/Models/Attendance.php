<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id','date','grade_id','student_id','status','created_at','updated_at','deleted_at'];

    public function grades()
    {
        return $this->hasMany(Grade::class, 'grade_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'student_id');
    }

    // Attendance
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    
}
