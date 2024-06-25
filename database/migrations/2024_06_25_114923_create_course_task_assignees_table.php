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
        Schema::create('course_task_assignees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('course_task_id');
            $table->uuid('student_id');
            $table->string('task');
            $table->json('style')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('course_task_id')
                ->references('id')
                ->on('course_tasks')
                ->onUpdate('no action')
                ->onDelete('no action');
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onUpdate('no action')
                ->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_task_assignees');
    }
};
