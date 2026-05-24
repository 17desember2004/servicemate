<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\BengkelController;
use App\Http\Controllers\SettingController;

// Landing Page
Route::get('/', fn() => view('landing'));

// Auth
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('vehicles', VehicleController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('reminders', ReminderController::class);
    Route::patch('/reminders/{id}/read', [ReminderController::class, 'markRead'])->name('reminders.read');
    Route::resource('histories', HistoryController::class);
    Route::get('/bengkel', [BengkelController::class, 'index'])->name('bengkel.index');
    Route::get('/bengkel/{id}', [BengkelController::class, 'show'])->name('bengkel.show');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::put('/settings/password', [SettingController::class, 'updatePassword'])->name('settings.password');
});