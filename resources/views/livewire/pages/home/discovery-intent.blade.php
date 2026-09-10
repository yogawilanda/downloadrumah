{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path   : resources/views/livewire/pages/home/discovery-intent.blade.php
| @usage  : Shared search controller view with embedded suggestion component
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}
<div x-data="{ searchOpen: false }" @click.outside="searchOpen = false" class="relative">

    @if ($variant === 'compact')
        {{-- 1. TAMPILAN COMPACT / PIPIH (Khusus /listings) --}}
        <form wire:submit.prevent="submitSearch" class="bg-white p-2 sm:p-2.5 rounded-md border border-gray-200 shadow-sm flex flex-col md:flex-row items-center gap-2 relative">
            <div class="relative w-full md:flex-1">
                <input type="text"
                    wire:model.live.debounce.300ms="search"
                    @focus="searchOpen = true"
                    placeholder="Cari lokasi, nama properti..."
                    class="w-full pl-3 pr-3 py-2 text-xs sm:text-sm border-0 focus:ring-0 text-gray-800 placeholder-gray-400 focus:outline-none">

                {{-- Reusable Search Suggestions Component --}}
                <x-layouts.home.search-suggestions
                    :suggestions="$suggestions"
                    :search="$search"
                    :popularCities="$popularCities" />
            </div>

            <div class="h-4 w-px bg-gray-200 hidden md:block"></div>

            <select wire:model.live="city_id" class="w-full md:w-auto text-xs sm:text-sm border-0 bg-transparent text-gray-700 focus:ring-0 cursor-pointer">
                <option value="">Semua Kota</option>
                @foreach ($cities as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>

            <select wire:model.live="transaction_type" class="w-full md:w-auto text-xs sm:text-sm border-0 bg-transparent text-gray-700 focus:ring-0 cursor-pointer">
                <option value="">Status (Semua)</option>
                <option value="sale">Dijual</option>
                <option value="rent">Disewakan</option>
            </select>

            <button type="submit" class="w-full md:w-auto px-5 py-2 bg-blue-600 text-white font-semibold text-xs rounded-lg hover:bg-blue-700 transition">
                Cari
            </button>
        </form>

    @else
        {{-- 2. TAMPILAN HERO BANNER UTUH (Untuk Homefeed /) --}}
        <div class="relative bg-blue-600 rounded-2xl p-5 md:p-8 text-white shadow-md overflow-visible">
            <div class="relative z-10 space-y-4">
                <div>
                    <h1 class="text-xl md:text-2xl font-black tracking-tight">Cari aja dulu!</h1>
                    <p class="text-xs md:text-sm text-blue-100">Lihat-lihat dulu berdasarkan lokasi, kebutuhan, dan budget.</p>
                </div>

                <form wire:submit.prevent="submitSearch" class="bg-white p-2 rounded-md text-gray-800 shadow-lg grid grid-cols-1 md:grid-cols-12 gap-2 items-center relative">
                    <!-- Search Input & Autocomplete Suggestions -->
                    <div class="md:col-span-5 relative">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider px-2">Lokasi / Properti</label>
                        <input type="text"
                            wire:model.live.debounce.300ms="search"
                            @focus="searchOpen = true"
                            placeholder="Cari lokasi, nama properti..."
                            class="w-full px-2 py-1 text-xs font-semibold text-gray-800 border-0 focus:ring-0 focus:outline-none placeholder-gray-300">

                        {{-- Reusable Search Suggestions Component --}}
                        <x-layouts.home.search-suggestions
                            :suggestions="$suggestions"
                            :search="$search"
                            :popularCities="$popularCities" />
                    </div>

                    <!-- Dropdown Kota -->
                    <div class="md:col-span-3 border-t md:border-t-0 md:border-l border-gray-100 pt-2 md:pt-0 pl-0 md:pl-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider px-2">Kota</label>
                        <select wire:model.live="city_id" class="w-full px-1 py-1 text-xs font-semibold text-gray-800 border-0 focus:ring-0 bg-transparent cursor-pointer focus:outline-none">
                            <option value="">Semua Kota</option>
                            @foreach ($cities as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown Status -->
                    <div class="md:col-span-2 border-t md:border-t-0 md:border-l border-gray-100 pt-2 md:pt-0 pl-0 md:pl-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider px-2">Status</label>
                        <select wire:model.live="transaction_type" class="w-full px-1 py-1 text-xs font-semibold text-gray-800 border-0 focus:ring-0 bg-transparent cursor-pointer focus:outline-none">
                            <option value="">Semua</option>
                            <option value="sale">Dijual</option>
                            <option value="rent">Disewakan</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="md:col-span-2 pt-2 md:pt-0">
                        <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-lg shadow transition">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
