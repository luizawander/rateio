@props([
    'user' => null
])

@php
    $currentUser = $user ?? auth()->user();
@endphp

@if($currentUser)
    <div {{ $attributes->merge(['class' => 'flex items-center gap-3 min-w-0']) }}>
        @if ($currentUser->avatar)
            <img src="{{ $currentUser->avatar }}" class="w-10 h-10 rounded-full border border-slate-100 shadow-sm" alt="{{ $currentUser->name }}">
        @else
            <div class="w-10 h-10 rounded-full bg-[#e6f6f1] text-[#008f5d] flex items-center justify-center font-bold text-base border border-emerald-100 shadow-xs flex-shrink-0">
                {{ strtoupper(substr($currentUser->name, 0, 1)) }}
            </div>
        @endif
        <div class="flex flex-col min-w-0">
            <span class="text-sm font-bold text-slate-900 truncate">{{ $currentUser->name }}</span>
            <span class="text-xs text-slate-400 truncate">{{ $currentUser->email }}</span>
        </div>
    </div>
@endif
