<x-public-layout>
    <h1 class="font-heading text-4xl text-nk-text">Invoice {{ $order->invoice_number }}</h1>
    <x-card class="mt-6 space-y-4" padding="lg">
        <div class="flex items-center justify-between">
            <p class="text-sm text-nk-muted">Nama: {{ $order->customer_name }}</p>
            <x-status-badge :status="$order->status" />
        </div>
        <p class="text-sm text-nk-muted">Tanggal Acara: {{ $order->event_date?->format('d M Y') }}</p>
        <p class="text-sm text-nk-muted">Alamat: {{ $order->event_address }}</p>
        <div class="border-t border-nk-border pt-4">
            <p class="font-semibold text-nk-text">Total: <x-price :amount="$order->total_amount" class="text-nk-primary" /></p>
        </div>
    </x-card>
</x-public-layout>
