{{--
|--------------------------------------------------------------------------
| Top Navigation Bar Component (Home View)
|--------------------------------------------------------------------------
| @path : resources/views/components/layouts/home/search-suggestions.blade.php
| @usage : Search skeleton and result from end user inputs
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@props(['suggestions', 'search' => '', 'popularCities' => collect()])

<div x-show="searchOpen" x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
    class="absolute left-0 right-0 top-full mt-2 z-50 overflow-hidden rounded-md border border-gray-100 bg-white shadow-xl">

    {{-- STATE 1: Skeleton Loader saat Livewire memproses/fetch data --}}
    @include('components.layouts.home.search-in-progress')

    {{-- STATE 2: Konten Hasil (Ditampilkan jika tidak sedang loading) --}}
    <div wire:loading.remove wire:target="search, selectCitySuggestion">

        {{-- KONDISI A: Input Masih Kosong (< 2 Karakter) --}}
        @if (strlen(trim($search)) < 2)
            @include('components.layouts.home.search-standby')

            {{-- KONDISI B: Input Sudah Diketik (>= 2 Karakter) --}}
        @else
            {{-- Hasil Kota --}}
            @if (isset($suggestions['cities']) && $suggestions['cities']->isNotEmpty())
                <div class="border-b border-gray-100 p-3">
                    <p class="mb-2 text-[10px] font-bold uppercase tracking-wider text-gray-400">Lokasi</p>
                    <div class="space-y-1">
                        @foreach ($suggestions['cities'] as $city)
                            <button type="button" wire:click="selectCitySuggestion('{{ $city->code }}')"
                                @click="searchOpen = false"
                                class="w-full text-left flex items-center gap-2 rounded-md px-2 py-2 text-xs font-semibold text-gray-700 hover:bg-blue-50 transition">
                                <span class="text-blue-600">⌖</span>{{ $city->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Hasil Properti --}}
            <div class="p-3">
                <div class="mb-2 flex items-center justify-between">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Properti</p>
                    @if (isset($suggestions['estates']) && $suggestions['estates']->isNotEmpty())
                        <button type="button" wire:click="submitSearch" @click="searchOpen = false"
                            class="text-[10px] font-bold text-blue-600 hover:underline">
                            Lihat semua hasil
                        </button>
                    @endif
                </div>

                @if (isset($suggestions['estates']))
                    @forelse ($suggestions['estates'] as $estate)
                        <a href="{{ route('estates.show', $estate->slug) }}" wire:navigate @click="searchOpen = false"
                            class="flex items-center gap-2 rounded-md px-2 py-2 hover:bg-gray-50 transition">
                            <div class="h-9 w-9 shrink-0 overflow-hidden rounded-md bg-gray-100">
                                @if ($estate->primaryImage?->url)
                                    <img src="{{ $estate->primaryImage->url }}" class="h-full w-full object-cover"
                                        alt="{{ $estate->title }}">
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-xs font-bold text-gray-800">{{ $estate->title }}</p>
                                <p class="text-[10px] text-blue-600 font-semibold">{{ $estate->short_price }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="py-2 text-xs text-gray-400">Belum ada properti yang cocok.</p>
                    @endforelse
                @endif
            </div>
        @endif

    </div>
</div>
