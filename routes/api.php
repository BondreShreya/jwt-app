<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DepartmentController as APIDepartmentController;
use App\Http\Controllers\API\EmployeeController as APIEmployeeController;

// Public API Routes (no auth)
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Protected API Routes (JWT Auth Required)
Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('departments', APIDepartmentController::class);
    Route::apiResource('employees', APIEmployeeController::class);
});
