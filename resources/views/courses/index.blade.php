<x-layout title="Courses">
    <section class="mb-8 flex flex-col gap-5 sm:mb-10 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="mb-2 text-sm font-semibold uppercase tracking-[0.16em] text-indigo-600">Academic catalog</p>
            <h1 class="text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">Courses</h1>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">Browse and manage the courses available in your student portal.</p>
        </div>
        <a href="{{ route('courses.create') }}" class="inline-flex w-fit items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"><span aria-hidden="true">＋</span> Add a course</a>
    </section>
    <div class="mb-5 flex items-center justify-between rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-sm">
        <div><p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Catalog overview</p><p class="mt-1 text-sm text-slate-700"><span class="font-bold text-slate-950">{{ $courses->count() }}</span> {{ \Illuminate\Support\Str::plural('course', $courses->count()) }}</p></div>
        <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">Current term</span>
    </div>
    @if ($courses->isEmpty())
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
            <span class="mx-auto mb-4 flex size-12 items-center justify-center rounded-2xl bg-indigo-50 text-xl text-indigo-600" aria-hidden="true">▤</span>
            <h2 class="text-lg font-semibold text-slate-900">No courses yet</h2>
            <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-600">Add the first course to start building your catalog.</p>
            <a href="{{ route('courses.create') }}" class="mt-6 inline-flex rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">Add your first course</a>
        </div>
    @else
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ($courses as $course)
            <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <a href="{{ route('courses.show', $course) }}" class="relative block aspect-[16/9] overflow-hidden bg-gradient-to-br from-indigo-100 via-slate-100 to-sky-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-label="View {{ $course->title }}">
                    @if ($course->image_path)
                        <img src="{{ asset('storage/' . $course->image_path) }}" alt="Course image for {{ $course->title }}" class="size-full object-cover transition duration-300 group-hover:scale-[1.03]">
                    @else
                        <div class="flex size-full items-center justify-center bg-gradient-to-br from-indigo-600 to-violet-500 text-4xl font-bold tracking-wide text-white/90">{{ \Illuminate\Support\Str::substr($course->code, 0, 2) }}</div>
                    @endif
                    <span class="absolute left-4 top-4 rounded-full px-3 py-1 text-xs font-semibold {{ $course->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $course->is_active ? 'Active' : 'Inactive' }}</span>
                </a>
                <div class="flex flex-1 flex-col p-5">
                    <div class="flex items-start justify-between gap-3"><div class="min-w-0"><p class="text-xs font-bold uppercase tracking-wider text-indigo-600">{{ $course->code }}</p><h2 class="mt-1 truncate text-lg font-semibold tracking-tight text-slate-950"><a class="hover:text-indigo-700" href="{{ route('courses.show', $course) }}">{{ $course->title }}</a></h2></div><span class="shrink-0 rounded-lg bg-slate-100 px-2.5 py-1.5 text-xs font-semibold text-slate-600">{{ $course->units }} units</span></div>
                    <p class="mt-3 line-clamp-2 min-h-10 text-sm leading-5 text-slate-600">{{ $course->description ?: 'No course description has been added.' }}</p>
                    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4"><span class="truncate pr-3 text-xs text-slate-500">{{ $course->instructor?->name ?? 'Instructor not assigned' }}</span><a href="{{ route('courses.edit', $course) }}" class="shrink-0 rounded-lg px-3 py-2 text-xs font-semibold text-indigo-700 hover:bg-indigo-50">Edit course <span aria-hidden="true">→</span></a></div>
                </div>
            </article>
        @endforeach
        </div>
    @endif
    {{--
    <ul>
        @foreach ($courses as $c)
            <li>
                <a href="{{ route('courses.show', $c) }}">
                    {{ $c->code }} — {{ $c->title }}
                </a>
            </li>
        @endforeach
    </ul> --}}
</x-layout>
