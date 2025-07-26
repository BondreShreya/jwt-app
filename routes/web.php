<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

// Default Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Admin Routes
Route::middleware(['auth'])->group(function () {



    // Admin Department & Employee Routes
    Route::prefix('admin')->group(function () {
        Route::resource('departments', DepartmentController::class);
        Route::resource('employees', EmployeeController::class);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Export Excel Route
        Route::get('employees/export', [EmployeeController::class, 'export'])->name('employees.export');
    });

});

// Auth scaffolding (login, register, etc.)
require __DIR__ . '/auth.php';
