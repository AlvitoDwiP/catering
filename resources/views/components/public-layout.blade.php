<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? "Nad's Kitchen Order System" }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    @php
        $navCartCount = collect(session('cart.items', []))->count();
        $isActive = fn (string $routePattern): bool => request()->routeIs($routePattern);
    @endphp

    <header class="nk-header">
        <div class="nk-container h-full">
            <div class="flex h-full items-center justify-between gap-4">
                <a href="{{ route('public.home') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-[14px] border border-[var(--border)] bg-[var(--bg-card)]">
                        <img src="{{ asset('images/nads-kitchen-logo.png') }}" alt="Nad's Kitchen" class="h-full w-full object-contain p-1">
                    </span>
                    <span>
                        <span class="block text-[20px] font-semibold leading-none tracking-[-0.02em]">Nad's Kitchen</span>
                        <span class="mt-1 block text-[10px] font-medium uppercase tracking-[0.16em] text-[var(--text-secondary)]">Catering Surabaya</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-1 md:flex">
                    <a href="{{ route('public.home') }}" class="nk-nav-link {{ $isActive('public.home') ? 'is-active' : '' }}">Dashboard</a>
                    <a href="{{ route('public.menus.index') }}" class="nk-nav-link {{ $isActive('public.menus.*') ? 'is-active' : '' }}">Menu</a>
                    <a href="{{ route('public.orders.track.create') }}" class="nk-nav-link {{ $isActive('public.orders.track.*') ? 'is-active' : '' }}">Cek Pesanan</a>
                    <a href="{{ route('public.cart.index') }}" class="nk-nav-link {{ $isActive('public.cart.*') ? 'is-active' : '' }}">Keranjang</a>
                </nav>

                <div class="flex items-center gap-2.5">
                    <span class="hidden rounded-full border border-[var(--border)] bg-[var(--bg-card)] px-3 py-2 text-[11px] font-medium text-[var(--text-secondary)] md:inline-flex">
                        Warm meals. Fast response.
                    </span>
                    <button type="button" class="flex h-9 w-9 items-center justify-center rounded-full border border-[var(--border)] text-[var(--text-secondary)] md:hidden" aria-label="Toggle menu">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M4 7h16M4 12h16M4 17h16"></path>
                        </svg>
                    </button>

                    <a href="{{ route('public.cart.index') }}" class="nk-cart-pill">
                        <svg class="h-4 w-4 text-[var(--text-secondary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M3 3h2l1.2 9.2A2 2 0 0 0 8.2 14h8.8a2 2 0 0 0 2-1.6L20 7H6"></path>
                            <circle cx="9" cy="19" r="1"></circle>
                            <circle cx="17" cy="19" r="1"></circle>
                        </svg>
                        <span>Keranjang</span>
                        <span class="inline-flex h-[18px] min-w-[18px] items-center justify-center rounded-full bg-[var(--accent-warm)] px-1 text-[10px] font-bold text-white">{{ $navCartCount }}</span>
                    </a>

                    <a href="https://wa.me/628000000000" class="nk-btn-contact hidden md:inline-flex">Hubungi Admin</a>
                </div>
            </div>
        </div>
    </header>

    <main class="pb-16 pt-8">
        <div class="nk-container">
            @if (session('success'))
                <div class="mb-6 rounded-[14px] border border-[var(--success)]/40 bg-[var(--success)]/10 px-4 py-3 text-sm text-[var(--text)]">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-[14px] border border-[var(--error)]/40 bg-[var(--error)]/10 px-4 py-3 text-sm text-[var(--text)]">{{ session('error') }}</div>
            @endif

            {{ $slot }}
        </div>
    </main>

    <footer class="nk-footer">
        <div class="nk-container">
            <div class="flex flex-wrap items-start justify-between gap-8">
                <div class="max-w-[320px]">
                    <div class="flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-[14px] border border-[var(--border)] bg-[var(--bg-card)]">
                            <img src="{{ asset('images/nads-kitchen-logo.png') }}" alt="Nad's Kitchen" class="h-full w-full object-contain p-1">
                        </span>
                        <div>
                            <p class="text-[19px] font-semibold leading-none">Nad's Kitchen</p>
                            <p class="mt-1 text-[11px] uppercase tracking-[0.16em] text-[var(--text-secondary)]">Catering Surabaya</p>
                        </div>
                    </div>
                    <p class="mt-3 text-[12.5px] leading-[1.7] text-[var(--text-secondary)]">Catering hangat, rapi, dan premium untuk acara keluarga, kantor, dan komunitas.</p>
                </div>

                <div class="flex flex-wrap gap-8">
                    <div>
                        <p class="text-[10.5px] font-semibold uppercase tracking-[0.1em] text-[var(--text-secondary)]">WhatsApp</p>
                        <p class="mt-2 text-[13px]">+62 812-3456-7890</p>
                    </div>
                    <div>
                        <p class="text-[10.5px] font-semibold uppercase tracking-[0.1em] text-[var(--text-secondary)]">Operasional</p>
                        <p class="mt-2 text-[13px]">Senin - Sabtu, 07.00-17.00</p>
                    </div>
                    <div>
                        <p class="text-[10.5px] font-semibold uppercase tracking-[0.1em] text-[var(--text-secondary)]">Lokasi</p>
                        <p class="mt-2 text-[13px]">Surabaya, Jawa Timur</p>
                    </div>
                </div>
            </div>

            <div class="mt-7 border-t border-[var(--border)] pt-5 text-center text-[12.5px] text-[var(--text-secondary)]">
                © 2026 Nad's Kitchen. Seluruh hak cipta dilindungi.
            </div>
        </div>
    </footer>
</body>
</html>
