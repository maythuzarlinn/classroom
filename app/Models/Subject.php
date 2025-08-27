<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['id','title','grade_id'];

    public function grades()
    {
        return $this->hasMany(Grade::class, 'grade_id');
    }

    public function school_classes()
    {
        return $this->hasMany(SchoolClass::class, 'subject_id');
    }
}
