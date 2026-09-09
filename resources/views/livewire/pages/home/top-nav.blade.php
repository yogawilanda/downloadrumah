{{--
|--------------------------------------------------------------------------
| Top Navigation Bar Component (Home View)
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/home/top-nav.blade.php
| @usage : Responsive top navbar header across all breakpoints
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

{{-- Wrapper max-width & padding disesuaikan ramping untuk tablet (md:max-w-2xl lg:max-w-6xl) --}}
<div class="w-full max-w-md md:max-w-2xl lg:max-w-6xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8 py-2 space-y-2"
    x-data="{ searchOpen: false }">

    {{-- BARIS 1: Logo & Notifikasi / CTA --}}
    <div class="flex items-center justify-between gap-3 h-9">

        {{-- Logo & Brand --}}
        <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-1.5 shrink-0 py-1">
            <div class="flex items-center justify-center text-blue-600">
                <x-icons.header-logo class="w-5 h-5" />
            </div>
            <h1 class="text-base tracking-tight leading-none">
                <span class="font-bold text-gray-900">Download</span><span class="font-bold text-blue-600">Rumah</span>
            </h1>
        </a>

        {{-- Aksi Kanan --}}
        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ auth()->check() ? route('estates.create') : route('login') }}" wire:navigate
                class="hidden md:flex px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-md shadow-sm transition active:scale-95 items-center gap-1.5">
                <x-icons.icons-adds class="w-3.5 h-3.5 fill-current" />
                <span>Pasang Iklan</span>
            </a>

            <button type="button"
                class="p-2 bg-gray-100 hover:bg-gray-200 text-slate-600 rounded-md transition flex items-center justify-center relative active:scale-95"
                title="Notifikasi">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full ring-2 ring-white"></span>
            </button>
        </div>

    </div>

    {{-- BARIS 2: MOBILE ONLY (< 768px) - Search Bar & Dropdown Suggestions --}}
    <div class="flex md:hidden items-center gap-2 pt-0.5">
        <div class="relative flex-1" @click.outside="searchOpen = false">
            <form wire:submit.prevent="submitSearch">
                <input wire:model.live.debounce.300ms="search" @focus="searchOpen = true" type="text"
                    placeholder="Cari lokasi, nama properti..."
                    class="w-full pl-8 pr-7 py-1.5 bg-gray-100 text-xs rounded-md border-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-800 placeholder-gray-400 focus:bg-white" />
            </form>
            <svg class="w-3.5 h-3.5 absolute left-2.5 top-2.5 text-gray-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>

            {{-- Panggil komponen terpusat yang sudah menghandle skeleton & state di dalamnya --}}
            <x-layouts.home.search-suggestions :suggestions="$suggestions" :popularCities="$popularCities" :search="$search" />
        </div>

        <button @click="$dispatch('open-search-modal')"
            class="p-1.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-md transition shrink-0 active:scale-95"
            title="Filter Lengkap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 010 4m-6 8a2 2 0 100-4m0 4a2 2 0 010-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 010-4m0 4v2m0-6V4" />
            </svg>
        </button>
    </div>

    {{-- BARIS 3: MOBILE ONLY (< 768px) - Quick Chips & Select City --}}
    <div class="flex md:hidden items-center justify-between gap-2 pt-0.5">
        <div class="flex items-center space-x-1.5 overflow-x-auto no-scrollbar">
            @foreach (['' => 'Semua', 'sale' => 'Dijual', 'rent' => 'Disewa'] as $key => $label)
                <button wire:click="$set('transaction_type', '{{ $key }}')"
                    class="px-2.5 py-1 text-[11px] font-medium rounded-full whitespace-nowrap transition-all {{ $transaction_type === $key ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <select wire:model.live="city_id"
            class="px-2 py-1 text-[11px] font-medium rounded-md bg-gray-100 text-gray-600 border-none focus:ring-1 focus:ring-blue-500 max-w-[120px] truncate">
            <option value="">Semua Kota</option>
            @foreach ($cities as $c)
                <option value="{{ $c->code }}">{{ $c->name }}</option>
            @endforeach
        </select>
    </div>

</div>
