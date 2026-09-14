{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/components/layouts/home/search-suggestions.blade.php
| @usage            : DownloadRumah Search Suggestion Surface — Standby, Loading & Search Result States
| @type             : Blade Component (Search State Presentation)
| @expected_data    : [$suggestions, $search, $popularCities]
| @expected_events  : [searchOpen, submitSearch, selectCitySuggestion]
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Preserve existing search state logic while aligning presentation with
|                     DownloadRumah's structural visual language.
| @ruling_ui        : Search results extend directly from the input surface; avoid floating
|                     marketplace-card styling, excessive rounding, and generic shadows.
| @ruling_motion    : Short 150–200ms transitions only.
| @ruling_performance : No additional JavaScript, image loading strategy, or query logic introduced.
|
| @status           : Active
| @author           : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

@props([
    'suggestions',
    'search' => '',
    'popularCities' => collect(),
])

<div
    x-cloak
    x-show="searchOpen"
    x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0 -translate-y-1"
    x-transition:enter-end="opacity-100 translate-y-0"
    class="absolute left-0 right-0 top-full z-50 overflow-hidden border border-slate-300 bg-white shadow-[4px_4px_0_0_rgba(15,23,42,0.03)]"
>

    {{-- --------------------------------------------------------------------------------------------------
    | STATE 1 — Loading
    | ----------------------------------------------------------------------------------------------- --}}

    @include('components.layouts.home.search-in-progress')


    {{-- --------------------------------------------------------------------------------------------------
    | STATE 2 — Search Content
    | ----------------------------------------------------------------------------------------------- --}}

    <div wire:loading.remove wire:target="search, selectCitySuggestion">

        @if (strlen(trim($search)) < 2)

            {{-- ------------------------------------------------------------------------------------------
            | STATE 2A — Standby
            | --------------------------------------------------------------------------------------- --}}

            @include('components.layouts.home.search-standby')

        @else

            {{-- ------------------------------------------------------------------------------------------
            | STATE 2B — Search Results
            | --------------------------------------------------------------------------------------- --}}

            {{-- City Results --}}

            @if (isset($suggestions['cities']) && $suggestions['cities']->isNotEmpty())

                <div class="border-b border-slate-200 p-4 sm:p-5">

                    <div class="mb-3 flex items-center gap-2">

                        <span class="h-1.5 w-1.5 bg-sky-500"></span>

                        <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                            Lokasi
                        </p>

                    </div>

                    <div class="space-y-1">

                        @foreach ($suggestions['cities'] as $city)

                            <button
                                type="button"
                                wire:click="selectCitySuggestion('{{ $city->name }}')"
                                @click="searchOpen = false"
                                class="group flex w-full items-center gap-3 border border-transparent px-3 py-2.5 text-left transition-colors duration-150 hover:border-sky-200 hover:bg-sky-50"
                            >

                                <span
                                    class="h-1.5 w-1.5 shrink-0 bg-slate-300 transition-colors duration-150 group-hover:bg-sky-500"
                                    aria-hidden="true"
                                ></span>

                                <span class="text-xs font-semibold text-slate-700 group-hover:text-sky-700">
                                    {{ $city->name }}
                                </span>

                            </button>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- Property Results --}}

            <div class="p-4 sm:p-5">

                <div class="mb-3 flex items-center justify-between gap-4">

                    <div class="flex items-center gap-2">

                        <span class="h-1.5 w-1.5 bg-slate-300"></span>

                        <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                            Properti
                        </p>

                    </div>

                    @if (isset($suggestions['estates']) && $suggestions['estates']->isNotEmpty())

                        <button
                            type="button"
                            wire:click="submitSearch"
                            @click="searchOpen = false"
                            class="shrink-0 text-[10px] font-bold text-sky-700 transition-colors duration-150 hover:text-sky-900"
                        >
                            Lihat semua →
                        </button>

                    @endif

                </div>


                @if (isset($suggestions['estates']))

                    <div class="space-y-1">

                        @forelse ($suggestions['estates'] as $estate)

                            <a
                                href="{{ route('estates.show', $estate->slug) }}"
                                wire:navigate
                                @click="searchOpen = false"
                                class="group flex items-center gap-3 border border-transparent px-2.5 py-2.5 transition-colors duration-150 hover:border-slate-200 hover:bg-slate-50"
                            >

                                <div class="h-10 w-10 shrink-0 overflow-hidden border border-slate-200 bg-slate-100">

                                    @if ($estate->primaryImage?->url)

                                        <img
                                            src="{{ $estate->primaryImage->url }}"
                                            class="h-full w-full object-cover"
                                            alt="{{ $estate->title }}"
                                        >

                                    @endif

                                </div>

                                <div class="min-w-0 flex-1">

                                    <p class="truncate text-xs font-bold text-slate-800">
                                        {{ $estate->title }}
                                    </p>

                                    <p class="mt-0.5 text-[10px] font-semibold text-sky-700">
                                        {{ $estate->short_price }}
                                    </p>

                                </div>

                                <span
                                    class="hidden text-[11px] font-semibold text-slate-300 transition-colors duration-150 group-hover:text-sky-500 sm:block"
                                    aria-hidden="true"
                                >
                                    →
                                </span>

                            </a>

                        @empty

                            <div class="border border-dashed border-slate-200 px-3 py-4">

                                <p class="text-xs font-medium text-slate-500">
                                    Belum ada properti yang cocok.
                                </p>

                                <p class="mt-1 text-[10px] text-slate-400">
                                    Coba gunakan lokasi atau kata kunci lain.
                                </p>

                            </div>

                        @endforelse

                    </div>

                @endif

            </div>

        @endif

    </div>

</div>
