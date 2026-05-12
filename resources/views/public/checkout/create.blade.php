<x-public-layout>
    <h1 class="font-heading text-4xl text-nk-text">Form Pemesanan</h1>

    <div class="mt-6 grid gap-5 lg:grid-cols-3">
        <x-card class="lg:col-span-2" padding="lg">
            <form method="POST" action="{{ route('public.checkout.review') }}" class="space-y-4">
                @csrf
                <x-input name="customer_name" label="Nama Pemesan" :value="$checkoutData['customer_name'] ?? null" placeholder="Contoh: Nadia Putri" />
                <x-input name="customer_whatsapp" label="Nomor WhatsApp" :value="$checkoutData['customer_whatsapp'] ?? null" placeholder="Contoh: 08123456789" />
                <x-textarea name="event_address" label="Alamat Acara" :value="$checkoutData['event_address'] ?? null" placeholder="Tulis alamat lengkap acara" />
                <x-input name="event_date" type="date" label="Tanggal Acara" :value="$checkoutData['event_date'] ?? null" />
                <x-input name="event_time" type="time" label="Jam Acara" :value="$checkoutData['event_time'] ?? null" />
                <x-textarea name="notes" label="Catatan Tambahan" :value="$checkoutData['notes'] ?? null" placeholder="Opsional" />
                <div class="flex flex-wrap gap-2">
                    <x-button type="submit">Review Pesanan</x-button>
                    <x-button variant="secondary" :href="route('public.cart.index')">Kembali ke Keranjang</x-button>
                </div>
            </form>
        </x-card>

        <x-card class="lg:col-span-1" padding="lg">
            <h2 class="font-heading text-2xl text-nk-text">Ringkasan Keranjang</h2>
            <div class="mt-4 space-y-2">
                @foreach ($cartItems as $item)
                    <div class="flex items-start justify-between gap-3 text-sm">
                        <p class="text-nk-muted">{{ $item['name'] }} x {{ $item['quantity'] }}</p>
                        <x-price :amount="$item['subtotal']" class="font-medium text-nk-text" />
                    </div>
                @endforeach
            </div>
            <div class="mt-4 border-t border-nk-border pt-3">
                <p class="font-semibold text-nk-text">Total: <x-price :amount="$cartTotal" class="text-nk-primary" /></p>
            </div>
        </x-card>
    </div>
</x-public-layout>
