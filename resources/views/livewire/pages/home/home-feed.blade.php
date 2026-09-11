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

    {{-- Main Container Card --}}
    <div class="w-full max-w-md md:max-w-3xl lg:max-w-6xl mx-auto min-h-screen md:min-h-0 md:rounded-md relative pb-24 md:pb-12 bg-white border border-gray-100/80 shadow-sm">

        {{-- Content Area --}}
        <div class="space-y-6 md:space-y-8 p-5 md:p-8 pt-4 md:pt-6">

            {{-- Hero Text & Guided Discovery Header --}}
            <div class="mb-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3">
                    <div class="space-y-1">
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Bingung cari hunian yang pas dengan kantong?</h2>
                        <p class="text-sm text-gray-600">Simulasikan kebutuhanmu dulu, atau langsung cari properti di bawah.</p>
                    </div>

                    {{-- Secondary CTA: Pemilik Iklan --}}
                    <a href="{{ auth()->check() ? route('estates.create') : route('login') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 px-3 py-2 rounded-lg transition shrink-0">
                        <span>Pemilik Properti? Simpan dan gunakan alat ukur kami Gratis</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Interactive Discovery Card (Feature Banner) --}}
                <div class="p-4 bg-blue-600 rounded-md text-white shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="space-y-1 text-center sm:text-left">
                        <div class="inline-block px-2 py-0.5 bg-white/20 text-[10px] font-bold tracking-wider uppercase rounded-full">Kuisioner Singkat</div>
                        <h3 class="font-bold text-base">Bantu Aku Pilih Tempat Tinggal</h3>
                        <p class="text-xs text-indigo-100">Hitung budget, simulasi tabungan, dan dapatkan rekomendasi kos/rumah yang sesuai kemampuanmu.</p>
                    </div>
                    <button @click="$dispatch('open-analysis-modal')" class="w-full sm:w-auto px-4 py-2.5 bg-white text-blue-600 font-bold text-xs rounded-lg shadow hover:bg-indigo-50 transition whitespace-nowrap">
                        Mulai Analisa (1 Menit)
                    </button>
                </div>
            </div>

            {{-- Livewire Hero Search Widget Mandiri --}}
            @livewire(\App\Livewire\Pages\Home\DiscoveryIntent::class)

            <div wire:key="recent-estates-wrapper">
                <x-layouts.home.home-feed-section title="Properti Terbaru" subtitle="Listing aktif yang baru masuk" :estates="$recentEstates" />
            </div>

            <div wire:key="recommended-estates-wrapper">
                <x-layouts.home.home-feed-section title="Rekomendasi" subtitle="Pilihan hunian populer untukmu" :estates="$recommendedEstates" />
            </div>

            <div id="js-promo-banner" wire:key="promo-banner-wrapper">
                <x-layouts.home.home-feed-banner />
            </div>

            <x-layouts.home.home-feed-ad-regist />

        </div>

        {{-- Modals Wrapper --}}
        <div wire:key="search-advanced-modal-wrapper">
            <x-layouts.home.home-feed-search-advanced :transaction_type="''" :cities="[]" :districts="[]" />
        </div>

        {{-- Modal Analisis Kebutuhan --}}
        <div wire:key="needs-analysis-modal-wrapper">
            @livewire(\App\Livewire\Pages\Home\NeedsAnalysisModal::class)
        </div>

    </div>
</div>
