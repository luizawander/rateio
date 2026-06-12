@props([
    'label',
    'id',
    'checked' => false,
    'name' => '',
])

@php
    $fieldName = $name ?: $id;
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center justify-between py-2 border-b border-slate-100 last:border-0 last:pb-0']) }}>
    <span class="text-sm font-semibold text-slate-700">{{ $label }}</span>
    <label for="{{ $id }}" class="relative inline-flex items-center cursor-pointer select-none">
        <input 
            type="checkbox" 
            id="{{ $id }}" 
            name="{{ $fieldName }}" 
            class="sr-only peer" 
            {{ $checked ? 'checked' : '' }}
        >
        <div class="w-11 h-6 bg-slate-200/80 rounded-full peer peer-checked:bg-emerald-500 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
    </label>
</div>
