{{--
|--------------------------------------------------------------------------
| <Context & Meta Configuration>
|--------------------------------------------------------------------------
| @path : resources/views/components/layouts/app.blade.php
| @usage : Root html for whole project
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
| <Context & Meta Configuration/>
|--------------------------------------------------------------------------
--}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', 'Download Rumah') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}?v=20260905" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}?v=20260905" />
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}?v=20260905" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}?v=20260905" />
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}?v=20260905" />

    <meta name="theme-color" content="#2563eb">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Download Rumah" />

    @if (app()->environment('production'))
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif

    @stack('meta')

    @if (!View::hasSection('has_custom_meta'))
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', 'Download Rumah') }}">
        <meta property="og:description" content="Temukan hunian impian, kalkulasi KPR presisi, dan konsultasi properti cepat & transparan di Download Rumah.">
        <meta property="og:image" content="{{ asset('favicon.png') }}?v=20260905">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image" content="{{ asset('favicon.png') }}?v=20260905">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-white font-sans antialiased selection:bg-blue-500 selection:text-white" x-data="pwaInstaller()">

    <main class="max-w-md mx-auto min-h-screen bg-white relative pb-16">
        {{ $slot }}
    </main>

    <x-layouts.navigation />

    @livewireScripts

</body>
</html>
