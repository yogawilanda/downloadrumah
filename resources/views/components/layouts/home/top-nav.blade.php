{{--
loc: resources\views\components\layouts\home\top-nav.blade.php
usage: specific usage top navbar for home view, for all user in the actor use case/PRD
--}}

@props(['transaction_type'])

<div class="sticky top-0 z-30 bg-white/95 backdrop-blur-md px-4 pt-4 pb-3 border-b border-gray-100 shadow-sm space-y-3">
    {{-- Header Title --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="p-1.5 bg-blue-600 rounded-lg text-white shadow-sm shadow-blue-500/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            <div>
                <h1 class="text-base font-bold text-gray-900 leading-none">Download Rumah</h1>
                <p class="text-[10px] text-gray-500 font-medium tracking-wide uppercase mt-0.5">Temukan Properti Impian</p>
            </div>
        </div>
    </div>

    {{-- Search Input Bar --}}
    <div class="relative">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari lokasi, nama properti..."
            class="w-full pl-9 pr-4 py-2 bg-gray-100 text-xs rounded-xl border-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-800 placeholder-gray-400 focus:bg-white" />
        <svg class="w-4 h-4 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>

    {{-- Filter Quick Chips & Select --}}
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
