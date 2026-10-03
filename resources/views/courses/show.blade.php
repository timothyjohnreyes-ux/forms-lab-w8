<x-layout :title="$course->title">
    <div class="mx-auto max-w-4xl">
        <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-indigo-700"><span aria-hidden="true">←</span> All courses</a>
        <article class="mt-5 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="relative aspect-[16/7] bg-gradient-to-br from-indigo-600 to-violet-500">
                @if ($course->image_path)
                    <img src="{{ asset('storage/' . $course->image_path) }}" alt="Course image for {{ $course->title }}" class="size-full object-cover">
                @else
                    <div class="flex size-full items-center justify-center text-6xl font-bold tracking-wide text-white/90">{{ \Illuminate\Support\Str::substr($course->code, 0, 2) }}</div>
                @endif
                <span class="absolute left-5 top-5 rounded-full px-3 py-1.5 text-xs font-semibold shadow-sm {{ $course->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-white/90 text-slate-600' }}">{{ $course->is_active ? 'Active course' : 'Inactive course' }}</span>
            </div>
            <div class="p-6 sm:p-9">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.16em] text-indigo-600">{{ $course->code }}</p>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">{{ $course->title }}</h1>
                    </div>
                    <a href="{{ route('courses.edit', $course) }}" class="inline-flex w-fit items-center justify-center rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-700">Edit course</a>
                </div>
                <dl class="mt-8 grid gap-4 rounded-2xl bg-slate-50 p-5 sm:grid-cols-2">
                    <div><dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Instructor</dt><dd class="mt-1 text-sm font-medium text-slate-900">{{ $course->instructor?->name ?? 'Not assigned' }}</dd></div>
                    <div><dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Course units</dt><dd class="mt-1 text-sm font-medium text-slate-900">{{ $course->units }} units</dd></div>
                </dl>
                <section class="mt-8">
                    <h2 class="text-base font-semibold text-slate-900">About this course</h2>
                    <p class="mt-3 whitespace-pre-line text-sm leading-7 text-slate-600">{{ $course->description ?: 'No description has been added for this course yet.' }}</p>
                </section>
                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="mt-10 border-t border-slate-100 pt-6" onsubmit="return confirm('Delete this course? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-lg px-3 py-2 text-sm font-semibold text-rose-700 hover:bg-rose-50 focus:outline-none focus:ring-2 focus:ring-rose-500">Delete course</button>
                </form>
            </div>
        </article>
    </div>
</x-layout>
