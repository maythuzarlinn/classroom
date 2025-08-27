<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function school_classes()
    {
        return $this->hasMany(Classroom::class, 'classroom_id');
    }
}
