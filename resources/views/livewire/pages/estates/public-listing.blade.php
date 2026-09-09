{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path   : resources/views/livewire/pages/estates/public-listing.blade.php
| @usage  : Split-view responsive public estate listing with inline show component
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}
@php
    $seoTitle = trim(($search ? $search . ' ' : '') . ($city ? 'di ' . $city : 'Properti'));
    $seoTitle .= $max_price ? ' hingga Rp' . number_format((float) $max_price, 0, ',', '.') : '';
@endphp
@section('has_custom_meta', true)
@push('meta')
    <meta name="description" content="Temukan {{ $seoTitle }} di DownloadRumah.">
    <meta property="og:title" content="{{ $seoTitle }} - DownloadRumah">
    <meta property="og:description" content="Cari listing properti aktif sesuai lokasi, kata kunci, dan budget Anda.">
@endpush

<div class="min-h-screen bg-gray-50/50 py-4 lg:py-6 px-3 sm:px-6 lg:px-8" x-data="{ openSearchModal: false }"
    @open-search-modal.window="openSearchModal = true">

    <div class="w-full max-w-md sm:max-w-2xl md:max-w-4xl lg:max-w-6xl mx-auto min-h-[calc(100vh-4rem)]">

        <!-- Mobile Header (HP Only) -->
        <header class="lg:hidden mb-4 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-black text-gray-900 tracking-tight">Listing Properti</h1>
                <p class="text-xs text-gray-500">Pilih rumah yang cocok untuk kebutuhanmu.</p>
            </div>
            @if ($search || $transaction_type || $city_id || $max_price || $location)
                <button wire:click="resetFilter" class="text-xs font-bold text-blue-600">Reset filter</button>
            @endif
        </header>

        <!-- Main Split Grid: 1 Kolom di HP, 2 Kolom (5:7) di Desktop/Tablet -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- KOLOM 1: Listing Items (Mobile Full Width / Desktop 5 Cols) -->
            <div
                class="lg:col-span-5 bg-white rounded-md lg:rounded-md shadow-sm border border-gray-100 p-4 lg:p-5 space-y-4 lg:max-h-[calc(100vh-5rem)] lg:overflow-y-auto">
                <div class="hidden lg:flex items-center justify-between pb-2 border-b border-gray-100">
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Listing Properti</h2>
                        <p class="text-xs text-gray-400">Pilih properti untuk melihat detail</p>
                    </div>
                    @if ($search || $transaction_type || $city_id || $max_price || $location)
                        <button wire:click="resetFilter"
                            class="text-xs font-bold text-blue-600 hover:underline">Reset</button>
                    @endif
                </div>

                <!-- Listing Cards Stream -->
                <x-layouts.home.home-feed-listing :estates="$estates" variant="vertical" />
            </div>

            <!-- KOLOM 2: Direct Embed EstateShow Component (Desktop/Tablet Only) -->
            <div
                class="hidden lg:block lg:col-span-7 lg:sticky lg:top-6 bg-white rounded-md shadow-sm border border-gray-100 p-6 lg:min-h-[calc(100vh-5rem)] lg:max-h-[calc(100vh-5rem)] lg:overflow-y-auto">
                @if ($selectedEstate)
                    <livewire:pages.estates.estate-show :estate="$selectedEstate" :key="'estate-show-' . $selectedEstate->id" />
                @else
                    <div
                        class="h-full flex flex-col items-center justify-center text-center py-20 text-gray-400 space-y-3">
                        <div class="w-16 h-16 rounded-md bg-gray-50 flex items-center justify-center text-2xl">🏡</div>
                        <p class="text-sm font-medium">Pilih salah satu properti di kolom kiri<br>untuk melihat detail
                            selengkapnya.</p>
                    </div>
                @endif
            </div>

        </div>

        <!-- Advanced Search Modal (Shared) -->
        <x-layouts.home.home-feed-search-advanced :transaction_type="$transaction_type" :cities="[]" :districts="[]" />
    </div>
</div>
