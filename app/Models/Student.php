<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['full_name', 'grade_id', 'date_of_birth', 'parent_name', 'contact', 'status'];

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }   

}
