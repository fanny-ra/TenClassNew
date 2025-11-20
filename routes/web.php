<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\StudyGroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    // Tampilkan form pendaftaran
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    // Proses pendaftaran
    Route::post('/register', [AuthController::class, 'register']);

    // Tampilkan form login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Proses login
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    // Proses logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Resource Routes yang memerlukan autentikasi untuk CRUD

    // CRUD Jadwal
    Route::resource('schedules', SchedulesController::class);

    // CRUD Grup Belajar
    Route::resource('studygroups', StudyGroupController::class);
});

Route::resource('studygroups', StudyGroupController::class);
