{{--
|--------------------------------------------------------------------------
| @path   : resources/views/livewire/pages/home/home-feed.blade.php
| @usage  : Property Hub, Planning, Price Check & Private Matchmaking Feed
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="w-full min-h-screen bg-white" x-data="{ openSearchModal: false, activeTab: 'all' }" @open-search-modal.window="openSearchModal = true">

    {{-- Main Container (Max 6xl & Anti-Collapse) --}}
    <div class="w-full max-w-6xl mx-auto pb-24 md:pb-12 overflow-x-hidden">

        <div class="p-5 md:p-8 pt-8 md:pt-12">

            {{-- 1. EDITORIAL HERO SECTION (Flexbox Layout) --}}
            <div class="flex flex-col lg:flex-row items-center gap-10 w-full relative z-10 pb-36 lg:pb-24">

                {{-- Kiri: Text Content --}}
                <div class="w-full lg:w-1/2 space-y-6">

                    <h1 class="text-5xl lg:text-7xl font-black tracking-tighter leading-[1.05] text-slate-900">
                        Marketplace <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-sky-600">Properti Privat</span><br/>
                        & Terpercaya.
                    </h1>

                    <p class="text-base text-slate-500 leading-relaxed font-medium max-w-md">
                        Simulasi budget realistis & negosiasi langsung tanpa takut nomor HP tersebar.
                    </p>
                </div>

                {{-- Kanan: Floating Images (Desktop Only) --}}
                <div class="hidden lg:block lg:w-1/2 relative h-[450px] w-full">
                    {{-- Card Beli --}}
                    <div class="absolute bottom-0 left-0 w-[400px] h-[360px] rounded-md overflow-hidden shadow-2xl z-20 border border-slate-200">
                        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-sky-900/20"></div>
                        <div class="absolute top-0 bottom-0 left-0 flex items-center">
                            <span class="text-[8rem] font-black text-white/70 tracking-tighter transform -rotate-90 origin-center">Beli</span>
                        </div>
                    </div>
                    {{-- Card Sewa --}}
                    <div class="absolute top-0 right-4 w-[280px] h-[320px] rounded-md overflow-hidden shadow-2xl z-10 border border-slate-200">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-slate-900/20"></div>
                        <span class="absolute top-4 left-6 text-6xl font-black text-white tracking-tighter">Sewa</span>
                    </div>
                </div>
            </div>

            {{-- Floating Search Bar --}}
            <div class="relative z-30 -mt-8 lg:-mt-20 w-full max-w-5xl mx-auto">
                <div class="bg-white rounded-md shadow-lg border border-slate-200 p-4 md:p-6">
                    @livewire(\App\Livewire\Pages\Home\DiscoveryIntent::class)
                </div>
            </div>

            {{-- 2. User Intent Action Hub --}}
            <div class="space-y-5 pt-12 lg:pt-20">
                <h2 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight">Pilih Alat Perencanaan:</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">

                    <div @click="$dispatch('open-analysis-modal')" class="p-6 rounded-md border border-slate-200 bg-white hover:border-sky-300 hover:shadow-md transition-all cursor-pointer group">
                        <div class="w-12 h-12 rounded-md bg-sky-600 text-white flex items-center justify-center mb-4 group-hover:-translate-y-1 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-900 text-lg group-hover:text-sky-600">Kalkulator Budget</h3>
                        <p class="text-sm text-slate-500 mt-2">Hitung kemampuan bayar sebelum mencari.</p>
                    </div>

                    <div @click="openSearchModal = true" class="p-6 rounded-md border border-slate-200 bg-white hover:border-sky-300 hover:shadow-md transition-all cursor-pointer group">
                        <div class="w-12 h-12 rounded-md bg-sky-700 text-white flex items-center justify-center mb-4 group-hover:-translate-y-1 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-900 text-lg group-hover:text-sky-700">Cek Pasaran Harga</h3>
                        <p class="text-sm text-slate-500 mt-2">Bandingkan harga sewa/jual per area.</p>
                    </div>

                    <div class="p-6 rounded-md border border-slate-200 bg-white hover:border-sky-300 hover:shadow-md transition-all cursor-pointer group">
                        <div class="w-12 h-12 rounded-md bg-sky-500 text-white flex items-center justify-center mb-4 group-hover:-translate-y-1 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-900 text-lg group-hover:text-sky-500">Tanya Pemilik</h3>
                        <p class="text-sm text-slate-500 mt-2">Permintaan langsung tanpa umbar identitas.</p>
                    </div>

                    <a href="#" class="p-6 rounded-md border border-slate-200 bg-white hover:border-sky-300 hover:shadow-md transition-all group block">
                        <div class="w-12 h-12 rounded-md bg-slate-800 text-white flex items-center justify-center mb-4 group-hover:-translate-y-1 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-900 text-lg group-hover:text-slate-800">Forum Review Area</h3>
                        <p class="text-sm text-slate-500 mt-2">Tanya keamanan & banjir ke warga asli.</p>
                    </a>
                </div>
            </div>

            {{-- 3. Agnostic Category Quick Filters --}}
            <div class="space-y-3 pt-8">
                <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none text-sm font-semibold">
                    <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="px-4 py-2 rounded-md transition whitespace-nowrap">Semua Kategori</button>
                    <button @click="activeTab = 'sewa'" :class="activeTab === 'sewa' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="px-4 py-2 rounded-md transition whitespace-nowrap">Sewa Rumah / Apt</button>
                    <button @click="activeTab = 'kos'" :class="activeTab === 'kos' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="px-4 py-2 rounded-md transition whitespace-nowrap">Kos & Kontrakan</button>
                </div>
            </div>

            {{-- 4. Dynamic Feed Sections --}}
            <div class="space-y-8 mt-6">
                <div wire:key="recent-estates-wrapper"><x-layouts.home.home-feed-section title="Penawaran & Listing Terbaru" subtitle="Terverifikasi" :estates="$recentEstates" /></div>
                <div wire:key="recommended-estates-wrapper"><x-layouts.home.home-feed-section title="Rekomendasi Simulasi Budget" subtitle="Batas aman" :estates="$recommendedEstates" /></div>
                <div id="js-promo-banner" wire:key="promo-banner-wrapper"><x-layouts.home.home-feed-banner /></div>
                <div><x-layouts.home.home-feed-ad-regist /></div>
            </div>

        </div>

        {{-- Modals Wrapper --}}
        <div wire:key="search-advanced-modal-wrapper"><x-layouts.home.home-feed-search-advanced :transaction_type="''" :cities="[]" :districts="[]" /></div>
        <div wire:key="needs-analysis-modal-wrapper">@livewire(\App\Livewire\Pages\Home\NeedsAnalysisModal::class)</div>

    </div>
</div>
