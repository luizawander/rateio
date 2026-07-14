@props([
    'title' => 'Rateio',
    'active' => 'inicio'
])

<x-layout :title="$title">
    <div class="min-h-screen flex flex-col relative overflow-x-hidden">
        
        <header class="hidden lg:flex items-center justify-center py-6 bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-30 w-full mb-12">
            <x-logo size="text-4xl" />
        </header>

        <header class="lg:hidden flex items-center justify-between px-6 py-4 bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-30 w-full">
            <button id="mobile-menu-toggle" class="p-2 -ml-2 rounded-xl text-slate-600 hover:bg-slate-100 active:scale-95 transition-all cursor-pointer" aria-label="Abrir menu">
                <x-heroicon-o-bars-3 class="w-6 h-6" />
            </button>
            <x-logo size="text-2xl" />
            <div class="w-10"></div>
        </header>

        <div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/30 backdrop-blur-xs z-40 hidden lg:hidden opacity-0 transition-opacity duration-300"></div>

        <div class="w-full flex flex-col flex-grow px-4 sm:px-6 lg:pl-24 lg:pr-24">
            <div class="flex-grow flex flex-col lg:flex-row items-start">
                <div class="lg:w-72 lg:mx-6 lg:mb-6 flex-shrink-0 w-full lg:w-auto">
                    <x-sidebar :active="$active" />
                </div>

                <main class="flex-grow p-6 lg:p-10 lg:pt-0 z-10 w-full">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('mobile-menu-toggle');
        const closeBtn = document.getElementById('sidebar-close');
        const sidebar = document.getElementById('sidebar-menu');
        const backdrop = document.getElementById('sidebar-backdrop');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
            void backdrop.offsetWidth;
            backdrop.classList.add('opacity-100');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.remove('opacity-100');
            
            const transitionHandler = () => {
                backdrop.classList.add('hidden');
                backdrop.removeEventListener('transitionend', transitionHandler);
            };
            backdrop.addEventListener('transitionend', transitionHandler);
        }

        if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (backdrop) backdrop.addEventListener('click', closeSidebar);
    });
</script>
