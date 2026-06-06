<x-public-layout>
    <section class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-start">
        <div class="fade-up">
            <x-food-image
                :src="$menu->image_url"
                :placeholder="$menu->image_placeholder_url"
                :alt="$menu->name"
                ratio="16 / 11"
                class="overflow-hidden rounded-[32px] border border-[var(--border)] shadow-[0_20px_70px_rgba(43,42,40,0.14)]"
                image-class=""
            >
                <div class="absolute inset-x-0 bottom-0 z-10 flex items-center justify-between gap-3 p-5 text-white">
                    <span class="rounded-full border border-white/20 bg-white/12 px-3 py-1 text-[10.5px] font-semibold uppercase tracking-[0.14em] text-white/90 backdrop-blur-sm">{{ $menu->category?->name }}</span>
                    <span class="rounded-full border border-white/20 bg-white/12 px-3 py-1 text-[10.5px] font-semibold uppercase tracking-[0.14em] text-white/90 backdrop-blur-sm">{{ $menu->is_available ? 'Ready to order' : 'Currently unavailable' }}</span>
                </div>
            </x-food-image>

            <div class="mt-6 rounded-[28px] border border-[var(--border)] bg-[var(--bg-card)] p-6 shadow-[var(--shadow)]">
                <p class="nk-eyebrow">Detail Menu</p>
                <h1 class="mt-4 text-[clamp(2.2rem,5vw,4.2rem)] font-normal leading-[0.98] tracking-[-0.03em]">{{ $menu->name }}</h1>
                <p class="mt-5 text-[15.5px] leading-[1.85] text-[var(--text-secondary)]">{{ $menu->description }}</p>

                <div class="mt-8 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-[22px] border border-[var(--border)] bg-[var(--bg)] p-4">
                        <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Harga</p>
                        <p class="mt-2 text-[24px] font-medium text-[var(--accent-warm)]"><x-price :amount="$menu->price" /></p>
                    </div>
                    <div class="rounded-[22px] border border-[var(--border)] bg-[var(--bg)] p-4">
                        <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Minimum</p>
                        <p class="mt-2 text-[24px] font-medium">{{ $menu->minimum_order }} {{ $menu->unit }}</p>
                    </div>
                    <div class="rounded-[22px] border border-[var(--border)] bg-[var(--bg)] p-4">
                        <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Status</p>
                        <p class="mt-2 text-[24px] font-medium {{ $menu->is_available ? 'text-[var(--success)]' : 'text-[var(--error)]' }}">{{ $menu->is_available ? 'Tersedia' : 'Tidak tersedia' }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('public.cart.store') }}" class="mt-8 space-y-4">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                    <x-input
                        name="quantity"
                        type="number"
                        label="Jumlah Pesanan"
                        :value="$menu->minimum_order"
                        :placeholder="'Minimal ' . $menu->minimum_order"
                        min="{{ $menu->minimum_order }}"
                    />

                    @if (! $menu->is_available)
                        <div class="rounded-[18px] border border-[var(--error)]/25 bg-[var(--error)]/10 px-4 py-3 text-sm text-[var(--error)]">
                            Menu ini sedang tidak tersedia untuk dipesan.
                        </div>
                    @endif

                    <div class="flex flex-wrap gap-3">
                        <x-button type="submit" :disabled="! $menu->is_available">Tambah ke Keranjang</x-button>
                        <x-button variant="secondary" :href="route('public.menus.index')">Kembali ke menu</x-button>
                    </div>
                </form>
            </div>
        </div>

        <aside class="fade-up-d1 space-y-5 lg:sticky lg:top-[96px]">
            <div class="rounded-[28px] border border-[var(--border)] bg-[var(--bg-card)] p-6 shadow-[var(--shadow)]">
                <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Ringkasan</p>
                <h2 class="mt-4 text-[24px] font-medium leading-[1.1]">Informasi inti yang paling dibutuhkan pelanggan</h2>

                <div class="mt-5 space-y-4">
                    <div class="rounded-[18px] border border-[var(--border)] bg-[var(--bg)] px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Kategori</p>
                        <p class="mt-1 text-[15px] font-medium">{{ $menu->category?->name ?? '-' }}</p>
                    </div>
                    <div class="rounded-[18px] border border-[var(--border)] bg-[var(--bg)] px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Siap kirim</p>
                        <p class="mt-1 text-[15px] font-medium">Dikemas rapi untuk event dan kebutuhan harian</p>
                    </div>
                    <div class="rounded-[18px] border border-[var(--border)] bg-[var(--bg)] px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">CTA cepat</p>
                        <p class="mt-1 text-[15px] font-medium">Langsung masuk keranjang atau lanjut ke checkout</p>
                    </div>
                </div>
            </div>

            <div class="rounded-[28px] border border-[var(--border)] bg-[linear-gradient(135deg,rgba(108,122,90,0.12),rgba(201,123,99,0.16))] p-6 shadow-[var(--shadow)]">
                <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Butuh bantuan?</p>
                <h2 class="mt-3 text-[24px] font-medium leading-[1.1]">Pesanan untuk kantor, acara, atau harian bisa disesuaikan.</h2>
                <p class="mt-4 text-[14px] leading-[1.7] text-[var(--text-secondary)]">
                    Jika Anda membutuhkan jumlah banyak atau ingin kombinasi paket, halaman ini sudah cukup jelas untuk memulai proses order.
                </p>
                <div class="mt-5 flex flex-wrap gap-3">
                    <a href="{{ route('public.orders.track.create') }}" class="nk-btn-detail">Cek pesanan</a>
                    <a href="{{ route('public.home') }}" class="nk-btn-primary">Kembali ke beranda</a>
                </div>
            </div>
        </aside>
    </section>
</x-public-layout>
