<x-public-layout>
    @php
        $selectedCategoryModel = $selectedCategory ? $categories->firstWhere('slug', $selectedCategory) : null;
    @endphp

    <section class="grid gap-8 lg:grid-cols-[1.12fr_0.88fr] lg:items-end">
        <div class="fade-up max-w-[700px]">
            <p class="nk-eyebrow">Menu Tersedia</p>
            <h1 class="mt-5 text-[clamp(2.4rem,5vw,4.9rem)] font-normal leading-[0.96] tracking-[-0.03em]">
                Pilihan menu yang lebih mudah dibaca,<br>
                <em class="text-[var(--accent-warm)] not-italic">lebih enak dilihat</em>.
            </h1>
            <p class="mt-6 max-w-[560px] text-[15.5px] leading-[1.8] text-[var(--text-secondary)]">
                Setiap kartu menampilkan foto nyata, proporsi yang konsisten, dan hierarki informasi yang lebih tegas agar pelanggan bisa membandingkan menu tanpa merasa melihat template generik.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('public.home') }}" class="nk-btn-detail">Kembali ke beranda</a>
                <a href="{{ route('public.checkout.create') }}" class="nk-btn-primary">Lanjut checkout</a>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="rounded-[28px] border border-[var(--border)] bg-[var(--bg-card)] p-5 shadow-[var(--shadow)]">
                <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Total menu aktif</p>
                <p class="mt-2 text-[44px] font-medium leading-none text-[var(--accent-warm)]">{{ $menus->total() }}</p>
                <p class="mt-2 text-[13px] leading-[1.7] text-[var(--text-secondary)]">Disusun agar mudah dijelajahi dari halaman ini maupun dari kategori homepage.</p>
            </div>
            <div class="rounded-[28px] border border-[var(--border)] bg-[var(--bg-card)] p-5 shadow-[var(--shadow)]">
                <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Kategori aktif</p>
                <p class="mt-2 text-[44px] font-medium leading-none text-[var(--accent)]">{{ $selectedCategoryModel ? '1' : $categories->count() }}</p>
                <p class="mt-2 text-[13px] leading-[1.7] text-[var(--text-secondary)]">
                    {{ $selectedCategoryModel ? $selectedCategoryModel->name : 'Semua kategori tampil dengan filter yang jelas.' }}
                </p>
            </div>
        </div>
    </section>

    <section class="mt-10">
        <div class="flex items-center justify-between gap-4 border-b border-[var(--border)] pb-4 max-md:flex-col max-md:items-start">
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('public.menus.index') }}" class="{{ $selectedCategory ? 'nk-btn-detail' : 'nk-btn-primary' }}">Semua</a>
                @foreach ($categories as $category)
                    <a
                        href="{{ route('public.menus.index', ['category' => $category->slug]) }}"
                        class="{{ $selectedCategory === $category->slug ? 'nk-btn-primary' : 'nk-btn-detail' }}"
                    >
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            @if ($selectedCategoryModel)
                <p class="text-[13px] text-[var(--text-secondary)]">
                    Sedang menampilkan: <span class="font-medium text-[var(--text)]">{{ $selectedCategoryModel->name }}</span>
                </p>
            @endif
        </div>
    </section>

    <section class="mt-8">
        <div class="grid gap-5 lg:grid-cols-3 md:grid-cols-2">
            @forelse ($menus as $menu)
                <article class="group overflow-hidden rounded-[28px] border border-[var(--border)] bg-[var(--bg-card)] shadow-[var(--shadow)] transition duration-300 hover:-translate-y-1 hover:shadow-[var(--shadow-md)]">
                    <x-food-image
                        :src="$menu->image_url"
                        :placeholder="$menu->image_placeholder_url"
                        :alt="$menu->name"
                        ratio="4 / 3"
                        class="border-b border-[var(--border)]"
                        image-class="group-hover:scale-105"
                    >
                        <div class="absolute inset-x-0 bottom-0 z-10 flex items-center justify-between gap-3 p-5 text-white">
                            @if ($menu->is_recommended)
                                <span class="rounded-full border border-white/20 bg-white/12 px-3 py-1 text-[10.5px] font-semibold uppercase tracking-[0.14em] text-white/90 backdrop-blur-sm">Best seller</span>
                            @else
                                <span class="rounded-full border border-white/20 bg-white/12 px-3 py-1 text-[10.5px] font-semibold uppercase tracking-[0.14em] text-white/90 backdrop-blur-sm">{{ $menu->category?->name }}</span>
                            @endif

                            <span class="rounded-full border border-white/20 bg-white/12 px-3 py-1 text-[10.5px] font-semibold uppercase tracking-[0.14em] text-white/90 backdrop-blur-sm">{{ $menu->is_available ? 'Available' : 'Unavailable' }}</span>
                        </div>
                    </x-food-image>

                    <div class="flex h-full flex-col p-5">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">{{ $menu->category?->name }}</p>
                                <h2 class="mt-2 text-[23px] font-medium leading-[1.1] tracking-[-0.01em]">{{ $menu->name }}</h2>
                            </div>
                            <span class="nk-badge-available shrink-0">{{ $menu->is_available ? 'Tersedia' : 'Kosong' }}</span>
                        </div>

                        <p class="mt-3 flex-1 text-[14px] leading-[1.75] text-[var(--text-secondary)]">{{ $menu->description }}</p>

                        <div class="mt-5 flex items-end justify-between gap-4">
                            <div>
                                <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--text-secondary)]">Harga</p>
                                <p class="mt-1 text-[26px] font-medium leading-none text-[var(--accent-warm)]"><x-price :amount="$menu->price" /></p>
                                <p class="mt-2 text-[12px] text-[var(--text-secondary)]">Minimum {{ $menu->minimum_order }} {{ $menu->unit }}</p>
                            </div>
                            <a href="{{ route('public.menus.show', $menu) }}" class="nk-btn-detail whitespace-nowrap">Detail</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="lg:col-span-3 md:col-span-2">
                    <x-empty-state title="Belum ada menu" description="Menu akan ditampilkan setelah tersedia." />
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $menus->links() }}
        </div>
    </section>
</x-public-layout>
