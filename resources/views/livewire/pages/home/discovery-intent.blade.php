{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/home/discovery-intent.blade.php
| @usage            : Shared discovery/search controller with contextual suggestion surface
| @type             : Livewire View
| @expected_data    : [$variant, $search, $city, $transaction_type, $suggestions, $cities, $popularCities]
| @expected_events  : [submitSearch, selectCitySuggestion]
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Hero acts as a discovery doorway; compact acts as a lightweight
|                     search controller for active listing exploration.
| @ruling_ui        : Compact remains intentionally minimal and avoids marketplace-style
|                     filter controls. Hero owns the stronger discovery presentation.
| @ruling_motion    : Short 150–200ms interaction transitions only.
| @ruling_performance : CSS geometry only; no additional JavaScript or decorative animation.
|
| @status           : Active
| @author           : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

@if ($variant === 'compact')

    {{-- ----------------------------------------------------------------------------------------------
    | Compact Discovery Controller
    | ----------------------------------------------------------------------------------------------- --}}

    <div
        x-data="{ searchOpen: false }"
        @click.outside="searchOpen = false"
        class="relative"
    >

        <form
            wire:submit.prevent="submitSearch"
            class="flex border border-slate-300 bg-white"
        >

            {{-- Search --}}

            <div class="relative min-w-0 flex-1">

                <div class="flex h-10 items-center">

                    <span
                        class="pl-3 text-slate-400"
                        aria-hidden="true"
                    >
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 20 20"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <circle
                                cx="8.5"
                                cy="8.5"
                                r="5.5"
                            ></circle>

                            <path d="M13 13L17 17"></path>
                        </svg>
                    </span>

                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        @focus="searchOpen = true"
                        placeholder="Cari lokasi, nama properti..."
                        autocomplete="off"
                        class="w-full border-0 bg-transparent px-3 py-2 text-xs font-medium text-slate-800 outline-none placeholder:text-slate-400 focus:ring-0 sm:text-sm"
                    >

                </div>

                <x-layouts.home.search-suggestions
                    :suggestions="$suggestions"
                    :search="$search"
                    :popularCities="$popularCities"
                />

            </div>


            {{-- Submit --}}

            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="submitSearch"
                class="shrink-0 border-l border-slate-200 bg-slate-950 px-5 text-xs font-bold text-white transition duration-150 hover:bg-sky-600 disabled:cursor-wait disabled:opacity-60"
            >
                Cari
            </button>

        </form>

    </div>


@else

    {{-- ----------------------------------------------------------------------------------------------
    | Hero Discovery Surface
    | ----------------------------------------------------------------------------------------------- --}}

    <div class="relative">

        {{-- Discovery Context --}}

        <div class="mb-5 flex items-center justify-between gap-4">

            <div class="flex items-center gap-2">

                <span class="h-1.5 w-1.5 bg-sky-500"></span>

                <span class="text-[10px] font-semibold uppercase tracking-[0.16em] text-slate-500">
                    Mulai menjelajah
                </span>

            </div>

            <span class="hidden text-[10px] font-medium tracking-wide text-slate-400 sm:block">
                Cari apa yang sudah kamu bayangkan
            </span>

        </div>


        {{-- Main Discovery Surface --}}

        <div
            x-data="{ searchOpen: false }"
            @click.outside="searchOpen = false"
            class="relative"
        >

            {{-- Structural Frame --}}

            <div
                aria-hidden="true"
                class="pointer-events-none absolute inset-0 bg-slate-300"
                style="
                    clip-path: polygon(
                        14px 0,
                        100% 0,
                        100% calc(100% - 14px),
                        calc(100% - 14px) 100%,
                        0 100%,
                        0 14px
                    );
                "
            ></div>


            {{-- Inner Surface Background --}}

            <div
                aria-hidden="true"
                class="pointer-events-none absolute inset-px bg-white"
                style="
                    clip-path: polygon(
                        13px 0,
                        100% 0,
                        100% calc(100% - 13px),
                        calc(100% - 13px) 100%,
                        0 100%,
                        0 13px
                    );
                "
            ></div>


            {{-- Interactive Content --}}

            <div class="relative">

                <form wire:submit.prevent="submitSearch">

                    {{-- Search Input --}}

                    <div class="relative border-b border-slate-200">

                        <div class="flex items-center">

                            <span
                                class="pl-4 text-slate-400"
                                aria-hidden="true"
                            >
                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <circle
                                        cx="8.5"
                                        cy="8.5"
                                        r="5.5"
                                    ></circle>

                                    <path d="M13 13L17 17"></path>
                                </svg>
                            </span>

                            <input
                                type="text"
                                wire:model.live.debounce.300ms="search"
                                @focus="searchOpen = true"
                                placeholder="Cari lokasi, properti, atau area..."
                                autocomplete="off"
                                class="w-full border-0 bg-transparent px-3 py-4 text-sm font-medium text-slate-800 outline-none placeholder:text-slate-400 focus:ring-0"
                            >

                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                wire:target="submitSearch"
                                class="mr-2 hidden shrink-0 bg-sky-600 px-4 py-2 text-[11px] font-semibold text-white transition-colors duration-150 hover:bg-sky-700 disabled:cursor-wait disabled:opacity-60 sm:block"
                            >
                                Cari
                            </button>

                        </div>

                        <x-layouts.home.search-suggestions
                            :suggestions="$suggestions"
                            :search="$search"
                            :popularCities="$popularCities"
                        />

                    </div>


                    {{-- Mobile Submit --}}

                    <div class="border-b border-slate-200 p-2 sm:hidden">

                        <button
                            type="submit"
                            class="w-full bg-sky-600 px-4 py-2.5 text-xs font-semibold text-white transition-colors duration-150 hover:bg-sky-700"
                        >
                            Cari
                        </button>

                    </div>


                    {{-- Exploration Starters --}}

                    <div class="px-4 py-4 sm:px-5">

                        <div class="mb-3 flex items-center gap-2">

                            <span class="h-1 w-1 bg-slate-300"></span>

                            <span class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">
                                Mulai dari kota
                            </span>

                        </div>

                        <div class="flex flex-wrap gap-2">

                            @foreach ($popularCities as $popularCity)

                                <button
                                    type="button"
                                    wire:click="selectCitySuggestion('{{ $popularCity->name }}')"
                                    class="border border-slate-200 bg-slate-50 px-3 py-2 text-xs font-medium text-slate-600 transition-colors duration-150 hover:border-sky-300 hover:bg-sky-50 hover:text-sky-700"
                                >
                                    {{ $popularCity->name }}
                                </button>

                            @endforeach

                        </div>

                    </div>

                </form>

            </div>

        </div>


        {{-- Supporting Note --}}

        <div class="mt-4 flex items-center gap-2 pl-1 text-[10px] font-medium text-slate-400">

            <span class="h-px w-6 bg-slate-300"></span>

            <span>
                Tidak harus sudah tahu persis apa yang dicari.
            </span>

        </div>

    </div>

@endif
