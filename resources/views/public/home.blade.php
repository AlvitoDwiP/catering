<x-public-layout>
    <section class="rounded-[28px] border border-nk-border bg-gradient-to-r from-nk-card to-nk-alt px-8 py-14">
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-nk-muted">CATERING UNTUK SETIAP ACARA</p>
        <h1 class="mt-4 max-w-3xl font-heading text-4xl leading-tight text-nk-text sm:text-5xl">Pesan Catering Lebih Mudah untuk Setiap Acara</h1>
        <p class="mt-5 max-w-3xl text-nk-muted">Pilih menu, atur jumlah porsi, dan kirim pesanan Anda dengan praktis. Nad's Kitchen membantu menyiapkan kebutuhan acara Anda dengan lebih rapi.</p>
        <div class="mt-8 flex flex-wrap gap-3">
            <x-button :href="route('public.menus.index')">Mulai Pesan</x-button>
            <x-button variant="secondary" :href="route('public.orders.track.create')">Cek Pesanan</x-button>
        </div>
        <div class="mt-7 flex flex-wrap gap-4 text-sm text-nk-muted">
            <span class="rounded-full border border-nk-border bg-white/60 px-4 py-2">Tanpa login</span>
            <span class="rounded-full border border-nk-border bg-white/60 px-4 py-2">Invoice otomatis</span>
            <span class="rounded-full border border-nk-border bg-white/60 px-4 py-2">Konfirmasi admin</span>
        </div>
    </section>

    <section class="mt-8 grid gap-5 lg:grid-cols-3">
        <x-card class="lg:col-span-1">
            <h2 class="font-heading text-2xl text-nk-text">Pesan Catering</h2>
            <p class="mt-2 text-sm text-nk-muted">Pilih menu catering sesuai kebutuhan acara Anda dan tambahkan ke keranjang dengan mudah.</p>
            <div class="mt-5">
                <x-button :href="route('public.menus.index')">Mulai Pesan</x-button>
            </div>
        </x-card>

        <x-card class="lg:col-span-1">
            <h2 class="font-heading text-2xl text-nk-text">Cek Pesanan</h2>
            <form action="{{ route('public.orders.track.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <x-input name="invoice_number" label="Nomor Invoice" placeholder="Contoh: INV-20260512-001" />
                <x-button type="submit" variant="secondary">Cek Status</x-button>
            </form>
        </x-card>

        <x-card class="lg:col-span-1">
            <h2 class="font-heading text-2xl text-nk-text">Keranjang</h2>
            @if ($cartItems->isEmpty())
                <p class="mt-2 text-sm text-nk-muted">Belum ada menu yang dipilih.</p>
                <div class="mt-5">
                    <x-button :href="route('public.menus.index')" variant="secondary">Pilih Menu</x-button>
                </div>
            @else
                <p class="mt-2 text-sm text-nk-muted">{{ $cartCount }} menu dipilih</p>
                <p class="mt-1 text-sm text-nk-muted">Estimasi total: <x-price :amount="$cartTotal" class="font-semibold text-nk-primary" /></p>
                <div class="mt-5 flex flex-wrap gap-2">
                    <x-button :href="route('public.cart.index')" variant="secondary">Lihat Keranjang</x-button>
                    <x-button :href="route('public.checkout.create')">Lanjut Checkout</x-button>
                </div>
            @endif
        </x-card>
    </section>

    <section class="mt-10 space-y-4">
        <h2 class="font-heading text-3xl text-nk-text">Menu Tersedia</h2>
        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4">
            @forelse ($recommendedMenus as $menu)
                <x-card>
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="h-40 w-full rounded-xl object-cover">
                    <h3 class="mt-3 font-heading text-2xl text-nk-text">{{ $menu->name }}</h3>
                    <p class="mt-1 line-clamp-3 text-sm text-nk-muted">{{ $menu->description }}</p>
                    <p class="mt-3 text-sm text-nk-muted">Minimum {{ $menu->minimum_order }} {{ $menu->unit }}</p>
                    <p class="mt-2 text-xs font-semibold {{ $menu->is_available ? 'text-nk-success' : 'text-nk-error' }}">
                        {{ $menu->is_available ? 'Tersedia' : 'Tidak tersedia' }}
                    </p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <x-button :href="route('public.menus.show', $menu)" variant="secondary">Detail</x-button>
                        <form method="POST" action="{{ route('public.cart.store') }}">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <input type="hidden" name="quantity" value="{{ $menu->minimum_order }}">
                            <x-button type="submit" :disabled="! $menu->is_available">Tambah</x-button>
                        </form>
                    </div>
                </x-card>
            @empty
                <div class="md:col-span-2 lg:col-span-4">
                    <x-empty-state title="Menu belum tersedia" description="Kami sedang menyiapkan menu terbaik untuk Anda." />
                </div>
            @endforelse
        </div>
    </section>

    <section class="mt-10">
        <x-card padding="lg">
            <h2 class="font-heading text-3xl text-nk-text">Informasi Pemesanan</h2>
            <ul class="mt-4 list-disc space-y-2 pl-5 text-sm text-nk-muted">
                <li>Minimum pemesanan mengikuti ketentuan masing-masing menu.</li>
                <li>Pemesanan disarankan maksimal H-2 sebelum acara.</li>
                <li>Pembayaran dilakukan manual melalui transfer atau konfirmasi admin.</li>
                <li>Pesanan akan diproses setelah dikonfirmasi oleh admin.</li>
            </ul>
        </x-card>
    </section>
</x-public-layout>
