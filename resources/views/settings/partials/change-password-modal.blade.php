<x-modal id="change-password-modal" backdrop-id="change-password-backdrop" title="Alterar Senha" subtitle="Confirme sua senha atual e escolha uma nova senha segura.">
    <form action="{{ route('settings.password') }}" method="POST" class="space-y-5 relative">
        @csrf
        @method('PUT')
        
        <x-input-field label="Senha atual" id="current_password" type="password" required placeholder="Confirme sua senha atual" />
        
        <x-input-field label="Nova senha" id="new_password" type="password" required placeholder="Digite a nova senha" />
        
        <x-input-field label="Confirmar nova senha" id="new_password_confirmation" type="password" required placeholder="Repita a nova senha" />
        
        <div class="pt-4 flex justify-end gap-3">
            <button type="button" id="cancel-change-password" onclick="ModalDialog.close('change-password-modal')" class="px-6 py-2.5 rounded-full bg-white border border-slate-200 text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all cursor-pointer">
                Cancelar
            </button>
            <x-button type="submit" variant="gold" :full="false" size="sm" class="px-6 py-2.5 text-sm">
                Alterar Senha
            </x-button>
        </div>
    </form>
</x-modal>

@if($errors->has('current_password') || $errors->has('new_password'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        ModalDialog.open('change-password-modal');
    });
</script>
@endif
