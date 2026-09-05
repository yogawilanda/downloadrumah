{{--
loc: resources/views/components/layouts/home/home-feed-search-chips.blade.php
usage: Active filter chips area for home feed
--}}
@props([
    'max_price' => '',
    'location' => '',
    'search' => '',
    'city_id' => '',
    'district_id' => ''
])

@if ($max_price || $location || $search || $city_id || $district_id)
    <div class="px-4 flex items-center gap-1.5 overflow-x-auto no-scrollbar pt-1">
        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider shrink-0">Filter:</span>

        @if ($max_price)
            <div class="flex items-center gap-1 bg-blue-50 text-blue-700 border border-blue-200 px-2.5 py-1 rounded-full text-[11px] font-medium shrink-0">
                <span>Maks: Rp {{ number_format((float) $max_price, 0, ',', '.') }}</span>
                <button wire:click="$set('max_price', '')" class="hover:text-blue-900 ml-1 font-bold">✕</button>
            </div>
        @endif

        @if ($location)
            <div class="flex items-center gap-1 bg-blue-50 text-blue-700 border border-blue-200 px-2.5 py-1 rounded-full text-[11px] font-medium shrink-0">
                <span>Target: {{ ucfirst($location) }}</span>
                <button wire:click="$set('location', '')" class="hover:text-blue-900 ml-1 font-bold">✕</button>
            </div>
        @endif

        @if ($city_id)
            <div class="flex items-center gap-1 bg-blue-50 text-blue-700 border border-blue-200 px-2.5 py-1 rounded-full text-[11px] font-medium shrink-0">
                <span>Kota Aktif</span>
                <button wire:click="$set('city_id', '')" class="hover:text-blue-900 ml-1 font-bold">✕</button>
            </div>
        @endif

        @if ($district_id)
            <div class="flex items-center gap-1 bg-blue-50 text-blue-700 border border-blue-200 px-2.5 py-1 rounded-full text-[11px] font-medium shrink-0">
                <span>Kecamatan Aktif</span>
                <button wire:click="$set('district_id', '')" class="hover:text-blue-900 ml-1 font-bold">✕</button>
            </div>
        @endif

        @if ($search)
            <div class="flex items-center gap-1 bg-blue-50 text-blue-700 border border-blue-200 px-2.5 py-1 rounded-full text-[11px] font-medium shrink-0 max-w-[160px]">
                <span class="truncate">"{{ $search }}"</span>
                <button wire:click="$set('search', '')" class="hover:text-blue-900 ml-1 font-bold shrink-0">✕</button>
            </div>
        @endif

        <button wire:click="resetFilter" class="text-[11px] text-red-500 font-semibold underline shrink-0 pl-1 ml-auto">
            Reset All
        </button>
    </div>
@endif
