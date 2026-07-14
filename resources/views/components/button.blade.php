@props([
    'variant' => 'gold',
    'full' => true,
    'size' => 'md',
])

@php
    $widthClass = $full ? 'w-full' : '';
    
    $sizeClasses = [
        'sm' => 'px-6 py-2.5 text-sm',
        'md' => 'px-8 py-4 text-base',
        'lg' => 'px-10 py-5 text-lg',
    ];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];

    $baseClass = "flex items-center justify-center rounded-full transition-all duration-300 hover:scale-[1.01] active:scale-[0.99] font-bold shadow-sm hover:shadow-md $widthClass $sizeClass";
    
    $variantClasses = [
        'gold' => 'bg-[#FFEE8C] hover:bg-[#fbcd62] text-slate-800 border border-[#f5de82]',
        'white' => 'bg-white border border-slate-200/80 hover:border-slate-300 text-slate-700',
        'emerald' => 'bg-emerald-500 hover:bg-[#008f5d] text-white border border-emerald-600/10',
        'pastel-green' => 'bg-[#66DCB6] hover:bg-[#4ecd9e] text-slate-800 border border-[#57d4ad]',
        'turquoise-blue' => 'bg-[#26a4b6] hover:bg-[#1f8d9d] text-white border border-[#1f8d9d]/10',
    ];

    $selectedClass = $variantClasses[$variant] ?? $variantClasses['gold'];
@endphp

<button {{ $attributes->merge(['class' => $baseClass . ' ' . $selectedClass]) }}>
    {{ $slot }}
</button>
