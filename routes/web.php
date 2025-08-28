<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;

Route::get('/',[CourseController::class,'index']);
Route::resource('courses',CourseController::class)->only(['index','show','create','store']);
Route::post('courses/{course}/enroll',[EnrollmentController::class,'enroll'])->middleware('auth')->name('courses.enroll');
Route::get('/dashboard',[DashboardController::class,'index'])->middleware('auth')->name('dashboard');
require __DIR__.'/auth.php';