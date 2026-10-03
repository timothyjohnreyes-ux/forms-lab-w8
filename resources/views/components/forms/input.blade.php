@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'hint' => null,
    'required' => false,
])

@php($hasError = $errors->has($name))

<div class="space-y-2">
    <label for="{{ $name }}" class="block text-sm font-semibold text-slate-800">
        {{ $label }}
        @if ($required)<span class="text-rose-600" aria-hidden="true">*</span>@endif
    </label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        @if ($type !== 'file') value="{{ old($name, $value) }}" @endif
        @required($required)
        @if ($type === 'file') {{ $attributes->except(['class'])->merge(['class' => 'block w-full cursor-pointer rounded-xl border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:cursor-pointer file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500']) }} @else {{ $attributes->except(['class'])->merge(['class' => 'block w-full rounded-xl border bg-white px-3.5 py-3 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:ring-4 focus:ring-indigo-100 ' . ($hasError ? 'border-rose-400 focus:border-rose-500' : 'border-slate-300 focus:border-indigo-500')]) }} @endif
        @if ($hasError) aria-invalid="true" aria-describedby="{{ $name }}-error" @endif
    >
    @if ($hint)<p class="text-xs leading-5 text-slate-500">{{ $hint }}</p>@endif
    @error($name)<p id="{{ $name }}-error" class="text-sm font-medium text-rose-700">{{ $message }}</p>@enderror
</div>
