{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path   : resources/views/livewire/pages/home/home-feed.blade.php
| @usage  : Optimized Home Feed view with enhanced spacing & desktop responsiveness
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="w-full min-h-screen py-0 md:py-6" x-data="{ openSearchModal: false }" @open-search-modal.window="openSearchModal = true">

    {{-- Main Container Card (Tanpa overflow-hidden agar dropdown melayang bebas) --}}
    <div
        class="w-full max-w-md md:max-w-3xl lg:max-w-6xl mx-auto min-h-screen md:min-h-0 md:rounded-3xl relative pb-24 md:pb-12 bg-white border border-gray-100/80 shadow-sm">

        {{-- Content Area --}}
        <div class="space-y-6 md:space-y-8 px-4 md:px-8 pt-4 md:pt-6">

            {{-- Livewire Hero Search Widget Mandiri --}}
            @livewire(\App\Livewire\Pages\Home\DiscoveryIntent::class)

            <div wire:key="recent-estates-wrapper">
                <x-layouts.home.home-feed-section title="Properti Terbaru" subtitle="Listing aktif yang baru masuk"
                    :estates="$recentEstates" />
            </div>

            <div wire:key="recommended-estates-wrapper">
                <x-layouts.home.home-feed-section title="Rekomendasi" subtitle="Pilihan hunian populer untukmu"
                    :estates="$recommendedEstates" />
            </div>

            <div id="js-promo-banner" wire:key="promo-banner-wrapper">
                <x-layouts.home.home-feed-banner />
            </div>

            <x-layouts.home.home-feed-ad-regist />

        </div>

        <div wire:key="search-advanced-modal-wrapper">
            <x-layouts.home.home-feed-search-advanced :transaction_type="''" :cities="[]" :districts="[]" />
        </div>

    </div>
</div>
