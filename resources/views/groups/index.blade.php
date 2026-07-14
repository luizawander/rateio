<x-app-layout title="Grupos" active="groups">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <x-page-title class="!mb-0">Todos os grupos</x-page-title>
        <div class="flex flex-wrap items-center gap-3 lg:absolute lg:top-[130px] lg:right-[120px]">
            <x-button variant="pastel-green" :full="false" size="sm">
                Convites pendentes
            </x-button>
            <x-button id="open-new-group-modal" onclick="ModalDialog.open('new-group-modal')" variant="gold" :full="false" size="sm">
                + Novo grupo
            </x-button>
        </div>
    </div>

    @if($groups->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach($groups as $group)
                <x-group-card :group="$group" />
            @endforeach
        </div>
    @else
        <x-card>
            <div class="flex flex-col items-center text-center py-8">
                <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mb-4">
                    <x-heroicon-o-user-group class="w-8 h-8 text-slate-300" />
                </div>
                <h3 class="text-lg font-black text-slate-900 mb-1">Nenhum grupo ainda</h3>
                <p class="text-sm text-slate-500 mb-6">Crie seu primeiro grupo para começar a dividir despesas.</p>
                <x-button onclick="ModalDialog.open('new-group-modal')" variant="gold" :full="false" size="sm">
                    + Novo grupo
                </x-button>
            </div>
        </x-card>
    @endif

    @include('groups.partials.new-group-modal')
</x-app-layout>
