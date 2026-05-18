@props([
    'value' => 0,
    'unit' => null,
])

@php
    $unitText = strtolower(trim((string) $unit));
    $discreteUnits = ['potong', 'pcs', 'piece', 'buah', 'box', 'cup', 'porsi', 'pack', 'bungkus', 'lembar', 'botol'];

    $number = (float) $value;
    $isWhole = abs($number - round($number)) < 0.00001;

    if (in_array($unitText, $discreteUnits, true) && $isWhole) {
        $formatted = number_format($number, 0, ',', '.');
    } elseif ($isWhole) {
        $formatted = number_format($number, 0, ',', '.');
    } else {
        $formatted = rtrim(rtrim(number_format($number, 2, ',', '.'), '0'), ',');
    }
@endphp

{{ $formatted }}
