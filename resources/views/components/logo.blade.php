@props([
    'size' => 'text-2xl'
])

<span {{ $attributes->merge(['class' => "logo-text font-black $size"]) }}>Rateio</span>
