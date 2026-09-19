{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
    | @path : resources/views/livewire/pages/home/discovery-intent.blade.php
    | @usage : Shared discovery/search surface with contextual intent gateway
    | @type : Livewire View
    | @controller :
    <livewire:pages.home.discovery-intent />
    | @expected_data : [$variant, $search, $suggestions, $popularCities]
    | @expected_events : [submitSearch]
    | @techstack : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
    | @design_tokens : Font: Outfit | Theme: White / Slate / Sky Accent
    | @status : Active
    | @author : yogawilanda <eayogwilanda@gmail.com>
        -------------------------------------------------------------------------------------------------------- --}}

        @if ($variant === 'compact')

        {{-- ================================================================
        COMPACT DISCOVERY
        ================================================================= --}}
        <div x-data="{
            searchOpen: false,

            focusSearch() {
                this.searchOpen = true;

                if (window.innerWidth < 640) {
                    setTimeout(() => {
                        const element = this.$refs.searchController;

                        if (!element) return;

                        const rect = element.getBoundingClientRect();
                        const viewportHeight = window.innerHeight;
                        const targetY = viewportHeight * 0.45;
                        const scrollY = window.scrollY + rect.top - targetY;

                        window.scrollTo({
                            top: Math.max(0, scrollY),
                            behavior: 'smooth'
                        });
                    }, 100);
                }
            }
        }" x-ref="searchController" @click.outside="searchOpen = false" class="relative">

            <form wire:submit.prevent="submitSearch" class="
                flex
                border-b
                border-slate-300
                bg-white
                dark:border-slate-700
                dark:bg-slate-900
            ">

                <div class="relative min-w-0 flex-1">

                    <div class="flex h-11 items-center">

                        <span class="pl-1 text-slate-400" aria-hidden="true">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                stroke-width="1.6">
                                <circle cx="8.5" cy="8.5" r="5.5"></circle>
                                <path d="M13 13L17 17"></path>
                            </svg>
                        </span>

                        <input type="text" wire:model.live.debounce.500ms="search" @focus="focusSearch()"
                            placeholder="Cari lokasi, nama properti..." autocomplete="off" class="
                            w-full
                            border-0
                            bg-transparent
                            px-3
                            py-2
                            text-sm
                            font-medium
                            text-slate-800
                            outline-none
                            placeholder:text-slate-400
                            focus:ring-0

                            dark:text-white
                            dark:placeholder:text-slate-500
                        ">
                    </div>

                    <x-layouts.home.search-suggestions :suggestions="$suggestions" :search="$search"
                        :popularCities="$popularCities" />

                </div>

                <button type="submit" wire:loading.attr="disabled" wire:target="submitSearch" class="
                    shrink-0
                    border-l
                    border-slate-700
                    bg-slate-950
                    px-5
                    text-sm
                    font-bold
                    uppercase
                    tracking-[0.12em]
                    text-white
                    transition
                    hover:bg-slate-800
                    disabled:cursor-wait
                    disabled:opacity-60

                    dark:border-slate-300
                    dark:bg-white
                    dark:text-slate-950
                    dark:hover:bg-slate-200
                ">
                    Cari
                </button>

            </form>

        </div>

        @else

        {{-- ================================================================
        HERO DISCOVERY
        ================================================================= --}}
        <div class="relative">

            {{-- Context --}}
            <div class="mb-4 flex items-center gap-2 sm:mb-5">
                <span class="size-1.5 bg-sky-500"></span>

                <span class="
                text-xs
                font-bold
                uppercase
                tracking-[0.16em]
                text-slate-500

                sm:text-sm

                dark:text-slate-400
            ">
                    Mau langsung mencari? Mulai dari sini.
                </span>
            </div>


            {{-- ============================================================
            DISCOVERY SURFACE
            ============================================================= --}}
            <div x-data="{
                searchOpen: false,

                focusSearch() {
                    this.searchOpen = true;

                    if (window.innerWidth < 640) {
                        setTimeout(() => {
                            const element = this.$refs.searchController;

                            if (!element) return;

                            const rect = element.getBoundingClientRect();
                            const viewportHeight = window.innerHeight;
                            const targetY = viewportHeight * 0.80;
                            const scrollY = window.scrollY + rect.top - targetY;

                            window.scrollTo({
                                top: Math.max(0, scrollY),
                                behavior: 'smooth'
                            });
                        }, 100);
                    }
                }
            }" x-ref="searchController" @click.outside="searchOpen = false" class="
                relative
                border
                border-slate-300
                bg-white
                dark:border-slate-700
                dark:bg-slate-900
            ">

                {{-- Corner Accents --}}
                <span aria-hidden="true" class="
                    pointer-events-none
                    absolute
                    -left-px
                    -top-px
                    h-3
                    w-3
                    border-l
                    border-t
                    border-sky-500
                "></span>

                <span aria-hidden="true" class="
                    pointer-events-none
                    absolute
                    -bottom-px
                    -right-px
                    h-3
                    w-3
                    border-b
                    border-r
                    border-slate-400

                    dark:border-slate-500
                "></span>


                <form wire:submit.prevent="submitSearch">

                    {{-- ====================================================
                    SEARCH INPUT
                    ===================================================== --}}
                    <div class="relative">

                        <div class="
        mx-3
        my-3
        flex
        items-center
        border
        border-slate-300
        bg-slate-100
        px-3
        transition
        focus-within:border-sky-500
        focus-within:bg-white

        sm:mx-4
        sm:my-4
        sm:px-4

        dark:border-slate-600
        dark:bg-slate-800
        dark:focus-within:border-sky-500
        dark:focus-within:bg-slate-900
    ">

                            <span class="
                shrink-0
                text-slate-700
                dark:text-slate-200
            " aria-hidden="true">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="8.5" cy="8.5" r="5.5"></circle>
                                    <path d="M13 13L17 17"></path>
                                </svg>
                            </span>

                            <input type="text" wire:model.live.debounce.500ms="search" @focus="focusSearch()"
                                placeholder="Cari lokasi, properti, atau area..." autocomplete="off" class="
                w-full
                border-0
                bg-transparent
                px-3
                py-4
                text-base
                font-medium
                text-slate-900
                outline-none
                placeholder:text-slate-500
                focus:ring-0

                dark:text-white
                dark:placeholder:text-slate-400
            ">

                            {{-- Desktop Submit --}}
                            <button type="submit" wire:loading.attr="disabled" wire:target="submitSearch" class="
                mr-1
                hidden
                shrink-0
                bg-slate-950
                px-5
                py-2.5
                text-sm
                font-bold
                uppercase
                tracking-[0.12em]
                text-white
                transition
                hover:bg-slate-800
                disabled:cursor-wait
                disabled:opacity-60

                sm:block

                dark:bg-white
                dark:text-slate-950
                dark:hover:bg-slate-200
            ">
                                Cari
                            </button>

                        </div>

                        <x-layouts.home.search-suggestions :suggestions="$suggestions" :search="$search"
                            :popularCities="$popularCities" />

                    </div>

                    {{-- ====================================================
                    MOBILE SUBMIT
                    ===================================================== --}}
                    <div class="
                    border-t
                    border-slate-200
                    p-3

                    sm:hidden

                    dark:border-slate-800
                ">
                        <button type="submit" wire:loading.attr="disabled" wire:target="submitSearch" class="
                            w-full
                            bg-slate-950
                            px-4
                            py-3
                            text-sm
                            font-bold
                            uppercase
                            tracking-[0.12em]
                            text-white
                            transition
                            hover:bg-slate-800
                            disabled:cursor-wait
                            disabled:opacity-60

                            dark:bg-white
                            dark:text-slate-950
                            dark:hover:bg-slate-200
                        ">
                            Cari
                        </button>
                    </div>


                    {{-- ====================================================
                    INTENT GATEWAYS
                    ===================================================== --}}
                    <div class="
    border-t
    border-slate-200
    bg-slate-100/70
    px-3
    py-3

    sm:px-5
    sm:py-4

    dark:border-slate-800
    dark:bg-slate-950/40
