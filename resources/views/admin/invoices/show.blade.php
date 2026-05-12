<x-admin-layout title="Invoice {{ $order->invoice_number }}">
    <style>
        @media print {
            aside, header, .no-print { display: none !important; }
            main { padding: 0 !important; }
        }
    </style>

    <x-card padding="lg">
        <h1 class="font-heading text-4xl">Invoice Admin</h1>
        <p class="mt-2 text-sm text-nk-muted">{{ $order->invoice_number }} • {{ $order->created_at->format('d M Y H:i') }}</p>

        <div class="mt-5 grid gap-4 md:grid-cols-2 text-sm text-nk-muted">
            <div>
                <p>Customer: {{ $order->customer_name }}</p>
                <p>WhatsApp: {{ $order->customer_whatsapp }}</p>
                <p>Alamat acara: {{ $order->event_address }}</p>
            </div>
            <div>
                <p>Tanggal acara: {{ $order->event_date?->format('d M Y') }}</p>
                <p>Jam acara: {{ $order->event_time }}</p>
                <p>Status: {{ $order->status->label() }}</p>
            </div>
        </div>

        <div class="mt-6 overflow-x-auto rounded-2xl border border-nk-border">
            <table class="min-w-full text-sm">
                <thead class="bg-nk-alt/70"><tr><th class="px-4 py-3 text-left">Menu</th><th class="px-4 py-3 text-left">Harga</th><th class="px-4 py-3 text-left">Qty</th><th class="px-4 py-3 text-left">Subtotal</th></tr></thead>
                <tbody>
                @foreach($order->items as $item)
                    <tr class="border-t border-nk-border/80"><td class="px-4 py-3">{{ $item->menu_name }}</td><td class="px-4 py-3"><x-price :amount="$item->price" /></td><td class="px-4 py-3">{{ $item->quantity }}</td><td class="px-4 py-3"><x-price :amount="$item->subtotal" /></td></tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <p class="mt-5 font-heading text-3xl text-nk-primary">Total: <x-price :amount="$order->total_amount" /></p>
        <p class="mt-2 text-sm text-nk-muted">Pembayaran dilakukan secara manual melalui transfer atau konfirmasi langsung kepada admin Nad's Kitchen.</p>

        <div class="no-print mt-6 flex flex-wrap gap-2">
            <x-button href="javascript:window.print()">Print</x-button>
            <x-button :href="$whatsAppUrl" variant="secondary">WhatsApp Customer</x-button>
            <x-button :href="route('admin.orders.show', $order)" variant="secondary">Kembali</x-button>
        </div>
    </x-card>
</x-admin-layout>
