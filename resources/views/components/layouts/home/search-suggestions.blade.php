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

<div x-show="searchOpen"
    x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0 translate-y-1"
    x-transition:enter-end="opacity-100 translate-y-0"
    class="absolute left-0 right-0 top-full mt-2 z-50 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl">

    {{-- STATE 1: Skeleton Loader saat Livewire memproses/fetch data --}}
    <div wire:loading wire:target="search, selectCitySuggestion" class="w-full p-3 space-y-3">
        <div class="space-y-2">
            <div class="h-2.5 w-20 bg-gray-200 rounded animate-pulse"></div>
            <div class="h-8 w-full bg-gray-100 rounded-xl animate-pulse"></div>
            <div class="h-8 w-full bg-gray-100 rounded-xl animate-pulse"></div>
        </div>
        <div class="space-y-2 pt-2 border-t border-gray-100">
            <div class="h-2.5 w-24 bg-gray-200 rounded animate-pulse"></div>
            <div class="flex items-center gap-2">
                <div class="h-9 w-9 bg-gray-200 rounded-lg animate-pulse shrink-0"></div>
                <div class="space-y-1.5 flex-1">
                    <div class="h-3 w-3/4 bg-gray-100 rounded animate-pulse"></div>
                    <div class="h-2.5 w-1/4 bg-gray-100 rounded animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- STATE 2: Konten Hasil (Ditampilkan jika tidak sedang loading) --}}
    <div wire:loading.remove wire:target="search, selectCitySuggestion">

        {{-- KONDISI A: Input Masih Kosong (< 2 Karakter) --}}
        @if (strlen(trim($search)) < 2)
            <div class="p-3 space-y-3">
                <div class="flex items-center justify-between px-1">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Pencarian Populer</p>
                    <span class="text-[10px] font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">Rekomendasi</span>
                </div>

                <div class="space-y-1">
                    @forelse ($popularCities as $pCity)
                        <button type="button"
                            wire:click="selectCitySuggestion('{{ $pCity->code }}')"
                            @click="searchOpen = false"
                            class="w-full text-left flex items-center justify-between rounded-xl px-2.5 py-2 text-xs font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition group">
                            <div class="flex items-center gap-2">
                                <span class="text-blue-500 font-bold">⌖</span>
                                <span>Rumah di {{ $pCity->name }}</span>
                            </div>
                            <span class="text-[10px] text-gray-400 group-hover:text-blue-500">Cari ›</span>
                        </button>
                    @empty
                        @for ($i = 0; $i < 3; $i++)
                            <div class="flex items-center justify-between p-2 rounded-xl bg-gray-50/80 animate-pulse">
                                <div class="h-3.5 w-32 bg-gray-200 rounded"></div>
                                <div class="h-3 w-8 bg-gray-200 rounded"></div>
                            </div>
                        @endfor
                    @endforelse
                </div>
            </div>

        {{-- KONDISI B: Input Sudah Diketik (>= 2 Karakter) --}}
        @else
            {{-- Hasil Kota --}}
            @if (isset($suggestions['cities']) && $suggestions['cities']->isNotEmpty())
                <div class="border-b border-gray-100 p-3">
                    <p class="mb-2 text-[10px] font-bold uppercase tracking-wider text-gray-400">Lokasi</p>
                    <div class="space-y-1">
                        @foreach ($suggestions['cities'] as $city)
                            <button type="button"
                                wire:click="selectCitySuggestion('{{ $city->code }}')"
                                @click="searchOpen = false"
                                class="w-full text-left flex items-center gap-2 rounded-xl px-2 py-2 text-xs font-semibold text-gray-700 hover:bg-blue-50 transition">
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
                        <button type="button" wire:click="submitSearch" @click="searchOpen = false" class="text-[10px] font-bold text-blue-600 hover:underline">
                            Lihat semua hasil
                        </button>
                    @endif
                </div>

                @if (isset($suggestions['estates']))
                    @forelse ($suggestions['estates'] as $estate)
                        <a href="{{ route('estates.show', $estate->slug) }}" wire:navigate @click="searchOpen = false"
                            class="flex items-center gap-2 rounded-xl px-2 py-2 hover:bg-gray-50 transition">
                            <div class="h-9 w-9 shrink-0 overflow-hidden rounded-lg bg-gray-100">
                                @if ($estate->primaryImage?->url)
                                    <img src="{{ $estate->primaryImage->url }}" class="h-full w-full object-cover" alt="{{ $estate->title }}">
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
