{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/estates/public-listing.blade.php
| @usage            : Public listing page with full-width sticky filter bar
| @ruling           : max line of code 80%, max doc 20% | max total lines = 100
| @author            : yogawilanda <eaywilanda@gmail.com>
| @status            : Active
| @author            : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div
    class="min-h-screen bg-slate-100/50 pb-12 dark:bg-slate-950"
    x-data="{ openSearchModal: false }"
    @open-search-modal.window="openSearchModal = true"
>

    {{-- 1. FULL-WIDTH STICKY FILTER BAR --}}
    <div
        class="sticky top-0 z-30 mb-6 w-full border-b border-slate-200/80
               bg-white/95 px-4 py-3 shadow-sm backdrop-blur-md
               dark:border-slate-800 dark:bg-slate-950/95
               sm:px-6 lg:px-8"
    >
        <div class="mx-auto w-full max-w-6xl space-y-2 px-4 sm:px-6 lg:px-8">

            @livewire(\App\Livewire\Pages\Home\DiscoveryIntent::class, ['variant' => 'compact'])

            {{-- Quick Active Filter Chips --}}
            <div class="hidden pt-1 md:block">
                <x-layouts.home.home-feed-search-chips
                    :max_price="$max_price"
                    :location="$location"
                    :search="$search"
                    :city_id="$city_id"
                    :district_id="$district_id"
                />
            </div>

        </div>
    </div>


    {{-- 2. MAIN FEED CONTAINER --}}
    <main class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">

        {{-- Page Title & Counter Header --}}
        <div
            class="mb-6 flex items-end justify-between border-b border-slate-200/60 pb-3
                   dark:border-slate-800"
        >

            <div class="space-y-0.5">

                <h1
                    class="text-base font-black tracking-tight text-slate-900
                           dark:text-slate-100 sm:text-xl"
                >
                    {{ $search
                        ? 'Hasil Pencarian: "' . $search . '"'
                        : ($city
                            ? 'Properti di ' . \Illuminate\Support\Str::headline($city)
                            : 'Properti Terbaru') }}
                </h1>

                <p class="text-xs text-slate-400 dark:text-slate-500">
                    Pilih unit yang sesuai dengan preferensi Anda
                </p>

            </div>


            <div class="flex items-center gap-3">

                @if ($search || $transaction_type || $city_id || $max_price || $location)

                    <button
                        wire:click="resetFilter"
                        class="text-xs font-bold text-red-500 transition hover:text-red-600 hover:underline
                               dark:text-red-400 dark:hover:text-red-300"
                    >
                        Reset Filter
                    </button>

                @endif

                <span
                    class="border border-slate-200/50 bg-slate-100 px-3 py-1 text-xs
                           font-bold text-slate-600
                           dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300"
                >
                    {{ $estates->total() }} Unit
                </span>

            </div>

        </div>


        {{-- Listing Items --}}
        <x-layouts.home.home-feed-listing
            :estates="$estates"
            variant="vertical"
        />

    </main>


    {{-- Advanced Search Modal (Shared) --}}
    <x-layouts.home.home-feed-search-advanced
        :transaction_type="$transaction_type"
        :cities="[]"
        :districts="[]"
    />

</div>
