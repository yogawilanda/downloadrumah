{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/components/layouts/home/search-standby.blade.php
| @usage            : Initial discovery suggestions shown before search input reaches result threshold
| @type             : Blade Partial
| @expected_data    : [$popularCities]
| @expected_events  : [selectCitySuggestion]
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Standby state should invite exploration without behaving like a marketplace
|                     recommendation module.
| @ruling_ui        : Square geometry, restrained hierarchy, structural markers and no badges.
| @ruling_motion    : Short 150–200ms interaction transitions only.
|
| @status           : Active
| @author           : yogawilanda <eayogwilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div class="p-4 sm:p-5">

    {{-- Context Header --}}

    <div class="mb-3 flex items-center justify-between gap-4">

        <div class="flex items-center gap-2">

            <span class="h-1.5 w-1.5 bg-sky-500"></span>

            <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                Mulai dari kota
            </p>

        </div>

        <span class="hidden text-[10px] font-medium text-slate-400 sm:block">
            Pilih untuk menjelajah
        </span>

    </div>


    {{-- Popular Cities --}}

    <div class="space-y-1">

        @forelse ($popularCities as $pCity)

            <button
                type="button"
                wire:click="selectCitySuggestion('{{ $pCity->name }}')"
                @click="searchOpen = false"
                class="group flex w-full items-center justify-between border border-transparent px-3 py-2.5 text-left transition-colors duration-150 hover:border-sky-200 hover:bg-sky-50 dark:hover:border-sky-900 dark:hover:bg-slate-800/70"
            >

                <div class="flex min-w-0 items-center gap-3">

                    <span
                        class="h-1.5 w-1.5 shrink-0 bg-slate-300 transition-colors duration-150 group-hover:bg-sky-500 dark:bg-slate-600"
                        aria-hidden="true"
                    ></span>

                    <span class="truncate text-xs font-semibold text-slate-700 transition-colors duration-150 group-hover:text-sky-700 dark:text-slate-200 dark:group-hover:text-sky-400">
                        {{ $pCity->name }}
                    </span>

                </div>

                <span
                    class="ml-4 shrink-0 text-[10px] font-semibold text-slate-300 transition-colors duration-150 group-hover:text-sky-500 dark:text-slate-600 dark:group-hover:text-sky-400"
                >
                    Jelajah →
                </span>

            </button>

        @empty

            {{-- Standby Loading Fallback --}}

            @for ($i = 0; $i < 3; $i++)

                <div class="flex items-center justify-between border border-slate-100 px-3 py-2.5 dark:border-slate-800">

                    <div class="h-2.5 w-28 bg-slate-100 animate-pulse dark:bg-slate-800"></div>

                    <div class="h-2.5 w-12 bg-slate-100 animate-pulse dark:bg-slate-800"></div>

                </div>

            @endfor

        @endforelse

    </div>

</div> 
