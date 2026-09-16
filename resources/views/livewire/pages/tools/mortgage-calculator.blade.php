{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/tools/mortgage-calculator.blade.php
| @usage            : DownloadRumah KPR Planning — Mortgage Affordability & Installment Surface
| @type             : Livewire View Container
| @expected_data    : [kprApp state]
| @expected_events  : [mode switch, calculator interactions]
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : KPR is presented as a planning tool, not a generic financial calculator.
| @ruling_ui        : Structural geometry, restrained borders, hard surfaces, minimal rounding.
| @ruling_motion    : Short 150–200ms transitions only.
| @ruling_performance : Presentation-only refactor; calculation logic remains untouched.
|
| @status            : Active
| @author            : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div class="min-h-screen bg-slate-100 dark:bg-slate-950">

    <div
        x-data="kprApp"
        class="mx-auto w-full max-w-6xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12"
    >

        {{-- Page Context --}}

        <div class="mb-6 max-w-2xl">

            <div class="mb-3 flex items-center gap-2">

                <span class="h-1.5 w-1.5 bg-sky-500"></span>

                <span class="text-[10px] font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">
                    Perencanaan KPR
                </span>

            </div>

            <h1 class="text-2xl font-bold tracking-tight text-slate-950 dark:text-slate-100 sm:text-3xl">
                Rencanakan kemampuan beli
            </h1>

            <p class="mt-2 max-w-xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                Hitung kisaran kemampuanmu sebelum memilih properti atau melihat cicilan unit tertentu.
            </p>

        </div>


        {{-- Calculator Surface --}}

        <div class="border border-slate-300 bg-white dark:border-slate-800 dark:bg-slate-900">

            {{-- Mode Switcher --}}

            <div class="border-b border-slate-200 dark:border-slate-800">

                <div class="grid grid-cols-2">

                    <button
                        type="button"
                        @click="mode = 'buyer'"
                        :class="mode === 'buyer'
                            ? 'border-b-2 border-sky-500 bg-slate-50 text-slate-950 dark:bg-slate-800 dark:text-slate-100'
                            : 'text-slate-400 hover:bg-slate-50 hover:text-slate-700 dark:text-slate-500 dark:hover:bg-slate-800 dark:hover:text-slate-200'"
                        class="px-4 py-3 text-xs font-semibold transition-colors duration-150 sm:px-6"
                    >
                        Cari sesuai kemampuan
                    </button>

                    <button
                        type="button"
                        @click="mode = 'agent'"
                        :class="mode === 'agent'
                            ? 'border-b-2 border-sky-500 bg-slate-50 text-slate-950 dark:bg-slate-800 dark:text-slate-100'
                            : 'text-slate-400 hover:bg-slate-50 hover:text-slate-700 dark:text-slate-500 dark:hover:bg-slate-800 dark:hover:text-slate-200'"
                        class="border-l border-slate-200 px-4 py-3 text-xs font-semibold transition-colors duration-150 dark:border-slate-800 sm:px-6"
                    >
                        Hitung cicilan properti
                    </button>

                </div>

            </div>


            {{-- Mode Content --}}

            <div class="p-4 sm:p-6 lg:p-8">

                @include('livewire.pages.tools.extension.buyer')

                @include('livewire.pages.tools.extension.object')

            </div>

        </div>

    </div>

</div>
