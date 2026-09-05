{{--
loc: resources/views/components/layouts/home/home-feed-filter-modal.blade.php
usage: Filter modal component for HomeFeed page
--}}
@props(['transaction_type', 'provinces' => [], 'cities' => [], 'districts' => []])

<div x-show="openSearchModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <!-- Backdrop Blur -->
    <div x-show="openSearchModal" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="openSearchModal = false"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- Modal Box -->
    <div x-show="openSearchModal" x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150 transform" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="w-full max-w-sm bg-white rounded-2xl shadow-2xl z-10 p-5 space-y-4 relative border border-gray-100 max-h-[90vh] overflow-y-auto">

        <!-- Header Modal -->
        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 010 4m-6 8a2 2 0 100-4m0 4a2 2 0 010-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 010-4m0 4v2m0-6V4" />
                </svg>
                <h3 class="text-sm font-bold text-gray-800">Filter Pencarian</h3>
            </div>
            <button @click="openSearchModal = false"
                class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-100 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Body Form Filter -->
        <div class="space-y-3.5">
            <!-- Input Kata Kunci -->
            <div>
                <label class="block text-[11px] font-semibold text-gray-600 mb-1">Cari Kata Kunci / Judul</label>
                <input wire:model.live.debounce.300ms="search" type="text"
                    placeholder="Contoh: Rumah Minimalis, Villa..."
                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 text-xs rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white text-gray-800 placeholder-gray-400 transition" />
            </div>

            <!-- Filter Kota (Code Char 4) -->
            @if(count($cities) > 0)
                <div>
                    <label class="block text-[11px] font-semibold text-gray-600 mb-1">Pilih Kota / Kabupaten</label>
                    <select wire:model.live="city_id"
                        class="w-full px-3 py-2 bg-gray-50 border border-gray-200 text-xs rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white text-gray-800 transition">
                        <option value="">Semua Kota</option>
                        @foreach ($cities as $c)
                            <option value="{{ $c->code }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Filter Kecamatan (Code Char 7) -->
            @if(count($districts) > 0)
                <div>
                    <label class="block text-[11px] font-semibold text-gray-600 mb-1">Pilih Kecamatan</label>
                    <select wire:model.live="district_id"
                        class="w-full px-3 py-2 bg-gray-50 border border-gray-200 text-xs rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white text-gray-800 transition">
                        <option value="">Semua Kecamatan</option>
                        @foreach ($districts as $d)
                            <option value="{{ $d->code }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Input Maksimal Harga -->
            <div>
                <label class="block text-[11px] font-semibold text-gray-600 mb-1">Batas Maksimal Harga (Rp)</label>
                <input wire:model.live.debounce.500ms="max_price" type="number" placeholder="Contoh: 500000000"
                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 text-xs rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white text-gray-800 placeholder-gray-400 transition" />
            </div>

            <!-- Tipe Transaksi -->
            <div>
                <label class="block text-[11px] font-semibold text-gray-600 mb-1">Tipe Transaksi</label>
                <div class="grid grid-cols-3 gap-1.5">
                    <button type="button" wire:click="$set('transaction_type', '')"
                        class="py-1.5 text-xs font-medium rounded-lg border transition {{ $transaction_type === '' ? 'bg-blue-50 border-blue-600 text-blue-600 font-bold' : 'border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                        Semua
                    </button>
                    <button type="button" wire:click="$set('transaction_type', 'sale')"
                        class="py-1.5 text-xs font-medium rounded-lg border transition {{ $transaction_type === 'sale' ? 'bg-blue-50 border-blue-600 text-blue-600 font-bold' : 'border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                        Dijual
                    </button>
                    <button type="button" wire:click="$set('transaction_type', 'rent')"
                        class="py-1.5 text-xs font-medium rounded-lg border transition {{ $transaction_type === 'rent' ? 'bg-blue-50 border-blue-600 text-blue-600 font-bold' : 'border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                        Disewa
                    </button>
                </div>
            </div>
        </div>

        <!-- Action Footer -->
        <div class="pt-2 flex items-center gap-2">
            <button type="button" wire:click="resetFilter" @click="openSearchModal = false"
                class="flex-1 py-2 bg-gray-100 text-gray-600 text-xs font-semibold rounded-xl hover:bg-gray-200 transition">
                Reset
            </button>
            <button type="button" @click="openSearchModal = false"
                class="flex-1 py-2 bg-blue-600 text-white text-xs font-semibold rounded-xl shadow-md hover:bg-blue-700 transition active:scale-95">
                Terapkan
            </button>
        </div>
    </div>
</div>
