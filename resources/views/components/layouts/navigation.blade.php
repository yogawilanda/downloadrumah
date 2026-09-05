{{--
loc: resources/views/components/layouts/navigation.blade.php
usage: Global mobile bottom navigation container
--}}
<div x-data="botNavBar('{{ request()->routeIs('home') ? 'home' : (request()->routeIs('mortgage.calculator') ? 'kpr' : (request()->routeIs('listings.*') ? 'listings' : 'menu')) }}')">
    <div class="fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-gray-100 shadow-lg">
        <div class="max-w-md mx-auto flex items-center justify-around h-16 px-2">

            <!-- 1. Beranda -->
            <a href="{{ route('home') }}" wire:navigate @click="setTab('home')"
                :class="activeTab === 'home' ? 'text-blue-600 font-semibold' : 'text-gray-400 hover:text-gray-600 font-medium'"
                class="flex flex-col items-center justify-center flex-1 h-full space-y-1 transition-colors duration-150">
                <x-icons.icons-home class="w-5 h-5 shrink-0" />
                <span class="text-[10px] tracking-tight">Beranda</span>
            </a>

            <!-- 2. Kalkulator KPR -->
            <a href="{{ route('mortgage.calculator') }}" wire:navigate @click="setTab('kpr')"
                :class="activeTab === 'kpr' ? 'text-blue-600 font-semibold' : 'text-gray-400 hover:text-gray-600 font-medium'"
                class="flex flex-col items-center justify-center flex-1 h-full space-y-1 transition-colors duration-150">
                <x-icons.icons-calculator class="w-5 h-5 shrink-0" />
                <span class="text-[10px] tracking-tight">KPR</span>
            </a>

            <!-- 3. Floating CTA (+ Pasang Iklan) -->
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

            <!-- 5. Universal Menu Trigger -->
            <button type="button" @click="openMenu = true; setTab('menu')"
                :class="activeTab === 'menu' ? 'text-blue-600 font-semibold' : 'text-gray-400 hover:text-gray-600 font-medium'"
                class="flex flex-col items-center justify-center flex-1 h-full space-y-1 transition-colors duration-150 focus:outline-none">
                <x-icons.icons-menus class="w-5 h-5 shrink-0" />
                <span class="text-[10px] tracking-tight">Menu</span>
            </button>

        </div>
    </div>

    <!-- Partial Sub-component: Bottom Sheet Menu Modal -->
    <x-layouts.navigation-menu-sheet />
</div>
