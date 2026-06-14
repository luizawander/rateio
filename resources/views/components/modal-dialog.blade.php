@props([
    'id',
    'backdropId' => null,
    'closeId' => null,
    'title' => null,
    'subtitle' => null,
    'overflow' => 'overflow-hidden',
    'maxWidth' => 'max-w-lg'
])

<div id="{{ $id }}" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div id="{{ $backdropId ?? ($id . '-backdrop') }}" onclick="ModalDialog.close('{{ $id }}')" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
    
    <div class="w-full {{ $maxWidth }} bg-white/95 backdrop-blur-xl p-10 sm:p-12 rounded-[2.5rem] border border-slate-100/80 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.15)] flex flex-col relative {{ $overflow }} m-4 transform scale-95 transition-transform duration-300">
        <div class="absolute -top-12 -right-12 w-36 h-36 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -left-12 w-36 h-36 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <button type="button" id="{{ $closeId ?? ('close-' . $id) }}" onclick="ModalDialog.close('{{ $id }}')" class="absolute top-6 right-6 p-2 rounded-xl hover:bg-slate-100 text-slate-400 hover:text-slate-600 transition-all duration-200 active:scale-95 z-10 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        @if($title || $subtitle)
            <div class="mb-8 relative">
                @if($title)
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">{{ $title }}</h2>
                @endif
                @if($subtitle)
                    <p class="text-sm text-slate-500 mt-2">{{ $subtitle }}</p>
                @endif
            </div>
        @endif

        {{ $slot }}
    </div>
</div>

<script>
    if (!window.ModalDialog) {
        window.ModalDialog = {
            open(id) {
                const modal = document.getElementById(id);
                if (!modal) return;
                
                const form = modal.querySelector('form');
                if (form) {
                    form.reset();
                    const selectHidden = form.querySelector('.select-hidden');
                    if (selectHidden) selectHidden.value = '';
                    const selectLabel = form.querySelector('.select-label');
                    if (selectLabel) selectLabel.textContent = selectLabel.getAttribute('data-placeholder') || 'Selecione...';
                }
                
                const errorDiv = modal.querySelector('[id$="-error"]');
                if (errorDiv) {
                    errorDiv.classList.add('hidden');
                    errorDiv.textContent = '';
                }
                
                const formSection = modal.querySelector('[id$="-form-section"]');
                const successSection = modal.querySelector('[id$="-success-section"]');
                if (formSection) formSection.classList.remove('hidden');
                if (successSection) successSection.classList.add('hidden');

                const modalContent = modal.querySelector('.transform');
                modal.classList.remove('hidden');
                void modal.offsetWidth;
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
                if (modalContent) {
                    modalContent.classList.remove('scale-95');
                    modalContent.classList.add('scale-100');
                }
            },
            close(id) {
                const modal = document.getElementById(id);
                if (!modal) return;
                const modalContent = modal.querySelector('.transform');
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                if (modalContent) {
                    modalContent.classList.remove('scale-100');
                    modalContent.classList.add('scale-95');
                }
                const handler = () => {
                    modal.classList.add('hidden');
                    modal.removeEventListener('transitionend', handler);
                };
                modal.addEventListener('transitionend', handler);
            }
        };
    }
</script>
