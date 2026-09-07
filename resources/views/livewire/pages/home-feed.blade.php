{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/home-feed.blade.php
| @usage : Main Home Feed View Component for Property Discovery
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@section('has_custom_meta', true)

@push('meta')
    <!-- Open Graph Meta Khusus Halaman Beranda / Home -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title"
        content="{{ $search ? $search . ' - ' : '' }}{{ $city ? 'Properti di ' . $city . ' - ' : '' }}DownloadRumah">
    <meta property="og:description"
        content="Cari properti {{ $city ? 'di ' . $city : '' }}{{ $max_price ? ' hingga Rp' . number_format((float) $max_price, 0, ',', '.') : '' }} di DownloadRumah.">
    <meta property="og:image" content="{{ asset('favicon.png') }}?v=20260905">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
@endpush

<div class="min-h-screen bg-gray-100 flex justify-center items-start" x-data="{ openSearchModal: false }"
    @open-search-modal.window="openSearchModal = true">

    <div
        class="w-full max-w-md bg-white min-h-screen md:min-h-[844px] md:shadow-xl md:border md:border-gray-200 relative overflow-hidden pb-6">

        <!-- Navigation Bar Top -->
        <x-layouts.home.top-nav :transaction_type="$transaction_type" :search="$search" :city="$city" :max_price="$max_price"
            :city_id="$city_id" :cities="$cities" :suggestions="$suggestions" />

        <!-- Main Feed Content Area -->
        <div class="space-y-5 pt-2">

            <x-layouts.home.discovery-intent />

            <!-- Active Search Chips -->
            <x-layouts.home.home-feed-search-chips :max_price="$max_price" :location="$location" :search="$search"
                :city_id="$city_id" :district_id="$district_id ?? ''" />

            <!-- Carousel Sections -->
            <x-layouts.home.home-feed-section title="Properti Terbaru" subtitle="Listing aktif yang baru masuk"
                :estates="$recentEstates" />

            <x-layouts.home.home-feed-section title="Rekomendasi" subtitle="Pilihan hunian untuk pencarianmu"
                :estates="$recommendedEstates" />

            <div id="js-promo-banner">
                <x-layouts.home.home-feed-banner />
            </div>

            <x-layouts.home.home-feed-ad-regist />

        </div>

        <!-- Advanced Filter Modal -->
        <x-layouts.home.home-feed-search-advanced :transaction_type="$transaction_type" :cities="$cities" :districts="$districts ?? []" />

    </div>
</div>
