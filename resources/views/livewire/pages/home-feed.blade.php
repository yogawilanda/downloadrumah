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

<div class="min-h-screen bg-gray-100 flex justify-center items-center md:py-6" x-data="{ openSearchModal: false }"
    @open-search-modal.window="openSearchModal = true">

    {{-- Frame Container Mobile vs Desktop Container --}}
    <div
        class="w-full max-w-md bg-white min-h-screen md:min-h-[844px] md:max-h-[90vh] md:rounded-2xl md:shadow-2xl md:border md:border-gray-200 relative overflow-y-auto pb-6">

        <!-- Navigation Bar Top -->
        <div wire:key="top-nav-wrapper">
            <x-layouts.home.top-nav :transaction_type="$transaction_type" :search="$search" :city="$city" :max_price="$max_price"
                :city_id="$city_id" :cities="$cities" :suggestions="$suggestions" />
        </div>

        <!-- Main Feed Content Area -->
        <div class="space-y-5 pt-2">

            <x-layouts.home.discovery-intent />

            <!-- Active Search Chips (Isolated with wire:key) -->
            <div wire:key="home-chips-{{ md5($search . $city_id . $max_price . ($district_id ?? '')) }}">
                <x-layouts.home.home-feed-search-chips :max_price="$max_price" :location="$location" :search="$search"
                    :city_id="$city_id" :district_id="$district_id ?? ''" />
            </div>

            <!-- Carousel Sections -->
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

        <!-- Advanced Filter Modal -->
        <div wire:key="search-advanced-modal-wrapper">
            <x-layouts.home.home-feed-search-advanced :transaction_type="$transaction_type" :cities="$cities" :districts="$districts ?? []" />
        </div>

    </div>
</div>
