@props([
    'text' => '',
    'variant' => 'gold',
    'size' => 'sm',
    'full' => false,
    'successText' => 'Copiado!',
    'duration' => 2000
])

<x-button 
    type="button"
    onclick="ClipboardHelper.copy(this, '{{ e($text) }}', '{{ e($successText) }}', {{ $duration }})"
    :variant="$variant"
    :size="$size"
    :full="$full"
    {{ $attributes }}
>
    {{ $slot }}
</x-button>
