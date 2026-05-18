<x-admin-layout title="Dashboard Admin">
    <x-admin-page-header title="Dashboard Admin" description="Ringkasan pesanan dan aktivitas Nad's Kitchen." />

    <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        <x-admin-stat-card label="Pesanan Hari Ini" :value="$totalOrdersToday" />
        <x-admin-stat-card label="Pesanan Baru" :value="$newOrdersCount" />
        <x-admin-stat-card label="Dikonfirmasi" :value="$confirmedOrdersCount" />
        <x-admin-stat-card label="Diproses" :value="$processingOrdersCount" />
        <x-admin-stat-card label="Selesai" :value="$completedOrdersCount" variant="success" />
        <x-admin-stat-card label="Total Transaksi Bulan Ini" :value="'Rp' . number_format($totalRevenueThisMonth, 0, ',', '.')" variant="accent" />
    </section>

    <section class="mt-8">
        <h3 class="mb-3 font-heading text-2xl text-nk-text">Pesanan Terbaru</h3>
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted">
            <tr>
                <th class="px-4 py-3">Invoice</th>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Jadwal Acara</th>
                <th class="px-4 py-3">Total</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($latestOrders as $order)
                <tr class="border-t border-nk-border/80 align-top">
                    <td class="px-4 py-3 font-medium text-nk-text">{{ $order->invoice_number }}</td>
                    <td class="px-4 py-3 text-nk-muted">{{ $order->customer_name }}</td>
                    <td class="px-4 py-3 text-nk-muted">
                        <x-date-time :date="$order->event_date" :time="$order->event_time" variant="compact" />
                    </td>
                    <td class="px-4 py-3 text-nk-muted">Rp{{ number_format((float) $order->total_amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-3"><x-status-badge :status="$order->status" /></td>
                    <td class="px-4 py-3"><a href="{{ route('admin.orders.show', $order) }}" class="text-nk-primary hover:underline">Detail</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-sm text-nk-muted">Belum ada data pesanan.</td>
                </tr>
            @endforelse
            </tbody>
        </x-admin-table>
    </section>

    <section class="mt-8 grid gap-4 md:grid-cols-4">
        <x-admin-stat-card label="Menu Rekomendasi" :value="$recommendedMenusCount" />
        <x-admin-stat-card label="Menu Tersedia" :value="$availableMenusCount" />
        <a href="{{ route('admin.menus.index') }}" class="rounded-[20px] border border-nk-border bg-nk-card p-5 text-sm text-nk-muted hover:bg-nk-alt">Kelola Menu</a>
        <div class="rounded-[20px] border border-nk-border bg-nk-card p-5">
            <p class="text-sm text-nk-muted">Quick Actions</p>
            <div class="mt-3 grid gap-2 text-sm">
                <a href="{{ route('admin.menu-categories.index') }}" class="rounded-xl border border-nk-border px-3 py-2 text-nk-muted hover:bg-nk-alt hover:text-nk-text">Kategori Menu</a>
                <a href="{{ route('admin.orders.index') }}" class="rounded-xl border border-nk-border px-3 py-2 text-nk-muted hover:bg-nk-alt hover:text-nk-text">Lihat Pesanan</a>
                <a href="{{ route('public.home') }}" class="rounded-xl border border-nk-border px-3 py-2 text-nk-muted hover:bg-nk-alt hover:text-nk-text">Lihat Website</a>
            </div>
        </div>
    </section>
</x-admin-layout>
