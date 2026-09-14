{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/home/sections/property-professional.blade.php
| @usage            : DownloadRumah Home Feed — Property & Professional Relationship
| @type             : Home Feed Narrative Section
| @layout           : components.layouts.app
|
| @expected_data    : []
| @expected_events  : []
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Explain that a property and the person behind it are part of the same decision.
| @ruling_ui        : Relationship-focused composition; avoid directory / marketplace presentation.
| @ruling_motion    : Static layout; no continuous animation.
| @ruling_responsive: Mobile-first; columns stack naturally.
| @ruling_performance : CSS-only presentation; no additional JS or network requests.
|
| @status           : Active
| @author           : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<x-layouts.structural-section framed class="border-y border-slate-300 bg-white">

    <div class="grid md:grid-cols-[0.85fr_1.15fr]">

        {{-- Narrative --------------------------------------------------- --}}

        <div class="relative overflow-hidden px-5 py-12 sm:px-8 md:px-12 md:py-16">

            <div class="structural-dot-field-small absolute -bottom-12 -left-10 h-56 w-64 opacity-30" aria-hidden="true">
            </div>

            <div class="relative max-w-md">

                <div class="mb-4 flex items-center gap-2">

                    <span class="h-1.5 w-1.5 bg-sky-500"></span>

                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-sky-600">
                        Lebih dari sekadar listing
                    </p>

                </div>

                <h2 class="text-2xl font-black leading-[1.08] tracking-tight text-slate-950 sm:text-3xl">
                    Properti hanyalah satu bagian dari keputusan.
                </h2>

                <p class="mt-5 text-sm leading-6 text-slate-500 md:text-base md:leading-7">
                    Ketika sebuah pilihan mulai terasa cocok,
                    ada hal lain yang perlu dipahami:
                    <span class="font-semibold text-slate-700">
                        siapa yang bisa membantu menjawab pertanyaanmu.
                    </span>
                </p>

            </div>

        </div>

        {{-- Relationship Map ----------------------------------------- --}}

        <div class="border-t border-slate-300 bg-slate-50 md:border-l md:border-t-0">

            <div class="grid sm:grid-cols-2">

                {{-- Property ------------------------------------------- --}}

                <div class="border-b border-slate-300 p-6 sm:border-b-0 sm:border-r sm:p-8">

                    <div class="mb-7 flex items-center justify-between">

                        <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                            Property
                        </span>

                        <span class="h-2 w-2 bg-sky-500"></span>

                    </div>

                    <h3 class="text-base font-bold text-slate-900">
                        Apa yang tersedia?
                    </h3>

                    <div class="mt-5 space-y-3">

                        <div class="flex items-center gap-3 border-t border-slate-200 pt-3">
                            <span class="h-1 w-1 bg-slate-400"></span>
                            <span class="text-xs text-slate-600">Lokasi</span>
                        </div>

                        <div class="flex items-center gap-3 border-t border-slate-200 pt-3">
                            <span class="h-1 w-1 bg-slate-400"></span>
                            <span class="text-xs text-slate-600">Harga & kondisi</span>
                        </div>

                        <div class="flex items-center gap-3 border-t border-slate-200 pt-3">
                            <span class="h-1 w-1 bg-slate-400"></span>
                            <span class="text-xs text-slate-600">Detail properti</span>
                        </div>

                    </div>

                </div>

                {{-- Professional -------------------------------------- --}}

                <div class="p-6 sm:p-8">

                    <div class="mb-7 flex items-center justify-between">

                        <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                            Professional
                        </span>

                        <span class="h-2 w-2 border border-slate-400 bg-white"></span>

                    </div>

                    <h3 class="text-base font-bold text-slate-900">
                        Siapa yang bisa membantu?
                    </h3>

                    <div class="mt-5 space-y-3">

                        <div class="flex items-center gap-3 border-t border-slate-200 pt-3">
                            <span class="h-1 w-1 bg-slate-400"></span>
                            <span class="text-xs text-slate-600">Pemilik</span>
                        </div>

                        <div class="flex items-center gap-3 border-t border-slate-200 pt-3">
                            <span class="h-1 w-1 bg-slate-400"></span>
                            <span class="text-xs text-slate-600">Agen / marketing</span>
                        </div>

                        <div class="flex items-center gap-3 border-t border-slate-200 pt-3">
                            <span class="h-1 w-1 bg-slate-400"></span>
                            <span class="text-xs text-slate-600">Pihak terkait</span>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Conversation ------------------------------------------ --}}

            <div class="border-t border-slate-300 bg-white px-6 py-5 sm:px-8">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">
                            Di tengahnya
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            Percakapan yang punya konteks.
                        </p>

                    </div>

                    <div class="text-[10px] font-bold uppercase tracking-[0.12em] text-sky-600">
                        Property <span class="mx-1 text-slate-300">↔</span> Professional
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-layouts.structural-section>
