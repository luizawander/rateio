@props([
    'type' => 'success',
    'title' => null,
    'subtitle' => null,
])

@php
    $isSuccess = $type === 'success';

    $iconColors = $isSuccess
        ? 'bg-emerald-50 text-emerald-600 border-emerald-500/10'
        : 'bg-rose-50 text-rose-600 border-rose-500/10';

    $titleColors = $isSuccess
        ? 'text-emerald-600'
        : 'text-rose-600';

    $iconPath = $isSuccess
        ? 'm4.5 12.75 6 6 9-13.5'
        : 'M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z';
@endphp

<div class="flex flex-col items-center text-center space-y-6">
    <div class="w-16 h-16 rounded-full {{ $iconColors }} flex items-center justify-center border">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconPath }}" />
        </svg>
    </div>

    <div>
        <h2 class="text-2xl font-black {{ $titleColors }} tracking-tight">{{ $title }}</h2>
        @if($subtitle)
            <p class="text-sm text-slate-500 mt-2">{{ $subtitle }}</p>
        @endif
    </div>

    @if($slot->isNotEmpty())
        <div class="w-full pt-4 flex flex-col gap-3">
            {{ $slot }}
        </div>
    @endif

    <x-button type="button" onclick="window.location.reload()" variant="turquoise-blue" :full="true" size="sm" class="py-3">
        Continuar
    </x-button>
</div>
