<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'lastname',
        'age',
        'email',
        'phone',
    ];

    public function courses()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }
}
