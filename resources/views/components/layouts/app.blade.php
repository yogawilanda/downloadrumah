{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
    | @path : resources/views/components/layouts/app.blade.php
    | @usage : DownloadRumah Root Application Layout — Global HTML Shell & Page Orchestration
    | @type : Root Blade Layout (Global Application Shell)
    |
    | @expected_data : [$slot]
    | @expected_events : []
    | @techstack : Laravel 13.17, Livewire 3.6.4, Tailwind CSS
    | @design_tokens : Font: Outfit | Theme: White / Slate / Sky Accent | Dark Mode
    | @seo_context : Global Application Layout
    |
    | @ruling : Global shell only. Page-specific visual systems remain inside page views.
    | @ruling_header : TopNav is rendered only for public Home & Listings surfaces.
    | @ruling_layout : Main content remains full-width. Child pages own their content containers.
    | @ruling_navigation : Global bottom/navigation component remains outside the page slot.
    | @ruling_performance : Preserve LCP. Avoid unnecessary global layers and eager visual assets.
    | @ruling_theme : Global surfaces must support light and dark appearance through Tailwind dark variants.
    |
    | @status : Active — Layout Foundation
    | @author : yogawilanda <eaywilanda@gmail.com>
        | </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

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

        @if (session()->has('utm_short'))
            gtag('set', {
                'utm_short': @json(session('utm_short'))
            });
        @endif

        gtag('config', '{{ config('services.ga4.id') }}');
    </script>

    @if (app()->environment('production'))
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif

    @head

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @fluxAppearance
</head>

<body
    class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased
           selection:bg-sky-500 selection:text-white
           dark:bg-slate-950 dark:text-slate-100">

    {{-- Global Responsive Header --}}
    @if (request()->routeIs(['home', 'listings.index']))
        <header
            class="sticky top-0 z-30 w-full
                   border-b border-slate-200
                   bg-white/95 backdrop-blur-md
                   dark:border-slate-800
                   dark:bg-slate-950/95">

            @livewire(\App\Livewire\Pages\Home\TopNav::class, [
                'isListingPage' => request()->routeIs('listings.index'),
            ])

        </header>
    @endif

    {{-- Page Content --}}
    <main class="relative w-full flex-grow pb-16 md:pb-16">
        {{ $slot }}
    </main>

    {{-- Global Bottom Navigation --}}
    <x-layouts.bottom-navigation />

    @livewireScripts
    @fluxScripts
</body>

</html>
