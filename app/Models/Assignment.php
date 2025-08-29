<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id','title','description','deadline','day_left','grade_id','subject_id','teacher_id','status','created_at','updated_at','deleted_at'];
}
