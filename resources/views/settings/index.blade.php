<x-app-layout title="Ajustes" active="settings">
    <x-page-title>Ajustes</x-page-title>

    @if (session('status') === 'settings-updated')
        <div class="bg-emerald-50 text-emerald-700 px-6 py-4 rounded-2xl mb-6 font-bold border border-emerald-100/50 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-emerald-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Configurações salvas com sucesso!
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="bg-emerald-50 text-emerald-700 px-6 py-4 rounded-2xl mb-6 font-bold border border-emerald-100/50 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-emerald-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Senha alterada com sucesso!
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            <x-card>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-black text-slate-800">Perfil</h2>
                    <x-button type="button" id="edit-profile-btn" variant="gold" :full="false" size="sm" class="px-5 py-2 text-xs">
                        Alterar dados
                    </x-button>
                </div>
                
                <div id="profile-fields-container" class="space-y-5">
                    <x-input-field label="Nome" id="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Seu nome" />
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input-field label="E-mail" id="email" type="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Seu e-mail" />
                        @php
                            $rawPhone = auth()->user()->phone ?? '';
                            $formattedPhone = '';
                            $cleaned = preg_replace('/\D/', '', $rawPhone);
                            if (strlen($cleaned) === 11) {
                                $formattedPhone = '(' . substr($cleaned, 0, 2) . ') ' . substr($cleaned, 2, 5) . '-' . substr($cleaned, 7);
                            } elseif (strlen($cleaned) === 10) {
                                $formattedPhone = '(' . substr($cleaned, 0, 2) . ') ' . substr($cleaned, 2, 4) . '-' . substr($cleaned, 6);
                            } else {
                                $formattedPhone = $rawPhone;
                            }
                        @endphp
                        <x-input-field label="Telefone" id="phone" value="{{ old('phone', $formattedPhone) }}" placeholder="(11) 99999-0000" />
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-select-field 
                            label="Gênero" 
                            id="gender" 
                            :options="$genders" 
                            :selected="old('gender', auth()->user()->gender ?? '')" 
                            placeholder="Selecione o gênero" 
                        />
                        <x-input-field label="Data de nascimento" id="birth_date" type="date" value="{{ old('birth_date', auth()->user()->birth_date ? auth()->user()->birth_date->format('Y-m-d') : '') }}" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-select-field 
                            label="Tipo de Chave PIX" 
                            id="pix_key_type" 
                            :options="$pixKeyTypes" 
                            :selected="old('pix_key_type', auth()->user()->pix_key_type ?? '')" 
                            placeholder="Selecione o tipo" 
                        />
                        <x-input-field label="Chave PIX" id="pix_key" value="{{ old('pix_key', auth()->user()->pix_key ?? '') }}" placeholder="Digite sua chave" />
                    </div>
                    
                    <div id="profile-actions-container" class="pt-2 flex justify-end gap-3 transition-all duration-300 origin-right hidden opacity-0 scale-95">
                        <button type="button" id="cancel-edit-btn" class="px-6 py-2.5 rounded-full bg-white border border-slate-200 text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all cursor-pointer">
                            Cancelar
                        </button>
                        <x-button type="button" id="open-change-password-modal" onclick="ModalDialog.open('change-password-modal')" variant="pastel-green" :full="false" size="sm" class="px-6 py-2.5 text-sm">
                            Alterar senha
                        </x-button>
                        <x-button type="submit" variant="gold" :full="false" size="sm" class="px-6 py-2.5 text-sm">
                            Salvar alterações
                        </x-button>
                    </div>
                </div>
            </x-card>

            <x-card>
                <h2 class="text-lg font-black text-slate-800 mb-6">Preferências</h2>
                
                <div class="space-y-6">
                    <x-toggle-switch label="Avisos por e-mail" id="email_notifications" :checked="old('email_notifications', auth()->user()->email_notifications ?? true)" />
                    <x-toggle-switch label="Lembretes de vencimento" id="due_reminders" :checked="old('due_reminders', auth()->user()->due_reminders ?? true)" />
                    <x-toggle-switch label="Resumo semanal" id="weekly_summary" :checked="old('weekly_summary', auth()->user()->weekly_summary ?? false)" />
                </div>
            </x-card>
        </div>
    </form>
    @include('settings.partials.change-password-modal')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const editBtn = document.getElementById('edit-profile-btn');
            const cancelEditBtn = document.getElementById('cancel-edit-btn');
            const profileContainer = document.getElementById('profile-fields-container');
            const actionsContainer = document.getElementById('profile-actions-container');
            
            const hasErrors = @json($errors->any());
            let isEditing = hasErrors;

            function setEditingState(editing) {
                isEditing = editing;
                
                if (editing) {
                    if (actionsContainer.timeoutId) {
                        clearTimeout(actionsContainer.timeoutId);
                        actionsContainer.timeoutId = null;
                    }
                    actionsContainer.classList.remove('hidden');
                    void actionsContainer.offsetWidth;
                    actionsContainer.classList.remove('opacity-0', 'scale-95');
                    actionsContainer.classList.add('opacity-100', 'scale-100');
                    
                    if (editBtn) {
                        editBtn.classList.add('hidden');
                    }
                } else {
                    actionsContainer.classList.remove('opacity-100', 'scale-100');
                    actionsContainer.classList.add('opacity-0', 'scale-95');
                    
                    if (actionsContainer.timeoutId) {
                        clearTimeout(actionsContainer.timeoutId);
                    }
                    
                    actionsContainer.timeoutId = setTimeout(() => {
                        actionsContainer.classList.add('hidden');
                        actionsContainer.timeoutId = null;
                    }, 300);
                    
                    if (editBtn) {
                        editBtn.classList.remove('hidden');
                    }
                }

                if (profileContainer) {
                    const inputs = profileContainer.querySelectorAll('input');
                    const selectTriggers = profileContainer.querySelectorAll('button[id^="trigger-"]');
                    
                    inputs.forEach(input => {
                        if (input.id === 'pix_key') return;
                        if (editing) {
                            input.removeAttribute('readonly');
                            input.removeAttribute('disabled');
                            input.classList.remove('bg-slate-100/75', 'text-slate-400', 'cursor-not-allowed');
                            input.classList.add('bg-slate-50', 'text-slate-800');
                        } else {
                            input.setAttribute('readonly', 'true');
                            input.classList.remove('bg-slate-50', 'text-slate-800');
                            input.classList.add('bg-slate-100/75', 'text-slate-400', 'cursor-not-allowed');
                        }
                    });

                    const pixKeyType = document.getElementById('pix_key_type');
                    const pixKey = document.getElementById('pix_key');
                    if (pixKey) {
                        if (editing && pixKeyType && pixKeyType.value) {
                            pixKey.removeAttribute('readonly');
                            pixKey.removeAttribute('disabled');
                            pixKey.classList.remove('bg-slate-100/75', 'text-slate-400', 'cursor-not-allowed');
                            pixKey.classList.add('bg-slate-50', 'text-slate-800');
                        } else {
                            pixKey.setAttribute('readonly', 'true');
                            pixKey.classList.remove('bg-slate-50', 'text-slate-800');
                            pixKey.classList.add('bg-slate-100/75', 'text-slate-400', 'cursor-not-allowed');
                        }
                    }

                    selectTriggers.forEach(trigger => {
                        if (editing) {
                            trigger.removeAttribute('disabled');
                            trigger.classList.remove('bg-slate-100/75', 'text-slate-400', 'cursor-not-allowed', 'pointer-events-none');
                            trigger.classList.add('bg-slate-50', 'text-slate-800');
                        } else {
                            trigger.setAttribute('disabled', 'true');
                            trigger.classList.remove('bg-slate-50', 'text-slate-800');
                            trigger.classList.add('bg-slate-100/75', 'text-slate-400', 'cursor-not-allowed', 'pointer-events-none');
                        }
                    });
                }
            }

            setEditingState(isEditing);

            if (editBtn) {
                editBtn.addEventListener('click', () => {
                    setEditingState(true);
                });
            }

            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', () => {
                    const inputs = profileContainer.querySelectorAll('input');
                    inputs.forEach(input => {
                        input.value = input.defaultValue;
                    });
                    
                    const containers = profileContainer.querySelectorAll('.select-container');
                    containers.forEach(container => {
                        const selectHidden = container.querySelector('.select-hidden');
                        const selectLabel = container.querySelector('.select-label');
                        
                        const initialOption = selectHidden.querySelector('option[selected]') || selectHidden.querySelector('option');
                        const initialValue = initialOption ? initialOption.value : '';
                        const initialLabel = initialOption ? initialOption.textContent.trim() : '';
                        
                        selectHidden.value = initialValue;
                        selectLabel.textContent = initialLabel;
                        
                        container.querySelectorAll('.select-option').forEach(opt => {
                            const val = opt.getAttribute('data-value');
                            if (val === initialValue) {
                                opt.classList.remove('text-slate-500', 'hover:bg-[#FFFDF0]', 'hover:text-[#A17C00]');
                                opt.classList.add('bg-[#FFFBE6]', 'text-[#A17C00]');
                                opt.setAttribute('aria-selected', 'true');
                            } else {
                                opt.classList.remove('bg-[#FFFBE6]', 'text-[#A17C00]');
                                opt.classList.add('text-slate-500', 'hover:bg-[#FFFDF0]', 'hover:text-[#A17C00]');
                                opt.setAttribute('aria-selected', 'false');
                            }
                        });
                    });
                    
                    setEditingState(false);
                });
            }

            const phoneInput = document.getElementById('phone');
            if (phoneInput && window.Masks) {
                phoneInput.addEventListener('input', (e) => {
                    e.target.value = window.Masks.phone(e.target.value);
                });
            }

            const pixKeyTypeSelect = document.getElementById('pix_key_type');
            const pixKeyInput = document.getElementById('pix_key');
            
            if (pixKeyTypeSelect && pixKeyInput && window.Masks) {
                function applyPixMask() {
                    const type = pixKeyTypeSelect.value;
                    const val = pixKeyInput.value;
                    if (type === 'cpf') {
                        pixKeyInput.value = window.Masks.cpf(val);
                    } else if (type === 'cnpj') {
                        pixKeyInput.value = window.Masks.cnpj(val);
                    } else if (type === 'phone') {
                        pixKeyInput.value = window.Masks.phone(val);
                    }
                }

                pixKeyInput.addEventListener('input', (e) => {
                    const type = pixKeyTypeSelect.value;
                    if (type === 'cpf') {
                        e.target.value = window.Masks.cpf(e.target.value);
                    } else if (type === 'cnpj') {
                        e.target.value = window.Masks.cnpj(e.target.value);
                    } else if (type === 'phone') {
                        e.target.value = window.Masks.phone(e.target.value);
                    }
                });

                pixKeyTypeSelect.addEventListener('change', () => {
                    if (isEditing) {
                        if (pixKeyTypeSelect.value) {
                            pixKeyInput.removeAttribute('readonly');
                            pixKeyInput.removeAttribute('disabled');
                            pixKeyInput.classList.remove('bg-slate-100/75', 'text-slate-400', 'cursor-not-allowed');
                            pixKeyInput.classList.add('bg-slate-50', 'text-slate-800');
                        } else {
                            pixKeyInput.setAttribute('readonly', 'true');
                            pixKeyInput.value = '';
                            pixKeyInput.classList.remove('bg-slate-50', 'text-slate-800');
                            pixKeyInput.classList.add('bg-slate-100/75', 'text-slate-400', 'cursor-not-allowed');
                        }
                    }
                    applyPixMask();
                });

                applyPixMask();

                if (cancelEditBtn) {
                    cancelEditBtn.addEventListener('click', () => {
                        setTimeout(applyPixMask, 0);
                    });
                }
            }
        });
    </script>
</x-app-layout>
