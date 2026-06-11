@props([
    'active' => 'inicio'
])

<aside id="sidebar-menu" class="fixed inset-y-0 left-0 z-50 w-72 bg-white p-8 flex flex-col gap-8 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:flex lg:h-fit lg:w-full lg:m-0 lg:rounded-[2.5rem] lg:border lg:border-slate-100/80 lg:shadow-[0_20px_50px_-15px_rgba(0,0,0,0.05)]">
    <div class="flex items-center justify-between">
        <x-user-profile />
        <button id="sidebar-close" class="lg:hidden p-2 rounded-xl text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-all cursor-pointer flex-shrink-0 ml-2" aria-label="Fechar menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav class="flex flex-col gap-1.5">
        <x-sidebar-link :href="route('home')" :active="$active === 'inicio'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span>Início</span>
        </x-sidebar-link>

        <x-sidebar-link :active="$active === 'grupos'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.97 5.97 0 0 0-.75-2.906m-.173-4.059a4.5 4.5 0 1 1-1.807-8.313m-2.4 11.52A9 9 0 0 0 3.38 18c0-1.1.84-1.935 1.908-1.935h8.424c1.068 0 1.908.837 1.908 1.935 0 .076-.004.15-.011.224m-10.73 0a9.094 9.094 0 0 1-3.741-.479 3 3 0 0 1 4.682-2.72m-.94 3.198l-.002.031a3.86 3.86 0 0 0-.025.412m-.012.254c0 .225.012.447.037.666A11.968 11.968 0 0 0 12 21.75c2.207 0 4.281-.597 6.062-1.644" />
            </svg>
            <span>Grupos</span>
        </x-sidebar-link>

        <x-sidebar-link :active="$active === 'parcelas'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-19.5 5.25h19.5m-19.5 0h19.5M4 18h16a1 1 0 001-1V7a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1z" />
            </svg>
            <span>Parcelas</span>
        </x-sidebar-link>

        <x-sidebar-link :active="$active === 'avisos'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a9.04 9.04 0 0 1-5.186 0m9.758-4.89h-.001c.03-.437.052-.877.052-1.32V9c0-2.435-1.756-4.505-4.1-4.75a1.85 1.85 0 0 0-3.52 0C5.404 4.5 3.647 6.565 3.647 9v1.868c0 .443.022.883.052 1.32h-.001C3.12 13.95 3.62 18.01 7.5 18.01h9c3.88 0 4.38-4.06 3.857-6.068a9.04 9.04 0 0 1-.512-1.125Z" />
            </svg>
            <span>Avisos</span>
        </x-sidebar-link>

        <x-sidebar-link :active="$active === 'ajustes'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.43l-1.003.828c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.43l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.991l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.645-.869L9.594 3.94z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" /></svg>
            <span>Ajustes</span>
        </x-sidebar-link>

        <form action="/logout" method="POST" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 px-5 py-3.5 rounded-2xl font-bold text-sm text-slate-500 hover:bg-rose-50 hover:text-rose-600 transition-all duration-200 cursor-pointer" aria-label="Sair da conta">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                </svg>
                <span>Sair</span>
            </button>
        </form>
    </nav>
</aside>
