@props([
    'hover' => false,
])

@php
    $baseClass = 'bg-white/95 backdrop-blur-md border border-slate-100/80 rounded-[2.5rem] p-8 lg:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.015)] transition-all duration-300';
    $hoverClass = $hover ? 'hover:-translate-y-1 hover:shadow-[0_15px_35px_-5px_rgba(0,0,0,0.04)] cursor-pointer' : '';
@endphp

<div {{ $attributes->merge(['class' => $baseClass . ' ' . $hoverClass]) }}>
    {{ $slot }}
</div>
