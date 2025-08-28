<?php
namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
        
class LessonController extends Controller {
    public function create(Course $course) { return view('teacher.lessons.create', compact('course')); }
    public function store(Request $request, Course $course) {
        $request->validate(['title' => 'required', 'content' => 'required']);
        $course->lessons()->create($request->all());
        return redirect()->route('courses.show', $course)->with('success', 'Lesson added successfully.');
    }
    public function complete(Lesson $lesson) {
        $user = Auth::user();
        if (!$user->completedLessons->contains($lesson)) {
            $user->completedLessons()->attach($lesson->id);
        }
        return back()->with('success', 'Lesson marked as complete!');
    }
    public function uncomplete(Lesson $lesson) {
        $user = Auth::user();
        if ($user->completedLessons->contains($lesson)) {
            $user->completedLessons()->detach($lesson->id);
        }
        return back()->with('success', 'Lesson marked as incomplete.');
    }

    public function show(Lesson $lesson) {
        $isCompleted = Auth::check() ? Auth::user()->hasCompleted($lesson) : false;
        return view('lessons.show', compact('lesson', 'isCompleted'));
    }
}