@props(['title', 'description'])

<div class="rounded-[28px] border border-dashed border-nk-border bg-nk-card p-10 text-center shadow-[0_12px_30px_rgba(43,42,40,0.06)]">
    <h3 class="font-heading text-2xl tracking-[-0.02em] text-nk-text">{{ $title }}</h3>
    <p class="mt-2 text-sm leading-[1.7] text-nk-muted">{{ $description }}</p>
    @if (trim($slot))
        <div class="mt-5">
            {{ $slot }}
        </div>
    @endif
</div>
