<x-public-layout>
    <section>
        <h1 class="font-heading text-4xl text-nk-text">Menu Tersedia</h1>
        <p class="mt-2 text-sm text-nk-muted">Pilih menu terbaik Nad's Kitchen sesuai kebutuhan acara Anda.</p>

        <div class="mt-6 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($menus as $menu)
                <x-card>
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="h-44 w-full rounded-xl object-cover">
                    <p class="mt-3 text-xs uppercase tracking-wide text-nk-muted">{{ $menu->category?->name }}</p>
                    <h2 class="mt-1 font-heading text-2xl text-nk-text">{{ $menu->name }}</h2>
                    <p class="mt-2 line-clamp-3 text-sm text-nk-muted">{{ $menu->description }}</p>
                    <div class="mt-4 space-y-1 text-sm">
                        <p class="text-nk-primary"><x-price :amount="$menu->price" class="font-semibold" /></p>
                        <p class="text-nk-muted">Minimum {{ $menu->minimum_order }} {{ $menu->unit }}</p>
                        <p class="text-xs font-semibold {{ $menu->is_available ? 'text-nk-success' : 'text-nk-error' }}">{{ $menu->is_available ? 'Tersedia' : 'Tidak tersedia' }}</p>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <x-button variant="secondary" :href="route('public.menus.show', $menu)">Detail</x-button>
                        <form method="POST" action="{{ route('public.cart.store') }}" class="flex items-center gap-2">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <input type="hidden" name="quantity" value="{{ $menu->minimum_order }}">
                            <x-button type="submit" :disabled="! $menu->is_available">Tambah</x-button>
                        </form>
                    </div>
                </x-card>
            @empty
                <div class="md:col-span-2 lg:col-span-3">
                    <x-empty-state title="Belum ada menu" description="Menu akan ditampilkan setelah tersedia." />
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $menus->links() }}
        </div>
    </section>
</x-public-layout>
