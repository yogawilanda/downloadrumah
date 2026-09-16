@props(['title', 'subtitle', 'estates'])

<section
    class="space-y-2"
    x-data="{
        scrollNext() {
            $refs.container.scrollBy({ left: 280, behavior: 'smooth' });
        },
        scrollPrev() {
            $refs.container.scrollBy({ left: -280, behavior: 'smooth' });
        }
    }"
>

    {{-- Header Section --}}

    <div class="flex items-center justify-between px-4 pt-2">

        <div>
            <h2
                class="text-base font-bold leading-tight text-slate-800
                       dark:text-slate-100"
            >
                {{ $title }}
            </h2>

            <p class="text-xs text-slate-500 dark:text-slate-400">
                {{ $subtitle }}
            </p>
        </div>


        <div class="flex items-center gap-2">

            <div class="flex items-center gap-1">

                <button
                    type="button"
                    @click="scrollPrev"
                    class="border border-slate-200 bg-slate-100 p-1
                           text-slate-500 transition-colors
                           hover:bg-slate-200 hover:text-slate-700
                           focus:outline-none
                           dark:border-slate-700 dark:bg-slate-800
                           dark:text-slate-400 dark:hover:bg-slate-700
                           dark:hover:text-slate-200"
                    aria-label="Previous"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </button>


                <button
                    type="button"
                    @click="scrollNext"
                    class="border border-slate-200 bg-slate-100 p-1
                           text-slate-500 transition-colors
                           hover:bg-slate-200 hover:text-slate-700
                           focus:outline-none
                           dark:border-slate-700 dark:bg-slate-800
                           dark:text-slate-400 dark:hover:bg-slate-700
                           dark:hover:text-slate-200"
                    aria-label="Next"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </button>

            </div>


            <a
                href="{{ route('listings.index') }}"
                wire:navigate
                class="ml-1 text-xs font-bold text-sky-600 transition-colors
                       hover:text-sky-700
                       dark:text-sky-400 dark:hover:text-sky-300"
            >
                Lihat Semua
            </a>

        </div>

    </div>


    {{-- Container Carousel --}}

    <div
        x-ref="container"
        class="flex gap-3 overflow-x-auto px-4 scroll-px-4 scroll-smooth
               snap-x snap-mandatory
               [scrollbar-width:none]
               [-ms-overflow-style:none]
               [&::-webkit-scrollbar]:hidden"
    >
        <x-layouts.home.home-feed-listing :estates="$estates" />
    </div>

</section>
