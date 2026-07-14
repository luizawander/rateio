<x-layout>
<div id="app-container">
    <div id="main-grid-container">
        <div id="left-pane">
            <header class="site-header">
                <div class="flex items-center gap-2">
                    <x-logo size="text-4xl" class="cursor-pointer" onclick="goToLanding()" />
                </div>
                <div id="header-action-btn">
                    @auth
                        <div class="flex items-center gap-3">
                            @if (auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" class="w-8 h-8 rounded-full border border-slate-200" alt="Avatar">
                            @endif
                            <span class="text-sm font-semibold text-slate-700">Olá, {{ auth()->user()->name }}!</span>
                            <form action="/logout" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="btn-primary-sm bg-rose-50 text-rose-600 hover:from-rose-100 hover:to-rose-200 border-rose-200 cursor-pointer">
                                    sair
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </header>
            <div class="flex-grow flex flex-col items-center justify-center my-auto w-full">
                <main class="main-container">
                    <h1 class="page-title">
                        Divida <span class="text-gradient-green-blue">contas</span> e <span class="text-gradient-green-blue">parcelas</span> sem dor de cabeça
                    </h1>
                    <p class="page-subtitle">
                        Crie grupos, registre despesas parceladas e veja em segundos quem deve quanto para quem.
                    </p>
                    @auth
                        <div class="pt-4 flex items-center justify-center">
                            <span class="px-6 py-3 bg-emerald-50 text-emerald-700 font-bold border border-emerald-200 rounded-full flex items-center gap-2">
                                <x-heroicon-o-check-circle class="w-5 h-5 text-emerald-600" />
                                Você está autenticado com sucesso!
                            </span>
                        </div>
                    @else
                        <div id="hero-action-btn" class="pt-4 flex items-center justify-center gap-3">
                            <button onclick="goToAuth('register')" class="btn-primary text-base cursor-pointer">
                                Criar conta
                            </button>
                            <button onclick="goToAuth('login')" class="btn-primary text-base cursor-pointer">
                                Login
                            </button>
                        </div>
                    @endauth
                </main>
                <div class="features-container">
                    <div class="features-grid">
                        <x-feature-card title="Grupos" description="Crie grupos para dividir despesas de viagens, casa, festas, etc.">
                            <x-heroicon-o-users class="feature-icon" />
                        </x-feature-card>

                        <x-feature-card title="Parcelas" description="Divida contas de forma personalizada e com vencimentos individuais.">
                            <x-heroicon-o-credit-card class="feature-icon" />
                        </x-feature-card>

                        <x-feature-card title="Balanço" description="Quem deve para quem, simplificado.">
                            <x-heroicon-o-chart-pie class="feature-icon" />
                        </x-feature-card>

                        <x-feature-card title="Vencimentos" description="Veja as próximas parcelas em destaque.">
                            <x-heroicon-o-calendar class="feature-icon" />
                        </x-feature-card>
                    </div>
                </div>
            </div>

            <footer class="site-footer">
                <p>&copy; {{ date('Y') }} Rateio.</p>
            </footer>
        </div>
        <div id="right-pane">
            <x-auth-card />
        </div>

    </div>
</div>

<script>
    let currentAuthMode = 'login';

    function goToAuth(mode) {
        currentAuthMode = mode;
        
        const nameField = document.getElementById('field-name');
        const phoneField = document.getElementById('field-phone');
        const passwordConfirmationField = document.getElementById('field-password-confirmation');
        const emailWrapper = document.getElementById('email-wrapper');
        const passwordWrapper = document.getElementById('password-wrapper');
        const authTitle = document.getElementById('auth-title');
        const authSubtitle = document.getElementById('auth-subtitle');
        const submitBtn = document.getElementById('submit-btn');
        const toggleText = document.getElementById('toggle-text');
        const toggleModeLink = document.getElementById('toggle-mode-link');
        const forgotPassword = document.getElementById('forgot-password');
        const nameInput = document.getElementById('name');
        const phoneInput = document.getElementById('phone');
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const authForm = document.getElementById('auth-form');
        const authModeInput = document.getElementById('auth_mode_input');

        if (authForm) {
            authForm.action = mode === 'register' ? '/register' : '/login';
        }
        if (authModeInput) {
            authModeInput.value = mode;
        }

        if (mode === 'register') {
            authTitle.textContent = 'Criar conta';
            authSubtitle.textContent = 'Cadastre-se para começar a gerenciar seus rateios.';
            submitBtn.textContent = 'Criar conta';
            toggleText.textContent = 'Já tem conta?';
            toggleModeLink.textContent = 'Fazer login';
            forgotPassword.classList.add('hidden');
            
            if (emailWrapper) emailWrapper.className = 'col-span-2 md:col-span-1';
            if (passwordWrapper) passwordWrapper.className = 'col-span-2 md:col-span-1 relative';

            nameField.classList.remove('hidden');
            nameInput.setAttribute('required', 'true');
            phoneField.classList.remove('hidden');
            phoneInput.setAttribute('required', 'true');
            passwordConfirmationField.classList.remove('hidden');
            passwordConfirmationInput.setAttribute('required', 'true');

            setTimeout(() => {
                nameField.style.maxHeight = '100px';
                nameField.classList.remove('opacity-0');
                nameField.classList.add('opacity-100');
                phoneField.style.maxHeight = '100px';
                phoneField.classList.remove('opacity-0');
                phoneField.classList.add('opacity-100');
                passwordConfirmationField.style.maxHeight = '100px';
                passwordConfirmationField.classList.remove('opacity-0');
                passwordConfirmationField.classList.add('opacity-100');
            }, 50);
        } else {
            authTitle.textContent = 'Entrar na sua conta';
            authSubtitle.textContent = 'Bem-vindo de volta. Continue de onde parou.';
            submitBtn.textContent = 'Entrar';
            toggleText.textContent = 'Não tem conta?';
            toggleModeLink.textContent = 'Criar agora';
            forgotPassword.classList.remove('hidden');
            
            if (emailWrapper) emailWrapper.className = 'col-span-2';
            if (passwordWrapper) passwordWrapper.className = 'col-span-2 relative';

            nameInput.removeAttribute('required');
            nameField.classList.remove('opacity-100');
            nameField.classList.add('opacity-0');
            nameField.style.maxHeight = '0px';
            phoneInput.removeAttribute('required');
            phoneField.classList.remove('opacity-100');
            phoneField.classList.add('opacity-0');
            phoneField.style.maxHeight = '0px';
            passwordConfirmationInput.removeAttribute('required');
            passwordConfirmationField.classList.remove('opacity-100');
            passwordConfirmationField.classList.add('opacity-0');
            passwordConfirmationField.style.maxHeight = '0px';

            setTimeout(() => {
                nameField.classList.add('hidden');
                phoneField.classList.add('hidden');
                passwordConfirmationField.classList.add('hidden');
            }, 300);
        }

        document.getElementById('app-container').classList.add('auth-mode');
    }

    function goToLanding() {
        document.getElementById('app-container').classList.remove('auth-mode');
        if (window.location.hash) {
            history.pushState("", document.title, window.location.pathname + window.location.search);
        }
    }

    function toggleAuthMode() {
        const nextMode = currentAuthMode === 'login' ? 'register' : 'login';
        goToAuth(nextMode);
    }

    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        const eyeIcon = document.getElementById(`eye-icon-${inputId}`);
        const eyeSlashIcon = document.getElementById(`eye-slash-icon-${inputId}`);
        
        if (input.type === 'password') {
            input.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeSlashIcon.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeSlashIcon.classList.add('hidden');
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', (e) => {
                if (window.Masks) {
                    e.target.value = window.Masks.phone(e.target.value);
                }
            });
        }
    });
</script>

@if ($errors->any())
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const mode = "{{ old('auth_mode', 'login') }}";
        goToAuth(mode);
    });
</script>
@endif
</x-layout>
