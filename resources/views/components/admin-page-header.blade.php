@props(['title', 'description' => null])

<div class="mb-6 flex flex-wrap items-end justify-between gap-3">
    <div>
        <h2 class="font-heading text-4xl text-nk-text">{{ $title }}</h2>
        @if ($description)
            <p class="mt-1 text-sm text-nk-muted">{{ $description }}</p>
        @endif
    </div>

    @if (trim($slot))
        <div>{{ $slot }}</div>
    @endif
</div>
