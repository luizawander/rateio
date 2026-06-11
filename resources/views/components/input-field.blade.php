@props(['label', 'id', 'type' => 'text', 'placeholder' => '', 'required' => false, 'name' => ''])

@php
    $fieldName = $name ?: $id;
    $hasError = $errors->has($fieldName);
@endphp

<div>
    <div class="flex justify-between items-center mb-2">
        <label for="{{ $id }}" class="block text-sm font-medium text-slate-700">{{ $label }}</label>
        {{ $rightLabel ?? '' }}
    </div>
    <input 
        type="{{ $type }}" 
        id="{{ $id }}" 
        name="{{ $fieldName }}" 
        {{ $required ? 'required' : '' }} 
        placeholder="{{ $placeholder }}" 
        {{ $attributes->merge(['class' => 'w-full px-6 py-4 rounded-full bg-slate-50 border text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-4 transition-all duration-200 ' . ($hasError ? '!border-rose-300 focus:!border-rose-500 focus:!ring-rose-500/10' : 'border-slate-200 focus:border-emerald-500 focus:ring-emerald-500/10')]) }}
    >
    @error($fieldName)
        <p class="mt-1.5 text-xs font-semibold text-rose-600 pl-4">{{ $message }}</p>
    @enderror
</div>
