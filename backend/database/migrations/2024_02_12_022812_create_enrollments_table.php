<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id')->nullable();
            $table->index('student_id', 'enrollment_student_idx');
            $table->foreign('student_id', 'enrollment_student_fk')->references('id')->on('students');

            $table->unsignedBigInteger('course_id')->nullable();
            $table->index('course_id', 'enrollment_course_idx');
            $table->foreign('course_id', 'enrollment_course_fk')->references('id')->on('courses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
