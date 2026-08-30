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
    {{-- <link rel="icon" type="image/png" href="{{ asset('favicon.jpg') }}"> --}}
    
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png?v=20260830') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg?v=20260830" />
    <link rel="shortcut icon" href="/favicon.ico?v=20260830" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=20260830" />
    <meta name="apple-mobile-web-app-title" content="Download Rumah" />
    <link rel="manifest" href="/site.webmanifest?v=20260830" />

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
