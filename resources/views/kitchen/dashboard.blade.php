<x-kitchen-layout title="Dashboard Dapur">
    <x-admin-page-header title="Dashboard Dapur" description="Pantau pesanan yang perlu diproduksi dan kebutuhan bahan hari ini." />

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <x-card padding="lg"><p class="text-sm text-nk-muted">Pesanan Hari Ini</p><p class="mt-2 font-heading text-4xl text-nk-primary">{{ $todayProductionOrders->count() }}</p></x-card>
        <x-card padding="lg"><p class="text-sm text-nk-muted">Pesanan Besok</p><p class="mt-2 font-heading text-4xl text-nk-primary">{{ $tomorrowProductionOrders->count() }}</p></x-card>
        <x-card padding="lg"><p class="text-sm text-nk-muted">Dikonfirmasi</p><p class="mt-2 font-heading text-4xl text-nk-primary">{{ $confirmedOrdersCount }}</p></x-card>
        <x-card padding="lg"><p class="text-sm text-nk-muted">Diproses</p><p class="mt-2 font-heading text-4xl text-nk-primary">{{ $processingOrdersCount }}</p></x-card>
    </div>

    <section class="mt-6">
        <h3 class="mb-3 font-heading text-2xl">Pesanan Hari Ini</h3>
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Invoice</th><th class="px-4 py-3">Customer</th><th class="px-4 py-3">Jam acara</th><th class="px-4 py-3">Menu ringkas</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Aksi</th></tr></thead>
            <tbody>
            @forelse($todayProductionOrders as $order)
                <tr class="border-t border-nk-border/80">
                    <td class="px-4 py-3">{{ $order->invoice_number }}</td>
                    <td class="px-4 py-3">{{ $order->customer_name }}</td>
                    <td class="px-4 py-3 text-nk-muted">{{ $order->event_time }}</td>
                    <td class="px-4 py-3 text-sm text-nk-muted">{{ $order->items->pluck('menu_name')->take(2)->implode(', ') }}{{ $order->items->count() > 2 ? '...' : '' }}</td>
                    <td class="px-4 py-3"><x-status-badge :status="$order->status" /></td>
                    <td class="px-4 py-3"><x-button :href="route('kitchen.production-orders.show', $order)" variant="secondary">Detail</x-button></td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-6 text-center text-nk-muted">Tidak ada pesanan produksi hari ini.</td></tr>
            @endforelse
            </tbody>
        </x-admin-table>
    </section>

    <section class="mt-6">
        <h3 class="mb-3 font-heading text-2xl">Rekap Bahan Hari Ini</h3>
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Bahan</th><th class="px-4 py-3">Total kebutuhan</th><th class="px-4 py-3">Satuan</th></tr></thead>
            <tbody>
            @forelse($todayIngredientRecap as $item)
                <tr class="border-t border-nk-border/80"><td class="px-4 py-3">{{ $item['ingredient_name'] }}</td><td class="px-4 py-3 text-nk-muted">{{ number_format((float) $item['total_quantity'], 2, '.', ',') }}</td><td class="px-4 py-3 text-nk-muted">{{ $item['ingredient_unit'] }}</td></tr>
            @empty
                <tr><td colspan="3" class="px-4 py-6 text-center text-nk-muted">Belum ada rekap bahan untuk hari ini.</td></tr>
            @endforelse
            </tbody>
        </x-admin-table>
    </section>

    <section class="mt-6">
        <h3 class="mb-3 font-heading text-2xl">Upcoming Orders</h3>
        <x-card padding="md">
            <ul class="space-y-2 text-sm">
                @forelse($upcomingOrders as $order)
                    <li class="flex items-center justify-between gap-2 border-b border-nk-border/70 pb-2 last:border-b-0 last:pb-0">
                        <span>{{ $order->invoice_number }} - {{ $order->customer_name }}</span>
                        <span class="text-nk-muted">{{ $order->event_date?->format('d M Y') }} {{ $order->event_time }}</span>
                    </li>
                @empty
                    <li class="text-nk-muted">Belum ada pesanan upcoming.</li>
                @endforelse
            </ul>
        </x-card>
    </section>
</x-kitchen-layout>
