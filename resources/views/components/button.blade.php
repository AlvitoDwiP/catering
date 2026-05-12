@props(['variant' => 'primary', 'type' => 'button', 'href' => null])

@php
    $baseClass = 'inline-flex items-center justify-center rounded-full px-5 py-2.5 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-2';
    $variantClass = match ($variant) {
        'secondary' => 'border border-nk-border bg-nk-card text-nk-text hover:bg-nk-alt focus:ring-nk-border',
        'danger' => 'bg-nk-error text-white hover:opacity-90 focus:ring-nk-error',
        default => 'bg-nk-primary text-nk-card hover:opacity-90 focus:ring-nk-primary',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$baseClass $variantClass"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => "$baseClass $variantClass"]) }}>
        {{ $slot }}
    </button>
@endif
