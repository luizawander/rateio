@props(['groupTypes'])

<x-modal-dialog id="new-group-modal" backdrop-id="new-group-backdrop" overflow="overflow-visible">
    <div id="new-group-form-section">
        <div class="mb-8 relative">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Criar Novo Grupo</h2>
            <p class="text-sm text-slate-500 mt-2">Crie um grupo para começar a dividir suas despesas.</p>
        </div>

        <form id="new-group-form" method="POST" class="space-y-5 relative" novalidate>
            @csrf
            
            <x-input-field label="Nome do Grupo" id="name" required placeholder="Ex: Viagem de Fim de Ano" />
            
            <x-input-field label="Descrição" id="description" required placeholder="Ex: Despesas gerais da viagem" />

            <x-select-field 
                label="Tipo de Grupo" 
                id="type" 
                :options="$groupTypes" 
                placeholder="Selecione o tipo de grupo" 
            />
            
            <div id="new-group-error" class="hidden text-xs font-semibold text-rose-600 pl-4 mt-2"></div>

            <div class="pt-4 flex justify-end gap-3">
                <button type="button" id="cancel-new-group" onclick="ModalDialog.close('new-group-modal')" class="px-6 py-2.5 rounded-full bg-white border border-slate-200 text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all cursor-pointer">
                    Cancelar
                </button>
                <x-button type="submit" variant="gold" :full="false" size="sm" class="px-6 py-2.5 text-sm">
                    Criar Grupo
                </x-button>
            </div>
        </form>
    </div>

    <div id="new-group-success-section" class="hidden flex flex-col items-center text-center space-y-6">
        <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-500/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
        </div>
        
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Grupo criado!</h2>
            <p class="text-sm text-slate-500 mt-2">Seu grupo foi criado com sucesso. Agora você pode adicionar amigos ou compartilhar o link de acesso.</p>
        </div>

        <div class="w-full pt-4 flex flex-col gap-3">
            <x-copy-button id="copy-link-btn" success-text="Link copiado!" :full="true" size="sm" class="py-3 text-sm">
                Copiar link do grupo
            </x-copy-button>
            
            <button type="button" id="add-friends-btn" class="w-full px-6 py-3 rounded-full bg-slate-50 border border-slate-200 text-sm font-bold text-slate-700 hover:bg-slate-100 transition-all cursor-pointer">
                Adicionar amigos
            </button>
        </div>
    </div>
</x-modal-dialog>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('new-group-form');
        const formSection = document.getElementById('new-group-form-section');
        const successSection = document.getElementById('new-group-success-section');
        const errorDiv = document.getElementById('new-group-error');
        const copyLinkBtn = document.getElementById('copy-link-btn');
        const addFriendsBtn = document.getElementById('add-friends-btn');

        if (form) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                errorDiv.classList.add('hidden');
                errorDiv.textContent = '';

                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());

                try {
                    const response = await fetch('/groups', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || data._token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        if (result.errors) {
                            const firstKey = Object.keys(result.errors)[0];
                            throw new Error(result.errors[firstKey][0]);
                        } else {
                            throw new Error(result.message || 'Erro ao criar o grupo.');
                        }
                    }

                    if (result.success) {
                        if (copyLinkBtn) {
                            copyLinkBtn.setAttribute('data-copy-value', result.link);
                        }
                        
                        formSection.classList.add('hidden');
                        successSection.classList.remove('hidden');
                    }
                } catch (err) {
                    errorDiv.textContent = err.message;
                    errorDiv.classList.remove('hidden');
                }
            });
        }
    });
</script>
