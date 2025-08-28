<?php
namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
    

class CourseController extends Controller {
  public function index(){
    $courses=Course::with('teacher')->latest()->get();
    return view('courses.index',compact('courses'));
  }
  public function show(Course $course){
    return view('courses.show',compact('course'));
  }
  public function create(){
    abort_unless(auth()->user()->role==='teacher',403);
    return view('teacher.courses.create');
  }
  public function store(Request $r){
    abort_unless(auth()->user()->role==='teacher',403);
    auth()->user()->courses()->create($r->validate(['title'=>'required','description'=>'required']));
    return redirect()->route('dashboard');
  }
}