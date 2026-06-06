@props(['title' => 'Admin'])

<header class="border-b border-nk-border bg-nk-bg/90 px-6 py-4 backdrop-blur lg:px-8">
    <div class="flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/nads-kitchen-logo.png') }}" alt="Nad's Kitchen Catering" class="h-auto w-12 lg:hidden" />
            <h1 class="font-heading text-3xl text-nk-text">{{ $title }}</h1>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-right">
                <p class="text-sm font-medium text-nk-text">{{ auth()->user()?->name }}</p>
                <p class="text-xs text-nk-muted">{{ auth()->user()?->email }}</p>
            </div>
            <span class="rounded-full bg-nk-primary/15 px-3 py-1 text-xs font-semibold text-nk-primary">Admin</span>
        </div>
    </div>
</header>
