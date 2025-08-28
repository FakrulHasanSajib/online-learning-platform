<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;

// Homepage will show all courses
Route::get('/', [CourseController::class, 'index'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// Authenticated users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Student specific routes
    Route::middleware('can:isStudent')->group(function() {
        Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('courses.enroll');
        Route::post('/lessons/{lesson}/complete', [LessonController::class, 'complete'])->name('lessons.complete');
    });
    
    // Teacher specific routes
    Route::middleware('can:isTeacher')->prefix('teacher')->name('teacher.')->group(function() {
        Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('courses/{course}', [CourseController::class, 'update'])->name('courses.update');
        
        Route::get('courses/{course}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
        Route::post('courses/{course}/lessons', [LessonController::class, 'store'])->name('lessons.store');
    });
});

require __DIR__.'/auth.php';