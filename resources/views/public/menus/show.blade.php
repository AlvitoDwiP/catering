<x-public-layout>
    <x-card padding="lg" class="grid gap-7 md:grid-cols-2">
        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="h-full max-h-96 w-full rounded-2xl object-cover">
        <div>
            <p class="text-xs uppercase tracking-wide text-nk-muted">{{ $menu->category?->name }}</p>
            <h1 class="mt-2 font-heading text-4xl text-nk-text">{{ $menu->name }}</h1>
            <p class="mt-4 text-nk-muted">{{ $menu->description }}</p>

            <div class="mt-5 space-y-1 text-sm text-nk-muted">
                <p>Harga: <x-price :amount="$menu->price" class="font-semibold text-nk-primary" /></p>
                <p>Minimum order: <span class="font-semibold text-nk-text">{{ $menu->minimum_order }} {{ $menu->unit }}</span></p>
                <p>Status: <span class="font-semibold {{ $menu->is_available ? 'text-nk-success' : 'text-nk-error' }}">{{ $menu->is_available ? 'Tersedia' : 'Belum tersedia' }}</span></p>
            </div>

            <form method="POST" action="{{ route('public.cart.store') }}" class="mt-6 space-y-3">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                <x-input name="quantity" type="number" label="Jumlah Pesanan" :value="$menu->minimum_order" :placeholder="'Minimal ' . $menu->minimum_order" min="{{ $menu->minimum_order }}" />

                @if (! $menu->is_available)
                    <p class="text-sm text-nk-error">Menu belum tersedia untuk saat ini.</p>
                @endif

                <div class="flex flex-wrap gap-2">
                    <x-button type="submit" :disabled="! $menu->is_available">Tambah ke Keranjang</x-button>
                    <x-button variant="secondary" :href="route('public.menus.index')">Kembali</x-button>
                </div>
            </form>
        </div>
    </x-card>
</x-public-layout>
