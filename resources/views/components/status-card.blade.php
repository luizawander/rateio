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

    $iconName = $isSuccess ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle';
@endphp

<div class="flex flex-col items-center text-center space-y-6">
    <div class="w-16 h-16 rounded-full {{ $iconColors }} flex items-center justify-center border">
        <x-dynamic-component :component="$iconName" class="w-8 h-8" />
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
