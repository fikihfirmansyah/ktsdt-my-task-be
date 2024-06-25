<?php

use App\Http\Controllers\API\AuthController;
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
});
