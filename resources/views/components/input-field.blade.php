@props(['label', 'id', 'type' => 'text', 'placeholder' => '', 'required' => false, 'name' => ''])

<div>
    <div class="flex justify-between items-center mb-2">
        <label for="{{ $id }}" class="block text-sm font-medium text-slate-700">{{ $label }}</label>
        {{ $rightLabel ?? '' }}
    </div>
    <input 
        type="{{ $type }}" 
        id="{{ $id }}" 
        name="{{ $name ?: $id }}" 
        {{ $required ? 'required' : '' }} 
        placeholder="{{ $placeholder }}" 
        {{ $attributes->merge(['class' => 'w-full px-6 py-4 rounded-full bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200']) }}
    >
</div>
