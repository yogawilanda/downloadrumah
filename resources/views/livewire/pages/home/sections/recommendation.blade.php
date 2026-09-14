<x-layouts.structural-section class="bg-slate-100">

    <div class="py-10 sm:py-14 lg:py-20">

        <div class="border border-slate-300 bg-white shadow-[6px_6px_0_0_rgba(15,23,42,0.025)]">

            <div class="relative border-b border-slate-300 px-5 py-6 sm:px-7 md:px-9">

                <div class="absolute right-0 top-0 hidden h-full w-48 overflow-hidden sm:block">
                    <div class="structural-dot-field-small h-full w-full opacity-35"></div>
                </div>

                <div class="relative">

                    <div class="mb-2 flex items-center gap-2">
                        <span class="h-px w-6 bg-sky-500"></span>

                        <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                            Untuk dipertimbangkan
                        </p>
                    </div>

                    <h2 class="text-2xl font-black tracking-tight text-slate-950 md:text-3xl">
                        Ada pilihan lain yang mungkin cocok.
                    </h2>

                </div>

            </div>

            <div class="px-5 py-6 sm:px-7 md:px-9 md:py-9">

                <div wire:key="recommended-estates-wrapper">
                    <x-layouts.home.home-feed-section
                        title=""
                        subtitle=""
                        :estates="$recommendedEstates"
                    />
                </div>

            </div>

        </div>

    </div>

</x-layouts.structural-section>
