<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Teacher Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Metric Cards: Total Courses & Total Students --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">মোট কোর্স</div>
                            {{-- এখানে ভেরিয়েবলের নাম পরিবর্তন করা হয়েছে --}}
                            <div class="mt-1 text-4xl font-extrabold text-gray-900 dark:text-gray-100">{{ $totalCourses }}</div>
                        </div>
                        <i class="fa-solid fa-graduation-cap text-5xl text-blue-500/50"></i>
                    </div>
                </div>
            
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">মোট শিক্ষার্থী</div>
                            <div class="mt-1 text-4xl font-extrabold text-gray-900 dark:text-gray-100">{{ $totalStudents }}</div>
                        </div>
                        <i class="fa-solid fa-users text-5xl text-green-500/50"></i>
                    </div>
                </div>
            </div>

            {{-- My Recent Courses Section --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">আমার কোর্সগুলো</h3>
                    <a href="{{ route('teacher.courses.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fa-solid fa-plus mr-2"></i> নতুন কোর্স তৈরি করুন
                    </a>
                </div>

                @if ($recentCourses->isEmpty())
                    {{-- If no courses exist --}}
                    <div class="text-center py-12">
                        <p class="text-gray-500 dark:text-gray-400">আপনি এখনো কোনো কোর্স তৈরি করেননি।</p>
                        <a href="{{ route('teacher.courses.create') }}" class="mt-4 inline-block text-blue-600 hover:underline font-semibold">
                            প্রথম কোর্স তৈরি করে শুরু করুন!
                        </a>
                    </div>
                @else
                    {{-- If courses exist, loop through them --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($recentCourses as $course)
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 shadow-sm">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $course->title }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ Str::limit($course->description, 50) }}</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                        শিক্ষার্থী: {{ $course->enrollments_count }} জন
                                    </span>
                                    <a href="#" class="text-sm text-blue-600 hover:underline">দেখুন</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>