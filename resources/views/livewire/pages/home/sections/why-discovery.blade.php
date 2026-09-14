{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
    | @path : resources/views/livewire/pages/home/sections/why-discovery.blade.php
    | @usage : DownloadRumah Home Feed — Discovery Problem & Decision Context
    | @type : Home Feed Narrative Section
    | @layout : components.layouts.app
    |
    | @expected_data : []
    | @expected_events : []
    | @techstack : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
    | @design_tokens : Font: Outfit | Theme: White / Slate / Sky Accent
    |
    | @ruling : Explain why property discovery requires more than attractive listings.
    | @ruling_ui : Structural narrative; avoid marketplace-style promotional cards.
    | @ruling_motion : Static layout; no continuous animation.
    | @ruling_responsive: Mobile-first; comparison grid collapses naturally.
    | @ruling_performance : CSS-only decorative elements; no additional requests or JS state.
    |
    | @status : Active
    | @author : yogawilanda <eayogawilanda@gmail.com>
        | </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<x-layouts.structural-section framed class="border-y border-slate-300 bg-white">

    <div class="grid md:grid-cols-[1.15fr_0.85fr]">

        {{-- Narrative --------------------------------------------------- --}}

        <div class="relative overflow-hidden px-5 py-14 sm:px-8 md:px-12 md:py-18">

            <div class="structural-dot-field-small absolute -bottom-16 -left-12 h-64 w-72 opacity-35"
                aria-hidden="true"></div>

            <div class="relative max-w-xl">

                <div class="mb-4 flex items-center gap-2">

                    <span class="h-1.5 w-1.5 bg-sky-500"></span>

                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-sky-600">
                        Sebelum memilih
                    </p>

                </div>

                <h2 class="text-2xl font-black leading-[1.08] tracking-tight text-slate-950 sm:text-3xl md:text-4xl">
                    Yang terlihat menarik belum tentu cocok.
                </h2>

                <p class="mt-5 max-w-lg text-sm leading-6 text-slate-500 md:text-base md:leading-7">
                    Foto yang bagus, harga yang masuk akal, atau lokasi yang sesuai
                    belum selalu menjawab pertanyaan yang sebenarnya:
                    <span class="font-semibold text-slate-700">
                        apakah tempat ini memang masuk akal untukmu?
                    </span>
                </p>

                <div class="mt-8 border-l-2 border-sky-500 pl-4">

                    <p class="text-xs font-semibold leading-5 text-slate-600">
                        Karena itu, menemukan properti bukan hanya tentang
                        menemukan lebih banyak pilihan.
                    </p>

                </div>

            </div>

        </div>

        {{-- Decision Context ------------------------------------------- --}}

        <div class="relative border-t border-slate-300 bg-slate-50 md:border-l md:border-t-0">

            <div class="absolute inset-0 opacity-40" aria-hidden="true">
                <div class="structural-dot-field h-full w-full"></div>
            </div>

            <div class="relative flex h-full flex-col justify-center px-5 py-10 sm:px-8 md:px-10 md:py-14">

                <div class="mb-6">

                    <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                        Yang perlu dipahami
                    </p>

                </div>

                <div class="space-y-0">

                    {{-- Context 01 --}}

                    <div class="border-t border-slate-300 py-4">

                        <div class="flex items-start gap-4">

                            <span class="pt-0.5 text-[10px] font-bold text-sky-600">
                                01
                            </span>

                            <div>

                                <h3 class="text-sm font-bold text-slate-800">
                                    Kebutuhan
                                </h3>

                                <p class="mt-1 text-xs leading-5 text-slate-500">
                                    Apa yang sebenarnya sedang kamu cari?
                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- Context 02 --}}

                    <div class="border-t border-slate-300 py-4">

                        <div class="flex items-start gap-4">

                            <span class="pt-0.5 text-[10px] font-bold text-sky-600">
                                02
                            </span>

                            <div>

                                <h3 class="text-sm font-bold text-slate-800">
                                    Pilihan
                                </h3>

                                <p class="mt-1 text-xs leading-5 text-slate-500">
                                    Mana yang benar-benar relevan dengan kebutuhanmu?
                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- Context 03 --}}

                    <div class="border-y border-slate-300 py-4">

                        <div class="flex items-start gap-4">

                            <span class="pt-0.5 text-[10px] font-bold text-sky-600">
                                03
                            </span>

                            <div>

                                <h3 class="text-sm font-bold text-slate-800">
                                    Percakapan
                                </h3>

                                <p class="mt-1 text-xs leading-5 text-slate-500">
                                    Siapa yang perlu kamu hubungi setelah menemukan pilihan?
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-layouts.structural-section>
