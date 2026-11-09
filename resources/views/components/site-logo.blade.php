@props([
    'variant' => 'default',
    'showName' => true,
    'imageClass' => 'h-8 w-auto',
    'nameClass' => 'font-display text-xl font-bold text-primary',
])

@php
    $brand = site_branding();
    $hasCustom = match ($variant) {
        'dark' => $brand['has_dark_logo'],
        'mobile' => $brand['has_mobile_logo'],
        default => $brand['has_logo'],
    };
    $logoUrl = match ($variant) {
        'dark' => $brand['logo_dark_url'],
        'mobile' => $brand['logo_mobile_url'],
        default => $brand['logo_url'],
    };
@endphp

@if ($hasCustom)
    <img src="{{ $logoUrl }}" alt="{{ $brand['site_name'] }}" {{ $attributes->merge(['class' => $imageClass]) }}>
@else
    <span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2']) }}>
        <span class="flex h-8 w-8 flex-none items-center justify-center rounded-lg bg-primary text-xl font-bold text-white">R</span>
        @if ($showName)
            <span class="{{ $nameClass }}">{{ $brand['site_name'] }}</span>
        @endif
    </span>
@endif
