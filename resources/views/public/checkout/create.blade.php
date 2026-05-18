<x-public-layout>
    <h1 class="font-heading text-4xl text-nk-text">Form Pemesanan</h1>

    <div class="nk-checkout-grid mt-6">
        <x-card class="nk-checkout-form-card" padding="lg">
            <form method="POST" action="{{ route('public.checkout.review') }}" class="space-y-5" id="checkout-form">
                @csrf
                <x-input name="customer_name" label="Nama Pemesan" :value="$checkoutData['customer_name'] ?? null" placeholder="Contoh: Nadia Putri" />
                <x-input name="customer_whatsapp" label="Nomor WhatsApp" :value="$checkoutData['customer_whatsapp'] ?? null" placeholder="Contoh: 08123456789" />
                <x-textarea name="event_address" label="Alamat Acara" :value="$checkoutData['event_address'] ?? null" placeholder="Tulis alamat lengkap acara" />

                @php
                    $eventDateValue = old('event_date', $checkoutData['event_date'] ?? null);
                    $eventTimeValue = old('event_time', $checkoutData['event_time'] ?? null);
                    $timeOptions = ['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
                @endphp

                <div class="nk-schedule-field">
                    <p class="nk-schedule-label">Tanggal Acara</p>

                    <div class="nk-schedule-card {{ $errors->has('event_date') ? 'nk-input-error' : '' }}" id="event-date-card" role="button" tabindex="0" aria-label="Pilih tanggal acara">
                        <div class="nk-schedule-main">
                            <div class="nk-schedule-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                    <rect x="3.5" y="5" width="17" height="15" rx="2.5"></rect>
                                    <path d="M8 3.5V7M16 3.5V7M3.5 10.5H20.5"></path>
                                </svg>
                            </div>
                            <div class="nk-schedule-content">
                                <p class="nk-schedule-value" id="event-date-display" data-empty="Pilih tanggal acara">Pilih tanggal acara</p>
                                <p class="nk-schedule-help">Pilih tanggal minimal H-2 sebelum acara.</p>
                            </div>
                        </div>
                        <span class="nk-schedule-action">Ubah Tanggal</span>

                        <input
                            type="date"
                            id="event-date-native"
                            class="nk-date-native-hidden"
                            value="{{ $eventDateValue }}"
                            min="{{ now()->addDays(2)->format('Y-m-d') }}"
                            aria-hidden="true"
                            tabindex="-1"
                        >
                    </div>

                    <input type="hidden" name="event_date" id="event-date-hidden" value="{{ $eventDateValue }}">

                    @error('event_date')
                        <p class="mt-1 text-sm text-[var(--error)]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="nk-schedule-field" id="event-time-field">
                    <p class="nk-schedule-label">Jam Acara</p>

                    <div class="nk-schedule-card {{ $errors->has('event_time') ? 'nk-input-error' : '' }}">
                        <div class="nk-schedule-main">
                            <div class="nk-schedule-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                    <circle cx="12" cy="12" r="8.5"></circle>
                                    <path d="M12 7.5V12L15 14"></path>
                                </svg>
                            </div>
                            <div class="nk-schedule-content">
                                <p class="nk-schedule-value" id="event-time-display" data-empty="Pilih jam acara">Pilih jam acara</p>
                                <p class="nk-schedule-help">Jam operasional 07.00–17.00 WIB.</p>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="event_time" id="event-time-hidden" value="{{ $eventTimeValue }}">

                    <div class="nk-time-grid" role="group" aria-label="Pilih jam acara">
                        @foreach ($timeOptions as $slot)
                            @php $displaySlot = str_replace(':', '.', $slot); @endphp
                            <button type="button" class="nk-time-option {{ $eventTimeValue === $slot ? 'is-active' : '' }}" data-time-value="{{ $slot }}">
                                <span>{{ $displaySlot }}</span>
                            </button>
                        @endforeach
                    </div>

                    @error('event_time')
                        <p class="mt-1 text-sm text-[var(--error)]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-1">
                    <x-textarea name="notes" label="Catatan Tambahan" :value="$checkoutData['notes'] ?? null" placeholder="Opsional" />
                </div>

                <div class="pt-3 space-y-3">
                    <p class="text-[12.5px] text-[var(--text-secondary)]">Pastikan data acara sudah benar sebelum lanjut review.</p>
                    <div class="flex flex-wrap gap-2">
                        <x-button type="submit">Review Pesanan</x-button>
                        <x-button variant="secondary" :href="route('public.cart.index')">Kembali ke Keranjang</x-button>
                    </div>
                </div>
            </form>
        </x-card>

        <x-card class="nk-checkout-summary-card" padding="lg">
            <h2 class="font-heading text-2xl text-nk-text">Ringkasan Keranjang</h2>

            <p class="nk-summary-label mt-4">Daftar Item</p>
            <div class="mt-2 space-y-2">
                @foreach ($cartItems as $item)
                    <div class="nk-summary-row">
                        <p class="nk-summary-value">{{ $item['name'] }} x {{ $item['quantity'] }}</p>
                        <x-price :amount="$item['subtotal']" class="font-medium text-nk-text" />
                    </div>
                @endforeach
            </div>

            <div class="mt-4 border-t border-[var(--border)] pt-3">
                <div class="nk-summary-row">
                    <p class="nk-summary-label">Total</p>
                    <p class="font-semibold text-[var(--accent)]"><x-price :amount="$cartTotal" /></p>
                </div>
            </div>

            <div class="mt-4 border-t border-[var(--border)] pt-3">
                <p class="nk-summary-label">Jadwal Acara</p>
                <div class="mt-2 space-y-1">
                    <p class="nk-summary-value" id="summary-date">Jadwal acara belum dipilih</p>
                    <p class="nk-summary-value" id="summary-time"></p>
                </div>
            </div>

            <p class="nk-summary-note mt-4">Pesanan akan dikonfirmasi admin sebelum diproses.</p>
        </x-card>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const localeDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const localeMonths = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const dateCard = document.getElementById('event-date-card');
            const dateNative = document.getElementById('event-date-native');
            const dateHidden = document.getElementById('event-date-hidden');
            const dateDisplay = document.getElementById('event-date-display');
            const summaryDate = document.getElementById('summary-date');
            const summaryTime = document.getElementById('summary-time');

            const timeHidden = document.getElementById('event-time-hidden');
            const timeDisplay = document.getElementById('event-time-display');
            const timeOptions = document.querySelectorAll('.nk-time-option');

            const formatDateId = (dateValue) => {
                if (!dateValue) return '';
                const [year, month, day] = dateValue.split('-').map(Number);
                if (!year || !month || !day) return '';
                const parsed = new Date(year, month - 1, day);
                return `${localeDays[parsed.getDay()]}, ${String(day).padStart(2, '0')} ${localeMonths[month - 1]} ${year}`;
            };

            const formatTimeDisplay = (timeValue) => {
                if (!timeValue) return '';
                return `${timeValue.replace(':', '.')} WIB`;
            };

            const syncSummary = (dateValue, timeValue) => {
                const formattedDate = formatDateId(dateValue || '');
                const formattedTime = formatTimeDisplay(timeValue || '');

                if (!formattedDate && !formattedTime) {
                    summaryDate.textContent = 'Jadwal acara belum dipilih';
                    summaryTime.textContent = '';
                    return;
                }

                summaryDate.textContent = formattedDate ? `Tanggal: ${formattedDate}` : 'Tanggal: Belum dipilih';
                summaryTime.textContent = formattedTime ? `Jam: ${formattedTime}` : 'Jam: Belum dipilih';
            };

            const syncDate = (dateValue) => {
                const formattedDate = formatDateId(dateValue || '');
                dateHidden.value = dateValue || '';
                dateNative.value = dateValue || '';
                dateDisplay.textContent = formattedDate || dateDisplay.dataset.empty;
                syncSummary(dateHidden.value, timeHidden.value);
            };

            const syncTime = (timeValue) => {
                const formattedTime = formatTimeDisplay(timeValue || '');
                timeHidden.value = timeValue || '';
                timeDisplay.textContent = formattedTime || timeDisplay.dataset.empty;
                timeOptions.forEach((option) => {
                    option.classList.toggle('is-active', option.dataset.timeValue === timeValue);
                });
                syncSummary(dateHidden.value, timeHidden.value);
            };

            syncDate(dateHidden.value || dateNative.value || '');
            syncTime(timeHidden.value || '');

            dateCard.addEventListener('click', () => dateNative.showPicker ? dateNative.showPicker() : dateNative.focus());
            dateCard.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    if (dateNative.showPicker) dateNative.showPicker();
                    else dateNative.focus();
                }
            });

            dateNative.addEventListener('change', (event) => {
                syncDate(event.target.value);
            });

            timeOptions.forEach((option) => {
                option.addEventListener('click', () => {
                    syncTime(option.dataset.timeValue);
                });
            });
        });
    </script>
</x-public-layout>
