<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_materials', 'material_id', 'course_id');
    }
}
