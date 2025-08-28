<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $course->title }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Session Messages -->
            @if(session('success')) <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div> @endif
            @if(session('error')) <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div> @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-3xl font-bold">{{ $course->title }}</h3>
                    <p class="text-md text-gray-600 my-2">By: {{ $course->teacher->name }}</p>
                    <p class="mt-4 text-gray-800 whitespace-pre-wrap border-t pt-4">{{ $course->description }}</p>
                    
                    <div class="mt-6 border-t pt-6">
                        @auth
                            @if(Gate::allows('isTeacher') && Auth::id() == $course->user_id)
                                <a href="{{ route('teacher.lessons.create', $course) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add New Lesson</a>
                            @elseif(!$isEnrolled)
                                <form action="{{ route('courses.enroll', $course) }}" method="POST"> @csrf <x-primary-button>Enroll Now</x-primary-button> </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold">Login to Enroll</a>
                        @endauth
                    </div>
                </div>
            </div>

            @if($isEnrolled || (Auth::check() && Auth::id() == $course->user_id))
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Course Lessons</h3>
                    <ul class="space-y-3">
                        @forelse($course->lessons as $lesson)
                        <li class="p-4 border rounded-md flex justify-between items-center @if(Auth::check() && Auth::user()->hasCompleted($lesson)) bg-green-50 border-green-300 @endif">
                            <div>
                                <h4 class="font-semibold">{{ $lesson->title }}</h4>
                                <!-- Add a link to view lesson content if needed -->
                            </div>
                            @if($isEnrolled)
                                @if(Auth::user()->hasCompleted($lesson))
                                    <span class="text-green-600 font-semibold flex items-center">
                                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        Completed
                                    </span>
                                @else
                                    <form action="{{ route('lessons.complete', $lesson) }}" method="POST">
                                        @csrf
                                        <button class="px-3 py-1 bg-gray-200 text-gray-800 text-sm rounded hover:bg-gray-300">Mark as Complete</button>
                                    </form>
                                @endif
                            @endif
                        </li>
                        @empty
                        <p class="text-gray-500">No lessons have been added to this course yet.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>