@props(['status' => 'pending'])

@php
    $classes = match($status) {
        'approved', 'active', 'paid' => 'bg-green-50 text-green-600 border-green-100',
        'pending' => 'bg-yellow-50 text-yellow-600 border-yellow-100',
        'rejected', 'inactive', 'failed' => 'bg-red-50 text-red-600 border-red-100',
        default => 'bg-gray-50 text-gray-600 border-gray-100'
    };
@endphp

<span {{ $attributes->merge(['class' => "px-3 py-1 text-xs font-semibold rounded-full border $classes capitalize"]) }}>
    {{ $status }}
</span>
