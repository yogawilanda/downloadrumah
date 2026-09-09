{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path   : resources/views/livewire/pages/home-feed.blade.php
| @usage  : Optimized Home Feed view with enhanced spacing & desktop responsiveness
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="w-full min-h-screen bg-slate-100/60 py-0 md:py-6" x-data="{ openSearchModal: false }" @open-search-modal.window="openSearchModal = true">

    {{-- Main Container Card --}}
    <div
        class="w-full max-w-md md:max-w-3xl lg:max-w-6xl mx-auto min-h-screen md:min-h-0 bg-white md:rounded-3xl md:border md:border-gray-200/80 md:shadow-sm overflow-hidden relative pb-24 md:pb-12">

        {{-- 1. Top Navbar --}}
        <div wire:key="top-nav-wrapper" class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-gray-100/80">
            <x-layouts.home.top-nav :transaction_type="$transaction_type" :search="$search" :city="$city" :max_price="$max_price"
                :city_id="$city_id" :cities="$cities" :suggestions="$suggestions" />
        </div>

        {{-- 2. Content Area (Responsive Spacing: space-y-6 di HP, space-y-8 di Desktop) --}}
        <div class="space-y-6 md:space-y-8 px-4 md:px-8 pt-4 md:pt-6">

            <x-layouts.home.discovery-intent />

            <div wire:key="home-chips-{{ md5($search . $city_id . $max_price . ($district_id ?? '')) }}">
                <x-layouts.home.home-feed-search-chips :max_price="$max_price" :location="$location" :search="$search"
                    :city_id="$city_id" :district_id="$district_id ?? ''" />
            </div>

            <div wire:key="recent-estates-wrapper">
                <x-layouts.home.home-feed-section title="Properti Terbaru" subtitle="Listing aktif yang baru masuk"
                    :estates="$recentEstates" />
            </div>

            <div wire:key="recommended-estates-wrapper">
                <x-layouts.home.home-feed-section title="Rekomendasi" subtitle="Pilihan hunian untuk pencarianmu"
                    :estates="$recommendedEstates" />
            </div>

            <div id="js-promo-banner" wire:key="promo-banner-wrapper">
                <x-layouts.home.home-feed-banner />
            </div>

            <x-layouts.home.home-feed-ad-regist />

        </div>

        <div wire:key="search-advanced-modal-wrapper">
            <x-layouts.home.home-feed-search-advanced :transaction_type="$transaction_type" :cities="$cities" :districts="$districts ?? []" />
        </div>

    </div>
</div>
