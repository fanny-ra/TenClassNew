<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\StudyGroupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {

    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('studygroups', StudyGroupController::class);

    Route::resource('schedules', ScheduleController::class);

    // approval peminjaman (khusus sarpras)
    Route::put('/schedules/{schedule}/approve', [ScheduleController::class, 'approve'])
        ->name('schedules.approve');

    Route::put('/schedules/{schedule}/reject', [ScheduleController::class, 'reject'])
        ->name('schedules.reject');

    // pengembalian / selesai
    Route::put('/schedules/{schedule}/return', [ScheduleController::class, 'returnRoom'])
        ->name('schedules.return');

});
