@props([
    'variant' => 'gold',
])

@php
    $baseClass = 'w-full flex items-center justify-center py-4 rounded-full transition-all duration-300 hover:scale-[1.01] active:scale-[0.99] font-bold shadow-sm hover:shadow-md';
    
    $variantClasses = [
        'gold' => 'bg-[#FFEE8C] hover:bg-[#fbcd62] text-slate-800 border border-[#f5de82]',
        'white' => 'bg-white border border-slate-200/80 hover:border-slate-300 text-slate-700',
        'emerald' => 'bg-emerald-500 hover:bg-[#008f5d] text-white border border-emerald-600/10'
    ];

    $selectedClass = $variantClasses[$variant] ?? $variantClasses['gold'];
@endphp

<button {{ $attributes->merge(['class' => $baseClass . ' ' . $selectedClass]) }}>
    {{ $slot }}
</button>
