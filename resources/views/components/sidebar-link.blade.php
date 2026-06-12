@props([
    'active' => false,
    'href' => 'javascript:void(0)'
])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'flex items-center gap-4 px-5 py-3.5 rounded-2xl font-bold text-sm transition-all duration-200 ' . ($active ? 'bg-[#e6f6f1] text-[#008f5d]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700')]) }}>
    {{ $slot }}
</a>
