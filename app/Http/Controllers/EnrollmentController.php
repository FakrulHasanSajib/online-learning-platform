<?php
namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
class EnrollmentController extends Controller{
  public function enroll(Course $course){
    $user=auth()->user();
    abort_unless($user->role==='student',403);
    $user->enrollments()->syncWithoutDetaching([$course->id]);
    return back()->with('ok','Enrolled successfully!');
  }
}