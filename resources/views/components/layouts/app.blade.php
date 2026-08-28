<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DownloadRumah' }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- PWA Web Manifest -->
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
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
