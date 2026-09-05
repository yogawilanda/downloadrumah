{{--
loc: resources/views/components/layouts/navigation-menu-sheet.blade.php
usage: Universal bottom sheet modal menu for navigation
--}}
<div x-show="openMenu" x-cloak class="fixed inset-0 z-50 flex items-end justify-center">
    <!-- Backdrop -->
    <div x-show="openMenu" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="openMenu = false"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm"></div>

    <!-- Panel Content -->
    <div x-show="openMenu" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="w-full max-w-md bg-white rounded-t-2xl shadow-2xl z-10 p-5 pb-8 space-y-4 max-h-[85vh] overflow-y-auto">

        <div class="flex justify-center">
            <div class="w-12 h-1.5 bg-gray-200 rounded-full"></div>
        </div>

        <div class="flex items-center justify-between pb-2 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-800">Menu & Informasi</h3>
            <button @click="openMenu = false" class="text-gray-400 hover:text-gray-600 focus:outline-none p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Header Status Akun -->
        @guest
            <div class="p-3 bg-blue-50/70 border border-blue-100 rounded-2xl flex items-center justify-between">
                <div class="space-y-0.5">
                    <p class="text-xs font-bold text-gray-800">Ingin Pasang Iklan?</p>
                    <p class="text-[11px] text-gray-500">Masuk untuk kelola propertimu.</p>
                </div>
                <a href="{{ route('login') }}" wire:navigate @click="openMenu = false"
                    class="px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-xl shadow-sm hover:bg-blue-700 transition">
                    Masuk
                </a>
            </div>
        @else
            <div class="p-3 bg-gray-50 border border-gray-100 rounded-2xl flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center text-sm shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="space-y-0.5 overflow-hidden">
                    <p class="text-xs font-bold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
        @endguest

        <!-- Menu Akun & Fitur -->
        @auth
            <div class="space-y-1 pt-1">
                <a href="{{ route('dashboard') }}" wire:navigate @click="openMenu = false"
                    class="flex items-center space-x-3 p-2.5 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition text-xs font-medium">
                    <span>Dashboard Agen</span>
                </a>
                <a href="{{ route('profile') }}" wire:navigate @click="openMenu = false"
                    class="flex items-center space-x-3 p-2.5 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition text-xs font-medium">
                    <span>Pengaturan Akun</span>
                </a>
            </div>
        @endauth

        <!-- Informasi Umum & Hukum -->
        <div class="pt-2 border-t border-gray-100 space-y-1">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider px-2 mb-1">Informasi Aplikasi</p>

            <a href="{{ route('privacy') }}" wire:navigate @click="openMenu = false"
                class="flex items-center justify-between p-2.5 text-gray-700 hover:bg-gray-50 rounded-xl transition text-xs font-medium">
                <span>Kebijakan Privasi</span>
                <span class="text-gray-400 text-[10px]">›</span>
            </a>

            <a href="{{ route('support') }}" wire:navigate @click="openMenu = false"
                class="flex items-center justify-between p-2.5 text-gray-700 hover:bg-gray-50 rounded-xl transition text-xs font-medium">
                <span>Bantuan / Konsultasi Aplikasi</span>
                <span class="text-gray-400 text-[10px]">›</span>
            </a>

            <a href="{{ route('terms') }}" wire:navigate @click="openMenu = false"
                class="flex items-center justify-between p-2.5 text-gray-700 hover:bg-gray-50 rounded-xl transition text-xs font-medium">
                <span>Syarat & Ketentuan</span>
                <span class="text-gray-400 text-[10px]">›</span>
            </a>

            <a href="{{ route('release-notes') }}" wire:navigate @click="openMenu = false"
                class="flex items-center justify-between p-2.5 text-gray-700 hover:bg-gray-50 rounded-xl transition text-xs font-medium">
                <span>Release Notes</span>
                <span class="text-xs text-blue-600 font-semibold">v0.9.0-alpha</span>
            </a>
        </div>

        <!-- Logout Button -->
        @auth
            <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-gray-100">
                @csrf
                <button type="submit"
                    class="w-full flex items-center space-x-3 p-2.5 text-red-600 hover:bg-red-50 rounded-xl transition text-left text-xs font-semibold">
                    <span>Keluar Akun</span>
                </button>
            </form>
        @endauth

    </div>
</div>
