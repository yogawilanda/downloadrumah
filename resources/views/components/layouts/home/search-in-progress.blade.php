{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/components/layouts/home/search-in-progress.blade.php
| @usage            : Loading skeleton for contextual search suggestions
| @type             : Blade Partial
| @expected_data    : []
| @expected_events  : []
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Skeleton mirrors the actual search suggestion hierarchy without
|                     introducing card-like visual noise.
| @ruling_ui        : Square geometry, restrained slate tones, structural dividers.
| @ruling_motion    : Pulse animation is functional loading feedback only.
| @ruling_performance : CSS-only loading feedback with no additional JavaScript.
|
| @status           : Active
| @author           : yogawilanda <eayogwilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div
    wire:loading
    wire:target="search, selectCitySuggestion"
    class="w-full"
>

    {{-- Location Skeleton --}}

    <div class="border-b border-slate-200 dark:border-slate-800 p-4 sm:p-5">

        <div class="mb-3 flex items-center gap-2">

            <span class="h-1.5 w-1.5 bg-slate-200 dark:bg-slate-700 animate-pulse"></span>

            <div class="h-2.5 w-16 bg-slate-200 dark:bg-slate-700 animate-pulse"></div>

        </div>

        <div class="space-y-1">

            @for ($i = 0; $i < 2; $i++)

                <div class="flex items-center gap-3 border border-transparent px-3 py-2.5">

                    <div class="h-1.5 w-1.5 shrink-0 bg-slate-200 dark:bg-slate-700 animate-pulse"></div>

                    <div class="h-2.5 w-28 bg-slate-100 dark:bg-slate-800 animate-pulse"></div>

                </div>

            @endfor

        </div>

    </div>


    {{-- Property Skeleton --}}

    <div class="p-4 sm:p-5">

        <div class="mb-3 flex items-center justify-between">

            <div class="flex items-center gap-2">

                <span class="h-1.5 w-1.5 bg-slate-200 dark:bg-slate-700 animate-pulse"></span>

                <div class="h-2.5 w-20 bg-slate-200 dark:bg-slate-700 animate-pulse"></div>

            </div>

            <div class="h-2.5 w-20 bg-slate-100 dark:bg-slate-800 animate-pulse"></div>

        </div>

        <div class="flex items-center gap-3 border border-transparent px-2.5 py-2.5">

            <div class="h-10 w-10 shrink-0 border border-slate-200 bg-slate-100 animate-pulse
                        dark:border-slate-700 dark:bg-slate-800"></div>

            <div class="min-w-0 flex-1 space-y-2">

                <div class="h-3 w-3/4 bg-slate-100 dark:bg-slate-800 animate-pulse"></div>

                <div class="h-2.5 w-1/4 bg-slate-100 dark:bg-slate-800 animate-pulse"></div>

            </div>

        </div>

    </div>

</div>
