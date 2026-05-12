<x-admin-layout title="Laporan Pesanan">
    <x-admin-page-header title="Laporan Pesanan" />

    <x-card class="mb-5" padding="sm">
        <form method="GET" class="grid gap-3 md:grid-cols-5">
            <x-input type="date" name="start_date" label="Tanggal mulai" :value="$startDate" />
            <x-input type="date" name="end_date" label="Tanggal akhir" :value="$endDate" />
            <div>
                <label class="text-sm font-medium text-nk-text">Status</label>
                <select name="status" class="mt-2 w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm">
                    <option value="">Semua</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->value }}" @selected($selectedStatus === $status->value)>{{ $status->label() }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-nk-text">Menu</label>
                <select name="menu_id" class="mt-2 w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm">
                    <option value="">Semua menu</option>
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}" @selected((string) $selectedMenuId === (string) $menu->id)>{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2"><x-button type="submit">Filter</x-button><x-button variant="secondary" :href="route('admin.reports.orders')">Reset</x-button></div>
        </form>
    </x-card>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <x-admin-stat-card label="Total Pesanan" :value="$totalOrders" />
        <x-admin-stat-card label="Total Transaksi" :value="'Rp ' . number_format($totalRevenue, 0, ',', '.')" />
        <x-admin-stat-card label="Pesanan Selesai" :value="$ordersByStatus->firstWhere('status', 'completed')->total ?? 0" />
        <x-admin-stat-card label="Pesanan Dibatalkan" :value="$ordersByStatus->firstWhere('status', 'cancelled')->total ?? 0" />
    </div>

    <section class="mt-6">
        <h3 class="mb-3 font-heading text-2xl">Orders by Status</h3>
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Status</th><th class="px-4 py-3">Jumlah</th></tr></thead>
            <tbody>
            @forelse($ordersByStatus as $row)
                <tr class="border-t border-nk-border/80"><td class="px-4 py-3">{{ \App\Enums\OrderStatus::from($row->status)->label() }}</td><td class="px-4 py-3 text-nk-muted">{{ $row->total }}</td></tr>
            @empty
                <tr><td colspan="2" class="px-4 py-6 text-center text-nk-muted">Tidak ada data.</td></tr>
            @endforelse
            </tbody>
        </x-admin-table>
    </section>

    <section class="mt-6">
        <h3 class="mb-3 font-heading text-2xl">Top Menus</h3>
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Menu</th><th class="px-4 py-3">Total quantity</th><th class="px-4 py-3">Total subtotal</th></tr></thead>
            <tbody>
            @forelse($topMenus as $menu)
                <tr class="border-t border-nk-border/80"><td class="px-4 py-3">{{ $menu->menu_name }}</td><td class="px-4 py-3 text-nk-muted">{{ $menu->total_quantity }}</td><td class="px-4 py-3 text-nk-muted">Rp {{ number_format((float) $menu->total_subtotal, 0, ',', '.') }}</td></tr>
            @empty
                <tr><td colspan="3" class="px-4 py-6 text-center text-nk-muted">Tidak ada data menu.</td></tr>
            @endforelse
            </tbody>
        </x-admin-table>
    </section>

    <section class="mt-6">
        <h3 class="mb-3 font-heading text-2xl">Daily Recap</h3>
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Tanggal acara</th><th class="px-4 py-3">Jumlah pesanan</th><th class="px-4 py-3">Total transaksi</th></tr></thead>
            <tbody>
            @forelse($dailyOrders as $day)
                <tr class="border-t border-nk-border/80"><td class="px-4 py-3">{{ \Carbon\Carbon::parse($day->event_date)->format('d M Y') }}</td><td class="px-4 py-3 text-nk-muted">{{ $day->total_orders }}</td><td class="px-4 py-3 text-nk-muted">Rp {{ number_format((float) $day->total_revenue, 0, ',', '.') }}</td></tr>
            @empty
                <tr><td colspan="3" class="px-4 py-6 text-center text-nk-muted">Tidak ada data harian.</td></tr>
            @endforelse
            </tbody>
        </x-admin-table>
    </section>

    <section class="mt-6">
        <h3 class="mb-3 font-heading text-2xl">Latest Orders</h3>
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Invoice</th><th class="px-4 py-3">Customer</th><th class="px-4 py-3">Tanggal acara</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Total</th></tr></thead>
            <tbody>
            @forelse($latestOrders as $order)
                <tr class="border-t border-nk-border/80"><td class="px-4 py-3">{{ $order->invoice_number }}</td><td class="px-4 py-3">{{ $order->customer_name }}</td><td class="px-4 py-3 text-nk-muted">{{ $order->event_date?->format('d M Y') }}</td><td class="px-4 py-3"><x-status-badge :status="$order->status" /></td><td class="px-4 py-3 text-nk-muted"><x-price :amount="$order->total_amount" /></td></tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-nk-muted">Tidak ada pesanan.</td></tr>
            @endforelse
            </tbody>
        </x-admin-table>
    </section>
</x-admin-layout>
