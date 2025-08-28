<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Learning Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Enrolled Courses Card -->
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="p-6 flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v11.494m-9-5.747h18" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Enrolled Courses</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $enrolledCount }}</p>
                        </div>
                    </div>
                </div>

                <!-- Overall Progress Card -->
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="p-6 flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Overall Progress</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $overallProgress }}%</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- My Learning Path -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">My Learning Path</h3>
                    <div class="space-y-4">
                    @forelse ($enrolledCourses as $course)
                        <div class="p-4 border rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="flex flex-col md:flex-row justify-between md:items-center">
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $course->title }}</h4>
                                    <p class="text-sm text-gray-500">by {{ $course->teacher->name }}</p>
                                </div>
                                <a href="{{ route('courses.show', $course) }}" class="mt-4 md:mt-0 inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-md hover:bg-indigo-700 text-center">
                                    Continue Learning
                                </a>
                            </div>
                            <!-- Progress Bar -->
                            <div class="mt-4">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700">Progress</span>
                                    <span class="text-sm font-medium text-gray-700">{{ $course->progress }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $course->progress }}%"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-gray-500">You are not enrolled in any courses yet.</p>
                            <a href="{{ route('courses.index') }}" class="mt-2 inline-block text-indigo-600 font-semibold hover:underline">Browse Courses Now</a>
                        </div>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>