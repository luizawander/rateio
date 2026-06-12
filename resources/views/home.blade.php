<x-app-layout title="Início" active="home">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <x-page-title class="!mb-0">Painel geral</x-page-title>
        <div class="flex flex-wrap items-center gap-3 lg:absolute lg:top-[130px] lg:right-[120px]">
            <x-button variant="pastel-green" :full="false" size="sm">
                Convites pendentes
            </x-button>
            <x-button variant="gold" :full="false" size="sm">
                + Novo grupo
            </x-button>
        </div>
    </div>
</x-app-layout>
