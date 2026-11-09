@props([
    'variant' => 'primary',
    'mode' => 'install',
    'label' => 'Install App',
    'compact' => false,
])

@php
    $classes = match ($variant) {
        'light' => 'inline-flex items-center justify-center gap-2 bg-white/90 text-primary border border-primary/20 px-4 py-2.5 rounded-2xl text-sm font-bold shadow-sm hover:bg-white transition-all',
        'menu' => 'flex w-full items-center gap-3 px-4 py-2 text-sm font-bold text-text-secondary hover:bg-soft rounded-xl transition-colors',
        'ghost' => 'inline-flex items-center gap-2 text-sm font-bold text-text-secondary hover:text-primary transition-colors',
        default => 'rd-button inline-flex items-center justify-center gap-2 bg-primary text-white px-4 py-2.5 rounded-2xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all',
    };
@endphp

<button
    type="button"
    @if ($mode === 'help')
        data-pwa-help
    @else
        data-pwa-install hidden
    @endif
    {{ $attributes->merge(['class' => $classes]) }}
>
    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v12m0 0l4-4m-4 4l-4-4M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2"></path>
    </svg>
    <span @if ($compact) class="hidden sm:inline" @endif>{{ $label }}</span>
</button>
