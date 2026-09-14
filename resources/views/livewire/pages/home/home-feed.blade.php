{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/home/home-feed.blade.php
| @usage            : DownloadRumah Home Feed — Primary Discovery & Property Exploration Surface
| @type             : Root Livewire Page View (Stateful Container & Orchestrator)
| @layout           : components.layouts.app
|
| @expected_data    : [$recentEstates, $recommendedEstates]
| @expected_events  : [open-search-modal]
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
| @seo_context      : Public Home Feed
|
| @ruling           : Structural visual pass before component extraction.
| @ruling_ui        : Mobile-first. Strong section boundaries. Restrained rounding.
| @ruling_modal     : Pure UI state uses Alpine.js. Livewire remains responsible for stateful content.
| @ruling_motion    : Snappy transitions only. No continuous decorative animation.
| @ruling_performance : Preserve LCP priority. Avoid unnecessary visual layers and eager media.
|
| @status           : Facelift — Visual Pass 4
| @author           : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div x-data="{ openSearchModal: false }" @open-search-modal.window="openSearchModal = true"
    class="relative w-full overflow-hidden bg-slate-100">

    {{-- =================================================================
         GLOBAL STRUCTURAL FIELD
         ================================================================= --}}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 z-0 overflow-hidden">

        {{-- Primary vertical rails --}}
        <div class="home-rail absolute inset-y-0 left-[4%] w-px sm:left-[6%] lg:left-[8%]"></div>
        <div class="home-rail absolute inset-y-0 right-[4%] w-px sm:right-[6%] lg:right-[8%]"></div>

        {{-- Inner desktop rails --}}
        <div class="home-rail-light absolute inset-y-0 left-[16%] hidden w-px lg:block"></div>
        <div class="home-rail-light absolute inset-y-0 right-[16%] hidden w-px lg:block"></div>

        {{-- Horizontal construction rails --}}
        <div class="home-rail-light absolute inset-x-0 top-[8%] h-px"></div>
        <div class="home-rail-light absolute inset-x-0 top-[27%] h-px"></div>
        <div class="home-rail-light absolute inset-x-0 top-[51%] h-px"></div>
        <div class="home-rail-light absolute inset-x-0 top-[74%] h-px"></div>
        <div class="home-rail-light absolute inset-x-0 bottom-[7%] h-px"></div>

        {{-- Main dot field --}}
        <div
            class="home-dot-field absolute right-[2%] top-[-30px] h-[460px] w-[460px] opacity-70 sm:right-[6%] lg:right-[10%]">
        </div>

        {{-- Secondary dot field --}}
        <div
            class="home-dot-field-small absolute bottom-[6%] left-[1%] h-[300px] w-[360px] opacity-60 sm:left-[5%] lg:left-[11%]">
        </div>

        {{-- Structural markers --}}
        <span class="absolute left-[4%] top-[8%] h-2 w-2 bg-sky-500 sm:left-[6%] lg:left-[8%]"></span>

        <span
            class="absolute right-[4%] top-[27%] h-2 w-2 border border-slate-400 bg-white sm:right-[6%] lg:right-[8%]"></span>

        <span
            class="absolute left-[4%] top-[51%] h-2 w-2 border border-slate-300 bg-slate-100 sm:left-[6%] lg:left-[8%]"></span>

        <span class="absolute right-[4%] top-[74%] h-2 w-2 bg-sky-400 sm:right-[6%] lg:right-[8%]"></span>
    </div>


    {{-- =================================================================
         CONTENT
         ================================================================= --}}
    <div class="relative z-10">


        {{-- =============================================================
             HERO / DISCOVERY
             ============================================================= --}}
        <section class="border-b border-slate-300 bg-white">

            <div class="mx-auto max-w-6xl
 px-4 sm:px-6 lg:px-8">

                <div class="border-x border-slate-300">

                    <div
                        class="grid min-h-[540px] items-center px-5 py-14 sm:px-8 md:px-12 md:py-20 lg:grid-cols-[0.9fr_1.1fr] lg:gap-16 lg:px-14">

                        {{-- Hero copy --}}
                        <div class="max-w-xl">

                            <div
                                class="mb-5 flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-sky-600">
                                <span class="h-1.5 w-1.5 bg-sky-500"></span>
                                DownloadRumah
                            </div>

                            <h1
                                class="max-w-lg text-[2.4rem] font-black leading-[1.01] tracking-[-0.045em] text-slate-950 sm:text-5xl lg:text-[3.6rem]">
                                Temukan tempat yang masuk akal untukmu.
                            </h1>

                            <p class="mt-5 max-w-md text-base font-medium leading-7 text-slate-600 lg:text-lg">
                                Lihat apa yang tersedia, pahami pilihannya, lalu tentukan langkah berikutnya.
                            </p>

                            <div class="mt-8 border-l-2 border-sky-500 pl-4">
                                <p class="max-w-sm text-xs font-semibold leading-5 text-slate-500">
                                    Tidak harus langsung tahu apa yang dicari.
                                    Mulai dari apa yang terasa menarik.
                                </p>
                            </div>

                        </div>


                        {{-- Discovery surface --}}
                        <div class="mt-10 lg:mt-0">

                            <div
                                class="border border-slate-300 bg-slate-50 p-1.5 shadow-[8px_8px_0_0_rgba(15,23,42,0.05)]">

                                @livewire(\App\Livewire\Pages\Home\DiscoveryIntent::class)

                            </div>

                            <div class="mt-3 flex items-center gap-2 text-[10px] font-medium text-slate-400">
                                <span class="h-px w-6 bg-slate-300"></span>
                                Mulai dari lokasi, kebutuhan, atau sekadar lihat-lihat.
                            </div>

                        </div>

                    </div>


                    {{-- Hero footer rail --}}
                    <div class="grid border-t border-slate-300 bg-slate-50 sm:grid-cols-2">

                        <div
                            class="border-b border-slate-200 px-5 py-3.5 sm:border-b-0 sm:border-r sm:px-8 md:px-12 lg:px-14">
                            <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                                Explore
                            </span>
                        </div>

                        <div class="flex items-center justify-between gap-3 px-5 py-3.5 sm:px-8 md:px-12 lg:px-14">

                            <span class="text-md font-medium text-slate-400">
                                Punya properti?
                            </span>

                            <a href="{{ auth()->check() ? route('estates.create') : route('login') }}"
                                class="text-[11px] font-bold text-sky-700 transition-colors duration-150 hover:text-sky-900">
                                Tambahkan properti →
                            </a>

                        </div>

                    </div>

                </div>
            </div>
        </section>


        {{-- =============================================================
             RECENT DISCOVERY
             ============================================================= --}}
        <section class="bg-slate-100">

            <div class="mx-auto max-w-6xl
 px-4 py-10 sm:px-6 sm:py-14 lg:px-8 lg:py-20">

                <div class="border border-slate-300 bg-white shadow-[6px_6px_0_0_rgba(15,23,42,0.025)]">

                    <div
                        class="flex flex-col gap-4 border-b border-slate-300 px-5 py-5 sm:flex-row sm:items-end sm:justify-between sm:px-7 md:px-9">

                        <div>

                            <div class="mb-2 flex items-center gap-2">
                                <span class="h-px w-6 bg-sky-500"></span>

                                <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                                    Baru ditemukan
                                </p>
                            </div>

                            <h2 class="text-2xl font-black tracking-tight text-slate-950 md:text-3xl">
                                Properti yang baru hadir
                            </h2>

                        </div>

                        <a href="{{ route('listings.index') }}"
                            class="text-xs font-bold text-sky-700 transition-colors duration-150 hover:text-sky-900">
                            Lihat semua →
                        </a>

                    </div>

                    <div class="px-5 py-6 sm:px-7 md:px-9 md:py-9">

                        <div wire:key="recent-estates-wrapper">
                            <x.layouts.home.home-feed-section title="" subtitle="" :estates="$recentEstates" />
                        </div>

                    </div>

                </div>
            </div>
        </section>


        {{-- =============================================================
             STRUCTURAL PAUSE
             ============================================================= --}}
        <section class="border-y border-slate-300 bg-white">

            <div class="mx-auto max-w-6xl
 px-4 sm:px-6 lg:px-8">

                <div class="border-x border-slate-300">

                    <div class="grid md:grid-cols-[1.3fr_0.7fr]">

                        <div
                            class="relative min-h-[280px] overflow-hidden px-5 py-12 sm:px-8 md:px-12 md:flex md:items-center md:py-16">

                            {{-- Local geometry --}}
                            <div class="absolute bottom-0 left-0 h-32 w-48 opacity-60">
                                <div class="home-dot-field-small h-full w-full"></div>
                            </div>

                            <div class="relative max-w-xl">

                                <div
                                    class="mb-3 flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.18em] text-sky-600">
                                    <span class="h-1.5 w-1.5 bg-sky-500"></span>
                                    Jangan buru-buru memilih
                                </div>

                                <h2
                                    class="text-2xl font-black leading-[1.08] tracking-tight text-slate-950 sm:text-3xl md:text-4xl">
                                    Yang terlihat menarik belum tentu cocok.
                                </h2>

                                <p class="mt-4 max-w-lg text-sm leading-6 text-slate-500 md:text-base">
                                    Kenali pilihanmu lebih dulu sebelum menentukan siapa yang perlu kamu hubungi.
                                </p>

                            </div>

                        </div>


                        {{-- Geometric side --}}
                        <div class="relative hidden overflow-hidden border-l border-slate-300 bg-slate-50 md:block">

                            <div class="absolute inset-0">
                                <div class="home-dot-field h-full w-full opacity-30"></div>
                            </div>

                            <div
                                class="absolute left-1/2 top-1/2 h-28 w-28 -translate-x-1/2 -translate-y-1/2 border border-slate-300">

                                <div class="absolute -bottom-4 -right-4 h-28 w-28 border border-sky-300 bg-white"></div>

                                <div class="absolute left-0 top-7 h-px w-16 bg-sky-500"></div>

                                <div class="absolute bottom-0 right-7 h-16 w-px bg-slate-300"></div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>


        {{-- =============================================================
             RECOMMENDATIONS
             ============================================================= --}}
        <section class="bg-slate-100">

            <div class="mx-auto max-w-6xl
 px-4 py-10 sm:px-6 sm:py-14 lg:px-8 lg:py-20">

                <div class="border border-slate-300 bg-white shadow-[6px_6px_0_0_rgba(15,23,42,0.025)]">

                    <div class="relative border-b border-slate-300 px-5 py-6 sm:px-7 md:px-9">

                        <div class="absolute right-0 top-0 hidden h-full w-48 overflow-hidden sm:block">
                            <div class="home-dot-field-small h-full w-full opacity-35"></div>
                        </div>

                        <div class="relative">

                            <div class="mb-2 flex items-center gap-2">
                                <span class="h-px w-6 bg-sky-500"></span>

                                <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                                    Untuk dipertimbangkan
                                </p>
                            </div>

                            <h2 class="text-2xl font-black tracking-tight text-slate-950 md:text-3xl">
                                Mungkin ada yang menarik perhatianmu
                            </h2>

                        </div>

                    </div>

                    <div class="px-5 py-6 sm:px-7 md:px-9 md:py-9">

                        <div wire:key="recommended-estates-wrapper">
                            <x.layouts.home.home-feed-section title="" subtitle=""
                                :estates="$recommendedEstates" />
                        </div>

                    </div>

                </div>
            </div>
        </section>


        {{-- =============================================================
             NEXT STEP
             ============================================================= --}}
        <section class="border-y border-slate-300 bg-white">

            <div class="mx-auto max-w-6xl
 px-4 sm:px-6 lg:px-8">

                <div class="border-x border-slate-300">

                    <div class="relative overflow-hidden px-5 py-14 sm:px-8 md:px-12 md:py-18">

                        <div class="home-dot-field absolute -right-16 bottom-[-80px] h-[300px] w-[420px] opacity-45"
                            aria-hidden="true"></div>

                        <div class="relative grid gap-10 md:grid-cols-[1fr_auto] md:items-center">

                            <div class="max-w-xl">

                                <div
                                    class="mb-3 flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.18em] text-sky-600">
                                    <span class="h-1.5 w-1.5 bg-sky-500"></span>
                                    Langkah berikutnya
                                </div>

                                <h2
                                    class="text-2xl font-black leading-[1.08] tracking-tight text-slate-950 md:text-3xl">
                                    Sudah menemukan sesuatu yang ingin kamu pahami lebih jauh?
                                </h2>

                                <p class="mt-4 max-w-lg text-sm leading-6 text-slate-500">
                                    Mulai dari properti yang menarik perhatianmu.
                                    Sisanya bisa kamu tentukan setelahnya.
                                </p>

                            </div>

                            <a href="{{ route('listings.index') }}"
                                class="inline-flex w-full items-center justify-center border border-slate-300 bg-white px-6 py-3.5 text-xs font-bold text-slate-800 shadow-[5px_5px_0_0_rgba(15,23,42,0.06)] transition duration-150 hover:border-slate-400 hover:shadow-[2px_2px_0_0_rgba(15,23,42,0.06)] md:w-auto">
                                Jelajahi properti
                                <span class="ml-2">→</span>
                            </a>

                        </div>

                    </div>

                </div>
            </div>
        </section>


        {{-- =============================================================
             PROMOTION
             ============================================================= --}}
        <section class="bg-slate-100">

            <div class="mx-auto max-w-6xl
 px-4 py-8 sm:px-6 md:py-12 lg:px-8">

                <div id="js-promo-banner" wire:key="promo-banner-wrapper"
                    class="border border-slate-300 bg-white p-5 sm:p-7 md:p-9">
                    <x.layouts.home.home-feed-banner />
                </div>

            </div>
        </section>


        {{-- =============================================================
             OWNER ACQUISITION
             ============================================================= --}}
        <section class="border-t border-slate-300 bg-slate-50">

            <div class="mx-auto max-w-6xl
 px-4 py-8 sm:px-6 md:py-10 lg:px-8">

                <div class="border border-slate-300 bg-white">
                    <x.layouts.home.home-feed-ad-regist />
                </div>

            </div>

        </section>


        {{-- =============================================================
             MODALS
             ============================================================= --}}
        <div wire:key="search-advanced-modal-wrapper">
            <x.layouts.home.home-feed-search-advanced :transaction_type="''" :cities="[]"
                :districts="[]" />
        </div>

        <div wire:key="needs-analysis-modal-wrapper">
            @livewire(\App\Livewire\Pages\Home\NeedsAnalysisModal::class)
        </div>

    </div>
</div>
