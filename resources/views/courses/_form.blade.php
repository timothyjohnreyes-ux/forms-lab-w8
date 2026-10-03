@php($editing = $course->exists)

<form action="{{ $editing ? route('courses.update', $course) : route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-7">
    @csrf
    @if ($editing) @method('PUT') @endif

    @if ($errors->any())
        <div role="alert" class="rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-900">
            <p class="font-semibold">Please check the information below.</p>
            <ul class="mt-2 list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="grid gap-6 sm:grid-cols-2">
        <x-forms.input name="code" label="Course code" :value="$course->code" placeholder="e.g. WEBDEV3" required maxlength="20" hint="Use a short, unique code students can recognize." />
        <x-forms.input name="title" label="Course title" :value="$course->title" placeholder="e.g. Web Framework Development" required maxlength="255" />

        <div class="space-y-2">
            <label for="instructor_id" class="block text-sm font-semibold text-slate-800">Instructor <span class="text-xs font-normal text-slate-500">(optional)</span></label>
            <select id="instructor_id" name="instructor_id" class="block w-full rounded-xl border {{ $errors->has('instructor_id') ? 'border-rose-400' : 'border-slate-300' }} bg-white px-3.5 py-3 text-sm text-slate-900 shadow-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" @if($errors->has('instructor_id')) aria-invalid="true" aria-describedby="instructor_id-error" @endif>
                <option value="">Select an instructor</option>
                @foreach ($instructors as $instructor)
                    <option value="{{ $instructor->id }}" @selected((string) old('instructor_id', $course->instructor_id) === (string) $instructor->id)>{{ $instructor->name }}</option>
                @endforeach
            </select>
            @error('instructor_id')<p id="instructor_id-error" class="text-sm font-medium text-rose-700">{{ $message }}</p>@enderror
        </div>

        <x-forms.input name="units" label="Units" type="number" :value="$course->units ?? 3" min="1" max="255" required />

        <div class="space-y-2 sm:col-span-2">
            <label for="description" class="block text-sm font-semibold text-slate-800">Description <span class="text-xs font-normal text-slate-500">(optional)</span></label>
            <textarea id="description" name="description" rows="4" maxlength="5000" placeholder="What will students learn in this course?" class="block w-full resize-y rounded-xl border {{ $errors->has('description') ? 'border-rose-400' : 'border-slate-300' }} bg-white px-3.5 py-3 text-sm leading-6 text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100" @if($errors->has('description')) aria-invalid="true" aria-describedby="description-error" @endif>{{ old('description', $course->description) }}</textarea>
            @error('description')<p id="description-error" class="text-sm font-medium text-rose-700">{{ $message }}</p>@enderror
        </div>

        <div class="space-y-3 sm:col-span-2">
            <x-forms.input name="image" label="Course image" type="file" accept="image/jpeg,image/png,image/webp" hint="Optional. JPG, PNG, or WebP; maximum 2 MB." />
            @if ($course->image_path)
                <div class="flex items-center gap-4 rounded-xl bg-slate-50 p-3">
                    <img src="{{ asset('storage/' . $course->image_path) }}" alt="Current image for {{ $course->title }}" class="size-16 rounded-lg object-cover">
                    <p class="text-xs text-slate-600">Current image is kept when you leave this field empty.</p>
                </div>
            @endif
        </div>

        <div class="sm:col-span-2">
            <input type="hidden" name="is_active" value="0">
            <label for="is_active" class="flex cursor-pointer items-start gap-3 rounded-xl border border-slate-200 p-4 transition hover:border-indigo-200 hover:bg-indigo-50/50">
                <input id="is_active" name="is_active" type="checkbox" value="1" @checked((bool) old('is_active', $course->exists ? $course->is_active : true)) class="mt-0.5 size-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <span><span class="block text-sm font-semibold text-slate-900">Course is active</span><span class="mt-1 block text-xs leading-5 text-slate-500">Active courses are available in the catalog.</span></span>
            </label>
            @error('is_active')<p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:items-center sm:justify-between">
        <a href="{{ $editing ? route('courses.show', $course) : route('courses.index') }}" class="inline-flex justify-center rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-100">Cancel</a>
        <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">{{ $editing ? 'Save changes' : 'Create course' }}</button>
    </div>
</form>
