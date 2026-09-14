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
| @ruling           : Structural page composition. Modularize child surfaces after visual approval.
| @ruling_ui        : Mobile-first. Strong section boundaries. Restrained rounding.
| @ruling_modal     : Pure UI state uses Alpine.js. Livewire remains responsible for stateful content.
| @ruling_motion    : Snappy transitions only. No continuous decorative animation.
| @ruling_performance : Preserve LCP priority. Avoid unnecessary visual layers and eager media.
|
| @status           : Facelift — Visual Pass 3
| @author           : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div
    x-data="{ openSearchModal: false }"
    @open-search-modal.window="openSearchModal = true"
    class="w-full overflow-hidden bg-slate-100"
>

    {{-- ================================================================
         HERO
         ================================================================ --}}
    <section class="relative border-b border-slate-300 bg-white">

        <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
            <div class="absolute inset-x-0 top-0 h-px bg-slate-300"></div>
            <div class="absolute inset-y-0 left-[6%] w-px bg-slate-200"></div>
            <div class="absolute inset-y-0 right-[6%] w-px bg-slate-200"></div>

            <div
                class="home-dot-field absolute -right-20 -top-16 h-[330px] w-[330px] opacity-60 sm:-right-8 md:right-[7%] md:top-0"
            ></div>

            <div class="absolute left-[6%] right-[6%] top-[42%] h-px bg-slate-100"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="border-x border-slate-200">

                <div class="grid min-h-[520px] items-center px-5 py-14 sm:px-8 md:px-12 md:py-20 lg:grid-cols-[1fr_1.15fr] lg:gap-12 lg:px-14">

                    <div class="relative z-10 max-w-xl">

                        <div class="mb-5 flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-sky-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                            DownloadRumah
                        </div>

                        <h1 class="max-w-lg text-[2.35rem] font-black leading-[1.02] tracking-[-0.04em] text-slate-950 sm:text-5xl lg:text-[3.5rem]">
                            Temukan tempat yang masuk akal untukmu.
                        </h1>

                        <p class="mt-5 max-w-md text-base font-medium leading-7 text-slate-600 lg:text-lg">
                            Lihat apa yang tersedia, pahami pilihannya, lalu tentukan langkah berikutnya.
                        </p>

                        <div class="mt-8 hidden border-l-2 border-sky-500 pl-4 sm:block">
                            <p class="text-xs font-semibold leading-5 text-slate-500">
                                Tidak harus langsung tahu apa yang dicari.
                                Mulai dari apa yang terasa menarik.
                            </p>
                        </div>
                    </div>

                    <div class="relative z-10 mt-10 lg:mt-0">
                        <div class="border border-slate-300 bg-slate-50 p-1 shadow-[8px_8px_0_0_rgba(15,23,42,0.04)] sm:p-1.5">
                            @livewire(\App\Livewire\Pages\Home\DiscoveryIntent::class)
                        </div>
                    </div>

                </div>

                <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 bg-slate-50 px-5 py-3.5 sm:px-8 md:px-12 lg:px-14">
                    <span class="text-[11px] font-medium text-slate-400">
                        Punya properti untuk dikenalkan?
                    </span>

                    <a
                        href="{{ auth()->check() ? route('estates.create') : route('login') }}"
                        class="text-[11px] font-bold text-sky-700 transition-colors duration-150 hover:text-sky-900"
                    >
                        Tambahkan properti →
                    </a>
                </div>

            </div>
        </div>
    </section>


    {{-- ================================================================
         RECENT PROPERTIES
         ================================================================ --}}
    <section class="bg-slate-100">

        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-16">

            <div class="border border-slate-200 bg-white">

                <div class="flex flex-col gap-4 border-b border-slate-200 px-5 py-5 sm:flex-row sm:items-end sm:justify-between sm:px-7 md:px-9">

                    <div>
                        <div class="mb-2 flex items-center gap-2">
                            <span class="h-px w-5 bg-sky-500"></span>
                            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                                Baru ditemukan
                            </p>
                        </div>

                        <h2 class="text-2xl font-black tracking-tight text-slate-950 md:text-3xl">
                            Properti yang baru hadir
                        </h2>
                    </div>

                    <a
                        href="{{ route('listings.index') }}"
                        class="text-xs font-bold text-sky-700 transition-colors duration-150 hover:text-sky-900"
                    >
                        Lihat semua →
                    </a>
                </div>

                <div class="px-5 py-6 sm:px-7 md:px-9 md:py-8">
                    <div wire:key="recent-estates-wrapper">
                        <x-layouts.home.home-feed-section
                            title=""
                            subtitle=""
                            :estates="$recentEstates"
                        />
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ================================================================
         VALUE TRANSITION
         ================================================================ --}}
    <section class="border-y border-slate-300 bg-white">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="border-x border-slate-200">

                <div class="grid md:grid-cols-[1.4fr_0.6fr]">

                    <div class="relative overflow-hidden px-5 py-12 sm:px-8 md:px-12 md:py-16">

                        <div
                            class="home-dot-field-soft pointer-events-none absolute bottom-0 left-0 h-32 w-72 opacity-70"
                            aria-hidden="true"
                        ></div>

                        <div class="relative max-w-2xl">

                            <div class="mb-3 flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.18em] text-sky-600">
                                <span class="h-1.5 w-1.5 bg-sky-500"></span>
                                Jangan buru-buru memilih
                            </div>

                            <h2 class="max-w-xl text-2xl font-black leading-[1.08] tracking-tight text-slate-950 sm:text-3xl md:text-4xl">
                                Yang terlihat menarik belum tentu cocok.
                            </h2>

                            <p class="mt-4 max-w-lg text-sm leading-6 text-slate-500 md:text-base">
                                Kenali pilihanmu lebih dulu sebelum menentukan siapa yang perlu kamu hubungi.
                            </p>
                        </div>
                    </div>

                    <div class="hidden border-l border-slate-200 bg-slate-50 md:flex md:items-center md:justify-center">
                        <div class="relative h-28 w-28 border border-slate-300">
                            <div class="absolute -bottom-3 -right-3 h-28 w-28 border border-sky-200 bg-white"></div>
                            <div class="absolute -left-px top-7 h-px w-14 bg-sky-500"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{-- ================================================================
         RECOMMENDATIONS
         ================================================================ --}}
    <section class="bg-slate-100">

        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-16">

            <div class="border border-slate-200 bg-white">

                <div class="border-b border-slate-200 px-5 py-5 sm:px-7 md:px-9">

                    <div class="mb-2 flex items-center gap-2">
                        <span class="h-px w-5 bg-sky-500"></span>
                        <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                            Untuk dipertimbangkan
                        </p>
                    </div>

                    <h2 class="text-2xl font-black tracking-tight text-slate-950 md:text-3xl">
                        Mungkin ada yang menarik perhatianmu
                    </h2>

                </div>

                <div class="px-5 py-6 sm:px-7 md:px-9 md:py-8">
                    <div wire:key="recommended-estates-wrapper">
                        <x-layouts.home.home-feed-section
                            title=""
                            subtitle=""
                            :estates="$recommendedEstates"
                        />
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ================================================================
         NEXT STEP
         ================================================================ --}}
    <section class="border-y border-slate-300 bg-white">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="border-x border-slate-200">

                <div class="relative overflow-hidden px-5 py-12 sm:px-8 md:px-12 md:py-16">

                    <div
                        class="home-dot-field pointer-events-none absolute -right-12 bottom-0 h-52 w-72 opacity-35"
                        aria-hidden="true"
                    ></div>

                    <div class="relative grid gap-8 md:grid-cols-[1fr_auto] md:items-center">

                        <div class="max-w-xl">

                            <div class="mb-3 flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.18em] text-sky-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                                Langkah berikutnya
                            </div>

                            <h2 class="text-2xl font-black leading-[1.08] tracking-tight text-slate-950 md:text-3xl">
                                Sudah menemukan sesuatu yang ingin kamu pahami lebih jauh?
                            </h2>

                            <p class="mt-4 text-sm leading-6 text-slate-500">
                                Mulai dari properti yang menarik perhatianmu. Sisanya bisa kamu tentukan setelahnya.
                            </p>

                        </div>

                        <a
                            href="{{ route('listings.index') }}"
                            class="relative inline-flex w-full items-center justify-center border border-slate-300 bg-white px-6 py-3.5 text-xs font-bold text-slate-800 shadow-[4px_4px_0_0_rgba(15,23,42,0.06)] transition duration-150 hover:border-slate-400 hover:shadow-[2px_2px_0_0_rgba(15,23,42,0.06)] md:w-auto"
                        >
                            Jelajahi properti
                            <span class="ml-2">→</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ================================================================
         PROMOTION
         ================================================================ --}}
    <section class="bg-slate-100">

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 md:py-10 lg:px-8">

            <div class="border border-slate-200 bg-white p-5 sm:p-7 md:p-9">
                <div
                    id="js-promo-banner"
                    wire:key="promo-banner-wrapper"
                >
                    <x-layouts.home.home-feed-banner />
                </div>
            </div>

        </div>
    </section>


    {{-- ================================================================
         OWNER ACQUISITION
         ================================================================ --}}
    <section class="border-t border-slate-300 bg-slate-50">

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 md:py-10 lg:px-8">

            <div class="border border-slate-200 bg-white">
                <x-layouts.home.home-feed-ad-regist />
            </div>

        </div>
    </section>


    {{-- ================================================================
         MODALS
         ================================================================ --}}
    <div wire:key="search-advanced-modal-wrapper">
        <x-layouts.home.home-feed-search-advanced
            :transaction_type="''"
            :cities="[]"
            :districts="[]"
        />
    </div>

    <div wire:key="needs-analysis-modal-wrapper">
        @livewire(\App\Livewire\Pages\Home\NeedsAnalysisModal::class)
    </div>

</div>
