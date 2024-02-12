<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseMaterialController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'ping' => PingController::class,
    'courses' => CourseController::class,
    'enrollments' => EnrollMentController::class,
    'teachers' => TeacherController::class,
    'students' => StudentController::class,
    'materials' => MaterialController::class,
    'course_materials' => CourseMaterialController::class,
]);
