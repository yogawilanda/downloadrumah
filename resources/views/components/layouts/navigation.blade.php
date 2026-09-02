{{--
loc: resources/views/components/layouts/navigation.blade.php
usage: global navigations. regardless authenticated user or not.
--}}
<div x-data="botNavBar('{{ request()->routeIs('home') ? 'home' : '...'  }}')">
    <div class="fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-gray-100 shadow-lg">
        <div class="max-w-md mx-auto flex items-center justify-around h-16 px-2">

            <!-- 1. Beranda -->
            <a href="{{ route('home') }}" wire:navigate @click="setTab('home')"
                :class="activeTab === 'home' ? 'text-blue-600 font-semibold' : 'text-gray-400 hover:text-gray-600 font-medium'"
                class="flex flex-col items-center justify-center flex-1 h-full space-y-1 transition-colors duration-150">
                <x-icons.icons-home class="w-5 h-5 shrink-0" />
                <span class="text-[10px] tracking-tight">Beranda</span>
            </a>

            <!-- 2. Kalkulator KPR (Pengganti Cari) -->
            <a href="{{ route('mortgage.calculator') }}" wire:navigate @click="setTab('kpr')"
                :class="activeTab === 'kpr' ? 'text-blue-600 font-semibold' : 'text-gray-400 hover:text-gray-600 font-medium'"
                class="flex flex-col items-center justify-center flex-1 h-full space-y-1 transition-colors duration-150">
                <x-icons.icons-calculator/>
                <span class="text-[10px] tracking-tight">KPR</span>
            </a>

            <!-- 3. Floating CTA Button -->
            <div class="flex items-center justify-center flex-1 h-full">
                <a href="{{ auth()->check() ? route('estates.create') : route('login') }}" wire:navigate
                    class="flex items-center justify-center w-11 h-11 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-full shadow-md shadow-blue-200 hover:opacity-95 active:scale-95 transition-all">
                    <x-icons.icons-adds class="w-5 h-5" />
                </a>
            </div>

            <!-- 4. Listing Saya -->
            @auth
                <a href="{{ route('listings.index') }}" wire:navigate @click="setTab('listings')"
                    :class="activeTab === 'listings' ? 'text-blue-600 font-semibold' : 'text-gray-400 hover:text-gray-600 font-medium'"
                    class="flex flex-col items-center justify-center flex-1 h-full space-y-1 transition-colors duration-150">
                    <x-icons.icons-listings class="w-5 h-5 shrink-0" />
                    <span class="text-[10px] tracking-tight">Listing</span>
                </a>
            @else
                <a href="{{ route('login') }}" wire:navigate
                    class="flex flex-col items-center justify-center flex-1 h-full space-y-1 text-gray-300 hover:text-gray-400 font-medium transition-colors duration-150">
                    <x-icons.icons-listings class="w-5 h-5 shrink-0" />
                    <span class="text-[10px] tracking-tight">Listing</span>
                </a>
            @endauth

            <!-- 5. Menu / Masuk -->
            @auth
                <button type="button" @click="openMenu = true; setTab('menu')"
                    :class="activeTab === 'menu' ? 'text-blue-600 font-semibold' : 'text-gray-400 hover:text-gray-600 font-medium'"
                    class="flex flex-col items-center justify-center flex-1 h-full space-y-1 transition-colors duration-150 focus:outline-none">
                    <x-icons.icons-menus class="w-5 h-5 shrink-0" />
                    <span class="text-[10px] tracking-tight">Menu</span>
                </button>
            @else
                <a href="{{ route('login') }}" wire:navigate @click="setTab('menu')"
                    :class="activeTab === 'menu' ? 'text-blue-600 font-semibold' : 'text-gray-400 hover:text-gray-600 font-medium'"
                    class="flex flex-col items-center justify-center flex-1 h-full space-y-1 transition-colors duration-150">
                    <x-icons.icons-login class="w-5 h-5 shrink-0" />
                    <span class="text-[10px] tracking-tight">{{__('Masuk')}}</span>
                </a>
            @endauth

        </div>
    </div>

    <!-- Bottom Sheet Modal (Auth Only) -->
    @auth
        <div x-show="openMenu" x-cloak class="fixed inset-0 z-50 flex items-end justify-center">
            <!-- Backdrop First animation to make flawless animation -->
            <div x-show="openMenu" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="openMenu = false"
                class="fixed inset-0 bg-black/40 backdrop-blur-sm"></div>

            <!-- Panel Content -->
            <div x-show="openMenu" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0"
                x-transition:leave-end="translate-y-full"
                class="w-full max-w-md bg-white rounded-t-2xl shadow-2xl z-10 p-5 pb-8 space-y-4">

                <div class="flex justify-center">
                    <div class="w-12 h-1.5 bg-gray-200 rounded-full"></div>
                </div>

                <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-800">Menu Pengguna</h3>
                    <button @click="openMenu = false" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-1">
                    <a href="{{ route('dashboard') }}" wire:navigate @click="openMenu = false"
                        class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition">
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('profile') }}" wire:navigate @click="openMenu = false"
                        class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition">
                        <span class="text-sm font-medium">Ubah Profil</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-gray-100">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center space-x-3 p-3 text-red-600 hover:bg-red-50 rounded-xl transition text-left">
                            <span class="text-sm font-medium">Keluar Akun</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endauth
</div>
