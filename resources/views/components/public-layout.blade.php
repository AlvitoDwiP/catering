<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? "Nad's Kitchen Order System" }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-nk-bg font-sans text-nk-text">
    <header class="sticky top-0 z-50 border-b border-nk-border bg-nk-bg/95 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('public.home') }}" class="font-heading text-2xl font-semibold tracking-wide text-nk-text">Nad's Kitchen</a>
            <nav class="hidden items-center gap-6 text-sm text-nk-muted md:flex">
                <a href="{{ route('public.home') }}" class="transition hover:text-nk-text">Dashboard</a>
                <a href="{{ route('public.menus.index') }}" class="transition hover:text-nk-text">Menu</a>
                <a href="{{ route('public.orders.track.create') }}" class="transition hover:text-nk-text">Cek Pesanan</a>
                <a href="{{ route('public.cart.index') }}" class="transition hover:text-nk-text">Keranjang</a>
            </nav>
            <x-button href="https://wa.me/628000000000" variant="secondary">Hubungi Admin</x-button>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

    <footer class="border-t border-nk-border bg-nk-alt">
        <div class="mx-auto grid max-w-6xl gap-4 px-4 py-8 text-sm text-nk-muted sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <p class="font-heading text-lg text-nk-text">Nad's Kitchen</p>
                <p>Catering hangat untuk momen istimewa Anda.</p>
            </div>
            <div>
                <p class="font-semibold text-nk-text">WhatsApp</p>
                <p>+62 800 0000 0000</p>
            </div>
            <div>
                <p class="font-semibold text-nk-text">Jam & Alamat</p>
                <p>Senin - Sabtu, 08.00 - 17.00 WIB</p>
                <p>Jl. Catering Sejahtera No. 88, Jakarta</p>
            </div>
        </div>
    </footer>
</body>
</html>
