@props([
    'maxWidth' => 'max-w-lg',
    'onClose' => 'goToLanding()',
    'title' => null,
    'subtitle' => null
])

<div {{ $attributes->merge(['class' => 'w-full ' . $maxWidth . ' bg-white/95 backdrop-blur-xl p-10 sm:p-12 rounded-[2.5rem] border border-slate-100/80 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.12)] flex flex-col relative overflow-hidden m-4']) }}>
    <div class="absolute -top-12 -right-12 w-36 h-36 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-12 -left-12 w-36 h-36 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

    @if($onClose)
        <button onclick="{{ $onClose }}" class="absolute top-6 right-6 p-2 rounded-xl hover:bg-slate-100 text-slate-400 hover:text-slate-600 transition-all duration-200 active:scale-95 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    @endif

    @if($title || $subtitle)
        <div class="mb-8 relative text-center sm:text-left">
            @if($title)
                <h2 id="auth-title" class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $title }}</h2>
            @endif
            @if($subtitle)
                <p id="auth-subtitle" class="text-sm text-slate-500 mt-2">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    <div class="relative w-full">
        {{ $slot }}
    </div>
</div>
