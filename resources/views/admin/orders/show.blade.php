<x-admin-layout title="Detail Pesanan">
    <x-admin-page-header title="Detail Pesanan" description="{{ $order->invoice_number }}" />

    <div class="grid gap-4 lg:grid-cols-3">
        <x-card class="space-y-2" padding="lg">
            <h3 class="font-heading text-2xl">Data Customer</h3>
            <p class="text-sm text-nk-muted">Nama: {{ $order->customer_name }}</p>
            <p class="text-sm text-nk-muted">WhatsApp: {{ $order->customer_whatsapp }}</p>
        </x-card>

        <x-card class="space-y-3" padding="lg">
            <h3 class="font-heading text-2xl">Data Acara</h3>
            <x-date-time label="Jadwal Acara" :date="$order->event_date" :time="$order->event_time" variant="stacked" />
            <p class="text-sm text-nk-muted">Alamat: {{ $order->event_address }}</p>
            <p class="text-sm text-nk-muted">Catatan: {{ $order->notes ?: '-' }}</p>
        </x-card>

        <x-card class="space-y-3" padding="lg">
            <h3 class="font-heading text-2xl">Status</h3>
            <x-status-badge :status="$order->status" />
            @if($order->status === \App\Enums\OrderStatus::New)
                <div class="rounded-xl border border-nk-warning/30 bg-nk-warning/10 p-3 text-sm text-nk-text">
                    Pesanan ini belum masuk rekap bahan karena belum dikonfirmasi. Ubah status ke Dikonfirmasi agar dapur dapat melihat pesanan dan kebutuhan bahan.
                </div>
            @endif
            <p class="text-xs text-nk-muted">Konfirmasi pesanan agar masuk ke daftar produksi dapur.</p>
            <p class="text-xs text-nk-muted">Alur status operasional: Baru -> Dikonfirmasi -> Diproses -> Selesai (Dibatalkan tersedia jika pesanan batal).</p>
            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="space-y-3">
                @csrf @method('PATCH')
                <select name="status" class="w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm">
                    @foreach($statuses as $status)
                        <option value="{{ $status->value }}" @selected($order->status === $status)>{{ $status->label() }}</option>
                    @endforeach
                </select>
                <x-button type="submit">Update Status</x-button>
            </form>
            <x-button :href="route('admin.orders.index', ['event_date' => optional($order->event_date)->toDateString(), 'status' => \App\Enums\OrderStatus::Confirmed->value])" variant="secondary">Lihat Rekap Bahan Tanggal Acara Ini</x-button>
        </x-card>
    </div>

    <section class="mt-6">
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Menu</th><th class="px-4 py-3">Harga</th><th class="px-4 py-3">Quantity</th><th class="px-4 py-3">Subtotal</th></tr></thead>
            <tbody>
            @foreach($order->items as $item)
                <tr class="border-t border-nk-border/80">
                    <td class="px-4 py-3">{{ $item->menu_name }}</td>
                    <td class="px-4 py-3 text-nk-muted"><x-price :amount="$item->price" /></td>
                    <td class="px-4 py-3 text-nk-muted">{{ $item->quantity }}</td>
                    <td class="px-4 py-3 text-nk-muted"><x-price :amount="$item->subtotal" /></td>
                </tr>
            @endforeach
            </tbody>
        </x-admin-table>
        <div class="mt-4 flex flex-wrap items-center justify-between gap-2">
            <p class="font-heading text-3xl text-nk-primary">Total: <x-price :amount="$order->total_amount" /></p>
            <div class="flex gap-2">
                <x-button :href="route('admin.invoices.show', $order)">Lihat Invoice</x-button>
                <x-button :href="$whatsAppUrl" variant="secondary">Hubungi Customer</x-button>
                <x-button :href="route('admin.orders.index')" variant="secondary">Kembali</x-button>
            </div>
        </div>
    </section>

    <section class="mt-6 space-y-4">
        <x-card padding="lg" class="space-y-3">
            <h3 class="font-heading text-2xl">Perhitungan Kebutuhan Bahan</h3>

            @if($hasMissingBom)
                <div class="rounded-xl border border-nk-error/30 bg-nk-error/5 p-4">
                    <p class="text-sm text-nk-error">Beberapa menu belum memiliki komposisi bahan, sehingga perhitungan kebutuhan bahan belum lengkap.</p>
                    <ul class="mt-2 list-disc pl-5 text-sm text-nk-muted">
                        @foreach($missingBomMenus as $missingMenu)
                            <li>{{ $missingMenu['menu_name'] }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($ingredientNeeds->isEmpty())
                <p class="text-sm text-nk-muted">Belum ada data komposisi bahan untuk pesanan ini.</p>
            @else
                <x-admin-table>
                    <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted">
                    <tr>
                        <th class="px-4 py-3">Bahan</th>
                        <th class="px-4 py-3">Total Kebutuhan</th>
                        <th class="px-4 py-3">Satuan</th>
                        <th class="px-4 py-3">Detail pemakaian</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ingredientNeeds as $need)
                        <tr class="border-t border-nk-border/80 align-top">
                            <td class="px-4 py-3">{{ $need['ingredient_name'] }}</td>
                            <td class="px-4 py-3 text-nk-muted"><x-ingredient-qty :value="$need['total_quantity']" :unit="$need['ingredient_unit']" /></td>
                            <td class="px-4 py-3 text-nk-muted">{{ $need['ingredient_unit'] }}</td>
                            <td class="px-4 py-3 text-sm text-nk-muted">
                                @foreach($need['details'] as $detail)
                                    <p>{{ $detail['menu_name'] }}: <x-ingredient-qty :value="$detail['quantity_per_portion']" :unit="$detail['unit']" /> {{ $detail['unit'] }} × <x-ingredient-qty :value="$detail['order_quantity']" :unit="'porsi'" /> porsi = <x-ingredient-qty :value="$detail['total_quantity']" :unit="$detail['unit']" /> {{ $detail['unit'] }}</p>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </x-admin-table>
            @endif
        </x-card>
    </section>
</x-admin-layout>
