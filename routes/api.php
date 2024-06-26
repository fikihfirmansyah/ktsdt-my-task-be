<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\CourseLecturersController;
use App\Http\Controllers\API\CourseStudentsController;
use App\Http\Controllers\API\CourseTaskAssigneeController;
use App\Http\Controllers\API\CourseTaskController;
use App\Http\Controllers\API\LecturerController;
use App\Http\Controllers\API\StudentController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Add suffix v1
Route::prefix('auth')->group(function () {
// Route for registration
    Route::post('/register', [AuthController::class, 'register']);

// Route for login
    Route::post('/login', [AuthController::class, 'login']);

// Route for logout
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});

// Route list using sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
// Route for me
        Route::get('/me', [AuthController::class, 'me']);
    });

    Route::prefix('v1')->group(function () {
        // Route for me
        Route::apiResource('courses', CourseController::class);
        Route::apiResource('students', StudentController::class);
        Route::apiResource('lecturers', LecturerController::class);

        Route::prefix('courses')->group(function () {
            Route::post('/{course}/lecturers', [CourseLecturersController::class, 'assignLecturer']);
            Route::delete('/{course}/lecturers/{lecturer}', [CourseLecturersController::class, 'removeLecturer']);

            Route::post('/{course}/students', [CourseStudentsController::class, 'enrollStudent']);
            Route::delete('/{course}/students/{student}', [CourseStudentsController::class, 'removeStudent']);
        });

        Route::apiResource('course-tasks', CourseTaskController::class);
        Route::apiResource('course-task-assignees', CourseTaskAssigneeController::class);

    });

});
