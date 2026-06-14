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

    <x-new-group-modal :group-types="$groupTypes" />
</x-app-layout>
