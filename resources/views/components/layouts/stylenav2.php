{{-- resources/views/components/layouts/navigation.blade.php --}}
<div x-data="{
    openMenu: false,
    activeTab: '{{ request()->routeIs('home') ? 'home' : (request()->routeIs('search*') ? 'search' : (request()->routeIs('listings*') ? 'listings' : (request()->routeIs('dashboard*') || request()->routeIs('profile*') || request()->routeIs('login') ? 'menu' : ''))) }}',
    indicatorStyle: { left: '0px', width: '0px' },
    init() {
        this.updateIndicator();
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
        <nav class="relative flex items-center justify-between bg-white/85 backdrop-blur-2xl border border-purple-100/80 shadow-2xl shadow-purple-900/10 rounded-full p-1.5">

            <!-- DownloadRumah Tech-Glow Sliding Indicator -->
            <div x-show="activeTab !== '' && indicatorStyle.width !== '0px'"
                 class="absolute top-1.5 bottom-1.5 bg-gradient-to-r from-purple-600 via-indigo-600 to-violet-600 rounded-full shadow-lg shadow-purple-500/30 transition-all duration-300 cubic-bezier(0.34, 1.56, 0.64, 1) pointer-events-none"
                 :style="`left: ${indicatorStyle.left}; width: ${indicatorStyle.width};`"
                 x-cloak>
                 <!-- Subtle top light accent for tech feel -->
                 <div class="absolute inset-x-2 top-0.5 h-[1px] bg-white/40 rounded-full"></div>
            </div>

            <!-- 1. Home -->
            <a href="{{ route('home') }}" wire:navigate
               x-ref="home"
               @click="activeTab = 'home'; updateIndicator()"
               class="relative z-10 flex items-center space-x-2 px-3.5 py-2 rounded-full transition-colors duration-200 {{ request()->routeIs('home') ? 'text-white font-medium' : 'text-gray-400 hover:text-purple-600' }}">
                <x-icons.icons-home class="w-5 h-5 shrink-0" />
                @if(request()->routeIs('home'))
                    <span class="text-xs font-semibold whitespace-nowrap tracking-wide">Beranda</span>
                @endif
            </a>

            <!-- 2. Search / Explore -->
            <a href="#" wire:navigate
               x-ref="search"
               @click="activeTab = 'search'; updateIndicator()"
               class="relative z-10 flex items-center space-x-2 px-3.5 py-2 rounded-full transition-colors duration-200 {{ request()->routeIs('search*') ? 'text-white font-medium' : 'text-gray-400 hover:text-purple-600' }}">
                <x-icons.icons-search class="w-5 h-5 shrink-0" />
                @if(request()->routeIs('search*'))
                    <span class="text-xs font-semibold whitespace-nowrap tracking-wide">Cari</span>
                @endif
            </a>

            <!-- 3. Floating CTA Button (Upload / Pasang Iklan - Brand Hero) -->
            <div class="relative z-20 -my-3">
                <!-- Decorative Outer Glow -->
                <div class="absolute inset-0 bg-purple-600/30 rounded-full blur-md animate-pulse"></div>

                <a href="{{ auth()->check() ? route('estates.create') : route('login') }}" wire:navigate
                   class="relative flex items-center justify-center p-3.5 bg-gradient-to-tr from-purple-600 via-indigo-600 to-violet-500 text-white rounded-full shadow-xl shadow-purple-500/40 hover:scale-110 active:scale-95 transition-all duration-200 border-2 border-white ring-2 ring-purple-100 shrink-0">
                    <x-icons.icons-adds class="w-5 h-5" />
                </a>
            </div>

            <!-- 4. Listing Saya -->
            @auth
                <a href="{{ route('listings.index') }}" wire:navigate
                   x-ref="listings"
                   @click="activeTab = 'listings'; updateIndicator()"
                   class="relative z-10 flex items-center space-x-2 px-3.5 py-2 rounded-full transition-colors duration-200 {{ request()->routeIs('listings*') ? 'text-white font-medium' : 'text-gray-400 hover:text-purple-600' }}">
                    <x-icons.icons-listings class="w-5 h-5 shrink-0" />
                    @if(request()->routeIs('listings*'))
                        <span class="text-xs font-semibold whitespace-nowrap tracking-wide">Listing</span>
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
                        class="relative z-10 flex items-center space-x-2 px-3.5 py-2 rounded-full transition-colors duration-200 {{ request()->routeIs('dashboard*') || request()->routeIs('profile*') ? 'text-white font-medium' : 'text-gray-400 hover:text-purple-600' }} focus:outline-none">
                    <x-icons.icons-menus class="w-5 h-5 shrink-0" />
                    @if(request()->routeIs('dashboard*') || request()->routeIs('profile*'))
                        <span class="text-xs font-semibold whitespace-nowrap tracking-wide">Menu</span>
                    @endif
                </button>
            @else
                <a href="{{ route('login') }}" wire:navigate
                   x-ref="menu"
                   @click="activeTab = 'menu'; updateIndicator()"
                   class="relative z-10 flex items-center space-x-2 px-3.5 py-2 rounded-full transition-colors duration-200 {{ request()->routeIs('login') ? 'text-white font-medium' : 'text-gray-400 hover:text-purple-600' }}">
                    <x-icons.icons-login class="w-5 h-5 shrink-0" />
                    @if(request()->routeIs('login'))
                        <span class="text-xs font-semibold whitespace-nowrap tracking-wide">Masuk</span>
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
                 class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm"></div>

            <!-- Panel Content -->
            <div x-show="openMenu"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="translate-y-full"
                 x-transition:enter-end="translate-y-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="translate-y-0"
                 x-transition:leave-end="translate-y-full"
                 class="w-full max-w-md bg-white rounded-t-3xl shadow-2xl z-10 p-6 pb-8 space-y-4 border-t border-purple-100">

                <div class="flex justify-center">
                    <div class="w-10 h-1 bg-gray-200 rounded-full"></div>
                </div>

                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 rounded-full bg-purple-600"></div>
                        <h3 class="text-sm font-bold text-gray-800 tracking-tight">Akun DownloadRumah</h3>
                    </div>
                    <button @click="openMenu = false" class="text-gray-400 hover:text-gray-600 focus:outline-none p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="space-y-1.5 pt-1">
                    <a href="{{ route('dashboard') }}" wire:navigate @click="openMenu = false"
                       class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-2xl transition font-medium text-sm">
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('profile') }}" wire:navigate @click="openMenu = false"
                       class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-2xl transition font-medium text-sm">
                        <span>Ubah Profil</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-gray-100">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 p-3 text-red-500 hover:bg-red-50 rounded-2xl transition text-left font-medium text-sm">
                            <span>Keluar Akun</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endauth
</div>
