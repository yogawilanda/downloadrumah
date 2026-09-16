{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/components/layouts/home/home-feed-filter-modal.blade.php
| @usage            : Filter modal component for HomeFeed page
| @type             : Blade Component
| @expected_data    : [$transaction_type, $provinces, $cities, $districts]
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Filter modal provides focused filtering without leaving the current discovery context.
| @ruling_ui        : Hard borders, restrained geometry, minimal rounding, slate surfaces, sky accent.
| @ruling_motion    : Short 150–200ms transitions only.
|
| @status            : Active
| @author            : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

@props([
    'transaction_type',
    'provinces' => [],
    'cities' => [],
    'districts' => [],
])

<div
    x-show="openSearchModal"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
>

    {{-- Backdrop --}}

    <div
        x-show="openSearchModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="openSearchModal = false"
        class="fixed inset-0 bg-slate-950/50 backdrop-blur-sm dark:bg-black/60"
    ></div>


    {{-- Modal Box --}}

    <div
        x-show="openSearchModal"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150 transform"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative z-10 w-full max-w-sm space-y-4 overflow-y-auto
               border border-slate-300 bg-white p-5 shadow-2xl
               dark:border-slate-700 dark:bg-slate-900
               max-h-[90vh]"
    >

        {{-- Header Modal --}}

        <div
            class="flex items-center justify-between border-b border-slate-200 pb-3
                   dark:border-slate-800"
        >

            <div class="flex items-center gap-2">

                <svg
                    class="h-4 w-4 text-sky-600 dark:text-sky-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 010 4m-6 8a2 2 0 100-4m0 4a2 2 0 010-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 010-4m0 4v2m0-6V4"
                    />
                </svg>

                <h3 class="text-sm font-bold text-slate-800 dark:text-slate-100">
                    Filter Pencarian
                </h3>

            </div>


            <button
                type="button"
                @click="openSearchModal = false"
                class="rounded-md p-1 text-slate-400 transition
                       hover:bg-slate-100 hover:text-slate-700
                       dark:hover:bg-slate-800 dark:hover:text-slate-200"
                aria-label="Tutup"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>


        {{-- Body Form Filter --}}

        <div class="space-y-3.5">

            {{-- Input Kata Kunci --}}

            <div>

                <label
                    class="mb-1 block text-[11px] font-semibold text-slate-600
                           dark:text-slate-400"
                >
                    Cari Kata Kunci / Judul
                </label>

                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    placeholder="Contoh: Rumah Minimalis, Villa..."
                    class="w-full border border-slate-200 bg-slate-50 px-3 py-2
                           text-xs text-slate-800 outline-none transition
                           placeholder:text-slate-400
                           focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-500/20
                           dark:border-slate-700 dark:bg-slate-800
                           dark:text-slate-100 dark:placeholder:text-slate-500
                           dark:focus:border-sky-500 dark:focus:bg-slate-800"
                />

            </div>


            {{-- Filter Kota --}}

            @if (count($cities) > 0)

                <div>

                    <label
                        class="mb-1 block text-[11px] font-semibold text-slate-600
                               dark:text-slate-400"
                    >
                        Pilih Kota / Kabupaten
                    </label>

                    <select
                        wire:model.live="city"
                        class="w-full cursor-pointer border border-slate-200 bg-slate-50
                               px-3 py-2 text-xs text-slate-700 outline-none
                               transition focus:border-sky-500 focus:ring-2
                               focus:ring-sky-500/20
                               dark:border-slate-700 dark:bg-slate-800
                               dark:text-slate-200 dark:focus:border-sky-500"
                    >
                        <option value="">Semua Kota</option>

                        @foreach ($cities as $c)
                            <option value="{{ \Illuminate\Support\Str::slug($c->name) }}">
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>

                </div>

            @endif


            {{-- Filter Kecamatan --}}

            @if (count($districts) > 0)

                <div>

                    <label
                        class="mb-1 block text-[11px] font-semibold text-slate-600
                               dark:text-slate-400"
                    >
                        Pilih Kecamatan
                    </label>

                    <select
                        wire:model.live="district_id"
                        class="w-full border border-slate-200 bg-slate-50 px-3 py-2
                               text-xs text-slate-800 outline-none transition
                               focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20
                               dark:border-slate-700 dark:bg-slate-800
                               dark:text-slate-100 dark:focus:border-sky-500"
                    >
                        <option value="">Semua Kecamatan</option>

                        @foreach ($districts as $d)
                            <option value="{{ $d->code }}">
                                {{ $d->name }}
                            </option>
                        @endforeach
                    </select>

                </div>

            @endif


            {{-- Input Maksimal Harga --}}

            <div>

                <label
                    class="mb-1 block text-[11px] font-semibold text-slate-600
                           dark:text-slate-400"
                >
                    Batas Maksimal Harga (Rp)
                </label>

                <input
                    wire:model.live.debounce.500ms="max_price"
                    type="number"
                    placeholder="Contoh: 500000000"
                    class="w-full border border-slate-200 bg-slate-50 px-3 py-2
                           text-xs text-slate-800 outline-none transition
                           placeholder:text-slate-400
                           focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-500/20
                           dark:border-slate-700 dark:bg-slate-800
                           dark:text-slate-100 dark:placeholder:text-slate-500
                           dark:focus:border-sky-500 dark:focus:bg-slate-800"
                />

            </div>


            {{-- Tipe Transaksi --}}

            <div>

                <label
                    class="mb-1 block text-[11px] font-semibold text-slate-600
                           dark:text-slate-400"
                >
                    Tipe Transaksi
                </label>

                <div class="grid grid-cols-3 gap-1.5">

                    <button
                        type="button"
                        wire:click="$set('transaction_type', '')"
                        class="border px-2 py-1.5 text-xs font-medium transition
                            {{ $transaction_type === ''
                                ? 'border-sky-600 bg-sky-50 font-bold text-sky-600 dark:border-sky-500 dark:bg-sky-500/10 dark:text-sky-400'
                                : 'border-slate-200 text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-800' }}"
                    >
                        Semua
                    </button>

                    <button
                        type="button"
                        wire:click="$set('transaction_type', 'sale')"
                        class="border px-2 py-1.5 text-xs font-medium transition
                            {{ $transaction_type === 'sale'
                                ? 'border-sky-600 bg-sky-50 font-bold text-sky-600 dark:border-sky-500 dark:bg-sky-500/10 dark:text-sky-400'
                                : 'border-slate-200 text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-800' }}"
                    >
                        Dijual
                    </button>

                    <button
                        type="button"
                        wire:click="$set('transaction_type', 'rent')"
                        class="border px-2 py-1.5 text-xs font-medium transition
                            {{ $transaction_type === 'rent'
                                ? 'border-sky-600 bg-sky-50 font-bold text-sky-600 dark:border-sky-500 dark:bg-sky-500/10 dark:text-sky-400'
                                : 'border-slate-200 text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-800' }}"
                    >
                        Disewa
                    </button>

                </div>

            </div>

        </div>


        {{-- Action Footer --}}

        <div class="flex items-center gap-2 pt-2">

            <button
                type="button"
                wire:click="resetFilter"
                @click="openSearchModal = false"
                class="flex-1 border border-slate-200 bg-slate-100 py-2
                       text-xs font-semibold text-slate-600 transition
                       hover:bg-slate-200
                       dark:border-slate-700 dark:bg-slate-800
                       dark:text-slate-300 dark:hover:bg-slate-700"
            >
                Reset
            </button>

            <button
                type="button"
                @click="openSearchModal = false"
                class="flex-1 border border-sky-600 bg-sky-600 py-2
                       text-xs font-semibold text-white transition
                       hover:bg-sky-700 active:scale-95
                       dark:border-sky-500 dark:bg-sky-600
                       dark:hover:bg-sky-500"
            >
                Terapkan
            </button>

        </div>

    </div>

</div>
