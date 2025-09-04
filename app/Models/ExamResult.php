<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'exam_id', 'grade_id', 'subject_id', 'student_id', 'mark', 'status', 'created_at', 'updated_at', 'deleted_at'];
}
