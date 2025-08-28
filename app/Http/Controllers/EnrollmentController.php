<?php
namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
class EnrollmentController extends Controller {
    public function store(Course $course) {
        if (Auth::user()->enrollments()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'You are already enrolled.');
        }
        Auth::user()->enrollments()->attach($course->id);
        return redirect()->route('courses.show', $course)->with('success', 'Successfully enrolled!');
    }
}