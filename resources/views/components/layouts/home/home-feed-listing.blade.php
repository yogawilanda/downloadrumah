{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/components/layouts/home/home-feed-listing.blade.php
| @usage            : Reusable property listing surface for carousel and public listing views
| @type             : Blade Component
| @expected_data    : [$estates, $variant]
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Listing surfaces prioritize property imagery, location, price, and essential specs.
| @ruling_ui        : Hard borders, restrained geometry, minimal rounding, no decorative card shadows.
| @ruling_motion    : Short 150–200ms transitions only.
| @ruling_performance : Preserve lazy loading for non-primary images and eager loading only where appropriate.
|
| @status            : Active
| @author            : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

@props([
    'estates',
    'variant' => 'carousel',
])


@if ($variant === 'vertical')

    {{-- Public Listing — Responsive Property Rows --}}

    <div class="mx-auto w-full max-w-4xl space-y-4 px-4 pt-4">

        @forelse ($estates as $estate)

            <a
                href="{{ route('estates.show', $estate->slug) }}"
                wire:navigate
                class="group flex flex-col overflow-hidden border border-slate-300 bg-white
                       transition-colors duration-150 hover:border-sky-300
                       dark:border-slate-700 dark:bg-slate-900 dark:hover:border-sky-700
                       md:flex-row"
            >

                {{-- Image --}}

                <div
                    class="relative h-52 shrink-0 overflow-hidden bg-slate-200
                           dark:bg-slate-800 md:h-44 md:w-64 lg:w-72"
                >

                    <img
                        src="{{ $estate->primaryImage?->url ?? 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=800&q=80' }}"
                        alt="{{ $estate->title }}"
                        loading="lazy"
                        decoding="async"
                        class="h-full w-full object-cover transition-transform duration-200 group-hover:scale-[1.02]"
                    >

                    {{-- Status --}}

                    <span
                        class="absolute left-3 top-3 flex items-center gap-1.5
                               border border-white/70 bg-white/95 px-2 py-1
                               text-[9px] font-bold uppercase tracking-wide text-slate-700
                               dark:border-slate-600/70 dark:bg-slate-900/95 dark:text-slate-200"
                    >
                        <span class="h-1.5 w-1.5 bg-sky-500"></span>

                        {{ match ($estate->transaction_type) {
                            'sale' => 'Dijual',
                            'rent' => 'Disewakan',
                            'sale & rent' => 'Dijual & Disewakan',
                            default => 'Dijual',
                        } }}
                    </span>

                    {{-- Mobile Price --}}

                    <span
                        class="absolute bottom-3 right-3 border border-white/20
                               bg-slate-950/90 px-2.5 py-1 text-xs font-bold text-white
                               md:hidden"
                    >
                        {{ $estate->short_price }}
                    </span>

                </div>


                {{-- Content --}}

                <div class="flex min-w-0 flex-1 flex-col justify-between p-4 md:p-5">

                    <div>

                        <h2
                            class="line-clamp-1 text-base font-bold tracking-tight text-slate-900
                                   transition-colors duration-150 group-hover:text-sky-600
                                   dark:text-slate-100 dark:group-hover:text-sky-400 md:text-lg"
                        >
                            {{ $estate->title }}
                        </h2>


                        <p
                            class="mb-4 mt-1.5 flex items-center text-xs
                                   text-slate-500 dark:text-slate-400"
                        >

                            <svg
                                class="mr-1.5 h-3.5 w-3.5 shrink-0 text-slate-400 dark:text-slate-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>

                            <span class="truncate">
                                {{ $estate->short_location_label }}
                            </span>

                        </p>

                    </div>


                    {{-- Specs / Price --}}

                    <div
                        class="flex flex-col gap-3 border-t border-slate-200 pt-3
                               dark:border-slate-800 sm:flex-row sm:items-center sm:justify-between"
                    >

                        <div
                            class="flex items-center gap-3 overflow-x-auto text-xs text-slate-600
                                   [scrollbar-width:none] [&::-webkit-scrollbar]:hidden
                                   dark:text-slate-400"
                        >

                            @if ($estate->bedroom)
                                <div class="flex shrink-0 items-center gap-1">
                                    <span class="font-bold text-slate-800 dark:text-slate-200">
                                        {{ $estate->bedroom }}
                                    </span>
                                    <span class="text-slate-400 dark:text-slate-500">KT</span>
                                </div>
                            @endif

                            @if ($estate->bathroom)
                                <div class="flex shrink-0 items-center gap-1">
                                    <span class="font-bold text-slate-800 dark:text-slate-200">
                                        {{ $estate->bathroom }}
                                    </span>
                                    <span class="text-slate-400 dark:text-slate-500">KM</span>
                                </div>
                            @endif

                            @if ($estate->building_size)
                                <div class="flex shrink-0 items-center gap-1">
                                    <span class="font-bold text-slate-800 dark:text-slate-200">
                                        {{ $estate->building_size }}
                                    </span>
                                    <span class="text-slate-400 dark:text-slate-500">m² LB</span>
                                </div>
                            @endif

                            @if ($estate->land_size)
                                <div class="flex shrink-0 items-center gap-1">
                                    <span class="font-bold text-slate-800 dark:text-slate-200">
                                        {{ $estate->land_size }}
                                    </span>
                                    <span class="text-slate-400 dark:text-slate-500">m² LT</span>
                                </div>
                            @endif

                        </div>


                        <span
                            class="hidden shrink-0 text-right text-base font-bold tracking-tight
                                   text-sky-600 dark:text-sky-400 md:block"
                        >
                            {{ $estate->short_price }}
                        </span>

                    </div>

                </div>

            </a>

        @empty

            <x-layouts.home.empty-state :show-reset="true" />

        @endforelse


        {{-- Pagination --}}

        @if (method_exists($estates, 'links'))

            <div class="overflow-x-auto py-4 pb-6">
                {{ $estates->links('pagination::simple-tailwind') }}
            </div>

        @endif

    </div>


@else

    {{-- Home Feed — Horizontal Property Carousel --}}

    @forelse ($estates as $estate)

        <div class="w-[270px] shrink-0 snap-start py-1">

            <a
                href="{{ route('estates.show', $estate->slug) }}"
                wire:navigate
                class="group block overflow-hidden border border-slate-300 bg-white
                       transition-colors duration-150 hover:border-sky-300
                       dark:border-slate-700 dark:bg-slate-900 dark:hover:border-sky-700"
            >

                {{-- Image --}}

                <div
                    class="relative h-44 w-full overflow-hidden bg-slate-200 dark:bg-slate-800"
                >

                    <img
                        src="{{ $estate->primaryImage?->url }}"
                        alt="{{ $estate->title }}"
                        loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                        fetchpriority="{{ $loop->first ? 'high' : 'auto' }}"
                        decoding="async"
                        class="h-full w-full object-cover transition-transform duration-200 group-hover:scale-[1.02]"
                    >


                    {{-- Status --}}

                    <span
                        class="absolute left-3 top-3 flex items-center gap-1.5
                               border border-white/70 bg-white/95 px-2 py-1
                               text-[9px] font-bold uppercase tracking-wide text-slate-700
                               dark:border-slate-600/70 dark:bg-slate-900/95 dark:text-slate-200"
                    >
                        <span class="h-1.5 w-1.5 bg-sky-500"></span>

                        {{ match ($estate->transaction_type) {
                            'sale' => 'Dijual',
                            'rent' => 'Disewakan',
                            'sale & rent' => 'Dijual & Disewakan',
                            default => 'Dijual',
                        } }}
                    </span>


                    {{-- Price --}}

                    <span
                        class="absolute bottom-3 right-3 border border-white/20
                               bg-slate-950/90 px-2.5 py-1 text-xs font-bold text-white"
                    >
                        {{ $estate->short_price }}
                    </span>

                </div>


                {{-- Content --}}

                <div class="p-3.5">

                    <h2
                        class="mb-1 line-clamp-1 text-sm font-bold tracking-tight text-slate-900
                               transition-colors duration-150 group-hover:text-sky-600
                               dark:text-slate-100 dark:group-hover:text-sky-400"
                    >
                        {{ $estate->title }}
                    </h2>


                    <p
                        class="mb-3 flex items-center text-xs
                               text-slate-500 dark:text-slate-400"
                    >

                        <svg
                            class="mr-1.5 h-3.5 w-3.5 shrink-0 text-slate-400 dark:text-slate-500"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                        </svg>

                        <span class="truncate">
                            {{ $estate->short_location_label }}
                        </span>

                    </p>


                    {{-- Specs --}}

                    <div
                        class="flex items-center gap-3 overflow-x-auto border-t border-slate-200 pt-2.5
                               text-[11px] text-slate-600
                               [scrollbar-width:none] [-ms-overflow-style:none]
                               [&::-webkit-scrollbar]:hidden
                               dark:border-slate-800 dark:text-slate-400"
                    >

                        @if ($estate->bedroom)
                            <div class="flex shrink-0 items-center gap-1">
                                <span class="font-bold text-slate-800 dark:text-slate-200">
                                    {{ $estate->bedroom }}
                                </span>
                                <span class="text-slate-400 dark:text-slate-500">KT</span>
                            </div>
                        @endif

                        @if ($estate->bathroom)
                            <div class="flex shrink-0 items-center gap-1">
                                <span class="font-bold text-slate-800 dark:text-slate-200">
                                    {{ $estate->bathroom }}
                                </span>
                                <span class="text-slate-400 dark:text-slate-500">KM</span>
                            </div>
                        @endif

                        @if ($estate->building_size)
                            <div class="flex shrink-0 items-center gap-1">
                                <span class="font-bold text-slate-800 dark:text-slate-200">
                                    {{ $estate->building_size }}
                                </span>
                                <span class="text-slate-400 dark:text-slate-500">m² LB</span>
                            </div>
                        @endif

                        @if ($estate->land_size)
                            <div class="flex shrink-0 items-center gap-1">
                                <span class="font-bold text-slate-800 dark:text-slate-200">
                                    {{ $estate->land_size }}
                                </span>
                                <span class="text-slate-400 dark:text-slate-500">m² LT</span>
                            </div>
                        @endif

                    </div>

                </div>

            </a>

        </div>

    @empty

        <div
            class="flex w-full items-center justify-center border border-dashed
                   border-slate-300 bg-white px-4 py-8 text-center
                   dark:border-slate-700 dark:bg-slate-900"
        >
            <p class="text-xs font-medium text-slate-400 dark:text-slate-500">
                Belum ada properti tersedia.
            </p>
        </div>

    @endforelse

@endif
