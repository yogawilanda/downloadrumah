{{-- resources/views/components/layouts/navigation.blade.php --}}
{{-- icons assets: resources/views/components/icons/.. --}}
<nav class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white/90 backdrop-blur-md border-t border-gray-100 z-50">
    <div class="flex items-center justify-around h-16 px-2">

        <!-- Home -->
        <a href="{{ route('home') }}" wire:navigate
            class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('home') ? 'text-indigo-600 font-semibold' : 'text-gray-400 hover:text-gray-600' }}">
            <x-icons.icons-home />
            <span class="text-[10px]">Beranda</span>
        </a>

        <!-- Search / Explore (Opsional) -->
        <a href="#" wire:navigate
            class="flex flex-col items-center justify-center w-full h-full space-y-1 text-gray-400 hover:text-gray-600">
            <x-icons.icons-search />
            <span class="text-[10px]">Cari</span>
        </a>

        <!-- Floating CTA Center Button (Pasang Iklan) -->
        <div class="flex items-center justify-center w-full h-full">
            @auth
                <a href="{{ route('estates.create') }}" wire:navigate
                    class="p-3 bg-indigo-600 text-white rounded-full shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition transform active:scale-95 -mt-5">
                    <x-icons.icons-adds />
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="p-3 bg-indigo-600 text-white rounded-full shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition transform active:scale-95 -mt-5">
                    <x-icons.icons-login />
                </a>
            @endauth
        </div>

        <!-- Auth User Listings -->
        <a href="{{ route('dashboard') }}" wire:navigate
            class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('dashboard*') ? 'text-indigo-600 font-semibold' : 'text-gray-400 hover:text-gray-600' }}">
            <x-icons.icons-listings />
            <span class="text-[10px]">Listing Saya</span>
        </a>

        <!-- Account / Dashboard -->
        @auth
            <a href="{{ route('dashboard') }}" wire:navigate
                class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('dashboard*') ? 'text-indigo-600 font-semibold' : 'text-gray-400 hover:text-gray-600' }}">
                <x-icons.icons-menus />
                <span class="text-[10px]">Menu Lain</span>
            </a>
        @else
            <a href="{{ route('login') }}"
                class="flex flex-col items-center justify-center w-full h-full space-y-1 text-gray-400 hover:text-gray-600">
                <x-icons.icons-login/>
                <span class="text-[10px]">Masuk</span>
            </a>
        @endauth
    </div>
</nav>
