<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Courses
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($courses as $course)
                            <div class="p-4 border rounded-lg">
                                <h3 class="text-lg font-bold">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-600">By: {{ $course->teacher->name }}</p>
                                <p class="mt-2">{{ Str::limit($course->description, 100) }}</p>
                                <a href="{{ route('courses.show', $course) }}" class="inline-block mt-4 text-indigo-600 hover:text-indigo-900">View Course</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>