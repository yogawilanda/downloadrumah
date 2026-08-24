<div class="max-w-md mx-auto min-h-screen bg-gray-50 pb-20">
    <!-- Header & Sticky Search Bar -->
    <div class="sticky top-0 z-30 bg-white/95 backdrop-blur-md px-4 pt-4 pb-3 border-b border-gray-100 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <div>
                <h1 class="text-xl font-bold text-gray-900 tracking-tight">DownloadRumah</h1>
                <p class="text-xs text-gray-500">Temukan hunian impianmu</p>
            </div>
            @auth
                <a href="{{ route('dashboard') }}"
                    class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-full">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                    class="text-xs font-semibold text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">Masuk</a>
            @endauth
        </div>

        <!-- Input Search -->
        <div class="relative mb-2.5">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari lokasi, nama properti..."
                class="w-full pl-9 pr-4 py-2 bg-gray-100 text-sm rounded-xl border-none focus:ring-2 focus:ring-indigo-500 transition-all text-gray-800 placeholder-gray-400" />
            <svg class="w-4 h-4 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        <!-- Horizontal Scroll Filter Caps -->
        <div class="flex items-center space-x-2 overflow-x-auto no-scrollbar py-1">
            <!-- Filter Tipe Transaksi -->
            <button wire:click="$set('transaction_type', '')"
                class="px-3 py-1.5 text-xs font-medium rounded-full whitespace-nowrap transition-all {{ $transaction_type === '' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600' }}">
                Semua
            </button>
            <button wire:click="$set('transaction_type', 'sale')"
                class="px-3 py-1.5 text-xs font-medium rounded-full whitespace-nowrap transition-all {{ $transaction_type === 'sale' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600' }}">
                Dijual
            </button>
            <button wire:click="$set('transaction_type', 'rent')"
                class="px-3 py-1.5 text-xs font-medium rounded-full whitespace-nowrap transition-all {{ $transaction_type === 'rent' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600' }}">
                Disewa
            </button>

            <!-- Dropdown Kota -->
            <select wire:model.live="city"
                class="px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-600 border-none focus:ring-0">
                <option value="">Semua Kota</option>
                <option value="Jakarta Selatan">Jakarta Selatan</option>
                <option value="Surabaya">Surabaya</option>
                <option value="Bandung">Bandung</option>
                <option value="Tangerang Selatan">Tangerang Selatan</option>
                <option value="Bekasi">Bekasi</option>
            </select>
        </div>
    </div>

    <!-- Feed Property Cards -->
    <div class="px-4 pt-4 space-y-4">
        @forelse ($estates as $estate)
            <a href="{{ route('estate.show', $estate->slug) }}" wire:navigate
                class="block bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                <div
                    class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                    <!-- Image Container with Badges -->
                    <div class="relative h-48 w-full bg-gray-200">
                        <img src="{{ $estate->primaryImage?->url ?? 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=800&q=80' }}"
                            alt="{{ $estate->title }}" class="w-full h-full object-cover" />

                        <!-- Transaction Badge -->
                        <span
                            class="absolute top-3 left-3 px-2.5 py-1 text-[10px] font-bold tracking-wide uppercase rounded-lg text-white backdrop-blur-md {{ $estate->transaction_type === 'sale' ? 'bg-emerald-600/90' : 'bg-amber-600/90' }}">
                            {{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}
                        </span>

                        <!-- Short Price Tag -->
                        <div
                            class="absolute bottom-3 right-3 bg-gray-900/80 backdrop-blur-md text-white px-3 py-1 rounded-xl text-sm font-bold">
                            {{ $estate->short_price }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h2 class="font-bold text-gray-900 text-base line-clamp-1 mb-1">{{ $estate->title }}</h2>

                        <p class="text-xs text-gray-500 flex items-center mb-3">
                            <svg class="w-3.5 h-3.5 mr-1 text-gray-400 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $estate->city }}{{ $estate->district ? ', ' . $estate->district : '' }}
                        </p>

                        <!-- Specs Strip -->
                        <div class="flex items-center space-x-4 pt-3 border-t border-gray-100 text-xs text-gray-600">
                            @if($estate->bedroom)
                                <div class="flex items-center space-x-1">
                                    <span class="font-bold text-gray-800">{{ $estate->bedroom }}</span>
                                    <span class="text-gray-400">KT</span>
                                </div>
                            @endif
                            @if($estate->bathroom)
                                <div class="flex items-center space-x-1">
                                    <span class="font-bold text-gray-800">{{ $estate->bathroom }}</span>
                                    <span class="text-gray-400">KM</span>
                                </div>
                            @endif
                            @if($estate->building_size)
                                <div class="flex items-center space-x-1">
                                    <span class="font-bold text-gray-800">{{ $estate->building_size }}</span>
                                    <span class="text-gray-400">m² (LB)</span>
                                </div>
                            @endif
                            @if($estate->land_size)
                                <div class="flex items-center space-x-1">
                                    <span class="font-bold text-gray-800">{{ $estate->land_size }}</span>
                                    <span class="text-gray-400">m² (LT)</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center py-12 bg-white rounded-2xl border border-gray-100">
                <p class="text-sm font-medium text-gray-500">Properti tidak ditemukan.</p>
                <p class="text-xs text-gray-400 mt-1">Coba ubah kata kunci atau filter pencarianmu.</p>
            </div>
        @endforelse

        <!-- Pagination -->
        <div class="pt-2">
            {{ $estates->links() }}
        </div>
    </div>
</div>
