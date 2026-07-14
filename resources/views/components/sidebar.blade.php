@props([
    'active' => 'home'
])

<aside id="sidebar-menu" class="fixed inset-y-0 left-0 z-50 w-72 bg-white p-8 flex flex-col gap-8 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:flex lg:h-fit lg:w-full lg:m-0 lg:rounded-[2.5rem] lg:border lg:border-slate-100/80 lg:shadow-[0_20px_50px_-15px_rgba(0,0,0,0.05)]">
    <div class="flex items-center justify-between">
        <x-user-profile />
        <button id="sidebar-close" class="lg:hidden p-2 rounded-xl text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-all cursor-pointer flex-shrink-0 ml-2" aria-label="Fechar menu">
            <x-heroicon-o-x-mark class="w-5 h-5" />
        </button>
    </div>

    <nav class="flex flex-col gap-1.5">
        <x-sidebar-link :href="route('home')" :active="$active === 'home'">
            <x-heroicon-o-home class="w-5 h-5" />
            <span>Início</span>
        </x-sidebar-link>

        <x-sidebar-link :href="route('groups')" :active="$active === 'groups'">
            <x-heroicon-o-user-group class="w-5 h-5" />
            <span>Grupos</span>
        </x-sidebar-link>

        <x-sidebar-link :href="route('installments')" :active="$active === 'installments'">
            <x-heroicon-o-credit-card class="w-5 h-5" />
            <span>Parcelas</span>
        </x-sidebar-link>

        <x-sidebar-link :href="route('notifications')" :active="$active === 'notifications'">
            <x-heroicon-o-bell class="w-5 h-5" />
            <span>Avisos</span>
        </x-sidebar-link>

        <x-sidebar-link :href="route('settings')" :active="$active === 'settings'">
            <x-heroicon-o-cog-6-tooth class="w-5 h-5" />
            <span>Ajustes</span>
        </x-sidebar-link>

        <form action="/logout" method="POST" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 px-5 py-3.5 rounded-2xl font-bold text-sm text-slate-500 hover:bg-rose-50 hover:text-rose-600 transition-all duration-200 cursor-pointer" aria-label="Sair da conta">
                <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5" />
                <span>Sair</span>
            </button>
        </form>
    </nav>
</aside>
