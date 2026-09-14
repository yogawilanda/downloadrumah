{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/components/layouts/app.blade.php
| @usage : Root html for whole project
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.ga4.id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        // 1. Set global parameters first
        @if (session()->has('utm_short'))
            gtag('set', {
                'utm_short': @json(session('utm_short'))
            });
        @endif

        // 2. Initialize GA4 & trigger initial page_view
        gtag('config', '{{ config('services.ga4.id') }}');
    </script>

    @if (app()->environment('production'))
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif

    @head

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="bg-slate-100 font-sans antialiased text-gray-900 selection:bg-sky-500 selection:text-white min-h-screen flex flex-col">

    {{-- Global Responsive Header (Mobile, Tablet, & Desktop) --}}
    @if (request()->routeIs(['home', 'listings.index']))
        <header class="sticky top-0 z-30 w-full bg-white/95 backdrop-blur-md border-b border-gray-100">
            @livewire(\App\Livewire\Pages\Home\TopNav::class, [
                'isListingPage' => request()->routeIs('listings.index'),
            ])
        </header>
    @endif

    {{-- Main Container --}}
    <main class="w-full flex-grow relative pb-16 md:pb-0">
        {{ $slot }}
    </main>

    <x-layouts.navigation />

    @livewireScripts

</body>

</html>
