<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DownloadRumah' }}</title>

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

    <!-- 2. Taruh Scripts wajib Livewire 3 di paling bawah body -->
    @livewireScripts
</body>
</html>
