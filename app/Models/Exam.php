<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id','exam_title', 'date', 'start_time', 'end_time', 'classroom_id', 'subject_id', 'grade_id', 'description','day_left', 'created_at', 'updated_at', 'deleted_at'];
}
