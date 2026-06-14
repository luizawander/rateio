<x-modal 
    title="Entrar na sua conta" 
    subtitle="Bem-vindo de volta. Continue de onde parou." 
    onClose="goToLanding()"
>
    <form id="auth-form" method="POST" action="/login" class="space-y-5" novalidate>
        @csrf
        <input type="hidden" name="auth_mode" id="auth_mode_input" value="{{ old('auth_mode', 'login') }}">
        <div id="field-name" class="hidden opacity-0 max-h-0 overflow-hidden transition-all duration-300">
            <x-input-field label="Nome Completo" id="name" placeholder="Como quer ser chamado?" value="{{ old('name') }}" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div id="email-wrapper" class="col-span-2">
                <x-input-field label="E-mail" id="email" type="email" required placeholder="voce@email.com" value="{{ old('email') }}" />
            </div>

            <div id="field-phone" class="hidden opacity-0 max-h-0 overflow-hidden transition-all duration-300 col-span-2 md:col-span-1">
                <x-input-field label="Telefone" id="phone" placeholder="(11) 99999-0000" value="{{ old('phone') }}" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div id="password-wrapper" class="col-span-2 relative">
                <x-input-field label="Senha" id="password" type="password" required placeholder="••••••••" />
                <button type="button" onclick="togglePasswordVisibility('password')" class="absolute right-5 top-[52px] text-slate-400 hover:text-slate-600 focus:outline-none">
                    <x-heroicon-o-eye id="eye-icon-password" class="w-5 h-5" />
                    <x-heroicon-o-eye-slash id="eye-slash-icon-password" class="w-5 h-5 hidden" />
                </button>
                <div class="mt-2 text-right" id="forgot-password-container">
                    <a href="#" id="forgot-password" class="text-xs font-semibold text-[#008f5d] hover:underline">Esqueci minha senha</a>
                </div>
            </div>

            <div id="field-password-confirmation" class="hidden opacity-0 max-h-0 overflow-hidden transition-all duration-300 relative col-span-2 md:col-span-1">
                <x-input-field label="Confirmar Senha" id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" />
                <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute right-5 top-[52px] text-slate-400 hover:text-slate-600 focus:outline-none">
                    <x-heroicon-o-eye id="eye-icon-password_confirmation" class="w-5 h-5" />
                    <x-heroicon-o-eye-slash id="eye-slash-icon-password_confirmation" class="w-5 h-5 hidden" />
                </button>
            </div>
        </div>

        <x-button type="submit" id="submit-btn" variant="gold">
            entrar
        </x-button>
    </form>

    <div class="relative my-6 text-center">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-slate-100"></div>
        </div>
        <span class="relative px-4 bg-white/95 text-xs font-semibold text-slate-400 uppercase tracking-wider">ou</span>
    </div>

    <div>
        <x-button type="button" onclick="window.location.href='/auth/google'" variant="white">
            <x-google-icon class="mr-3 inline-block" />
            Continuar com Google
        </x-button>
        @error('oauth')
            <p class="mt-2 text-xs font-semibold text-rose-600 text-center">{{ $message }}</p>
        @enderror
    </div>

    <div class="mt-8 text-center text-sm text-slate-500">
        <span id="toggle-text">Não tem conta?</span>
        <a href="#" id="toggle-mode-link" onclick="event.preventDefault(); toggleAuthMode();" class="font-bold text-[#008f5d] hover:underline ml-1">Criar agora</a>
    </div>
</x-modal>
