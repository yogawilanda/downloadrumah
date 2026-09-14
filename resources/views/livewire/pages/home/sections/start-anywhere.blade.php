{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/home/sections/start-anywhere.blade.php
| @usage            : DownloadRumah Home Feed — Flexible Discovery Entry Points
| @type             : Home Feed Narrative Section
| @layout           : components.layouts.app
|
| @expected_data    : []
| @expected_events  : []
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Visitors do not need a fully defined property intent to begin exploring.
| @ruling_ui        : Three equal entry points; no promotional marketplace framing.
| @ruling_motion    : Static layout; no continuous animation.
| @ruling_responsive: Mobile-first; cards stack on small screens.
| @ruling_performance : CSS-only presentation; no additional JS or network requests.
|
| @status           : Active
| @author           : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<x-layouts.structural-section class="bg-slate-100">

    <div class="py-12 sm:py-16 lg:py-20">

        <div class="border border-slate-300 bg-white">

            {{-- Header -------------------------------------------------- --}}

            <div class="border-b border-slate-300 px-5 py-8 sm:px-7 md:px-9 md:py-10">

                <div class="max-w-2xl">

                    <div class="mb-3 flex items-center gap-2">

                        <span class="h-px w-6 bg-sky-500"></span>

                        <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                            Mulai dari mana saja
                        </p>

                    </div>

                    <h2 class="text-2xl font-black leading-[1.08] tracking-tight text-slate-950 sm:text-3xl md:text-4xl">
                        Tidak harus sudah tahu semuanya.
                    </h2>

                    <p class="mt-4 max-w-xl text-sm leading-6 text-slate-500 md:text-base md:leading-7">
                        Kamu bisa mulai dari hal yang sudah kamu tahu,
                        atau sekadar melihat-lihat sampai menemukan sesuatu
                        yang terasa relevan.
                    </p>

                </div>

            </div>

            {{-- Entry Points ------------------------------------------ --}}

            <div class="grid md:grid-cols-3">

                {{-- Location ------------------------------------------- --}}

                <div class="border-b border-slate-300 p-6 sm:p-8 md:border-b-0 md:border-r">

                    <div class="mb-8 flex items-center justify-between">

                        <span class="text-[10px] font-bold tracking-[0.16em] text-sky-600">
                            01
                        </span>

                        <span class="h-2 w-2 bg-sky-500"></span>

                    </div>

                    <h3 class="text-base font-bold text-slate-900">
                        Saya tahu lokasinya
                    </h3>

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Mulai dari kota atau area yang ingin kamu tinggali,
                        lalu lihat apa yang tersedia di sekitarnya.
                    </p>

                </div>

                {{-- Need ------------------------------------------------ --}}

                <div class="border-b border-slate-300 p-6 sm:p-8 md:border-b-0 md:border-r">

                    <div class="mb-8 flex items-center justify-between">

                        <span class="text-[10px] font-bold tracking-[0.16em] text-sky-600">
                            02
                        </span>

                        <span class="h-2 w-2 border border-slate-400 bg-white"></span>

                    </div>

                    <h3 class="text-base font-bold text-slate-900">
                        Saya tahu kebutuhannya
                    </h3>

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Mulai dari jenis tempat, kondisi, atau tujuan
                        yang sedang kamu cari.
                    </p>

                </div>

                {{-- Explore -------------------------------------------- --}}

                <div class="p-6 sm:p-8">

                    <div class="mb-8 flex items-center justify-between">

                        <span class="text-[10px] font-bold tracking-[0.16em] text-sky-600">
                            03
                        </span>

                        <span class="h-2 w-2 bg-slate-300"></span>

                    </div>

                    <h3 class="text-base font-bold text-slate-900">
                        Saya ingin melihat dulu
                    </h3>

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Tidak masalah. Jelajahi beberapa pilihan
                        sampai kamu mulai tahu apa yang masuk akal.
                    </p>

                </div>

            </div>

            {{-- Closing statement ------------------------------------- --}}

            <div class="border-t border-slate-300 bg-slate-50 px-5 py-5 sm:px-7 md:px-9">

                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                    <p class="text-xs font-semibold text-slate-600">
                        Mulai dari apa yang kamu tahu. Sisanya bisa dipahami sambil berjalan.
                    </p>

                    <span class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">
                        Explore → Understand → Decide
                    </span>

                </div>

            </div>

        </div>

    </div>

</x-layouts.structural-section>
