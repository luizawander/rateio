<x-layout>
    <header class="site-header">
        <div class="flex items-center gap-2">
            <span class="logo-text">Rateio</span>
        </div>
        <div>
            <a href="#login" class="btn-primary-sm">
                login
            </a>
        </div>
    </header>

    <main class="main-container">
        <h1 class="page-title">
            Divida <span class="text-gradient-green-blue">contas</span> e <span class="text-gradient-green-blue">parcelas</span> sem dor de cabeça
        </h1>
        <p class="page-subtitle">
            Crie grupos, registre despesas parceladas e veja em segundos quem deve quanto para quem.
        </p>
        
        <div class="pt-4">
            <a href="#login" class="btn-primary text-base">
                criar minha conta
            </a>
        </div>
    </main>

    <div class="features-container">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <x-heroicon-o-users class="feature-icon" />
                </div>
                <h2 class="feature-title">Grupos</h2>
                <p class="feature-description">Viagem, casa, festa — convide por link.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <x-heroicon-o-credit-card class="feature-icon" />
                </div>
                <h2 class="feature-title">Parcelas</h2>
                <p class="feature-description">Até 24x, vencimentos individuais.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <x-heroicon-o-chart-pie class="feature-icon" />
                </div>
                <h2 class="feature-title">Balanço</h2>
                <p class="feature-description">Quem deve para quem, simplificado.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <x-heroicon-o-calendar class="feature-icon" />
                </div>
                <h2 class="feature-title">Vencimentos</h2>
                <p class="feature-description">Próximas parcelas em destaque.</p>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <p>&copy; {{ date('Y') }} Rateio.</p>
    </footer>
</x-layout>
