<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // যদি ইউজার টিচার হয়
        if ($user->role === 'teacher') {
            // টিচারের কোর্সের সংখ্যা এবং সাম্প্রতিক ৫টি কোর্স বের করা হচ্ছে
            $totalCourses = $user->courses()->count();
            $recentCourses = $user->courses()
                                   ->latest() // সবচেয়ে নতুন কোর্সগুলো আগে দেখাবে
                                   ->withCount('students') // প্রতিটি কোর্সের শিক্ষার্থী সংখ্যা
                                   ->take(5) // শুধু ৫টি কোর্স নেবে
                                   ->get();

            // টিচারের কোর্সে মোট এনরোল করা শিক্ষার্থীর সংখ্যা
            $totalStudents = $recentCourses->sum('students_count');

            return view('teacher.dashboard', [
                'recentCourses' => $recentCourses,
                'totalCourses' => $totalCourses,
                'totalStudents' => $totalStudents,
            ]);
        }
        
        // যদি ইউজার স্টুডেন্ট হয়
        if ($user->role === 'student') {
            // শিক্ষার্থীর এনরোল করা কোর্সের সংখ্যা এবং তালিকা
            $enrolledCourses = $user->enrollments()->with('lessons')->withCount('lessons')->get();
            $enrolledCount = $enrolledCourses->count();
            
            // শিক্ষার্থীর সব সম্পন্ন করা লেসনের ID গুলো একটি মাত্র কোয়েরিতে নেওয়া হচ্ছে
            // এটি লুপের মধ্যে বারবার কোয়েরি করা থেকে বিরত থাকবে, যা পারফরম্যান্স বাড়ায়।
            $completedLessonIds = $user->completedLessons()->pluck('lesson_id')->toArray();

            // মোট লেসন এবং সম্পন্ন করা লেসনের সংখ্যা বের করা
            $totalLessonsCount = $enrolledCourses->sum('lessons_count');
            $completedLessonsCount = count($completedLessonIds);

            // সামগ্রিক প্রগ্রেস ক্যালকুলেশন
            $overallProgress = ($totalLessonsCount > 0) ? round(($completedLessonsCount / $totalLessonsCount) * 100) : 0;
            
            // প্রত্যেক কোর্সের জন্য আলাদা প্রগ্রেস ক্যালকুলেশন
            foreach ($enrolledCourses as $course) {
                $total = $course->lessons_count;
                if ($total > 0) {
                    // এই কোর্সের লেসন ID গুলো এবং সম্পন্ন করা লেসন ID গুলো তুলনা করা হচ্ছে
                    $courseLessonIds = $course->lessons->pluck('id')->toArray();
                    $completedInCourse = count(array_intersect($completedLessonIds, $courseLessonIds));
                    $course->progress = round(($completedInCourse / $total) * 100);
                } else {
                    $course->progress = 0;
                }
            }
            
            return view('student.dashboard', compact('enrolledCourses', 'enrolledCount', 'overallProgress'));
        }

        // যদি ইউজার কোনো নির্দিষ্ট রোল না থাকে
        return view('dashboard');
    }
}