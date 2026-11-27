<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.submit');
});

// Authenticated routes
Route::middleware('auth')->group(function () {

   Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    // Patient Management
    Route::get('/patients', [PatientController::class, 'index'])
        ->name('patients.index');

    Route::get('/patients/create', [PatientController::class, 'create'])
        ->name('patients.create');

    Route::post('/patients', [PatientController::class, 'store'])
        ->name('patients.store');

    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])
        ->name('patients.destroy');

     // Doctor Management
    Route::resource('doctors', DoctorController::class);

    // Appointment Management
    Route::resource('appointments', AppointmentController::class);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
