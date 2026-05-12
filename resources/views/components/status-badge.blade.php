@props(['status'])

@php
    $variant = $status->badgeVariant();
    $classes = match ($variant) {
        'success' => 'bg-nk-success/15 text-nk-success',
        'warning' => 'bg-nk-warning/20 text-[#8A5A16]',
        'danger' => 'bg-nk-error/15 text-nk-error',
        'secondary' => 'bg-nk-secondary/15 text-nk-secondary',
        default => 'bg-nk-primary/15 text-nk-primary',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex rounded-full px-3 py-1 text-xs font-semibold $classes"]) }}>
    {{ $status->label() }}
</span>
