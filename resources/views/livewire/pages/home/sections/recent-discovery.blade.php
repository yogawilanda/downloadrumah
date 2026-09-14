<x-layouts.structural-section class="bg-slate-100">

    <div class="py-10 sm:py-14 lg:py-20">

        <div class="border border-slate-300 bg-white shadow-[6px_6px_0_0_rgba(15,23,42,0.025)]">

            <div
                class="flex flex-col gap-4 border-b border-slate-300 px-5 py-5 sm:flex-row sm:items-end sm:justify-between sm:px-7 md:px-9"
            >

                <div>

                    <div class="mb-2 flex items-center gap-2">

                        <span class="h-px w-6 bg-sky-500"></span>

                        <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                            Baru ditemukan
                        </p>

                    </div>

                    <h2 class="text-2xl font-black tracking-tight text-slate-950 md:text-3xl">
                        Mungkin ini yang kamu cari.
                    </h2>

                </div>

                <a
                    href="{{ route('listings.index') }}"
                    class="text-xs font-bold text-sky-700 transition-colors duration-150 hover:text-sky-900"
                >
                    Jelajahi semua →
                </a>

            </div>

            <div class="px-5 py-6 sm:px-7 md:px-9 md:py-9">

                <div wire:key="recent-estates-wrapper">

                    <x-layouts.home.home-feed-section
                        title=""
                        subtitle=""
                        :estates="$recentEstates"
                    />

                </div>

            </div>

        </div>

    </div>

</x-layouts.structural-section>
