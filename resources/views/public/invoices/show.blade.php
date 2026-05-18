<x-public-layout>
    <h1 class="font-heading text-4xl text-nk-text">Invoice Pesanan</h1>

    <x-card class="mt-6 space-y-6" padding="lg">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-nk-border pb-4">
            <div>
                <p class="text-sm text-nk-muted">Invoice Number</p>
                <p class="font-heading text-3xl text-nk-text">{{ $order->invoice_number }}</p>
                <x-date-time label="Dipesan pada" :date="$order->created_at" :time="$order->created_at" variant="compact" class="mt-1" :show-day="false" />
            </div>
            <x-status-badge :status="$order->status" />
        </div>

        <p class="rounded-xl bg-nk-alt px-4 py-3 text-sm text-nk-text">{{ $order->status->customerMessage() }}</p>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <p class="text-sm font-semibold text-nk-text">Data Customer</p>
                <div class="mt-2 space-y-1 text-sm text-nk-muted">
                    <p>Nama: {{ $order->customer_name }}</p>
                    <p>WhatsApp: {{ $order->customer_whatsapp }}</p>
                </div>
            </div>
            <div>
                <p class="text-sm font-semibold text-nk-text">Data Acara</p>
                <div class="mt-2 space-y-3 text-sm text-nk-muted">
                    <x-date-time label="Jadwal Acara" :date="$order->event_date" :time="$order->event_time" variant="stacked" />
                    <p>Alamat: {{ $order->event_address }}</p>
                    <p>Catatan: {{ $order->notes ?: '-' }}</p>
                </div>
            </div>
        </div>

        <div>
            <p class="text-sm font-semibold text-nk-text">Daftar Item</p>
            <div class="mt-3 divide-y divide-nk-border rounded-xl border border-nk-border bg-white/60">
                @foreach ($order->items as $item)
                    <div class="flex items-start justify-between gap-3 px-4 py-3 text-sm">
                        <div>
                            <p class="font-medium text-nk-text">{{ $item->menu_name }}</p>
                            <p class="text-nk-muted">{{ $item->quantity }} x <x-price :amount="$item->price" /></p>
                        </div>
                        <x-price :amount="$item->subtotal" class="font-semibold text-nk-text" />
                    </div>
                @endforeach
            </div>
        </div>

        <div class="border-t border-nk-border pt-4">
            <p class="font-heading text-3xl text-nk-primary">Total Tagihan: <x-price :amount="$order->total_amount" /></p>
            <p class="mt-3 text-sm text-nk-muted">Pembayaran dilakukan secara manual melalui transfer atau konfirmasi langsung kepada admin Nad's Kitchen. Pesanan akan diproses setelah dikonfirmasi oleh admin.</p>
        </div>

        <div class="flex flex-wrap gap-2">
            <x-button href="https://wa.me/628000000000">Hubungi Admin</x-button>
            <x-button variant="secondary" :href="route('public.home')">Kembali ke Dashboard</x-button>
            <x-button variant="secondary" href="javascript:window.print()">Cetak Invoice</x-button>
        </div>
    </x-card>
</x-public-layout>
