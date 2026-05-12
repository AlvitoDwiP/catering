<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? "Nad's Kitchen Order System" }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-nk-bg font-sans text-nk-text">
    @php
        $navCartCount = collect(session('cart.items', []))->count();
        $isActive = fn (string $routePattern): bool => request()->routeIs($routePattern);
        $activeClass = 'nk-nav-pill px-4 py-2 text-nk-text';
        $inactiveClass = 'px-4 py-2 text-nk-muted transition hover:text-nk-text';
    @endphp

    <header class="sticky top-0 z-50 border-b border-nk-border/80 bg-nk-bg/95 backdrop-blur">
        <div class="mx-auto max-w-[1140px] px-4 sm:px-6 lg:px-8">
            <div class="flex min-h-[72px] flex-wrap items-center justify-between gap-4">
                <a href="{{ route('public.home') }}" class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-nk-primary text-white">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"></circle>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="12" cy="12" r="1.4" fill="currentColor" stroke="none"></circle>
                        </svg>
                    </span>
                    <span>
                        <span class="block font-heading text-[18px] leading-tight text-nk-text">Nad's Kitchen</span>
                        <span class="mt-0.5 block text-[11px] tracking-[0.18em] text-nk-muted">CATERING · SURABAYA</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-1 text-[15px] font-medium md:flex">
                    <a href="{{ route('public.home') }}" class="{{ $isActive('public.home') ? $activeClass : $inactiveClass }}">Dashboard</a>
                    <a href="{{ route('public.menus.index') }}" class="{{ $isActive('public.menus.*') ? $activeClass : $inactiveClass }}">Menu</a>
                    <a href="{{ route('public.orders.track.create') }}" class="{{ $isActive('public.orders.track.*') ? $activeClass : $inactiveClass }}">Cek Pesanan</a>
                    <a href="{{ route('public.cart.index') }}" class="{{ $isActive('public.cart.*') ? $activeClass : $inactiveClass }}">Keranjang</a>
                </nav>

                <div class="flex items-center gap-2">
                    <a href="{{ route('public.cart.index') }}" class="nk-nav-pill inline-flex items-center gap-2 px-4 py-2 text-[15px] font-medium text-nk-text">
                        <svg class="h-4.5 w-4.5 text-nk-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M3 3h2l1.2 9.2A2 2 0 0 0 8.2 14h8.8a2 2 0 0 0 2-1.6L20 7H6"></path>
                            <circle cx="9" cy="19" r="1"></circle>
                            <circle cx="17" cy="19" r="1"></circle>
                        </svg>
                        <span>Keranjang</span>
                        <span class="inline-flex min-w-5 items-center justify-center rounded-full bg-nk-secondary px-1.5 py-0.5 text-[11px] font-semibold text-white">{{ $navCartCount }}</span>
                    </a>
                    <a href="https://wa.me/628000000000" class="inline-flex items-center rounded-full bg-nk-primary px-5 py-2 text-[15px] font-semibold text-white transition hover:bg-nk-primary-dark">Hubungi Admin</a>
                </div>
            </div>
        </div>
    </header>

    <main class="mx-auto w-full max-w-[1140px] px-4 py-8 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-nk-success/40 bg-nk-success/10 px-4 py-3 text-sm text-nk-text">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-nk-error/40 bg-nk-error/10 px-4 py-3 text-sm text-nk-text">{{ session('error') }}</div>
        @endif

        {{ $slot }}
    </main>

    <footer class="border-t border-nk-border bg-nk-alt/75 py-10">
        <div class="mx-auto max-w-[1140px] px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 text-[14px] text-nk-muted md:grid-cols-4">
                <div>
                    <p class="font-heading text-[28px] text-nk-text">Nad's Kitchen</p>
                    <p class="mt-2">Catering untuk Setiap Acara · Surabaya</p>
                </div>
                <div>
                    <p class="text-[12px] font-semibold uppercase tracking-[0.16em]">WhatsApp</p>
                    <p class="mt-2 text-nk-primary">+62 812-3456-7890</p>
                </div>
                <div>
                    <p class="text-[12px] font-semibold uppercase tracking-[0.16em]">Jam Operasional</p>
                    <p class="mt-2 text-nk-text">Senin - Sabtu, 07.00-17.00</p>
                </div>
                <div>
                    <p class="text-[12px] font-semibold uppercase tracking-[0.16em]">Alamat</p>
                    <p class="mt-2 text-nk-text">Surabaya, Jawa Timur</p>
                </div>
            </div>
            <div class="mt-8 border-t border-nk-border pt-5 text-center text-[13px] text-nk-muted">© 2026 Nad's Kitchen. Seluruh hak cipta dilindungi.</div>
        </div>
    </footer>
</body>
</html>
