{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/components/layouts/home/home-feed-search-chips.blade.php
| @usage            : Active filter chips area for home feed
| @type             : Blade Component
| @expected_data    : [$max_price, $location, $search, $city_id, $district_id]
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Active filters remain compact, scannable, and removable.
| @ruling_ui        : Hard edges, restrained geometry, sky accent, horizontal overflow.
| @ruling_motion    : Short transitions only.
|
| @status            : Active
| @author            : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

@props([
    'max_price' => '',
    'location' => '',
    'search' => '',
    'city_id' => '',
    'district_id' => '',
])


@if ($max_price || $location || $search || $city_id || $district_id)

    <div class="flex items-center gap-1.5 overflow-x-auto px-4 pt-1 no-scrollbar">

        <span
            class="shrink-0 text-[10px] font-bold uppercase tracking-wider
                   text-slate-400 dark:text-slate-500"
        >
            Filter:
        </span>


        @if ($max_price)

            <div
                class="flex shrink-0 items-center gap-1 border border-sky-200
                       bg-sky-50 px-2.5 py-1 text-[11px] font-medium text-sky-700
                       dark:border-sky-800 dark:bg-sky-950/40 dark:text-sky-400"
            >
                <span>
                    Maks: Rp {{ number_format((float) $max_price, 0, ',', '.') }}
                </span>

                <button
                    type="button"
                    wire:click="$set('max_price', '')"
                    class="ml-1 font-bold text-sky-500 transition-colors
                           hover:text-sky-800 dark:text-sky-500 dark:hover:text-sky-300"
                    aria-label="Hapus filter harga"
                >
                    ✕
                </button>
            </div>

        @endif


        @if ($location)

            <div
                class="flex shrink-0 items-center gap-1 border border-sky-200
                       bg-sky-50 px-2.5 py-1 text-[11px] font-medium text-sky-700
                       dark:border-sky-800 dark:bg-sky-950/40 dark:text-sky-400"
            >
                <span>Target: {{ ucfirst($location) }}</span>

                <button
                    type="button"
                    wire:click="$set('location', '')"
                    class="ml-1 font-bold text-sky-500 transition-colors
                           hover:text-sky-800 dark:text-sky-500 dark:hover:text-sky-300"
                    aria-label="Hapus filter lokasi"
                >
                    ✕
                </button>
            </div>

        @endif


        @if ($city_id)

            <div
                class="flex shrink-0 items-center gap-1 border border-sky-200
                       bg-sky-50 px-2.5 py-1 text-[11px] font-medium text-sky-700
                       dark:border-sky-800 dark:bg-sky-950/40 dark:text-sky-400"
            >
                <span>Kota Aktif</span>

                <button
                    type="button"
                    wire:click="$set('city_id', '')"
                    class="ml-1 font-bold text-sky-500 transition-colors
                           hover:text-sky-800 dark:text-sky-500 dark:hover:text-sky-300"
                    aria-label="Hapus filter kota"
                >
                    ✕
                </button>
            </div>

        @endif


        @if ($district_id)

            <div
                class="flex shrink-0 items-center gap-1 border border-sky-200
                       bg-sky-50 px-2.5 py-1 text-[11px] font-medium text-sky-700
                       dark:border-sky-800 dark:bg-sky-950/40 dark:text-sky-400"
            >
                <span>Kecamatan Aktif</span>

                <button
                    type="button"
                    wire:click="$set('district_id', '')"
                    class="ml-1 font-bold text-sky-500 transition-colors
                           hover:text-sky-800 dark:text-sky-500 dark:hover:text-sky-300"
                    aria-label="Hapus filter kecamatan"
                >
                    ✕
                </button>
            </div>

        @endif


        @if ($search)

            <div
                class="flex max-w-[160px] shrink-0 items-center gap-1 border
                       border-sky-200 bg-sky-50 px-2.5 py-1 text-[11px]
                       font-medium text-sky-700
                       dark:border-sky-800 dark:bg-sky-950/40 dark:text-sky-400"
            >
                <span class="truncate">"{{ $search }}"</span>

                <button
                    type="button"
                    wire:click="$set('search', '')"
                    class="ml-1 shrink-0 font-bold text-sky-500 transition-colors
                           hover:text-sky-800 dark:text-sky-500 dark:hover:text-sky-300"
                    aria-label="Hapus kata kunci"
                >
                    ✕
                </button>
            </div>

        @endif


        <button
            type="button"
            wire:click="resetFilter"
            class="ml-auto shrink-0 pl-1 text-[11px] font-semibold
                   text-red-500 underline transition-colors
                   hover:text-red-600
                   dark:text-red-400 dark:hover:text-red-300"
        >
            Reset All
        </button>

    </div>

@endif
