<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name', 'DownloadRumah') }}</title>

    {{-- Import Tailwind via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-100/60 min-h-screen flex items-center justify-center p-4">

    {{-- Wrapper Card Mobile First --}}
    <div class="w-full max-w-md bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm text-center space-y-5">

        {{-- Code Badge --}}
        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto text-2xl font-extrabold shadow-inner">
            @yield('code')
        </div>

        {{-- Title & Message --}}
        <div class="space-y-1.5">
            <h1 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight">
                @yield('title')
            </h1>
            <p class="text-xs text-slate-500 leading-relaxed">
                @yield('message')
            </p>
        </div>

        {{-- Action Button --}}
        <div class="pt-2">
            <a href="{{ route('home') }}"
               class="inline-flex items-center justify-center w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                &larr; Kembali ke Beranda
            </a>
        </div>

    </div>

</body>
</html>
