<x-public-layout>
    <section class="nk-hero-gradient rounded-[28px] px-6 pb-8 pt-14 lg:px-8 lg:pb-10 lg:pt-[90px]">
        <div class="grid items-center gap-10 lg:grid-cols-2">
            <div>
                <p class="flex items-center gap-3 text-[12px] font-semibold uppercase tracking-[0.2em] text-nk-primary">
                    <span class="h-px w-8 bg-nk-primary"></span>
                    CATERING UNTUK SETIAP ACARA
                </p>

                <h1 class="mt-6 font-heading text-[56px] leading-[1.08] text-nk-text lg:text-[62px]">
                    Pesan Catering
                    <br>
                    Lebih <span class="italic text-nk-secondary">Mudah</span> untuk
                    <br>
                    Setiap Acara
                </h1>

                <p class="mt-6 max-w-xl text-[17px] leading-[1.8] text-nk-muted">Pilih menu, atur jumlah porsi, dan kirim pesanan Anda dengan praktis. Nad's Kitchen membantu menyiapkan kebutuhan acara Anda dengan lebih rapi.</p>

                <div class="mt-7 flex flex-wrap items-center gap-3">
                    <a href="{{ route('public.menus.index') }}" class="inline-flex items-center gap-2 rounded-full bg-nk-primary px-7 py-3 text-[16px] font-semibold text-white transition hover:bg-nk-primary-dark">+ Mulai Pesan</a>
                    <a href="{{ route('public.orders.track.create') }}" class="inline-flex items-center gap-2 rounded-full border border-nk-border bg-nk-card px-7 py-3 text-[16px] font-semibold text-nk-text transition hover:bg-nk-alt/70">
                        <svg class="h-4 w-4 text-nk-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="m20 20-3.5-3.5"></path>
                        </svg>
                        Cek Pesanan
                    </a>
                </div>

                <div class="mt-7 flex flex-wrap gap-6 text-[15px] text-nk-muted">
                    <span class="inline-flex items-center gap-2"><span class="font-semibold text-nk-primary">✓</span> Tanpa login</span>
                    <span class="inline-flex items-center gap-2"><span class="font-semibold text-nk-primary">✓</span> Invoice otomatis</span>
                    <span class="inline-flex items-center gap-2"><span class="font-semibold text-nk-primary">✓</span> Konfirmasi admin</span>
                </div>
            </div>

            <div class="relative">
                <div class="nk-menu-visual relative grid h-[520px] grid-cols-2 lg:h-[560px]">
                    <div class="flex items-center justify-center bg-[#E6DDCE] text-[62px]">🍱</div>
                    <div class="flex items-center justify-center bg-[#DDD3C5] text-[62px]">🍛</div>
                    <div class="flex items-center justify-center bg-[#DCD2C6] text-[62px]">🍙</div>
                    <div class="flex items-center justify-center bg-[#E2D8CA] text-[62px]">🧋</div>

                    <div class="nk-floating-card absolute right-3 top-3 px-5 py-3">
                        <p class="text-[11px] font-medium uppercase tracking-[0.16em] text-nk-muted">● PESANAN AKTIF</p>
                        <p class="mt-1.5 font-heading text-[36px] leading-none text-nk-text">24 <span class="font-sans text-[15px] text-nk-muted">pesanan/hari</span></p>
                    </div>

                    <div class="nk-floating-card absolute -bottom-4 left-4 px-5 py-3">
                        <p class="text-[11px] font-medium uppercase tracking-[0.16em] text-nk-muted">RATING</p>
                        <p class="mt-1.5 font-heading text-[36px] leading-none text-nk-text">4.9 <span class="text-[15px] text-[#D6A43A]">⭐</span> <span class="font-sans text-[15px] text-nk-muted">dari pelanggan</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-12 grid gap-6 lg:grid-cols-2">
        <article class="rounded-[28px] border border-nk-border bg-nk-card p-8 nk-soft-shadow">
            <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl border border-nk-border bg-nk-alt/60 text-nk-primary">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M3 7h18" />
                    <path d="M5 7l1 12h12l1-12" />
                    <path d="M9 11h6" />
                    <path d="M10 7V5a2 2 0 0 1 4 0v2" />
                </svg>
            </div>
            <h2 class="mt-6 font-heading text-[24px] text-nk-text">Pesan Catering</h2>
            <p class="mt-3 max-w-xl text-[16px] leading-[1.7] text-nk-muted">Pilih menu catering sesuai kebutuhan acara Anda dan tambahkan ke keranjang dengan mudah.</p>
            <div class="mt-7">
                <a href="{{ route('public.menus.index') }}" class="inline-flex items-center gap-2 rounded-full bg-nk-primary px-7 py-3 text-[16px] font-semibold text-white transition hover:bg-nk-primary-dark">Mulai Pesan <span>→</span></a>
            </div>
        </article>

        <article class="rounded-[28px] border border-nk-border bg-nk-card p-8 nk-soft-shadow">
            <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl border border-nk-border bg-nk-alt/60 text-nk-primary">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-3.5-3.5"></path>
                </svg>
            </div>
            <h2 class="mt-6 font-heading text-[24px] text-nk-text">Cek Pesanan</h2>
            <p class="mt-3 text-[16px] leading-[1.7] text-nk-muted">Masukkan nomor invoice atau kode pesanan untuk melihat status pesanan Anda secara real-time.</p>
            <form action="{{ route('public.orders.track.store') }}" method="POST" class="mt-7 flex flex-wrap items-end gap-3">
                @csrf
                <div class="min-w-[240px] flex-1">
                    <label for="invoice_number" class="sr-only">Nomor Invoice</label>
                    <input id="invoice_number" name="invoice_number" value="{{ old('invoice_number') }}" placeholder="Contoh: INV-20260512-001" class="h-14 w-full rounded-2xl border border-nk-border bg-nk-card px-5 text-[15px] text-nk-text placeholder:text-nk-muted focus:border-nk-primary focus:outline-none">
                    @error('invoice_number')
                        <p class="mt-2 text-sm text-nk-error">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="h-14 rounded-full bg-nk-primary px-7 text-[16px] font-semibold text-white transition hover:bg-nk-primary-dark">Cek Status</button>
            </form>
        </article>
    </section>

    <section class="mt-10 rounded-[28px] border border-nk-border bg-nk-card p-7 nk-soft-shadow">
        @if ($cartItems->isEmpty())
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-4">
                    <span class="inline-flex h-14 w-14 items-center justify-center rounded-2xl border border-nk-border bg-nk-alt/60 text-2xl text-nk-primary">🛒</span>
                    <div>
                        <p class="text-[12px] font-semibold uppercase tracking-[0.16em] text-nk-muted">Keranjang Anda</p>
                        <p class="font-heading text-[34px] text-nk-text">0 menu dipilih</p>
                        <p class="text-[15px] text-nk-muted">Belum ada item. Tambahkan menu dulu untuk lanjut checkout.</p>
                    </div>
                </div>
                <a href="{{ route('public.menus.index') }}" class="inline-flex items-center rounded-full bg-nk-primary px-7 py-3 text-[16px] font-semibold text-white">Pilih Menu</a>
            </div>
        @else
            <div class="grid gap-5 lg:grid-cols-[1fr_1fr_auto] lg:items-center">
                <div class="flex items-center gap-4">
                    <span class="inline-flex h-14 w-14 items-center justify-center rounded-2xl border border-nk-border bg-nk-alt/60 text-2xl text-nk-primary">🛒</span>
                    <div>
                        <p class="text-[12px] font-semibold uppercase tracking-[0.16em] text-nk-muted">Keranjang Anda</p>
                        <p class="font-heading text-[34px] text-nk-text">{{ $cartCount }} menu dipilih</p>
                        <p class="text-[14px] text-nk-muted">● Siap untuk checkout</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2">
                    @foreach ($cartItems->take(5) as $item)
                        <span class="inline-flex items-center gap-2 rounded-2xl border border-nk-border bg-nk-alt/45 px-3 py-1.5 text-[14px] text-nk-text">{{ $item['name'] }} <span class="rounded-full bg-nk-primary px-2 py-0.5 text-[11px] font-semibold text-white">{{ $item['quantity'] }}</span></span>
                    @endforeach
                </div>

                <div class="text-left lg:text-right">
                    <p class="text-[14px] text-nk-muted">Estimasi Total</p>
                    <p class="font-heading text-[42px] leading-tight text-nk-secondary"><x-price :amount="$cartTotal" /></p>
                    <div class="mt-3 flex flex-wrap gap-2 lg:justify-end">
                        <a href="{{ route('public.cart.index') }}" class="inline-flex items-center rounded-full border border-nk-border bg-nk-card px-5 py-2.5 text-[15px] text-nk-text">Lihat Keranjang</a>
                        <a href="{{ route('public.checkout.create') }}" class="inline-flex items-center rounded-full bg-nk-secondary px-5 py-2.5 text-[15px] font-semibold text-white">Lanjut Checkout →</a>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <section class="mt-14">
        <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
            <div>
                <h2 class="font-heading text-[48px] text-nk-text">Menu Tersedia</h2>
                <p class="mt-2 text-[16px] text-nk-muted">Pilih menu favorit untuk acara keluarga, kantor, maupun kegiatan lainnya.</p>
            </div>
            <a href="{{ route('public.menus.index') }}" class="text-[16px] font-medium text-nk-primary">Lihat Semua Menu →</a>
        </div>

        <div class="grid gap-8 md:grid-cols-2">
            @forelse ($recommendedMenus->take(4) as $menu)
                <article class="nk-menu-card">
                    <div class="flex h-64 items-center justify-center text-[74px] {{ $loop->iteration % 4 === 1 ? 'bg-[#E8DCC7]' : ($loop->iteration % 4 === 2 ? 'bg-[#CFE0CF]' : ($loop->iteration % 4 === 3 ? 'bg-[#E6D8CC]' : 'bg-[#CFE1EA]')) }}">
                        @if ($loop->iteration % 4 === 1)
                            🍱
                        @elseif ($loop->iteration % 4 === 2)
                            🍙
                        @elseif ($loop->iteration % 4 === 3)
                            🍛
                        @else
                            🧋
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="font-heading text-[24px] text-nk-text">{{ $menu->name }}</h3>
                            <span class="inline-flex items-center rounded-full bg-[#DCE3D5] px-3 py-1.5 text-[13px] font-semibold text-[#648054]">● {{ $menu->is_available ? 'Tersedia' : 'Tidak tersedia' }}</span>
                        </div>
                        <p class="mt-3 line-clamp-2 text-[16px] leading-[1.7] text-nk-muted">{{ $menu->description }}</p>
                        <div class="mt-4 flex flex-wrap items-center gap-2">
                            <p class="font-heading text-[22px] text-nk-text"><x-price :amount="$menu->price" /> <span class="font-sans text-[14px] text-nk-muted">/{{ $menu->unit }}</span></p>
                            <span class="rounded-xl border border-nk-border bg-nk-alt/45 px-3 py-1.5 text-[13px] text-nk-muted">Min. {{ $menu->minimum_order }} {{ $menu->unit }}</span>
                        </div>
                        <div class="mt-5 flex gap-2">
                            <a href="{{ route('public.menus.show', $menu) }}" class="inline-flex items-center rounded-full border border-nk-border bg-nk-card px-5 py-2.5 text-[14px] text-nk-text">Detail</a>
                            <form method="POST" action="{{ route('public.cart.store') }}" class="flex-1">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                <input type="hidden" name="quantity" value="{{ $menu->minimum_order }}">
                                <button type="submit" class="w-full rounded-full bg-nk-primary px-5 py-2.5 text-[15px] font-semibold text-white transition hover:bg-nk-primary-dark" @disabled(! $menu->is_available)>+ Tambah</button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="md:col-span-2">
                    <x-empty-state title="Menu belum tersedia" description="Kami sedang menyiapkan menu terbaik untuk Anda." />
                </div>
            @endforelse
        </div>
    </section>

    <section class="mt-14 -mx-4 border-y border-nk-border bg-nk-alt/85 px-4 py-14 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div>
            <p class="flex items-center gap-3 text-[12px] font-semibold uppercase tracking-[0.2em] text-nk-primary">
                <span class="h-px w-8 bg-nk-primary"></span>
                PANDUAN PEMESANAN
            </p>
            <h2 class="mt-5 font-heading text-[44px] text-nk-text">Informasi Pemesanan</h2>
            <p class="mt-2 text-[16px] text-nk-muted">Pastikan Anda memahami ketentuan berikut sebelum mengirim pesanan.</p>

            <div class="mt-10 grid gap-8 sm:grid-cols-2 xl:grid-cols-4">
                <article>
                    <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-2xl border border-nk-border bg-nk-card text-nk-primary">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 7h18"/><path d="M5 7l1 12h12l1-12"/><path d="M9 11h6"/><path d="M10 7V5a2 2 0 0 1 4 0v2"/></svg>
                    </div>
                    <h3 class="font-heading text-[24px] text-nk-text">Minimum Pemesanan</h3>
                    <p class="mt-2 text-[15px] leading-[1.8] text-nk-muted">Minimum pemesanan mengikuti ketentuan masing-masing menu yang tertera di halaman menu.</p>
                </article>
                <article>
                    <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-2xl border border-nk-border bg-nk-card text-nk-primary">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </div>
                    <h3 class="font-heading text-[24px] text-nk-text">Waktu Pemesanan</h3>
                    <p class="mt-2 text-[15px] leading-[1.8] text-nk-muted">Pemesanan disarankan maksimal H-2 sebelum acara untuk memastikan persiapan yang optimal.</p>
                </article>
                <article>
                    <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-2xl border border-nk-border bg-nk-card text-nk-primary">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><path d="M2 10h20"/></svg>
                    </div>
                    <h3 class="font-heading text-[24px] text-nk-text">Metode Pembayaran</h3>
                    <p class="mt-2 text-[15px] leading-[1.8] text-nk-muted">Pembayaran dilakukan secara manual melalui transfer bank atau konfirmasi langsung kepada admin.</p>
                </article>
                <article>
                    <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-2xl border border-nk-border bg-nk-card text-nk-primary">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="m9 12 2 2 4-4"/><circle cx="12" cy="12" r="9"/></svg>
                    </div>
                    <h3 class="font-heading text-[24px] text-nk-text">Konfirmasi Pesanan</h3>
                    <p class="mt-2 text-[15px] leading-[1.8] text-nk-muted">Pesanan akan diproses dan disiapkan setelah dikonfirmasi oleh admin Nad's Kitchen.</p>
                </article>
            </div>
        </div>
    </section>
</x-public-layout>
