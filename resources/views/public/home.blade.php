<x-public-layout>
    <section class="rounded-[28px] border border-nk-border bg-gradient-to-r from-nk-card to-nk-alt px-8 py-16">
        <p class="text-sm uppercase tracking-[0.2em] text-nk-muted">Nad's Kitchen</p>
        <h1 class="mt-4 max-w-2xl font-heading text-5xl leading-tight text-nk-text">Warm Minimal Premium Catering untuk Momen Berharga</h1>
        <p class="mt-5 max-w-2xl text-nk-muted">Temukan paket catering praktis dan lezat untuk kantor, keluarga, dan acara spesial Anda.</p>
        <div class="mt-8 flex flex-wrap gap-3">
            <x-button :href="route('public.menus.index')">Lihat Menu</x-button>
            <x-button variant="secondary" :href="route('public.orders.track.create')">Cek Pesanan</x-button>
        </div>
    </section>

    <section class="mt-10 space-y-4">
        <h2 class="font-heading text-3xl text-nk-text">Menu Rekomendasi</h2>
        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($recommendedMenus as $menu)
                <x-card>
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="h-44 w-full rounded-xl object-cover">
                    <h3 class="mt-4 font-heading text-2xl text-nk-text">{{ $menu->name }}</h3>
                    <p class="mt-2 text-sm text-nk-muted">{{ $menu->description }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <x-price :amount="$menu->price" class="font-semibold text-nk-primary" />
                        <x-button variant="secondary" :href="route('public.menus.show', $menu)">Detail</x-button>
                    </div>
                </x-card>
            @empty
                <div class="md:col-span-2 lg:col-span-3">
                    <x-empty-state title="Menu belum tersedia" description="Kami sedang menyiapkan daftar menu terbaik untuk Anda." />
                </div>
            @endforelse
        </div>
    </section>
</x-public-layout>
