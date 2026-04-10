<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Student routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');
});

// Teacher routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherDashboard::class, 'index'])->name('dashboard');
    Route::get('/my-classes', [TeacherDashboard::class, 'myClasses'])->name('my-classes');
    Route::get('/my-classes/class-a', [TeacherDashboard::class, 'classStudents'])->name('class-students');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
