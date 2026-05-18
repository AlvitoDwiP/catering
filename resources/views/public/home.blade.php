<x-public-layout>
    <section class="grid items-center gap-16 pb-[88px] pt-[80px] md:grid-cols-2 md:gap-[64px] max-md:grid-cols-1 max-md:pb-[56px] max-md:pt-[48px]">
        <div class="fade-up">
            <p class="nk-eyebrow">Catering Untuk Setiap Acara</p>
            <h1 class="mt-6 text-[58px] font-normal leading-[1.12] tracking-[-0.01em] max-lg:text-[46px] max-md:text-[40px]">
                Pesan Catering Lebih <em class="text-[var(--accent-warm)]">Mudah</em><br>
                untuk Setiap Acara
            </h1>
            <p class="mt-5 max-w-[440px] text-[15.5px] leading-[1.75] text-[var(--text-secondary)]">
                Pilih menu, atur jumlah porsi, dan kirim pesanan Anda dengan praktis. Nad's Kitchen membantu menyiapkan kebutuhan acara dengan alur pemesanan yang rapi dan nyaman.
            </p>

            <div class="mt-7 flex flex-wrap gap-3 max-md:flex-col">
                <a href="{{ route('public.menus.index') }}" class="nk-btn-primary max-md:w-full max-md:justify-center">+ Mulai Pesan</a>
                <a href="{{ route('public.orders.track.create') }}" class="nk-btn-secondary max-md:w-full max-md:justify-center">Cek Pesanan</a>
            </div>

            <div class="mt-6 flex flex-wrap gap-5 text-[12.5px] text-[var(--text-secondary)]">
                <span class="inline-flex items-center gap-2"><span class="text-[var(--success)]">✓</span> Tanpa login</span>
                <span class="inline-flex items-center gap-2"><span class="text-[var(--success)]">✓</span> Invoice otomatis</span>
                <span class="inline-flex items-center gap-2"><span class="text-[var(--success)]">✓</span> Konfirmasi admin</span>
            </div>
        </div>

        <div class="relative fade-up-d1 max-md:hidden">
            <div class="mx-auto max-w-[480px] overflow-hidden rounded-[28px] border border-[var(--border)]">
                <div class="grid grid-cols-2">
                    <div class="flex aspect-square items-center justify-center bg-[linear-gradient(160deg,#EDE0CC,#E8D5BB)] text-[64px]">🍱</div>
                    <div class="flex aspect-square items-center justify-center bg-[linear-gradient(160deg,#DDE8DA,#D0E0CC)] text-[64px]">🍙</div>
                    <div class="flex aspect-square items-center justify-center bg-[linear-gradient(160deg,#E8D8CC,#DCCCC0)] text-[64px]">🍛</div>
                    <div class="flex aspect-square items-center justify-center bg-[linear-gradient(160deg,#CCE0E8,#C4D8E4)] text-[64px]">🧋</div>
                </div>
            </div>

            <div class="nk-floating-card absolute -right-[14px] -top-[14px]">
                <p class="text-[11px] uppercase tracking-[0.12em] text-[var(--text-secondary)]">Pesanan Aktif</p>
                <p class="mt-1 text-[20px] font-medium">24/hari</p>
            </div>

            <div class="nk-floating-card absolute -bottom-[14px] -left-[14px] inline-flex items-center gap-2">
                <span class="nk-dot-pulse"></span>
                <div>
                    <p class="text-[11px] uppercase tracking-[0.12em] text-[var(--text-secondary)]">Status Dapur</p>
                    <p class="text-[15px]">Siap Produksi</p>
                </div>
            </div>
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-2">
        <article class="nk-qa-card p-8 fade-up-d1">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-[14px] border border-[var(--border)] bg-[var(--bg-alt)] text-[var(--accent)]">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 7h18"/><path d="M5 7l1 12h12l1-12"/><path d="M9 11h6"/><path d="M10 7V5a2 2 0 0 1 4 0v2"/></svg>
            </span>
            <h2 class="mt-5 text-[24px] font-medium">Pesan Catering</h2>
            <p class="mt-3 text-[14px] leading-[1.7] text-[var(--text-secondary)]">Pilih menu favorit untuk kebutuhan acara Anda dan tambah ke keranjang dalam beberapa langkah cepat.</p>
            <div class="mt-6">
                <a href="{{ route('public.menus.index') }}" class="nk-btn-primary">Mulai Pesan</a>
            </div>
        </article>

        <article class="nk-qa-card p-8 fade-up-d2">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-[14px] border border-[var(--border)] bg-[var(--bg-alt)] text-[var(--accent)]">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-3.5-3.5"></path></svg>
            </span>
            <h2 class="mt-5 text-[24px] font-medium">Cek Pesanan</h2>
            <p class="mt-3 text-[14px] leading-[1.7] text-[var(--text-secondary)]">Masukkan nomor invoice untuk melihat status pesanan Anda secara real-time.</p>
            <form action="{{ route('public.orders.track.store') }}" method="POST" class="mt-6 flex gap-[10px] max-md:flex-col" data-track-form>
                @csrf
                <input id="invoice_number" name="invoice_number" value="{{ old('invoice_number') }}" placeholder="Contoh: INV-20260512-001" class="w-full" data-track-input>
                <button type="submit" class="nk-btn-primary min-w-[136px]" data-track-submit>Cek Status</button>
            </form>
            @error('invoice_number')
                <p class="mt-2 text-sm text-[var(--error)]">{{ $message }}</p>
            @enderror
        </article>
    </section>

    <section class="nk-cart-card mt-9 p-[28px] lg:px-[36px] fade-up-d2 max-md:p-5">
        @if ($cartItems->isEmpty())
            <div class="flex flex-wrap items-center gap-8">
                <span class="inline-flex h-[52px] w-[52px] items-center justify-center rounded-[14px] border border-[var(--border)] bg-[var(--bg-alt)] text-[22px]">🛒</span>
                <div>
                    <p class="text-[11px] uppercase tracking-[0.12em] text-[var(--text-secondary)]">Keranjang Anda</p>
                    <p class="text-[22px] font-medium">0 menu dipilih</p>
                    <p class="text-[14px] text-[var(--text-secondary)]">Belum ada item. Tambahkan menu untuk lanjut checkout.</p>
                </div>
                <a href="{{ route('public.menus.index') }}" class="nk-btn-primary">Pilih Menu</a>
            </div>
        @else
            <div class="flex flex-wrap items-center gap-10 max-md:flex-col max-md:items-start">
                <div class="flex items-center gap-4">
                    <span class="inline-flex h-[52px] w-[52px] items-center justify-center rounded-[14px] border border-[var(--border)] bg-[var(--bg-alt)] text-[22px]">🛒</span>
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.12em] text-[var(--text-secondary)]">Keranjang Anda</p>
                        <p class="text-[22px] font-medium">{{ $cartCount }} menu dipilih</p>
                        <p class="text-[14px] text-[var(--text-secondary)]">Siap untuk checkout</p>
                    </div>
                </div>

                <div class="flex flex-1 flex-wrap gap-2">
                    @foreach ($cartItems->take(5) as $item)
                        <span class="inline-flex items-center gap-2 rounded-[10px] border border-[var(--border)] bg-[var(--bg-alt)] px-3 py-1.5 text-[13px]">
                            {{ $item['name'] }}
                            <span class="inline-flex h-[18px] min-w-[18px] items-center justify-center rounded-full bg-[var(--accent)] px-1 text-[10px] font-bold text-white">{{ $item['quantity'] }}</span>
                        </span>
                    @endforeach
                </div>

                <div class="max-md:w-full max-md:text-left">
                    <p class="text-[11px] uppercase tracking-[0.12em] text-[var(--text-secondary)]">Estimasi Total</p>
                    <p class="text-[30px] font-medium leading-none text-[var(--accent-warm)]"><x-price :amount="$cartTotal" /></p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <a href="{{ route('public.cart.index') }}" class="nk-btn-detail">Lihat Keranjang</a>
                        <a href="{{ route('public.checkout.create') }}" class="nk-btn-checkout">Lanjut Checkout</a>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <section class="mt-14">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4 max-md:flex-col max-md:items-start">
            <div>
                <h2 class="text-[38px] font-normal max-md:text-[30px]">Menu Tersedia</h2>
                <p class="mt-2 text-[13.5px] leading-[1.7] text-[var(--text-secondary)]">Pilihan menu favorit untuk acara keluarga, kantor, maupun komunitas.</p>
            </div>
            <a href="{{ route('public.menus.index') }}" class="nk-btn-sm">Lihat Semua Menu</a>
        </div>

        <div class="grid gap-7 md:grid-cols-2 max-md:grid-cols-1">
            @forelse ($recommendedMenus->take(4) as $menu)
                <article class="nk-menu-card fade-up-d3 overflow-hidden">
                    <div class="nk-menu-photo">
                        <div class="nk-menu-photo-inner {{ $loop->iteration % 4 === 1 ? 'bg-[linear-gradient(160deg,#EDE0CC,#E8D5BB)]' : ($loop->iteration % 4 === 2 ? 'bg-[linear-gradient(160deg,#DDE8DA,#D0E0CC)]' : ($loop->iteration % 4 === 3 ? 'bg-[linear-gradient(160deg,#E8D8CC,#DCCCC0)]' : 'bg-[linear-gradient(160deg,#CCE0E8,#C4D8E4)]')) }}">
                            @if ($loop->iteration % 4 === 1) 🍱 @elseif ($loop->iteration % 4 === 2) 🍙 @elseif ($loop->iteration % 4 === 3) 🍛 @else 🧋 @endif
                        </div>
                    </div>

                    <div class="flex h-full flex-col p-[22px] pb-6">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="max-w-[70%] text-[21px] font-medium leading-[1.25]">{{ $menu->name }}</h3>
                            <span class="nk-badge-available">{{ $menu->is_available ? 'Tersedia' : 'Tidak tersedia' }}</span>
                        </div>

                        <p class="mt-3 flex-1 text-[13.5px] leading-[1.65] text-[var(--text-secondary)]">{{ $menu->description }}</p>

                        <div class="mt-4 flex items-center justify-between gap-3">
                            <p class="text-[22px] font-medium"><x-price :amount="$menu->price" /> <span class="font-[var(--font-body)] text-[12px] text-[var(--text-secondary)]">/{{ $menu->unit }}</span></p>
                            <span class="nk-menu-min">Min. {{ $menu->minimum_order }} {{ $menu->unit }}</span>
                        </div>

                        <div class="mt-5 flex gap-2">
                            <a href="{{ route('public.menus.show', $menu) }}" class="nk-btn-detail">Detail</a>
                            <form method="POST" action="{{ route('public.cart.store') }}" class="flex-1">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                <input type="hidden" name="quantity" value="{{ $menu->minimum_order }}">
                                <button type="submit" class="nk-btn-add" data-add-btn @disabled(! $menu->is_available)>+ Tambah</button>
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

    <section class="nk-info-section mt-16 -mx-5 px-5 md:-mx-8 md:px-8 lg:-mx-14 lg:px-14">
        <p class="nk-eyebrow">Panduan Pemesanan</p>
        <h2 class="mt-5 text-[38px] font-normal max-md:text-[30px]">Informasi Pemesanan</h2>

        <div class="mt-12 grid gap-8 lg:grid-cols-4 md:grid-cols-2 max-md:grid-cols-1">
            <article class="fade-up-d1">
                <span class="nk-info-icon"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 7h18"/><path d="M5 7l1 12h12l1-12"/><path d="M9 11h6"/><path d="M10 7V5a2 2 0 0 1 4 0v2"/></svg></span>
                <h3 class="mt-4 text-[18px] font-medium">Minimum Pemesanan</h3>
                <p class="mt-2 text-[13.5px] leading-[1.7] text-[var(--text-secondary)]">Minimum pesanan mengikuti ketentuan setiap menu yang tertera di halaman menu.</p>
            </article>
            <article class="fade-up-d2">
                <span class="nk-info-icon"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg></span>
                <h3 class="mt-4 text-[18px] font-medium">Waktu Pemesanan</h3>
                <p class="mt-2 text-[13.5px] leading-[1.7] text-[var(--text-secondary)]">Disarankan melakukan pemesanan maksimal H-2 sebelum acara untuk persiapan optimal.</p>
            </article>
            <article class="fade-up-d3">
                <span class="nk-info-icon"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><path d="M2 10h20"/></svg></span>
                <h3 class="mt-4 text-[18px] font-medium">Metode Pembayaran</h3>
                <p class="mt-2 text-[13.5px] leading-[1.7] text-[var(--text-secondary)]">Pembayaran dilakukan via transfer bank atau konfirmasi manual ke admin Nad's Kitchen.</p>
            </article>
            <article class="fade-up-d4">
                <span class="nk-info-icon"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="m9 12 2 2 4-4"/><circle cx="12" cy="12" r="9"/></svg></span>
                <h3 class="mt-4 text-[18px] font-medium">Konfirmasi Pesanan</h3>
                <p class="mt-2 text-[13.5px] leading-[1.7] text-[var(--text-secondary)]">Pesanan diproses setelah dikonfirmasi admin dan Anda bisa monitor status lewat invoice.</p>
            </article>
        </div>
    </section>
</x-public-layout>
