{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path   : resources/views/livewire/pages/estates/public-listing.blade.php
| @usage  : Public listing page with full-width sticky filter bar
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

<div class="min-h-screen bg-gray-50/50 pb-12" x-data="{ openSearchModal: false }" @open-search-modal.window="openSearchModal = true">

    <!-- 1. FULL-WIDTH STICKY FILTER BAR (Membentang Penuh 100% Layar) -->
    <div class="sticky top-0 z-30 w-full bg-white backdrop-blur-md border-b border-gray-200/80 py-3 mb-6 px-4 sm:px-6 lg:px-8 shadow-sm">
        <div class="w-full max-w-6xl mx-auto space-y-2 px-4 sm:px-6 lg:px-8">
            @livewire(\App\Livewire\Pages\Home\DiscoveryIntent::class, ['variant' => 'compact'])

            <!-- Quick Active Filter Chips -->
            <div class="hidden md:block pt-1">
                <x-layouts.home.home-feed-search-chips :max_price="$max_price" :location="$location" :search="$search"
                    :city_id="$city_id" :district_id="$district_id" />
            </div>
        </div>
    </div>

    <!-- 2. MAIN FEED CONTAINER -->
    <main class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Title & Counter Header -->
        <div class="flex items-end justify-between pb-3 border-b border-gray-200/60 mb-6">
            <div class="space-y-0.5">
                <h1 class="text-base sm:text-xl font-black text-gray-900 tracking-tight">
                    {{ $search ? 'Hasil Pencarian: "' . $search . '"' : ($city ? 'Properti di ' . $city : 'Properti Terbaru') }}
                </h1>
                <p class="text-xs text-gray-400">Pilih unit yang sesuai dengan preferensi Anda</p>
            </div>

            <div class="flex items-center gap-3">
                @if ($search || $transaction_type || $city_id || $max_price || $location)
                    <button wire:click="resetFilter"
                        class="text-xs font-bold text-red-500 hover:text-red-600 hover:underline transition">
                        Reset Filter
                    </button>
                @endif

                <span
                    class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-full border border-gray-200/50">
                    {{ $estates->total() }} Unit
                </span>
            </div>
        </div>

        <!-- Listing Items -->
        <x-layouts.home.home-feed-listing :estates="$estates" variant="vertical" />
    </main>

    <!-- Advanced Search Modal (Shared) -->
    <x-layouts.home.home-feed-search-advanced :transaction_type="$transaction_type" :cities="[]" :districts="[]" />
</div>
