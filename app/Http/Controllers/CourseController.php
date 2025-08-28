<?php
namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller {
    public function index() {
        $courses = Course::with('teacher')->latest()->paginate(9);
        return view('courses.index', compact('courses'));
    }
    public function create() { return view('teacher.courses.create'); }
    public function store(Request $request) {
        $request->validate(['title' => 'required|max:255', 'description' => 'required']);
        Auth::user()->courses()->create($request->all());
        return redirect()->route('dashboard')->with('success', 'Course created successfully!');
    }
    public function show(Course $course) {
        $isEnrolled = Auth::check() ? Auth::user()->enrollments->contains($course) : false;
        return view('courses.show', compact('course', 'isEnrolled'));
    }
    // edit and update methods can be added similarly
}