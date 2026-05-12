@props(['title', 'description'])

<div class="rounded-[20px] border border-dashed border-nk-border bg-nk-card p-10 text-center">
    <h3 class="font-heading text-2xl text-nk-text">{{ $title }}</h3>
    <p class="mt-2 text-sm text-nk-muted">{{ $description }}</p>
    @if (trim($slot))
        <div class="mt-5">
            {{ $slot }}
        </div>
    @endif
</div>
