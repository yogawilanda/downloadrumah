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

    @if (app()->environment('production'))
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif

    @head

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-slate-100 font-sans antialiased text-gray-900 selection:bg-blue-500 selection:text-white min-h-screen flex flex-col">

    {{-- Main Container yang fleksibel untuk Mobile Shell maupun Desktop Grid --}}
    <main class="w-full flex-grow relative pb-16 md:pb-0">
        {{ $slot }}
    </main>

    <x-layouts.navigation />

    @livewireScripts

</body>
</html>