">

                        <div class="mb-2.5 flex items-center gap-2 sm:mb-3">

                            <span class="
            h-px
            w-4
            bg-slate-300

            dark:bg-slate-700
        "></span>

                            <span class="
            text-[10px]
            font-bold
            uppercase
            tracking-[0.14em]
            text-slate-400

            sm:text-xs

            dark:text-slate-500
        ">
                                Atau bisa kami bantu dengan ini.
                            </span>

                        </div>


                        {{-- Gateway Grid --}}
                        <div class="
        grid
        grid-cols-3
        gap-1.5

        sm:gap-2
    ">

                            {{-- Search Intent --}}
                            <a href="{{ route('matching.search') }}" wire:navigate class="
                group
                flex
                min-h-12
                items-center
                justify-between
                border
                border-slate-300
                bg-white
                px-2
                py-2
                text-left
                transition

                hover:border-slate-500
                hover:bg-slate-50

                sm:min-h-16
                sm:px-3
                sm:py-3

                dark:border-slate-700
                dark:bg-slate-900
                dark:hover:border-slate-500
                dark:hover:bg-slate-800
            ">
                                <span class="
                text-[11px]
                font-bold
                leading-tight
                text-slate-800

                sm:text-sm

                dark:text-slate-100
            ">
                                    Bantu saya mencari
                                </span>

                                <span class="
                ml-1
                hidden
                shrink-0
                text-sm
                text-slate-400
                transition

                sm:block
                sm:group-hover:translate-x-1
                sm:group-hover:text-slate-900

                dark:sm:group-hover:text-white
            ">
                                    →
                                </span>
                            </a>


                            {{-- Offer Intent --}}
                            <a href="{{ route('matching.offer') }}" wire:navigate class="
                group
                flex
                min-h-12
                items-center
                justify-between
                border
                border-slate-300
                bg-white
                px-2
                py-2
                text-left
                transition

                hover:border-slate-500
                hover:bg-slate-50

                sm:min-h-16
                sm:px-3
                sm:py-3

                dark:border-slate-700
                dark:bg-slate-900
                dark:hover:border-slate-500
                dark:hover:bg-slate-800
            ">
                                <span class="
                text-[11px]
                font-bold
                leading-tight
                text-slate-800

                sm:text-sm

                dark:text-slate-100
            ">
                                    Bantu saya menjual
                                </span>

                                <span class="
                ml-1
                hidden
                shrink-0
                text-sm
                text-slate-400
                transition

                sm:block
                sm:group-hover:translate-x-1
                sm:group-hover:text-slate-900

                dark:sm:group-hover:text-white
            ">
                                    →
                                </span>
                            </a>


                            {{-- Analysis Intent --}}
                            <button type="button" class="
                group
                flex
                min-h-12
                items-center
                justify-between
                border
                border-slate-300
                bg-white
                px-2
                py-2
                text-left
                transition

                hover:border-slate-500
                hover:bg-slate-50

                sm:min-h-16
                sm:px-3
                sm:py-3

                dark:border-slate-700
                dark:bg-slate-900
                dark:hover:border-slate-500
                dark:hover:bg-slate-800
            ">
                                <span class="
                text-[11px]
                font-bold
                leading-tight
                text-slate-800

                sm:text-sm

                dark:text-slate-100
            ">
                                    Bantu saya menganalisa
                                </span>

                                <span class="
                ml-1
                hidden
                shrink-0
                text-sm
                text-slate-400
                transition

                sm:block
                sm:group-hover:translate-x-1
                sm:group-hover:text-slate-900

                dark:sm:group-hover:text-white
            ">
                                    →
                                </span>
                            </button>

                        </div>

                    </div>

                </form>

            </div>


            {{-- ============================================================
            SUPPORTING NOTE
            ============================================================= --}}
            <div class="
            mt-4
            flex
            items-start
            gap-2
            pl-1
            text-xs
            font-medium
            leading-5
            text-slate-400

            sm:text-sm

            dark:text-slate-500
        ">
                <span class="
                    mt-2
                    h-px
                    w-6
                    shrink-0
                    bg-slate-300

                    dark:bg-slate-700
                "></span>

                <span>
                    DownloadRumah adalah perusahaan teknologi, bukan agen properti.
                    Kami membantu mengurangi ketidakpastian melalui pemahaman kebutuhan,
                    informasi properti, dan pencocokan kebutuhan kedua belah pihak.
                </span>
            </div>

        </div>

        @endif
