{{-- resources/views/components/layouts/navigation.blade.php --}}
<div x-data="{
    openMenu: false,
    activeTab: '{{ request()->routeIs('home') ? 'home' : (request()->routeIs('search*') ? 'search' : (request()->routeIs('listings*') ? 'listings' : (request()->routeIs('dashboard*') || request()->routeIs('profile*') || request()->routeIs('login') ? 'menu' : ''))) }}',
    indicatorStyle: { left: '0px', width: '0px' },
    init() {
        this.updateIndicator();
        // Recalculate saat Livewire selesasi navigasi
        document.addEventListener('livewire:navigated', () => {
            this.updateActiveTabFromRoute();
            this.updateIndicator();
        });
    },
    updateIndicator() {
        this.$nextTick(() => {
            setTimeout(() => {
                const activeEl = this.$refs[this.activeTab];
                if (activeEl) {
                    this.indicatorStyle = {
                        left: activeEl.offsetLeft + 'px',
                        width: activeEl.offsetWidth + 'px'
                    };
                }
            }, 50);
        });
    },
    updateActiveTabFromRoute() {
        const path = window.location.pathname;
        if (path === '/' || path.includes('home')) this.activeTab = 'home';
        else if (path.includes('search')) this.activeTab = 'search';
        else if (path.includes('listings')) this.activeTab = 'listings';
        else if (path.includes('dashboard') || path.includes('profile') || path.includes('login')) this.activeTab = 'menu';
    }
}"
@resize.window.debounce.100ms="updateIndicator()">

    <!-- Floating Bottom Navigation -->
    <div class="fixed bottom-5 left-1/2 -translate-x-1/2 z-40 w-full max-w-md px-4">
        <nav class="relative flex items-center justify-between bg-white/80 backdrop-blur-xl border border-gray-100 shadow-xl rounded-full p-1.5">

            <!-- Sliding Active Indicator Background -->
            <div x-show="activeTab !== '' && indicatorStyle.width !== '0px'"
                 class="absolute top-1.5 bottom-1.5 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full shadow-md shadow-purple-200 transition-all duration-300 ease-out pointer-events-none"
                 :style="`left: ${indicatorStyle.left}; width: ${indicatorStyle.width};`"
                 x-cloak>
            </div>

            <!-- 1. Home -->
            <a href="{{ route('home') }}" wire:navigate
               x-ref="home"
               @click="activeTab = 'home'; updateIndicator()"
               class="relative z-10 flex items-center space-x-2 px-3.5 py-2 rounded-full transition-colors duration-200 {{ request()->routeIs('home') ? 'text-white font-medium' : 'text-gray-500 hover:text-purple-600' }}">
                <x-icons.icons-home class="w-5 h-5 shrink-0" />
                @if(request()->routeIs('home'))
                    <span class="text-xs font-semibold whitespace-nowrap">Beranda</span>
                @endif
            </a>

            <!-- 2. Search / Explore -->
            <a href="#" wire:navigate
               x-ref="search"
               @click="activeTab = 'search'; updateIndicator()"
               class="relative z-10 flex items-center space-x-2 px-3.5 py-2 rounded-full transition-colors duration-200 {{ request()->routeIs('search*') ? 'text-white font-medium' : 'text-gray-500 hover:text-purple-600' }}">
                <x-icons.icons-search class="w-5 h-5 shrink-0" />
                @if(request()->routeIs('search*'))
                    <span class="text-xs font-semibold whitespace-nowrap">Cari</span>
                @endif
            </a>

            <!-- 3. Floating CTA Button (Pasang Iklan) -->
            <a href="{{ auth()->check() ? route('estates.create') : route('login') }}" wire:navigate
               class="relative z-10 flex items-center justify-center p-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-full shadow-lg shadow-purple-200 hover:opacity-90 active:scale-95 transition-all shrink-0">
                <x-icons.icons-adds class="w-5 h-5" />
            </a>

            <!-- 4. Listing Saya -->
            @auth
                <a href="{{ route('listings.index') }}" wire:navigate
                   x-ref="listings"
                   @click="activeTab = 'listings'; updateIndicator()"
                   class="relative z-10 flex items-center space-x-2 px-3.5 py-2 rounded-full transition-colors duration-200 {{ request()->routeIs('listings*') ? 'text-white font-medium' : 'text-gray-500 hover:text-purple-600' }}">
                    <x-icons.icons-listings class="w-5 h-5 shrink-0" />
                    @if(request()->routeIs('listings*'))
                        <span class="text-xs font-semibold whitespace-nowrap">Listing</span>
                    @endif
                </a>
            @else
                <a href="{{ route('login') }}" wire:navigate
                   class="relative z-10 flex items-center space-x-2 px-3.5 py-2 rounded-full transition-colors duration-200 text-gray-400 opacity-60 hover:opacity-100">
                    <x-icons.icons-listings class="w-5 h-5 shrink-0" />
                </a>
            @endauth

            <!-- 5. Menu Lain / Masuk -->
            @auth
                <button type="button"
                        x-ref="menu"
                        @click="openMenu = true"
                        class="relative z-10 flex items-center space-x-2 px-3.5 py-2 rounded-full transition-colors duration-200 {{ request()->routeIs('dashboard*') || request()->routeIs('profile*') ? 'text-white font-medium' : 'text-gray-500 hover:text-purple-600' }} focus:outline-none">
                    <x-icons.icons-menus class="w-5 h-5 shrink-0" />
                    @if(request()->routeIs('dashboard*') || request()->routeIs('profile*'))
                        <span class="text-xs font-semibold whitespace-nowrap">Menu</span>
                    @endif
                </button>
            @else
                <a href="{{ route('login') }}" wire:navigate
                   x-ref="menu"
                   @click="activeTab = 'menu'; updateIndicator()"
                   class="relative z-10 flex items-center space-x-2 px-3.5 py-2 rounded-full transition-colors duration-200 {{ request()->routeIs('login') ? 'text-white font-medium' : 'text-gray-500 hover:text-purple-600' }}">
                    <x-icons.icons-login class="w-5 h-5 shrink-0" />
                    @if(request()->routeIs('login'))
                        <span class="text-xs font-semibold whitespace-nowrap">Masuk</span>
                    @endif
                </a>
            @endauth

        </nav>
    </div>

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
                       class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-xl transition">
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('profile') }}" wire:navigate @click="openMenu = false"
                       class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-xl transition">
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
