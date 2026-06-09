@props(['title', 'description'])

<div class="feature-card">
    <div class="feature-icon-wrapper">
        {{ $slot }}
    </div>
    <h2 class="feature-title">{{ $title }}</h2>
    <p class="feature-description">{{ $description }}</p>
</div>
