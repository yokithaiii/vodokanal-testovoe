<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CourseMaterialResource;
use App\Models\CourseMaterial;
use Illuminate\Http\Request;

class CourseMaterialController extends Controller
{
    public function index()
    {
        $course_materials = CourseMaterialResource::collection(CourseMaterial::all());

        return response()->json([
            'data' => $course_materials
        ], 200);
    }
}
