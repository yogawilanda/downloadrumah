{{-- loc: resources/views/components/layouts/app.blade.php --}}
{{-- func: root layout untuk seluruh jenis user --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', 'Download Rumah') }}</title>

    <!-- TODO: tambah icon yang benar -->
    <link rel="icon" type="image/png" href="{{ asset('icon1.png') }}">

    <!-- PWA Web Manifest -->
    <meta name="theme-color" content="#9333ea">

    <!-- 1. Force HTTPS Asset kalau di Production -->
    @if (app()->environment('production'))
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 font-sans antialiased selection:bg-indigo-500 selection:text-white">
    <main class="max-w-md mx-auto min-h-screen bg-white shadow-xl relative pb-16">
        {{ $slot }}
    </main>
    <x-layouts.navigation />

    @livewireScripts
</body>

</html>
