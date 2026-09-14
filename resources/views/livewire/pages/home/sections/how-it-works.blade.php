{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/home/sections/how-it-works.blade.php
| @usage            : DownloadRumah Home Feed — Product Mechanism & Guided Discovery Flow
| @type             : Home Feed Narrative Section
| @layout           : components.layouts.app
|
| @expected_data    : []
| @expected_events  : []
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Explain DownloadRumah's role between user intent and property conversation.
| @ruling_ui        : Four-step guided flow; no marketplace-style promotional cards.
| @ruling_motion    : Static layout; no continuous animation.
| @ruling_responsive: Mobile-first; steps stack on small screens.
| @ruling_performance : CSS-only presentation; no additional JS or network requests.
|
| @status           : Active
| @author           : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<x-layouts.structural-section class="bg-slate-100">

    <div class="py-12 sm:py-16 lg:py-20">

        <div class="border border-slate-300 bg-white">

            {{-- Section Header ----------------------------------------- --}}

            <div class="border-b border-slate-300 px-5 py-8 sm:px-7 md:px-9 md:py-10">

                <div class="max-w-2xl">

                    <div class="mb-3 flex items-center gap-2">

                        <span class="h-px w-6 bg-sky-500"></span>

                        <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                            Cara DownloadRumah bekerja
                        </p>

                    </div>

                    <h2 class="text-2xl font-black leading-[1.08] tracking-tight text-slate-950 sm:text-3xl md:text-4xl">
                        Bukan sekadar menemukan properti.
                    </h2>

                    <p class="mt-4 max-w-xl text-sm leading-6 text-slate-500 md:text-base md:leading-7">
                        Kami membantu mempersempit pilihan berdasarkan apa yang
                        sebenarnya kamu butuhkan, sampai kamu tahu langkah berikutnya.
                    </p>

                </div>

            </div>

            {{-- Guided Flow ------------------------------------------- --}}

            <div class="grid md:grid-cols-2 lg:grid-cols-4">

                {{-- Step 01 --}}

                <div class="relative border-b border-slate-300 p-5 sm:p-7 lg:border-b-0 lg:border-r">

                    <div class="mb-8 flex items-center justify-between">

                        <span class="text-[10px] font-bold tracking-[0.16em] text-sky-600">
                            01
                        </span>

                        <span class="h-2 w-2 bg-sky-500"></span>

                    </div>

                    <h3 class="text-base font-bold text-slate-900">
                        Tentukan maksudmu
                    </h3>

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Tidak harus tahu nama properti.
                        Mulai dari lokasi, kebutuhan, atau apa yang sedang kamu cari.
                    </p>

                </div>

                {{-- Step 02 --}}

                <div class="relative border-b border-slate-300 p-5 sm:p-7 lg:border-b-0 lg:border-r">

                    <div class="mb-8 flex items-center justify-between">

                        <span class="text-[10px] font-bold tracking-[0.16em] text-sky-600">
                            02
                        </span>

                        <span class="h-2 w-2 border border-slate-400 bg-white"></span>

                    </div>

                    <h3 class="text-base font-bold text-slate-900">
                        Pahami pilihan
                    </h3>

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Lihat properti dalam konteks kebutuhanmu,
                        bukan hanya sebagai daftar hasil pencarian.
                    </p>

                </div>

                {{-- Step 03 --}}

                <div class="relative border-b border-slate-300 p-5 sm:p-7 lg:border-b-0 lg:border-r">

                    <div class="mb-8 flex items-center justify-between">

                        <span class="text-[10px] font-bold tracking-[0.16em] text-sky-600">
                            03
                        </span>

                        <span class="h-2 w-2 bg-slate-300"></span>

                    </div>

                    <h3 class="text-base font-bold text-slate-900">
                        Temukan pihak yang relevan
                    </h3>

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Ketika sebuah pilihan mulai masuk akal,
                        pahami siapa yang bisa membantu menjawab pertanyaanmu.
                    </p>

                </div>

                {{-- Step 04 --}}

                <div class="relative p-5 sm:p-7">

                    <div class="mb-8 flex items-center justify-between">

                        <span class="text-[10px] font-bold tracking-[0.16em] text-sky-600">
                            04
                        </span>

                        <span class="h-2 w-2 bg-sky-400"></span>

                    </div>

                    <h3 class="text-base font-bold text-slate-900">
                        Mulai percakapan
                    </h3>

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Setelah pilihannya terasa relevan,
                        kamu bisa menentukan apakah perlu melanjutkan.
                    </p>

                </div>

            </div>

            {{-- Flow Footer ------------------------------------------- --}}

            <div class="border-t border-slate-300 bg-slate-50 px-5 py-4 sm:px-7 md:px-9">

                <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">

                    <span>Intent</span>

                    <span class="text-sky-500">→</span>

                    <span>Understand</span>

                    <span class="text-sky-500">→</span>

                    <span>Match</span>

                    <span class="text-sky-500">→</span>

                    <span>Conversation</span>

                </div>

            </div>

        </div>

    </div>

</x-layouts.structural-section>
