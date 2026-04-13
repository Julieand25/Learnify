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
    Route::get('/learning-module', [StudentDashboard::class, 'learningModule'])->name('learning-module');
    Route::get('/learning-module/physics', [StudentDashboard::class, 'physicsNotes'])->name('physics-notes');
    Route::get('/learning-module/physics/resistance', [StudentDashboard::class, 'chapterResistance'])->name('chapter.resistance');
    Route::get('/quiz', [StudentDashboard::class, 'classQuiz'])->name('quiz');
    Route::get('/learning-module/search-class', [StudentDashboard::class, 'searchClass'])->name('class.search');
    Route::post('/learning-module/enroll', [StudentDashboard::class, 'enrollClass'])->name('class.enroll');
    Route::delete('/learning-module/{classRoom}', [StudentDashboard::class, 'unenrollClass'])->name('class.unenroll');
});

// Teacher routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherDashboard::class, 'index'])->name('dashboard');
    Route::get('/my-classes', [TeacherDashboard::class, 'myClasses'])->name('my-classes');
    Route::post('/my-classes', [TeacherDashboard::class, 'storeClass'])->name('my-classes.store');
    Route::put('/my-classes/{classRoom}', [TeacherDashboard::class, 'updateClass'])->name('my-classes.update');
    Route::delete('/my-classes/{classRoom}', [TeacherDashboard::class, 'destroyClass'])->name('my-classes.destroy');
    Route::get('/my-classes/class-a', [TeacherDashboard::class, 'classStudents'])->name('class-students');
    Route::get('/my-classes/class-a/notes-progress', [TeacherDashboard::class, 'notesProgress'])->name('notes-progress');
    Route::get('/my-classes/class-a/quiz-progress', [TeacherDashboard::class, 'quizProgress'])->name('quiz-progress');
    Route::get('/edit-quiz', [TeacherDashboard::class, 'editQuiz'])->name('edit-quiz');
    Route::get('/edit-quiz/{classRoom}', [TeacherDashboard::class, 'editQuizClass'])->name('edit-quiz.class');
    Route::get('/settings', [TeacherDashboard::class, 'settings'])->name('settings');
    Route::put('/settings/profile', [TeacherDashboard::class, 'updateProfile'])->name('settings.update-profile');
    Route::put('/settings/password', [TeacherDashboard::class, 'updatePassword'])->name('settings.update-password');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
