@props(['title' => 'Student Portal'])
<!doctype html>
<html lang="en" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f8fafc">
    <title>{{ $title }} · Course Portal</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="min-h-full">
        <header class="border-b border-slate-200 bg-white">
            <nav class="mx-auto flex max-w-6xl items-center justify-between px-5 py-4 sm:px-8" aria-label="Main navigation">
                <a href="{{ route('courses.index') }}" class="flex items-center gap-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-indigo-600 text-lg font-bold text-white">C</span>
                    <span>
                        <span class="block text-sm font-bold tracking-tight text-slate-900">Course Portal</span>
                        <span class="block text-xs text-slate-500">Student dashboard</span>
                    </span>
                </a>
                <div class="flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('courses.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">Courses</a>
                    <a href="{{ route('courses.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:px-4">
                        <span aria-hidden="true">＋</span><span class="hidden sm:inline">Add course</span><span class="sm:hidden">Add</span>
                    </a>
                </div>
            </nav>
        </header>

        <main class="mx-auto max-w-6xl px-5 py-8 sm:px-8 sm:py-12">
            @if (session('status'))
                <div role="status" class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-sm">
                    <span aria-hidden="true" class="mt-0.5">✓</span><p>{{ session('status') }}</p>
                </div>
            @endif

            {{ $slot }}
        </main>
        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto max-w-6xl px-5 py-5 text-xs text-slate-500 sm:px-8">Course Portal <span aria-hidden="true">·</span> Manage your course catalog</div>
        </footer>
    </div>
</body>

</html>
