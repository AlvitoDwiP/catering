@props(['padding' => 'default'])

@php
    $paddingClass = match ($padding) {
        'sm' => 'p-4',
        'lg' => 'p-8',
        default => 'p-6',
    };
@endphp

<div {{ $attributes->merge(['class' => "rounded-[24px] border border-nk-border bg-nk-card shadow-[0_12px_30px_rgba(43,42,40,0.08)] transition duration-200 ease-out hover:-translate-y-0.5 hover:shadow-[0_16px_40px_rgba(43,42,40,0.1)] $paddingClass"]) }}>
    {{ $slot }}
</div>
