<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Lesson to: {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('teacher.lessons.store', $course) }}">
                        @csrf
                        <div>
                            <x-input-label for="title" value="Lesson Title" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="content" value="Lesson Content (Text, Links)" />
                            <textarea id="content" name="content" rows="8" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>Add Lesson</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>