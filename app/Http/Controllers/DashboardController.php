<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {
  public function index(){
    $u=auth()->user();
    if($u->role==='teacher'){
        $courses=$u->courses()->withCount('students')->get();
        return view('dashboard.teacher',compact('u','courses'));
    }
    if($u->role==='student'){
        $courses=$u->enrollments()->with('teacher')->get();
        return view('dashboard.student',compact('u','courses'));
    }
  }
}