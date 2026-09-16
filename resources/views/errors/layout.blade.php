{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/errors/layout.blade.php
| @usage : Base Layout for HTTP Exceptions & Errors (Mobile-First Tailwind)
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Error') - {{ config('app.name', 'DownloadRumah') }}</title>

    {{-- Asset Bundle via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen items-center justify-center bg-slate-100/60 p-4 antialiased dark:bg-slate-950">

    {{-- Card Container Mobile-First --}}
    <div
        class="w-full max-w-md space-y-5 rounded-md border border-slate-200/80 bg-white p-6 text-center shadow-sm
               dark:border-slate-800 dark:bg-slate-900 dark:shadow-none sm:p-8"
    >

        {{-- Badge Code --}}
        <div
            class="mx-auto flex h-16 w-16 items-center justify-center rounded-md bg-sky-50 text-2xl
                   font-extrabold text-sky-600 shadow-inner
                   dark:bg-sky-950/40 dark:text-sky-400"
        >
            @yield('code', '!')
        </div>

        {{-- Content Message --}}
        <div class="space-y-1.5">
            <h1 class="text-base font-bold tracking-tight text-slate-900 dark:text-slate-100 sm:text-lg">
                @yield('title', 'Terjadi Kesalahan')
            </h1>

            <p class="text-xs leading-relaxed text-slate-500 dark:text-slate-400">
                @yield('message')
            </p>
        </div>

        {{-- Action Button --}}
        <div class="pt-2">
            <a
                href="{{ route('home') }}"
                class="inline-flex w-full items-center justify-center rounded-md bg-sky-600 px-4 py-2.5
                       text-xs font-semibold text-white shadow-sm transition-all duration-200
                       hover:bg-sky-700 dark:hover:bg-sky-500"
            >
                &larr; Kembali ke Beranda
            </a>
        </div>

    </div>

</body>

</html>
