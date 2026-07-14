@props([
    'group' => null,
])

@php
    $typeLabel = ucfirst($group->type);
    $memberCount = $group->members->count();

    $typeIcons = [
        'casa' => 'heroicon-o-home',
        'viagem' => 'heroicon-o-briefcase',
        'casal' => 'heroicon-o-heart',
    ];
    $iconName = $typeIcons[$group->type] ?? 'heroicon-o-light-bulb';
@endphp

<x-card hover class="!p-5">
    <div class="flex items-start justify-between gap-4 mb-3">
        <div class="flex items-center gap-3">
            <x-dynamic-component :component="$iconName" class="w-5 h-5 text-[#A17C00]" />
            <div>
                <h3 class="text-base font-black text-slate-900 tracking-tight">{{ $group->name }}</h3>
                <span class="text-xs font-bold text-[#A17C00] uppercase tracking-wide">{{ $typeLabel }}</span>
            </div>
        </div>
        <span class="text-xs font-semibold text-slate-400 whitespace-nowrap">
            {{ $group->created_at->diffForHumans() }}
        </span>
    </div>

    <div class="flex items-center justify-between pt-3 border-t border-slate-100">
        <div class="flex items-center gap-2">
            <x-heroicon-o-user-group class="w-4 h-4 text-slate-600" />
            <span class="text-sm font-semibold text-slate-600">{{ $memberCount }} {{ $memberCount === 1 ? 'membro' : 'membros' }}</span>
        </div>
    </div>
</x-card>
