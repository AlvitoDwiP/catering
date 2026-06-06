<x-public-layout>
    <section class="grid items-center gap-10 py-8 lg:grid-cols-[1.05fr_0.95fr] lg:gap-14 lg:py-10">
        <div class="fade-up max-w-[640px]">
            <p class="nk-eyebrow">Warm. Premium. Trustworthy.</p>
            <h1 class="mt-5 text-[clamp(2.7rem,6vw,5.4rem)] font-normal leading-[0.95] tracking-[-0.03em]">
                Catering yang terlihat<br>
                <em class="text-[var(--accent-warm)] not-italic">benar-benar nyata</em>.
            </h1>
            <p class="mt-6 max-w-[540px] text-[15.5px] leading-[1.8] text-[var(--text-secondary)]">
                Nad's Kitchen menghadirkan makanan rumahan yang rapi, premium, dan siap untuk kebutuhan kantor, acara keluarga, maupun event besar. Semua tampilan di halaman ini memakai foto asli agar bisnis terasa lebih meyakinkan sejak pandangan pertama.
            </p>

            <div class="mt-8 flex flex-wrap gap-3 max-md:flex-col">
                <a href="{{ route('public.menus.index') }}" class="nk-btn-primary max-md:w-full max-md:justify-center">Lihat Menu</a>
                <a href="{{ route('public.checkout.create') }}" class="nk-btn-secondary max-md:w-full max-md:justify-center">Pesan Sekarang</a>
            </div>

            <div class="mt-8 grid gap-3 sm:grid-cols-3">
                <div class="rounded-[22px] border border-[var(--border)] bg-[var(--bg-card)] p-4 shadow-[var(--shadow)]">
                    <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Siap untuk</p>
                    <p class="mt-2 text-[18px] font-medium leading-tight">Kantor, acara, keluarga</p>
                </div>
                <div class="rounded-[22px] border border-[var(--border)] bg-[var(--bg-card)] p-4 shadow-[var(--shadow)]">
                    <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Visual</p>
                    <p class="mt-2 text-[18px] font-medium leading-tight">Real food photography</p>
                </div>
                <div class="rounded-[22px] border border-[var(--border)] bg-[var(--bg-card)] p-4 shadow-[var(--shadow)]">
                    <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Respons cepat</p>
                    <p class="mt-2 text-[18px] font-medium leading-tight">Alur order lebih jelas</p>
                </div>
            </div>
        </div>

        <div class="relative fade-up-d1">
            <div class="absolute -right-2 top-4 z-20 hidden rounded-full border border-[var(--border)] bg-[var(--bg-card)] px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.14em] text-[var(--text-secondary)] shadow-[var(--shadow)] lg:inline-flex">
                Hero image
            </div>

            <x-food-image
                image-key="hero.main"
                placeholder-key="hero"
                alt="Nad's Kitchen catering hero image"
                ratio="4 / 5"
                priority="true"
                class="group shadow-[0_20px_70px_rgba(43,42,40,0.18)]"
                image-class="group-hover:scale-105"
            >
                <div class="absolute inset-x-0 bottom-0 z-10 p-5 sm:p-6">
                    <div class="rounded-[24px] border border-white/20 bg-white/80 p-4 backdrop-blur-md">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="nk-dot-pulse"></span>
                            <div class="min-w-0">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-[var(--text-secondary)]">Dipilih untuk rasa percaya</p>
                                <p class="mt-1 text-[15px] font-medium leading-tight text-[var(--text)]">Hangat, bersih, dan cocok untuk bisnis catering premium.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-food-image>

            <div class="absolute -bottom-4 left-4 hidden max-w-[220px] rounded-[22px] border border-[var(--border)] bg-[var(--bg-card)] p-4 shadow-[0_20px_50px_rgba(43,42,40,0.12)] lg:block">
                <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Pesanan aktif</p>
                <p class="mt-1 text-[26px] font-medium leading-none text-[var(--accent-warm)]">24+</p>
                <p class="mt-2 text-[13px] leading-[1.6] text-[var(--text-secondary)]">Pilihan menu yang rapi untuk kebutuhan harian dan acara.</p>
            </div>
        </div>
    </section>

    <section id="categories" class="pt-4">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="nk-eyebrow">Popular Categories</p>
                <h2 class="mt-4 text-[clamp(2rem,4vw,3.15rem)] font-normal tracking-[-0.02em]">Kategori yang langsung terasa familiar</h2>
            </div>
            <a href="{{ route('public.menus.index') }}" class="nk-btn-sm">Lihat semua menu</a>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
            @foreach ($featuredCategories as $category)
                <a href="{{ route('public.menus.index', ['category' => $category['slug']]) }}" class="group overflow-hidden rounded-[28px] border border-[var(--border)] bg-[var(--bg-card)] shadow-[var(--shadow)] transition duration-300 hover:-translate-y-1 hover:shadow-[var(--shadow-md)]">
                    <x-food-image
                        :image-key="$category['image_key']"
                        :placeholder-key="$category['placeholder_key']"
                        :alt="$category['name']"
                        ratio="4 / 5"
                        :overlay="true"
                        rounded="rounded-none"
                        image-class="group-hover:scale-105"
                    >
                        <div class="absolute inset-0 z-10 flex flex-col justify-end p-5 text-white">
                            <span class="inline-flex w-fit rounded-full border border-white/20 bg-white/12 px-3 py-1 text-[10.5px] font-semibold uppercase tracking-[0.14em] text-white/90 backdrop-blur-sm">Kategori</span>
                            <h3 class="mt-3 text-[24px] font-medium leading-[1.05] text-white">{{ $category['name'] }}</h3>
                            <p class="mt-2 text-[13px] leading-[1.6] text-white/85">{{ $category['description'] }}</p>
                        </div>
                    </x-food-image>
                </a>
            @endforeach
        </div>
    </section>

    <section id="best-seller" class="pt-16">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="nk-eyebrow">Best Seller Menu</p>
                <h2 class="mt-4 text-[clamp(2rem,4vw,3.15rem)] font-normal tracking-[-0.02em]">Pilihan premium yang paling mewakili brand</h2>
            </div>
            <p class="max-w-[420px] text-[14px] leading-[1.7] text-[var(--text-secondary)]">
                Setiap kartu memakai foto asli dan hierarki visual yang lebih kuat supaya pilihan menu lebih meyakinkan, lebih mudah dibaca, dan lebih siap dikonversi.
            </p>
        </div>

        <div class="grid gap-5 lg:grid-cols-3 md:grid-cols-2">
            @forelse ($recommendedMenus as $menu)
                <article class="group overflow-hidden rounded-[28px] border border-[var(--border)] bg-[var(--bg-card)] shadow-[var(--shadow)] transition duration-300 hover:-translate-y-1 hover:shadow-[var(--shadow-md)]">
                    <x-food-image
                        :src="$menu->image_url"
                        :placeholder="$menu->image_placeholder_url"
                        :alt="$menu->name"
                        ratio="4 / 3"
                        class="border-b border-[var(--border)]"
                        image-class="group-hover:scale-105"
                    >
                        <div class="absolute inset-x-0 bottom-0 z-10 flex items-end justify-between gap-3 p-5 text-white">
                            <span class="rounded-full border border-white/20 bg-white/12 px-3 py-1 text-[10.5px] font-semibold uppercase tracking-[0.14em] text-white/90 backdrop-blur-sm">{{ $menu->category?->name }}</span>
                            <span class="rounded-full border border-white/20 bg-white/12 px-3 py-1 text-[10.5px] font-semibold uppercase tracking-[0.14em] text-white/90 backdrop-blur-sm">Best seller</span>
                        </div>
                    </x-food-image>

                    <div class="flex h-full flex-col p-5">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="text-[23px] font-medium leading-[1.1] tracking-[-0.01em]">{{ $menu->name }}</h3>
                            <span class="nk-badge-available shrink-0">{{ $menu->is_available ? 'Tersedia' : 'Tidak tersedia' }}</span>
                        </div>

                        <p class="mt-3 flex-1 text-[14px] leading-[1.75] text-[var(--text-secondary)]">{{ $menu->description }}</p>

                        <div class="mt-5 flex items-end justify-between gap-4">
                            <div>
                                <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Harga mulai</p>
                                <p class="mt-1 text-[28px] font-medium leading-none text-[var(--accent-warm)]"><x-price :amount="$menu->price" /></p>
                                <p class="mt-2 text-[12px] text-[var(--text-secondary)]">Minimum {{ $menu->minimum_order }} {{ $menu->unit }}</p>
                            </div>
                            <a href="{{ route('public.menus.show', $menu) }}" class="nk-btn-detail whitespace-nowrap">Detail menu</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="lg:col-span-3 md:col-span-2">
                    <x-empty-state title="Menu belum tersedia" description="Kami sedang menyiapkan pilihan terbaik untuk Anda." />
                </div>
            @endforelse
        </div>
    </section>

    <section id="promotions" class="pt-16">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="nk-eyebrow">Promotional Area</p>
                <h2 class="mt-4 text-[clamp(2rem,4vw,3.15rem)] font-normal tracking-[-0.02em]">Paket yang paling cocok untuk penawaran aktif</h2>
            </div>
            <a href="{{ route('public.checkout.create') }}" class="nk-btn-primary">Mulai checkout</a>
        </div>

        <div class="grid gap-5 lg:grid-cols-3">
            @foreach ($promotions as $promotion)
                <article class="group overflow-hidden rounded-[28px] border border-[var(--border)] bg-[var(--bg-card)] shadow-[var(--shadow)]">
                    <x-food-image
                        :image-key="$promotion['image_key']"
                        :placeholder-key="$promotion['placeholder_key']"
                        :alt="$promotion['title']"
                        ratio="16 / 11"
                        rounded="rounded-none"
                        image-class="group-hover:scale-105"
                    >
                        <div class="absolute inset-x-0 bottom-0 z-10 p-5 text-white">
                            <span class="inline-flex rounded-full border border-white/20 bg-white/12 px-3 py-1 text-[10.5px] font-semibold uppercase tracking-[0.14em] text-white/90 backdrop-blur-sm">Promo</span>
                        </div>
                    </x-food-image>

                    <div class="p-5">
                        <h3 class="text-[24px] font-medium leading-[1.1] tracking-[-0.01em]">{{ $promotion['title'] }}</h3>
                        <p class="mt-3 text-[14px] leading-[1.75] text-[var(--text-secondary)]">{{ $promotion['description'] }}</p>
                        <div class="mt-5">
                            <a href="{{ route('public.menus.index') }}" class="nk-btn-detail">Lihat paket</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mt-16 rounded-[32px] border border-[var(--border)] bg-[linear-gradient(135deg,rgba(255,250,245,0.95),rgba(241,234,226,0.95))] p-7 shadow-[var(--shadow)] lg:p-10">
        <div class="flex flex-col items-start justify-between gap-6 lg:flex-row lg:items-center">
            <div class="max-w-[620px]">
                <p class="nk-eyebrow">Siap dipakai untuk bisnis nyata</p>
                <h2 class="mt-4 text-[clamp(1.8rem,4vw,2.8rem)] font-normal tracking-[-0.02em]">Visualnya sekarang terasa seperti catering yang sungguh-sungguh beroperasi.</h2>
                <p class="mt-4 text-[14px] leading-[1.75] text-[var(--text-secondary)]">
                    Homepage, kategori, best seller, dan promo sekarang memakai foto asli dengan cropping yang konsisten, hierarki yang jelas, dan komposisi yang jauh lebih premium.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('public.menus.index') }}" class="nk-btn-primary">Telusuri menu</a>
                <a href="{{ route('public.orders.track.create') }}" class="nk-btn-secondary">Cek pesanan</a>
            </div>
        </div>
    </section>
</x-public-layout>
