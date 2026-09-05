{{--
|--------------------------------------------------------------------------
| Top Navigation Bar Component (Home View)
|--------------------------------------------------------------------------
| @path : resources/views/components/layouts/home/top-nav.blade.php
| @usage : Global top navbar header for home page across all user roles
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@props(['transaction_type', 'city' => ''])

<div class="sticky top-0 z-30 bg-white/95 backdrop-blur-md px-4 pt-4 pb-3 border-b border-gray-100 shadow-sm space-y-3">
    {{-- Header Title --}}
    <div class="flex items-center justify-start">
        <div class="flex items-center gap-2">
            <div class="flex items-center justify-center text-blue-600">
                <x-icons.header-logo class="w-7 h-7" />
            </div>
            <h1 class="text-lg tracking-tight leading-none">
                <span class="font-bold text-gray-900">Download</span><span
                    class="font-bold text-blue-600 ml-0.5">Rumah</span>
            </h1>
        </div>
    </div>

    {{-- Search Input Bar + Filter Trigger Button --}}
    <div class="flex items-center gap-2">
        <div class="relative flex-1">
            <input wire:model.live.debounce.300ms="search"  type="text" placeholder="Cari lokasi, nama properti..."
                class="w-full pl-9 pr-4 py-2 bg-gray-100 text-xs rounded-xl border-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-800 placeholder-gray-400 focus:bg-white" />
            <svg class="w-4 h-4 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        {{-- Tombol Buka Modal Filter Lengkap --}}
        <button @click="$dispatch('open-search-modal')"
            class="p-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl transition shrink-0 active:scale-95"
            title="Filter Lengkap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 010 4m-6 8a2 2 0 100-4m0 4a2 2 0 010-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 010-4m0 4v2m0-6V4" />
            </svg>
        </button>
    </div>

    {{-- Quick Chips & Select Kota --}}
    <div class="flex items-center justify-between gap-2">
        <div class="flex items-center space-x-1.5 overflow-x-auto no-scrollbar">
            <button wire:click="$set('transaction_type', '')"
                class="px-3 py-1 text-[11px] font-medium rounded-full whitespace-nowrap transition-all {{ $transaction_type === '' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semua
            </button>
            <button wire:click="$set('transaction_type', 'sale')"
                class="px-3 py-1 text-[11px] font-medium rounded-full whitespace-nowrap transition-all {{ $transaction_type === 'sale' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Dijual
            </button>
            <button wire:click="$set('transaction_type', 'rent')"
                class="px-3 py-1 text-[11px] font-medium rounded-full whitespace-nowrap transition-all {{ $transaction_type === 'rent' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Disewa
            </button>
        </div>

        <select wire:model.live="city"
            class="px-2 py-1 text-[11px] font-medium rounded-lg bg-gray-100 text-gray-600 border-none focus:ring-1 focus:ring-blue-500">
            <option value="">Semua Kota</option>
            <option value="Jakarta Selatan">Jakarta Selatan</option>
            <option value="Surabaya">Surabaya</option>
            <option value="Bandung">Bandung</option>
            <option value="Tangerang Selatan">Tangerang Selatan</option>
            <option value="Bekasi">Bekasi</option>
        </select>
    </div>

</div>
