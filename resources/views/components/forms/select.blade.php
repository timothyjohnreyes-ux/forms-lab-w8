@props(['name', 'label', 'options' => [], 'selected' => null, 'placeholder' => 'None'])

@php($hasError = $errors->has($name))

<div class="space-y-2">
    <label for="{{ $name }}" class="block text-sm font-semibold text-slate-800">{{ $label }}</label>
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $attributes->except(['class'])->merge(['class' => 'block w-full rounded-xl border bg-white px-3.5 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:ring-4 focus:ring-indigo-100 ' . ($hasError ? 'border-rose-400 focus:border-rose-500' : 'border-slate-300 focus:border-indigo-500')]) }}
        @if ($hasError) aria-invalid="true" aria-describedby="{{ $name }}-error" @endif
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" @selected(old($name, $selected) == $value)>{{ $text }}</option>
        @endforeach
    </select>
    @error($name)<p id="{{ $name }}-error" class="text-sm font-medium text-rose-700">{{ $message }}</p>@enderror
</div>
