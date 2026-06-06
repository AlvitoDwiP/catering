@props(['variant' => 'primary', 'type' => 'button', 'href' => null])

@php
    $baseClass = 'inline-flex items-center justify-center rounded-full px-5 py-2.5 text-sm font-medium transition duration-200 ease-out focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:transform-none';
    $variantClass = match ($variant) {
        'secondary' => 'border border-nk-border bg-white/70 text-nk-text shadow-sm hover:-translate-y-0.5 hover:bg-nk-alt focus:ring-nk-border',
        'danger' => 'bg-nk-error text-white shadow-sm hover:-translate-y-0.5 hover:opacity-90 focus:ring-nk-error',
        default => 'bg-nk-primary text-nk-card shadow-sm hover:-translate-y-0.5 hover:opacity-95 focus:ring-nk-primary',
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
