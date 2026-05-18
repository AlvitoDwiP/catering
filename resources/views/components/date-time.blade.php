@props([
    'date' => null,
    'time' => null,
    'label' => null,
    'variant' => 'default',
    'showDay' => true,
    'timezone' => 'Asia/Jakarta',
])

@php
    $dateValue = null;
    $timeValue = null;

    if ($date) {
        try {
            $dateValue = \Carbon\Carbon::parse($date, $timezone)
                ->timezone($timezone)
                ->locale('id');
        } catch (\Throwable $e) {
            $dateValue = null;
        }
    }

    if ($time) {
        try {
            $timeValue = \Carbon\Carbon::parse($time, $timezone)->timezone($timezone);
        } catch (\Throwable $e) {
            try {
                $timeValue = \Carbon\Carbon::createFromFormat('H:i', (string) $time, $timezone)->timezone($timezone);
            } catch (\Throwable $inner) {
                $timeValue = null;
            }
        }
    }

    $formattedDate = $dateValue
        ? $dateValue->translatedFormat($showDay ? 'l, d F Y' : 'd F Y')
        : 'Belum ditentukan';

    $formattedTime = $timeValue
        ? $timeValue->format('H.i') . ' WIB'
        : null;

    $combinedValue = $formattedDate;
    if ($formattedTime) {
        $combinedValue .= ' · ' . $formattedTime;
    }

    $labelText = $label ? mb_strtoupper($label) : null;
@endphp

@if ($variant === 'badge')
    <span {{ $attributes->merge(['class' => 'nk-date-badge']) }}>
        {{ $combinedValue }}
    </span>
@elseif ($variant === 'compact')
    <div {{ $attributes->merge(['class' => 'nk-date-block']) }}>
        @if ($label)
            <p class="nk-date-subvalue">{{ $label }}</p>
        @endif
        <p class="nk-date-subvalue">{{ $combinedValue }}</p>
    </div>
@elseif ($variant === 'stacked')
    <div {{ $attributes->merge(['class' => 'nk-date-block']) }}>
        @if ($labelText)
            <p class="nk-date-label">{{ $labelText }}</p>
        @endif
        <p class="nk-date-value {{ $dateValue ? '' : 'nk-date-muted' }}">{{ $formattedDate }}</p>
        <p class="nk-date-subvalue">{{ $formattedTime ?? 'Jadwal belum diisi' }}</p>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'nk-date-block']) }}>
        @if ($labelText)
            <p class="nk-date-label">{{ $labelText }}</p>
        @endif
        <p class="nk-date-value {{ $dateValue ? '' : 'nk-date-muted' }}">{{ $combinedValue }}</p>
    </div>
@endif
