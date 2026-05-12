@props(['label', 'value', 'description' => null, 'variant' => 'default'])

@php
    $color = match ($variant) {
        'accent' => 'text-nk-secondary',
        'success' => 'text-nk-success',
        default => 'text-nk-primary',
    };
@endphp

<div class="rounded-[20px] border border-nk-border bg-nk-card p-5 shadow-[0_10px_25px_rgba(43,42,40,0.07)]">
    <p class="text-sm text-nk-muted">{{ $label }}</p>
    <p class="mt-2 font-heading text-4xl {{ $color }}">{{ $value }}</p>
    @if ($description)
        <p class="mt-1 text-xs text-nk-muted">{{ $description }}</p>
    @endif
</div>
