<aside class="hidden w-72 border-r border-nk-border bg-nk-card p-6 lg:block">
    <a href="{{ route('admin.dashboard') }}" class="block">
        <p class="font-heading text-3xl text-nk-text">Nad's Kitchen</p>
        <p class="text-sm text-nk-muted">Admin Panel</p>
    </a>

    <nav class="mt-8 space-y-2 text-sm">
        @php
            $links = [
                ['label' => 'Dashboard', 'href' => route('admin.dashboard'), 'active' => request()->routeIs('admin.dashboard')],
                ['label' => 'Menu', 'href' => '#', 'active' => false],
                ['label' => 'Kategori Menu', 'href' => '#', 'active' => false],
                ['label' => 'Pesanan', 'href' => '#', 'active' => false],
                ['label' => 'Invoice', 'href' => '#', 'active' => false],
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
