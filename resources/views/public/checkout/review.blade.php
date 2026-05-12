<x-public-layout>
    <h1 class="font-heading text-4xl text-nk-text">Review Pesanan</h1>

    <div class="mt-6 grid gap-5 lg:grid-cols-3">
        <x-card class="space-y-4 lg:col-span-2" padding="lg">
            <div>
                <h2 class="font-heading text-2xl text-nk-text">Data Pemesan</h2>
                <div class="mt-2 space-y-1 text-sm text-nk-muted">
                    <p>Nama: {{ $customerData['customer_name'] }}</p>
                    <p>WhatsApp: {{ $customerData['customer_whatsapp'] }}</p>
                </div>
            </div>

            <div>
                <h2 class="font-heading text-2xl text-nk-text">Data Acara</h2>
                <div class="mt-2 space-y-1 text-sm text-nk-muted">
                    <p>Tanggal: {{ \Carbon\Carbon::parse($customerData['event_date'])->format('d M Y') }}</p>
                    <p>Jam: {{ $customerData['event_time'] }}</p>
                    <p>Alamat: {{ $customerData['event_address'] }}</p>
                    <p>Catatan: {{ $customerData['notes'] ?: '-' }}</p>
                </div>
            </div>

            <div>
                <h2 class="font-heading text-2xl text-nk-text">Daftar Menu</h2>
                <div class="mt-3 space-y-2">
                    @foreach ($cartItems as $item)
                        <div class="flex items-start justify-between gap-3 rounded-xl border border-nk-border bg-white/60 px-4 py-3 text-sm">
                            <p class="text-nk-muted">{{ $item['name'] }} x {{ $item['quantity'] }}</p>
                            <x-price :amount="$item['subtotal']" class="font-semibold text-nk-text" />
                        </div>
                    @endforeach
                </div>
            </div>
        </x-card>

        <x-card class="lg:col-span-1" padding="lg">
            <h2 class="font-heading text-2xl text-nk-text">Total Tagihan</h2>
            <p class="mt-3 font-heading text-3xl text-nk-primary"><x-price :amount="$cartTotal" /></p>

            <form method="POST" action="{{ route('public.checkout.store') }}" class="mt-6 space-y-3">
                @csrf
                <input type="hidden" name="customer_name" value="{{ $customerData['customer_name'] }}">
                <input type="hidden" name="customer_whatsapp" value="{{ $customerData['customer_whatsapp'] }}">
                <input type="hidden" name="event_address" value="{{ $customerData['event_address'] }}">
                <input type="hidden" name="event_date" value="{{ $customerData['event_date'] }}">
                <input type="hidden" name="event_time" value="{{ $customerData['event_time'] }}">
                <input type="hidden" name="notes" value="{{ $customerData['notes'] }}">

                <x-button type="submit" class="w-full">Submit Pesanan</x-button>
            </form>

            <div class="mt-3 grid gap-2">
                <x-button variant="secondary" :href="route('public.checkout.create')">Edit Data</x-button>
                <x-button variant="secondary" :href="route('public.cart.index')">Edit Keranjang</x-button>
            </div>
        </x-card>
    </div>
</x-public-layout>
