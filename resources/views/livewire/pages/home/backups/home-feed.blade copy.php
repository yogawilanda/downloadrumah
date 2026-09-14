{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path   : resources/views/livewire/pages/home/home-feed.blade.php
| @usage  : Property Hub, Planning, Price Check & Private Matchmaking Feed
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="w-full min-h-screen py-0 md:py-6"
     x-data="{
        openSearchModal: false,
        activeTab: 'all' // all, sewa, beli, kos, jasa
     }"
     @open-search-modal.window="openSearchModal = true">

    {{-- Main Container Card --}}
    <div class="w-full max-w-md md:max-w-3xl lg:max-w-6xl mx-auto min-h-screen md:min-h-0 md:rounded-2xl relative pb-24 md:pb-12 bg-white border border-gray-100/80 shadow-sm overflow-hidden">

        {{-- Top Notification / Privacy Guarantee Badge --}}
        <div class="bg-slate-900 text-white px-4 py-2.5 text-xs text-center flex items-center justify-center gap-2">
            <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span><strong>Privasi Terjamin:</strong> Hubungi pemilik & simulasi budget tanpa membagikan nomor telepon publikmu.</span>
        </div>

        {{-- Content Area --}}
        <div class="space-y-8 p-5 md:p-8 pt-6">

            {{-- 1. Hero Header & Quick Action Hub --}}
            <div class="space-y-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-gray-100 pb-6">
                    <div class="space-y-2 max-w-2xl">
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-sky-50 text-blue-700 text-xs font-bold tracking-wide uppercase">
                            Platform Perencanaan & Matchmaking Properti
                        </div>
                        <h1 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight leading-snug">
                            Cari Hunian, Cek Pasaran Harga, atau Rencanakan Dulu Secara Privat.
                        </h1>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Bisa simulasi budget, periksa kewajaran harga sewa/beli, hingga diskusi langsung dengan pemilik tanpa takut di-spam.
                        </p>
                    </div>

                    {{-- Secondary CTA: Pemilik / Provider --}}
                    <div class="flex flex-col sm:flex-row gap-2 shrink-0">
                        <a href="#" class="inline-flex items-center justify-center gap-2 text-xs font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2.5 rounded-xl transition">
                            <span>Pasang Listing / Jasa</span>
                        </a>
                        <button @click="$dispatch('open-analysis-modal')" class="inline-flex items-center justify-center gap-2 text-xs font-bold text-white bg-sky-600 hover:bg-sky-700 px-4 py-2.5 rounded-xl shadow-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            <span>Simulasi Budget</span>
                        </button>
                    </div>
                </div>

                {{-- 2. User Intent Cards (Pilih Jalur Masuk) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    {{-- Card 1: Perencanaan & Simulasi --}}
                    <div @click="$dispatch('open-analysis-modal')" class="p-5 rounded-2xl border border-blue-100 bg-gradient-to-br from-blue-50/50 to-indigo-50/30 hover:border-blue-300 transition cursor-pointer group relative overflow-hidden">
                        <div class="w-10 h-10 rounded-xl bg-sky-600 text-white flex items-center justify-center mb-3 shadow-md shadow-blue-500/20 group-hover:scale-105 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-sm group-hover:text-blue-600 transition">Kalkulator & Planner</h3>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Hitung kemampuan bayar, simulasi tabungan, & kriteria hunian idealmu.</p>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-600 mt-3">
                            Hitung Sekarang &rarr;
                        </span>
                    </div>

                    {{-- Card 2: Cek Pasaran & Transparansi Harga --}}
                    <div @click="openSearchModal = true" class="p-5 rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-50/50 to-teal-50/30 hover:border-emerald-300 transition cursor-pointer group">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center mb-3 shadow-md shadow-emerald-500/20 group-hover:scale-105 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-sm group-hover:text-emerald-600 transition">Cek Pasaran Harga</h3>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Bandingkan harga sewa/jual per area biar nggak kena markup berlebihan.</p>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600 mt-3">
                            Eksplor Data Harga &rarr;
                        </span>
                    </div>

                    {{-- Card 3: Komunikasi & Negosiasi Privat --}}
                    <div class="p-5 rounded-2xl border border-amber-100 bg-gradient-to-br from-amber-50/50 to-orange-50/30 hover:border-amber-300 transition cursor-pointer group">
                        <div class="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center mb-3 shadow-md shadow-amber-500/20 group-hover:scale-105 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-sm group-hover:text-amber-600 transition">Tanya / Nego Privat</h3>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Kirim permintaan kustom langsung ke pemilik tanpa umbar identitas.</p>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-amber-600 mt-3">
                            Mulai Diskusi &rarr;
                        </span>
                    </div>

                    {{-- Card 4: Forum & Insight Komunitas --}}
                    <a href="#" class="p-5 rounded-2xl border border-purple-100 bg-gradient-to-br from-purple-50/50 to-fuchsia-50/30 hover:border-purple-300 transition group block">
                        <div class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center mb-3 shadow-md shadow-purple-500/20 group-hover:scale-105 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-sm group-hover:text-purple-600 transition">Forum & Review Lingkungan</h3>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Tanya keamanannya, bebas banjir atau enggak dari warga/penghuni asli.</p>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-purple-600 mt-3">
                            Baca Komunitas &rarr;
                        </span>
                    </a>

                </div>
            </div>

            {{-- 3. Agnostic Category Quick Filters --}}
            <div class="space-y-3 pt-2">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-gray-900">Jelajahi Berdasarkan Kebutuhan:</h3>
                    <button @click="openSearchModal = true" class="text-xs font-semibold text-blue-600 hover:underline">Filter Lanjutan</button>
                </div>
                <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none text-xs font-semibold">
                    <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-xl transition whitespace-nowrap">
                        Semua Kategori
                    </button>
                    <button @click="activeTab = 'sewa'" :class="activeTab === 'sewa' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-xl transition whitespace-nowrap">
                        Sewa Rumah / Apt
                    </button>
                    <button @click="activeTab = 'kos'" :class="activeTab === 'kos' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-xl transition whitespace-nowrap">
                        Kos & Kontrakan
                    </button>
                    <button @click="activeTab = 'jual'" :class="activeTab === 'jual' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-xl transition whitespace-nowrap">
                        Jual / Beli Property
                    </button>
                    <button @click="activeTab = 'ruko'" :class="activeTab === 'ruko' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-xl transition whitespace-nowrap">
                        Komersial / Ruko
                    </button>
                    <button @click="activeTab = 'jasa'" :class="activeTab === 'jasa' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'" class="px-4 py-2 rounded-xl transition whitespace-nowrap">
                        Jasa Pendukung (Pindahan/Interior)
                    </button>
                </div>
            </div>

            {{-- 4. Widget Search Mandiri --}}
            @livewire(\App\Livewire\Pages\Home\DiscoveryIntent::class)

            {{-- 5. Dynamic Feed Sections --}}
            <div wire:key="recent-estates-wrapper" class="space-y-4">
                <x-layouts.home.home-feed-section
                    title="Penawaran & Listing Terbaru"
                    subtitle="Listing rumah, kos, ruko, dan layanan properti terverifikasi"
                    :estates="$recentEstates"
                />
            </div>

            <div wire:key="recommended-estates-wrapper" class="space-y-4">
                <x-layouts.home.home-feed-section
                    title="Rekomendasi Sesuai Simulasi Budget"
                    subtitle="Properti yang masuk dalam batas aman rencana keuanganmu"
                    :estates="$recommendedEstates"
                />
            </div>

            {{-- Promo / Interactive Calculator Banner --}}
            <div id="js-promo-banner" wire:key="promo-banner-wrapper">
                <x-layouts.home.home-feed-banner />
            </div>

            {{-- Registration CTA for Property Owners & Service Providers --}}
            <x-layouts.home.home-feed-ad-regist />

        </div>

        {{-- Modals Wrapper --}}
        <div wire:key="search-advanced-modal-wrapper">
            <x-layouts.home.home-feed-search-advanced :transaction_type="''" :cities="[]" :districts="[]" />
        </div>

        <div wire:key="needs-analysis-modal-wrapper">
            @livewire(\App\Livewire\Pages\Home\NeedsAnalysisModal::class)
        </div>

    </div>
</div>
