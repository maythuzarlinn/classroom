<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = ['classroom_id', 'day_of_week', 'start_time', 'end_time', 'subject_id', 'teacher_id'];
}
