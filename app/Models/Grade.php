<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
    
    public function students()
    {
        return $this->hasMany(Student::class, 'grade_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'grade_id');
    }    
}
