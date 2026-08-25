{{-- resources/views/components/layouts/navigation.blade.php --}}
<div x-data="{ openMenu: false }">
    <nav class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white/90 backdrop-blur-md border-t border-gray-100 z-40">
        <div class="grid grid-cols-5 h-16 items-center">

            <!-- 1. Home -->
            <a href="{{ route('home') }}" wire:navigate
                class="flex flex-col items-center justify-center h-full space-y-1 {{ request()->routeIs('home') ? 'text-indigo-600 font-semibold' : 'text-gray-400 hover:text-gray-600' }}">
                <x-icons.icons-home />
                <span class="text-[10px]">Beranda</span>
            </a>

            <!-- 2. Search / Explore -->
            <a href="#" wire:navigate
                class="flex flex-col items-center justify-center h-full space-y-1 text-gray-400 hover:text-gray-600">
                <x-icons.icons-search />
                <span class="text-[10px]">Cari</span>
            </a>

            <!-- 3. Floating CTA Center Button (Pasang Iklan) -->
            <div class="flex items-center justify-center h-full">
                <a href="{{ auth()->check() ? route('estates.create') : route('login') }}" wire:navigate
                    class="p-3 bg-indigo-600 text-white rounded-full shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition transform active:scale-95 -mt-5">
                    <x-icons.icons-adds />
                </a>
            </div>

            <!-- 4. Listing Saya (Auth Only / Placeholder Guest) -->
            @auth
                <a href="{{ route('dashboard') }}" wire:navigate
                    class="flex flex-col items-center justify-center h-full space-y-1 {{ request()->routeIs('dashboard*') ? 'text-indigo-600 font-semibold' : 'text-gray-400 hover:text-gray-600' }}">
                    <x-icons.icons-listings />
                    <span class="text-[10px]">Listing Saya</span>
                </a>
            @else
                <a href="{{ route('login') }}" wire:navigate
                    class="flex flex-col items-center justify-center h-full space-y-1 text-gray-400 hover:text-gray-600 opacity-60">
                    <x-icons.icons-listings />
                    <span class="text-[10px]">Listing Saya</span>
                </a>
            @endauth

            <!-- 5. Menu Lain (Auth) / Masuk (Guest) -->
            @auth
                <button type="button" @click="openMenu = true"
                    class="flex flex-col items-center justify-center h-full space-y-1 text-gray-400 hover:text-gray-600 focus:outline-none">
                    <x-icons.icons-menus />
                    <span class="text-[10px]">Menu Lain</span>
                </button>
            @else
                <a href="{{ route('login') }}" wire:navigate
                    class="flex flex-col items-center justify-center h-full space-y-1 text-gray-400 hover:text-gray-600">
                    <x-icons.icons-login />
                    <span class="text-[10px]">Masuk</span>
                </a>
            @endauth

        </div>
    </nav>

    <!-- Bottom Sheet Modal (Auth Only) -->
    @auth
        <div x-show="openMenu" x-cloak class="fixed inset-0 z-50 flex items-end justify-center">

            <!-- Backdrop -->
            <div x-show="openMenu"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="openMenu = false"
                 class="fixed inset-0 bg-black/40 backdrop-blur-sm"></div>

            <!-- Panel Content -->
            <div x-show="openMenu"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="translate-y-full"
                 x-transition:enter-end="translate-y-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="translate-y-0"
                 x-transition:leave-end="translate-y-full"
                 class="w-full max-w-md bg-white rounded-t-2xl shadow-2xl z-10 p-5 pb-8 space-y-4">

                <div class="flex justify-center">
                    <div class="w-12 h-1.5 bg-gray-200 rounded-full"></div>
                </div>

                <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-800">Menu Pengguna</h3>
                    <button @click="openMenu = false" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="space-y-1">
                    <a href="{{ route('dashboard') }}" wire:navigate @click="openMenu = false"
                       class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition">
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('profile') }}" wire:navigate @click="openMenu = false"
                       class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition">
                        <span class="text-sm font-medium">Ubah Profil</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-gray-100">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 p-3 text-red-600 hover:bg-red-50 rounded-xl transition text-left">
                            <span class="text-sm font-medium">Keluar Akun</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endauth
</div>
