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
        if(!Schema::hasTable('course_materials')) {
            Schema::create('course_materials', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('course_id')->nullable();
                $table->index('course_id', 'course_material_course_idx');
                $table->foreign('course_id', 'course_material_course_fk')->references('id')->on('courses');
                
                $table->unsignedBigInteger('material_id')->nullable();
                $table->index('material_id', 'course_material_material_idx');
                $table->foreign('material_id', 'course_material_material_fk')->references('id')->on('materials');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_materials');
    }
};
