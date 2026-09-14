
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
| @ruling           : Hero variant acts as a discovery doorway rather than a conventional
|                     marketplace filter form.
| @ruling_ui        : Structural geometry is concentrated on the outer discovery surface.
|                     Internal controls remain familiar and visually calm.
| @ruling_motion    : Short 150–200ms interaction transitions only.
| @ruling_performance : CSS geometry only; no additional JavaScript or decorative animation.
|
| @status           : Active
| @author           : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

@if ($variant === 'compact')

    {{-- ----------------------------------------------------------------------------------------------
    | Compact Search Surface
    | ------------------------------------------------------------------------------------------- --}}

    <div
        x-data="{ searchOpen: false }"
        @click.outside="searchOpen = false"
        class="relative"
    >

        <form
            wire:submit.prevent="submitSearch"
            class="relative flex flex-col items-center gap-2 border border-slate-200 bg-white p-2 shadow-sm sm:p-2.5 md:flex-row"
        >

            <div class="relative w-full md:flex-1">

                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    @focus="searchOpen = true"
                    placeholder="Cari lokasi, nama properti..."
                    class="w-full border-0 px-3 py-2 text-xs text-slate-800 outline-none placeholder:text-slate-400 focus:ring-0 sm:text-sm"
                >

                <x-layouts.home.search-suggestions
                    :suggestions="$suggestions"
                    :search="$search"
                    :popularCities="$popularCities"
                />

            </div>

            <div class="hidden h-4 w-px bg-slate-200 md:block"></div>

            <select
                wire:model.live="city"
                class="w-full cursor-pointer border-0 bg-transparent text-xs text-slate-700 focus:ring-0 md:w-auto sm:text-sm"
            >
                <option value="">Semua Kota</option>

                @foreach ($cities as $c)

                    <option value="{{ \Illuminate\Support\Str::slug($c->name) }}">
                        {{ $c->name }}
                    </option>

                @endforeach

            </select>

            <select
                wire:model.live="transaction_type"
                class="w-full cursor-pointer border-0 bg-transparent text-xs text-slate-700 focus:ring-0 md:w-auto sm:text-sm"
            >
                <option value="">Status (Semua)</option>
                <option value="sale">Dijual</option>
                <option value="rent">Disewakan</option>
            </select>

            <button
                type="submit"
                class="w-full bg-sky-600 px-5 py-2 text-xs font-semibold text-white transition-colors duration-150 hover:bg-sky-700 md:w-auto"
            >
                Cari
            </button>

        </form>

    </div>

@else

    {{-- ----------------------------------------------------------------------------------------------
    | Hero Discovery Surface
    | ------------------------------------------------------------------------------------------- --}}

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


        {{-- ------------------------------------------------------------------------------------------
        | Main Discovery Surface
        | ------------------------------------------------------------------------------------------- --}}

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
