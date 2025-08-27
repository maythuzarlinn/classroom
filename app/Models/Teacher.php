<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact'];

    public function school_classes()
    {
        return $this->hasMany(SchoolClass::class, 'teacher_id');
    }
}
