{{--
loc: resources\views\livewire\pages\home-feed.blade.php
usage: root of homepage content which globally available to accessed by all visitor including non authorized user.
--}}
<div class="max-w-md mx-auto min-h-screen pb-20" x-data="{ openSearchModal: false }" @open-search-modal.window="openSearchModal = true">
    <x-layouts.home.top-nav :transaction_type="$transaction_type" />

    <!-- Feed Property Cards -->
    <x-layouts.home.home-feed-listing :estates="$estates" />

    <!-- Pop-up Search & Filter Sheet -->
    <div x-show="openSearchModal" x-cloak class="fixed inset-0 z-50 flex items-end justify-center">
        <!-- Backdrop -->
        <div x-show="openSearchModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="openSearchModal = false"
             class="fixed inset-0 bg-black/40 backdrop-blur-sm"></div>

        <!-- Sheet Panel -->
        <div x-show="openSearchModal"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="w-full max-w-md bg-white rounded-t-2xl shadow-2xl z-10 p-5 pb-8 space-y-4">

            <!-- Drag Handle & Header -->
            <div class="flex flex-col items-center gap-2">
                <div class="w-12 h-1.5 bg-gray-200 rounded-full"></div>
                <div class="w-full flex items-center justify-between border-b border-gray-100 pb-2">
                    <h3 class="text-sm font-bold text-gray-800">Cari & Filter Properti</h3>
                    <button @click="openSearchModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Input Search -->
            <div class="relative">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari lokasi, nama properti..."
                    class="w-full pl-9 pr-4 py-2 bg-gray-100 text-sm rounded-xl border-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-800 placeholder-gray-400" />
                <svg class="w-4 h-4 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <!-- Filter Tipe Transaksi & Kota -->
            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-600">Tipe Transaksi</label>
                <div class="flex items-center space-x-2 overflow-x-auto no-scrollbar py-1">
                    <button wire:click="$set('transaction_type', '')"
                        class="px-3 py-1.5 text-xs font-medium rounded-full whitespace-nowrap transition-all {{ $transaction_type === '' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600' }}">
                        Semua
                    </button>
                    <button wire:click="$set('transaction_type', 'sale')"
                        class="px-3 py-1.5 text-xs font-medium rounded-full whitespace-nowrap transition-all {{ $transaction_type === 'sale' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600' }}">
                        Dijual
                    </button>
                    <button wire:click="$set('transaction_type', 'rent')"
                        class="px-3 py-1.5 text-xs font-medium rounded-full whitespace-nowrap transition-all {{ $transaction_type === 'rent' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600' }}">
                        Disewa
                    </button>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-600">Lokasi Kota</label>
                <select wire:model.live="city"
                    class="w-full px-3 py-2 text-xs font-medium rounded-xl bg-gray-100 text-gray-600 border-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kota</option>
                    <option value="Jakarta Selatan">Jakarta Selatan</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Tangerang Selatan">Tangerang Selatan</option>
                    <option value="Bekasi">Bekasi</option>
                </select>
            </div>

            <!-- Apply Button -->
            <button @click="openSearchModal = false" class="w-full py-2.5 bg-blue-600 text-white text-xs font-semibold rounded-xl shadow-md hover:bg-blue-700 transition">
                Tampilkan Hasil
            </button>
        </div>
    </div>
</div>
