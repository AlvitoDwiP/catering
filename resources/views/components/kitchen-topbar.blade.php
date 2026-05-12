@props(['title' => 'Dapur', 'class' => ''])

<header {{ $attributes->merge(['class' => 'border-b border-nk-border bg-nk-bg/90 px-6 py-4 backdrop-blur lg:px-8 ' . $class]) }}>
    <div class="flex items-center justify-between gap-3">
        <h1 class="font-heading text-3xl text-nk-text">{{ $title }}</h1>
        <div class="flex items-center gap-3">
            <div class="text-right">
                <p class="text-sm font-medium text-nk-text">{{ auth()->user()?->name }}</p>
                <p class="text-xs text-nk-muted">{{ auth()->user()?->email }}</p>
            </div>
            <span class="rounded-full bg-nk-primary/15 px-3 py-1 text-xs font-semibold text-nk-primary">Dapur</span>
        </div>
    </div>
</header>
