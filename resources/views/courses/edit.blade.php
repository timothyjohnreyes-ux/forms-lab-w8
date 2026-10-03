<x-layout title="Edit course">
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('courses.show', $course) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-indigo-700"><span aria-hidden="true">←</span> Back to course</a>
        <div class="mb-7 mt-5">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-indigo-600">{{ $course->code }}</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">Edit course</h1>
            <p class="mt-2 text-sm leading-6 text-slate-600">Update the course details and save your changes.</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
            @include('courses._form')
        </div>
    </div>
</x-layout>
