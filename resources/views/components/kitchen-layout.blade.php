@props(['title' => 'Dapur'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - Nad's Kitchen Dapur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .print\:hidden { display: none !important; }
            .print\:p-0 { padding: 0 !important; }
            body { background: #fff !important; }
            main { width: 100% !important; }
            table { width: 100% !important; font-size: 12px; }
        }
    </style>
</head>
<body class="min-h-screen bg-nk-bg font-sans text-nk-text">
<div class="flex min-h-screen">
    <x-kitchen-sidebar class="print:hidden" />
    <div class="flex min-h-screen flex-1 flex-col">
        <x-kitchen-topbar :title="$title" class="print:hidden" />
        <main class="flex-1 p-6 lg:p-8 print:p-0">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-nk-success/40 bg-nk-success/10 px-4 py-3 text-sm">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-2xl border border-nk-error/40 bg-nk-error/10 px-4 py-3 text-sm">{{ session('error') }}</div>
            @endif
            @if (session('warning'))
                <div class="mb-6 rounded-2xl border border-nk-warning/40 bg-nk-warning/10 px-4 py-3 text-sm">{{ session('warning') }}</div>
            @endif
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
