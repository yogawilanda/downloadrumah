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

<body class="bg-blue-600 font-sans antialiased selection:bg-blue-500 selection:text-white">

    <main class="max-w-md mx-auto min-h-screen bg-white relative pb-16">
        {{ $slot }}
    </main>

    <x-layouts.navigation />

    @livewireScripts

</body>
</html>
