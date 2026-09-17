{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/home/discovery-intent.blade.php
| @usage            : Shared discovery/search surface with contextual intent gateway
| @type             : Livewire View
| @controller       : <livewire:pages.home.discovery-intent />
| @expected_data    : [$variant, $search, $suggestions, $popularCities]
| @expected_events  : [submitSearch]
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Architectural Accent
| @status           : Active
| @author           : yogawilanda <eayogawilanda@gmail.com>
-------------------------------------------------------------------------------------------------------- --}}

@if ($variant === 'compact')

    {{-- Compact Discovery Controller --}}
    <div
        x-data="{
            searchOpen: false,
            focusSearch() {
                this.searchOpen = true;

                if (window.innerWidth < 640) {
                    setTimeout(() => {
                        this.$refs.searchController.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }, 350);
                }
            }
        }"
        x-ref="searchController"
        @click.outside="searchOpen = false"
        class="relative"
    >
        <form
            wire:submit.prevent="submitSearch"
            class="flex border-b border-slate-300 bg-white/80
                   dark:border-slate-700 dark:bg-slate-900/80"
        >
            <div class="relative min-w-0 flex-1">
                <div class="flex h-11 items-center">
                    <span class="pl-1 text-slate-400" aria-hidden="true">
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 20 20"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <circle cx="8.5" cy="8.5" r="5.5"></circle>
                            <path d="M13 13L17 17"></path>
                        </svg>
                    </span>

                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        @focus="focusSearch()"
                        placeholder="Cari lokasi, nama properti..."
                        autocomplete="off"
                        class="w-full border-0 bg-transparent px-3 py-2 text-xs font-medium
                               text-slate-800 outline-none placeholder:text-slate-400
                               focus:ring-0 dark:text-white dark:placeholder:text-slate-500"
                    >
                </div>

                <x-layouts.home.search-suggestions
                    :suggestions="$suggestions"
                    :search="$search"
                    :popularCities="$popularCities"
                />
            </div>

            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="submitSearch"
                class="shrink-0 border-l border-slate-200 bg-slate-900 px-5
                       text-[10px] font-bold uppercase tracking-[0.12em] text-white
                       transition hover:bg-slate-800 disabled:cursor-wait disabled:opacity-60
                       dark:border-slate-700 dark:bg-white dark:text-slate-950
                       dark:hover:bg-slate-200"
            >
                Cari
            </button>
        </form>
    </div>

