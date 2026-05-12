<x-public-layout>
    <h1 class="font-heading text-4xl text-nk-text">Keranjang Pesanan</h1>

    @if ($isEmpty)
        <div class="mt-6">
            <x-empty-state title="Keranjang masih kosong" description="Belum ada menu yang Anda pilih.">
                <x-button :href="route('public.menus.index')">Pilih Menu</x-button>
            </x-empty-state>
        </div>
    @else
        <div class="mt-6 grid gap-4">
            @foreach ($cartItems as $item)
                <x-card class="grid gap-4 md:grid-cols-[100px_1fr_auto] md:items-center">
                    <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="h-24 w-full rounded-xl object-cover">
                    <div>
                        <h2 class="font-semibold text-nk-text">{{ $item['name'] }}</h2>
                        <p class="text-sm text-nk-muted">Harga: <x-price :amount="$item['price']" /></p>
                        <p class="text-sm text-nk-muted">Minimum {{ $item['minimum_order'] }} {{ $item['unit'] }}</p>
                        <p class="mt-1 text-sm font-semibold text-nk-primary">Subtotal: <x-price :amount="$item['subtotal']" /></p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2 md:justify-end">
                        <form method="POST" action="{{ route('public.cart.update', $item['menu_id']) }}" class="flex items-end gap-2">
                            @csrf
                            @method('PATCH')
                            <x-input name="quantity" type="number" label="Jumlah" :value="$item['quantity']" min="{{ $item['minimum_order'] }}" class="w-28" />
                            <x-button type="submit" variant="secondary">Update</x-button>
                        </form>
                        <form method="POST" action="{{ route('public.cart.destroy', $item['menu_id']) }}">
                            @csrf
                            @method('DELETE')
                            <x-button type="submit" variant="danger">Hapus</x-button>
                        </form>
                    </div>
                </x-card>
            @endforeach
        </div>

        <x-card class="mt-6" padding="lg">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-nk-muted">Total item: {{ $cartTotalQuantity }}</p>
                    <p class="font-heading text-3xl text-nk-text">Total: <x-price :amount="$cartTotal" class="text-nk-primary" /></p>
                </div>
                <x-button :href="route('public.checkout.create')">Lanjut Checkout</x-button>
            </div>
        </x-card>
    @endif
</x-public-layout>
