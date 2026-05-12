<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', "Nad's Kitchen") }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-nk-bg font-sans text-nk-text antialiased">
    <div class="flex min-h-screen items-center justify-center px-4 py-10">
        <div class="w-full max-w-md rounded-[24px] border border-nk-border bg-nk-card p-8 shadow-[0_20px_45px_rgba(43,42,40,0.08)]">
            <div class="mb-6 text-center">
                <a href="{{ route('public.home') }}" class="font-heading text-4xl text-nk-text">Nad's Kitchen</a>
                <p class="mt-1 text-sm text-nk-muted">Admin Panel</p>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>
</html>
