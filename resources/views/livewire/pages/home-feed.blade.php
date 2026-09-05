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
    <meta property="og:title" content="DownloadRumah - Cari & Temukan Hunian Impianmu">
    <meta property="og:description"
        content="Platform mobile-first pencarian properti, simulasi KPR presisi, dan konsultasi properti cepat & transparan.">
    <meta property="og:image" content="{{ asset('favicon.png') }}?v=20260905">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
@endpush

<div class="min-h-screen bg-gray-100 flex justify-center items-start" x-data="{ openSearchModal: false }"
    @open-search-modal.window="openSearchModal = true">

    <div
        class="w-full max-w-md bg-white min-h-screen md:min-h-[844px] md:shadow-xl md:border md:border-gray-200 relative overflow-hidden pb-20">

        <!-- Navigation Bar Top (Mengirim data cities untuk dropdown lokasi) -->
        <x-layouts.home.top-nav
            :transaction_type="$transaction_type"
            :search="$search"
            :city_id="$city_id"
            :cities="$cities ?? []" />

        <!-- Main Feed Content Area -->
        <div class="space-y-5 pt-2">

            <!-- 1. Banner Pasang Iklan -->
            <div class="px-4">
                <div class="flex items-center justify-between rounded-2xl p-4 text-blue shadow-md">
                    <div class="space-y-0.5">
                        <p class="text-[14px] font-medium text-slate-800">Punya Properti?</p>
                        <h3 class="text-xs font-bold text-blue-600">Jual atau Sewakan Propertimu</h3>
                        <p class="text-[10px] text-slate-600">Pasang iklan gratis hanya dalam 2 menit.</p>
                    </div>
                    <a href="{{ route('estates.create') }}" wire:navigate
                        class="shrink-0 rounded-xl bg-blue-600 px-3 py-2 text-xs font-semibold text-white shadow-sm transition active:scale-95 hover:bg-blue-500">
                        + Pasang Iklan
                    </a>
                </div>
            </div>

            <!-- 2. Promo Banner -->
            <div id="js-promo-banner">
                <x-layouts.home.home-feed-banner />
            </div>

            <!-- 3. Active Search Chips (Ditambahkan district_id) -->
            <x-layouts.home.home-feed-search-chips
                :max_price="$max_price"
                :location="$location"
                :search="$search"
                :city_id="$city_id"
                :district_id="$district_id ?? ''" />

            <!-- 4. Section Header -->
            <div class="px-4 flex items-center justify-between pt-1">
                <div>
                    <h2 class="text-base font-bold text-gray-800 leading-tight">Rekomendasi Properti</h2>
                    <p class="text-xs text-gray-500">Pilihan hunian terbaik berdasarkan pencarianmu</p>
                </div>
                <a href="{{ route('listings.index') }}" wire:navigate
                    class="text-xs font-bold text-blue-600 hover:text-blue-700 active:scale-95 transition-all py-1 px-2 rounded-lg hover:bg-blue-50">
                    Lihat Semua
                </a>
            </div>

            <!-- 5. Feed Property Cards -->
            <div id="js-listing-container">
                <x-layouts.home.home-feed-listing :estates="$estates" />
            </div>

        </div>

        <!-- 6. Advanced Filter Modal (Passing parameter lokasi) -->
        <x-layouts.home.home-feed-search-advanced
            :transaction_type="$transaction_type"
            :cities="$cities ?? []"
            :districts="$districts ?? []" />

    </div>
</div>
