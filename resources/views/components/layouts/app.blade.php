<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DownloadRumah' }}</title>

    <!-- INI BARIS WAJIB KUNCI TAILWIND -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 font-sans antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Container Utama Dibatasi Max Mobile Width -->
    <main class="max-w-md mx-auto min-h-screen bg-white shadow-xl relative pb-16">
        {{ $slot }}
    </main>

    <!-- Flutter-style Bottom Navigation Bar -->
    <nav class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white/90 backdrop-blur-md border-t border-gray-100 z-50">
        <div class="flex items-center justify-around h-16 px-2">

            <!-- Home -->
            <a href="{{ route('home') }}" wire:navigate
               class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('home') ? 'text-indigo-600 font-semibold' : 'text-gray-400 hover:text-gray-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-[10px]">Beranda</span>
            </a>

            <!-- Search / Explore (Opsional) -->
            <a href="#" wire:navigate
               class="flex flex-col items-center justify-center w-full h-full space-y-1 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span class="text-[10px]">Cari</span>
            </a>

            <!-- Floating CTA Center Button (Pasang Iklan) -->
            <div class="flex items-center justify-center w-full h-full">
                @auth
                    <a href="{{ route('dashboard') }}" wire:navigate
                       class="p-3 bg-indigo-600 text-white rounded-full shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition transform active:scale-95 -mt-5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="p-3 bg-indigo-600 text-white rounded-full shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition transform active:scale-95 -mt-5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </a>
                @endauth
            </div>

            <!-- Saved / Wishlist -->
            <a href="#" wire:navigate
               class="flex flex-col items-center justify-center w-full h-full space-y-1 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span class="text-[10px]">Favorit</span>
            </a>

            <!-- Account / Dashboard -->
            @auth
                <a href="{{ route('dashboard') }}" wire:navigate
                   class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('dashboard*') ? 'text-indigo-600 font-semibold' : 'text-gray-400 hover:text-gray-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-[10px]">Akun</span>
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="flex flex-col items-center justify-center w-full h-full space-y-1 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    <span class="text-[10px]">Masuk</span>
                </a>
            @endauth

        </div>
    </nav>

    @livewireScripts
</body>

</html>