@else

    {{-- Hero Discovery Surface --}}
    <div class="relative">

        {{-- Discovery Context --}}
        <div class="mb-5 flex items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="h-1.5 w-1.5 bg-sky-500"></span>

                <span
                    class="text-[10px] font-semibold uppercase tracking-[0.16em]
                           text-slate-500 dark:text-slate-400"
                >
                    Mulai menjelajah
                </span>
            </div>

            <span
                class="hidden text-[10px] font-medium tracking-wide
                       text-slate-400 dark:text-slate-500 sm:block"
            >
                Tidak harus sudah tahu persis apa yang dicari
            </span>
        </div>


        {{-- Main Discovery Surface --}}
        <div
            x-data="{
                searchOpen: false,
                focusSearch() {
                    this.searchOpen = true;

                    if (window.innerWidth < 640) {
                        setTimeout(() => {
                            this.$refs.searchController.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }, 350);
                    }
                }
            }"
            x-ref="searchController"
            @click.outside="searchOpen = false"
            class="relative"
        >

            {{-- Quiet Architectural Frame --}}
            <div
                aria-hidden="true"
                class="pointer-events-none absolute inset-0 border
                       border-slate-300/80 dark:border-slate-700"
            ></div>


            {{-- Corner Accents --}}
            <span
                aria-hidden="true"
                class="pointer-events-none absolute -left-px -top-px h-3 w-3
                       border-l border-t border-sky-500"
            ></span>

            <span
                aria-hidden="true"
                class="pointer-events-none absolute -bottom-px -right-px h-3 w-3
                       border-b border-r border-slate-400 dark:border-slate-500"
            ></span>


            <div class="relative">

                <form wire:submit.prevent="submitSearch">

                    {{-- Search Input --}}
                    <div class="relative">
                        <div class="flex items-center px-4">
                            <span class="text-slate-400" aria-hidden="true">
                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                >
                                    <circle cx="8.5" cy="8.5" r="5.5"></circle>
                                    <path d="M13 13L17 17"></path>
                                </svg>
                            </span>

                            <input
                                type="text"
                                wire:model.live.debounce.300ms="search"
                                @focus="focusSearch()"
                                placeholder="Cari lokasi, properti, atau area..."
                                autocomplete="off"
                                class="w-full border-0 bg-transparent px-3 py-5 text-sm
                                       font-medium text-slate-800 outline-none
                                       placeholder:text-slate-400 focus:ring-0
                                       dark:text-white dark:placeholder:text-slate-500"
                            >

                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                wire:target="submitSearch"
                                class="mr-1 hidden shrink-0 bg-slate-900 px-4 py-2
                                       text-[10px] font-bold uppercase tracking-[0.12em]
                                       text-white transition hover:bg-slate-700
                                       disabled:cursor-wait disabled:opacity-60
                                       dark:bg-white dark:text-slate-950
                                       dark:hover:bg-slate-200 sm:block"
                            >
                                Cari
                            </button>
                        </div>

                        <x-layouts.home.search-suggestions
                            :suggestions="$suggestions"
                            :search="$search"
                            :popularCities="$popularCities"
                        />
                    </div>


                    {{-- Mobile Submit --}}
                    <div
                        class="border-t border-slate-200/80 p-3
                               dark:border-slate-800 sm:hidden"
                    >
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="submitSearch"
                            class="w-full bg-slate-900 px-4 py-3 text-[10px]
                                   font-bold uppercase tracking-[0.12em] text-white
                                   transition hover:bg-slate-700
                                   disabled:cursor-wait disabled:opacity-60
                                   dark:bg-white dark:text-slate-950
                                   dark:hover:bg-slate-200"
                        >
                            Cari
                        </button>
                    </div>


                    {{-- Intent Gateways --}}
                    <div
                        class="border-t border-slate-200/70 px-4 py-4
                               dark:border-slate-800 sm:px-5"
                    >

                        <div class="mb-3 flex items-center gap-2">
                            <span class="h-px w-5 bg-slate-300 dark:bg-slate-700"></span>

                            <span
                                class="text-[10px] font-semibold uppercase tracking-[0.14em]
                                       text-slate-400 dark:text-slate-500"
                            >
                                Atau mulai dari sini
                            </span>
                        </div>


                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">

                            {{-- Search Intent --}}
                            <a
                                href="{{ route('matching.search') }}"
                                wire:navigate
                                class="group flex min-h-16 items-center justify-between
                                       border border-slate-200 bg-slate-50 px-4 py-3
                                       text-left transition
                                       hover:border-slate-400 hover:bg-white
                                       dark:border-slate-700 dark:bg-slate-800/40
                                       dark:hover:border-slate-500 dark:hover:bg-slate-800"
                            >
                                <span>
                                    <span
                                        class="block text-xs font-bold text-slate-800
                                               dark:text-slate-100"
                                    >
                                        Bantu saya mencari
                                    </span>

                                    <span
                                        class="mt-1 block text-[10px] font-medium
                                               text-slate-400 dark:text-slate-500"
                                    >
                                        Temukan properti yang sesuai
                                    </span>
                                </span>

                                <span
                                    class="ml-3 text-sm text-slate-400 transition
                                           group-hover:translate-x-1 group-hover:text-slate-900
                                           dark:group-hover:text-white"
                                >
                                    →
                                </span>
                            </a>


                            {{-- Offer Intent --}}
                            <a
                                href="{{ route('matching.offer') }}"
                                wire:navigate
                                class="group flex min-h-16 items-center justify-between
                                       border border-slate-200 bg-slate-50 px-4 py-3
                                       text-left transition
                                       hover:border-slate-400 hover:bg-white
                                       dark:border-slate-700 dark:bg-slate-800/40
                                       dark:hover:border-slate-500 dark:hover:bg-slate-800"
                            >
                                <span>
                                    <span
                                        class="block text-xs font-bold text-slate-800
                                               dark:text-slate-100"
                                    >
                                        Bantu saya menjual
                                    </span>

                                    <span
                                        class="mt-1 block text-[10px] font-medium
                                               text-slate-400 dark:text-slate-500"
                                    >
                                        Temukan cara menawarkan properti
                                    </span>
                                </span>

                                <span
                                    class="ml-3 text-sm text-slate-400 transition
                                           group-hover:translate-x-1 group-hover:text-slate-900
                                           dark:group-hover:text-white"
                                >
                                    →
                                </span>
                            </a>


                            {{-- Analysis Intent --}}
                            <button
                                type="button"
                                class="group flex min-h-16 items-center justify-between
                                       border border-slate-200 bg-slate-50 px-4 py-3
                                       text-left transition
                                       hover:border-slate-400 hover:bg-white
                                       dark:border-slate-700 dark:bg-slate-800/40
                                       dark:hover:border-slate-500 dark:hover:bg-slate-800"
                            >
                                <span>
                                    <span
                                        class="block text-xs font-bold text-slate-800
                                               dark:text-slate-100"
                                    >
                                        Bantu saya menganalisa
                                    </span>

                                    <span
                                        class="mt-1 block text-[10px] font-medium
                                               text-slate-400 dark:text-slate-500"
                                    >
                                        Pahami nilai dan kondisi properti
                                    </span>
                                </span>

                                <span
                                    class="ml-3 text-sm text-slate-400 transition
                                           group-hover:translate-x-1 group-hover:text-slate-900
                                           dark:group-hover:text-white"
                                >
                                    →
                                </span>
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>


        {{-- Supporting Note --}}
        <div
            class="mt-4 flex items-center gap-2 pl-1 text-[10px] font-medium
                   text-slate-400 dark:text-slate-500"
        >
            <span class="h-px w-6 bg-slate-300 dark:bg-slate-700"></span>

            <span>
                Kamu bisa mulai dengan kata-kata sendiri.
            </span>
        </div>

    </div>

@endif
