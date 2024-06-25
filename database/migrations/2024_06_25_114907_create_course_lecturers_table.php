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
        Schema::create('course_lecturers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('lecturer_id');
            $table->uuid('course_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lecturer_id')
                ->references('id')
                ->on('lecturers')
                ->onUpdate('no action')
                ->onDelete('no action');
            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_lecturers');
    }
};
