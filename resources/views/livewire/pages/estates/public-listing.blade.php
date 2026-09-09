{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path   : resources/views/livewire/pages/estates/public-listing.blade.php
| @usage  : Split-view layout (Clean Mobile & Ultra-Wide Desktop)
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

<div class="min-h-screen bg-white lg:bg-gray-50/50 py-0 lg:py-6 px-0 sm:px-6 lg:px-8"
    x-data="{ openSearchModal: false }"
    @open-search-modal.window="openSearchModal = true">

    <div class="w-full max-w-md sm:max-w-2xl md:max-w-4xl lg:max-w-6xl mx-auto min-h-[calc(100vh-4rem)]">

        <!-- Header HP Bawaan (Hanya Tampil di Mobile) -->
        <header class="px-4 pt-5 pb-2 lg:hidden flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-blue-600">Temukan hunian</p>
                <h1 class="text-xl font-black text-gray-900 tracking-tight">Listing Properti</h1>
                <p class="text-xs text-gray-500 mt-0.5">Pilih rumah yang cocok untuk kebutuhanmu.</p>
            </div>
            @if ($search || $transaction_type || $city_id || $max_price || $location)
                <button wire:click="resetFilter" class="text-xs font-bold text-blue-600">Reset filter</button>
            @endif
        </header>

        <!-- Main Split Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 lg:gap-6 items-start">

            <!-- 1. LEFT COLUMN: Listing Feed (Mobile: Tanpa Box / Desktop: Card Left) -->
            <div class="lg:col-span-4 xl:col-span-3 px-4 lg:px-4 lg:py-4 lg:bg-white lg:rounded-xl lg:shadow-sm lg:border lg:border-gray-100 space-y-4 lg:max-h-[calc(100vh-5rem)] lg:overflow-y-auto">

                <!-- Header Card Internal (HANYA TAMPIL DI DESKTOP) -->
                <div class="hidden lg:flex items-center justify-between pb-3 border-b border-gray-100">
                    <div>
                        <h2 class="text-sm font-bold text-gray-900">Listing Properti</h2>
                        <p class="text-[11px] text-gray-400">Total {{ $estates->total() }} unit</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button @click="$dispatch('open-search-modal')"
                            class="p-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-semibold rounded-md transition"
                            title="Filter Lanjutan">
                            🔍 Filter
                        </button>
                        @if ($search || $transaction_type || $city_id || $max_price || $location)
                            <button wire:click="resetFilter"
                                class="text-xs font-bold text-red-500 hover:underline">Reset</button>
                        @endif
                    </div>
                </div>

                <!-- Stream List Properti -->
                <x-layouts.home.home-feed-listing :estates="$estates" variant="vertical" />
            </div>

            <!-- 2. RIGHT COLUMN: Wide Preview (Desktop Only) -->
            <div class="hidden lg:block lg:col-span-8 xl:col-span-9 lg:sticky lg:top-6 bg-white rounded-xl shadow-sm border border-gray-100 p-6 xl:p-8 lg:min-h-[calc(100vh-5rem)] lg:max-h-[calc(100vh-5rem)] lg:overflow-y-auto">
                @if ($selectedEstate)
                    <!-- Top Action Bar Preview -->
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-100" x-data="{ copied: false }">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">
                                Pratinjau Langsung
                            </span>
                            <span class="text-xs text-gray-400">| ID: #{{ $selectedEstate->id }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="button"
                                @click="navigator.clipboard.writeText('{{ route('estates.show', $selectedEstate->slug) }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg transition">
                                <span x-text="copied ? '✓ Tersalin' : '📋 Salin Link'"></span>
                            </button>

                            <a href="{{ route('estates.show', $selectedEstate->slug) }}"
                                target="_blank"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                                <span>↗ Buka Tab Baru</span>
                            </a>
                        </div>
                    </div>

                    <livewire:pages.estates.estate-show :estate="$selectedEstate" :key="'estate-show-' . $selectedEstate->id" />
                @else
                    <div class="h-full flex flex-col items-center justify-center text-center py-24 text-gray-400 space-y-3">
                        <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center text-3xl">🏡</div>
                        <p class="text-sm font-medium">Pilih salah satu properti di daftar sebelah kiri<br>untuk menampilkan detail lengkapnya.</p>
                    </div>
                @endif
            </div>

        </div>

        <!-- Advanced Search Modal (Shared) -->
        <x-layouts.home.home-feed-search-advanced :transaction_type="$transaction_type" :cities="[]" :districts="[]" />
    </div>
</div>
