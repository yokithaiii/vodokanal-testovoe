<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'lastname',
        'age',
        'email',
        'phone',
        'unknown_field',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }
}
