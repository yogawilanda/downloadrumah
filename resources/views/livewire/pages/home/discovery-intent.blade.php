{{--
|--------------------------------------------------------------------------
| Top Navigation Bar Component (Home View)
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/home/discovery-intent.blade.php
| @usage : Search display or view for end user to input their specific expectations.
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="hidden md:block w-full bg-blue-600 rounded-3xl p-6 md:p-8 text-white shadow-xl shadow-blue-500/10 relative overflow-visible z-20"
    x-data="{ searchOpen: false }">

    {{-- Headline Intent --}}
    <div class="mb-6 space-y-1">
        <p class="text-xs font-bold uppercase tracking-wider text-blue-200">DownloadRumah</p>
        <h2 class="text-2xl font-black">Cari hunian yang terasa cocok</h2>
        <p class="text-xs text-blue-100">Lihat-lihat dulu berdasarkan lokasi, kebutuhan, dan budget.</p>
    </div>

    {{-- Form Widget Search Desktop (overflow-visible agar dropdown tidak terpotong) --}}
    <form wire:submit.prevent="submitSearch"
        class="grid grid-cols-1 md:grid-cols-12 gap-3 bg-white p-2.5 rounded-2xl text-gray-800 shadow-md relative overflow-visible">

        {{-- Input Search --}}
        <div class="md:col-span-5 relative z-30" @click.outside="searchOpen = false">
            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider px-3 pt-1">
                Lokasi / Properti
            </label>

            <input wire:model.live.debounce.300ms="search" @focus="searchOpen = true" type="text"
                placeholder="Cari lokasi, nama properti..."
                class="w-full px-3 pb-1 pt-0 text-xs font-semibold text-gray-800 border-none focus:ring-0 placeholder-gray-400 bg-transparent" />

            {{-- Cukup panggil komponen ini saja --}}
            <x-layouts.home.search-suggestions :suggestions="$suggestions" :popularCities="$popularCities" :search="$search" />
        </div>

        {{-- Select Kota --}}
        <div class="md:col-span-3 border-t md:border-t-0 md:border-l border-gray-100 pt-2 md:pt-0">
            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider px-3 pt-1">Kota</label>
            <select wire:model.live="city_id"
                class="w-full px-2 pb-1 pt-0 text-xs font-semibold text-gray-800 border-none focus:ring-0 bg-transparent">
                <option value="">Semua Kota</option>
                @foreach ($cities as $c)
                    <option value="{{ $c->code }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Select Tipe Transaksi --}}
        <div class="md:col-span-2 border-t md:border-t-0 md:border-l border-gray-100 pt-2 md:pt-0">
            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider px-3 pt-1">Status</label>
            <select wire:model.live="transaction_type"
                class="w-full px-2 pb-1 pt-0 text-xs font-semibold text-gray-800 border-none focus:ring-0 bg-transparent">
                <option value="">Semua</option>
                <option value="sale">Dijual</option>
                <option value="rent">Disewa</option>
            </select>
        </div>

        {{-- Submit Button --}}
        <div class="md:col-span-2 flex items-center">
            <button type="submit"
                class="w-full h-full min-h-[40px] bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-bold text-xs rounded-xl transition shadow-sm">
                Cari
            </button>
        </div>

    </form>
</div>
