@props(['class' => ''])

<aside {{ $attributes->merge(['class' => 'hidden w-72 border-r border-nk-border bg-nk-card p-6 lg:block ' . $class]) }}>
    <a href="{{ route('kitchen.dashboard') }}" class="block">
        <img src="{{ asset('images/nads-kitchen-logo.png') }}" alt="Nad's Kitchen Catering" class="h-auto w-44 max-w-full" />
        <p class="mt-2 text-sm text-nk-muted">Dapur Panel</p>
    </a>

    <nav class="mt-8 space-y-2 text-sm">
        @php
            $links = [
                ['label' => 'Dashboard Dapur', 'href' => route('kitchen.dashboard'), 'active' => request()->routeIs('kitchen.dashboard')],
                ['label' => 'Pesanan Produksi', 'href' => route('kitchen.production-orders.index'), 'active' => request()->routeIs('kitchen.production-orders.*')],
                ['label' => 'Rekap Bahan', 'href' => route('kitchen.ingredient-recaps.index'), 'active' => request()->routeIs('kitchen.ingredient-recaps.*')],
            ];
        @endphp

        @foreach ($links as $link)
            <a href="{{ $link['href'] }}" class="block rounded-xl px-4 py-2.5 transition {{ $link['active'] ? 'bg-nk-alt text-nk-text font-semibold' : 'text-nk-muted hover:bg-nk-alt/70 hover:text-nk-text' }}">
                {{ $link['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="mt-8 space-y-2">
        <a href="{{ route('public.home') }}" class="block rounded-xl border border-nk-border px-4 py-2.5 text-sm text-nk-muted transition hover:bg-nk-alt hover:text-nk-text">Lihat Website</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full rounded-xl bg-nk-error px-4 py-2.5 text-sm font-medium text-white transition hover:opacity-90">Logout</button>
        </form>
    </div>
</aside>
