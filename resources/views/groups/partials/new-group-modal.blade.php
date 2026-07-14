<x-modal id="new-group-modal" backdrop-id="new-group-backdrop" overflow="overflow-visible">
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

            <div id="custom-type-wrapper" class="hidden">
                <x-input-field label="Qual a categoria?" id="custom_type" name="custom_type" placeholder="Ex: Festa, Projeto, Trabalho" />
            </div>
            
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

    <div id="new-group-success-section" class="hidden">
        <x-status-card type="success" title="Grupo criado!" subtitle="Seu grupo foi criado com sucesso. Agora você pode adicionar amigos ou compartilhar o link de acesso.">
            <div class="flex gap-3">
                <x-copy-button id="copy-link-btn" variant="white" success-text="Link copiado!" :full="true" size="sm" class="py-3 text-sm">
                    Copiar link do grupo
                </x-copy-button>

                <x-button type="button" id="add-friends-btn" variant="pastel-green" :full="true" size="sm" class="py-3">
                    Adicionar amigos
                </x-button>
            </div>
        </x-status-card>
    </div>
</x-modal>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('new-group-form');
        const formSection = document.getElementById('new-group-form-section');
        const successSection = document.getElementById('new-group-success-section');
        const errorDiv = document.getElementById('new-group-error');
        const copyLinkBtn = document.getElementById('copy-link-btn');
        const addFriendsBtn = document.getElementById('add-friends-btn');

        const typeSelect = document.getElementById('type');
        const customTypeWrapper = document.getElementById('custom-type-wrapper');
        const customTypeInput = document.getElementById('custom_type');

        if (typeSelect && customTypeWrapper) {
            typeSelect.addEventListener('change', () => {
                if (typeSelect.value === 'outros') {
                    customTypeWrapper.classList.remove('hidden');
                } else {
                    customTypeWrapper.classList.add('hidden');
                    if (customTypeInput) {
                        customTypeInput.value = '';
                    }
                }
            });
        }

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
