{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path   : resources/views/livewire/pages/estates/public-listing.blade.php
| @usage  : publicly display list of registered estate regardless authed or not
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

<div class="min-h-screen bg-gray-100 flex justify-center items-start" x-data="{ openSearchModal: false }"
    @open-search-modal.window="openSearchModal = true">
    <div class="w-full max-w-md min-h-screen bg-white relative pb-2">

        <header class="px-4 pt-5 pb-2">
            <p class="text-[11px] font-semibold uppercase tracking-wider text-blue-600">Temukan hunian</p>
            <h1 class="text-xl font-black text-gray-900">Listing Properti</h1>
            <p class="text-xs text-gray-500 mt-1">Pilih rumah yang paling cocok untuk kebutuhanmu.</p>
        </header>

        <div class="px-4">
            <x-layouts.home.home-feed-search-chips :max_price="$max_price" :location="$location" :search="$search"
                :city_id="$city_id" :district_id="$district_id" />
        </div>

        <div class="px-4 pt-4 flex items-center justify-between">
            <h2 class="text-sm font-bold text-gray-900">Properti terbaru</h2>
            @if ($search || $transaction_type || $city_id || $max_price || $location)
                <button wire:click="resetFilter" class="text-xs font-bold text-blue-600">Reset filter</button>
            @endif
        </div>

        <x-layouts.home.home-feed-listing :estates="$estates" variant="vertical" />
        <x-layouts.home.home-feed-search-advanced :transaction_type="$transaction_type" :cities="[]" :districts="[]" />
    </div>
</div>
