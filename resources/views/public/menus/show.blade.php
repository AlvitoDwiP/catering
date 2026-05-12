<x-public-layout>
    <x-card padding="lg" class="grid gap-8 md:grid-cols-2">
        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="h-full max-h-96 w-full rounded-2xl object-cover">
        <div>
            <p class="text-sm text-nk-muted">{{ $menu->category?->name }}</p>
            <h1 class="mt-2 font-heading text-4xl text-nk-text">{{ $menu->name }}</h1>
            <p class="mt-4 text-nk-muted">{{ $menu->description }}</p>
            <div class="mt-6 space-y-2 text-sm text-nk-muted">
                <p>Minimum order: <span class="font-semibold text-nk-text">{{ $menu->minimum_order }} {{ $menu->unit }}</span></p>
                <p>Harga: <x-price :amount="$menu->price" class="font-semibold text-nk-primary" /></p>
            </div>
            <div class="mt-8">
                <x-button variant="secondary" :href="route('public.menus.index')">Kembali ke Daftar Menu</x-button>
            </div>
        </div>
    </x-card>
</x-public-layout>
