<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold">{{ $course->title }}</h3>
                    <p class="text-md text-gray-600 my-2">Created by: {{ $course->teacher->name }}</p>
                    <p class="mt-4">{{ $course->description }}</p>
                    
                    @auth
                        @if (Auth::user()->role == 'student' && !Auth::user()->enrollments->contains($course))
                            <form action="{{ route('courses.enroll', $course) }}" method="POST" class="mt-6">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Enroll Now
                                </button>
                            </form>
                        @elseif(Auth::user()->enrollments->contains($course))
                            <p class="mt-6 text-green-600 font-bold">You are enrolled in this course.</p>
                            <!-- Ekhane Course er Lesson gulo dekhano jabe -->
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-block mt-6 text-indigo-600">Login to Enroll</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>