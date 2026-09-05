<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', 'Download Rumah') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}?v=20260830" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}?v=20260830" />
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}?v=20260830" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}?v=20260830" />
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}?v=20260830" />

    <!-- Meta untuk PWA & Mobile Web App -->
    <meta name="theme-color" content="#2563eb">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Download Rumah" />

    @if (app()->environment('production'))
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

{{-- Ubah bg-body disamakan dengan background container agar tidak terasa 'membal' saat pertama muat --}}
<body class="bg-white font-sans antialiased selection:bg-blue-500 selection:text-white">

    <main class="max-w-md mx-auto min-h-screen bg-white relative pb-16">
        {{ $slot }}
    </main>
    <x-layouts.navigation />

    @livewireScripts
</body>

</html>
