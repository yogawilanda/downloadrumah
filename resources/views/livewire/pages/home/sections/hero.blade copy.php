<x-layouts.structural-section framed
    class="border-b border-slate-300 bg-slate-200/20 dark:border-slate-800 dark:bg-slate-900/20">

    <div
        class="relative min-h-screen overflow-hidden bg-slate-100 px-5 py-14 dark:bg-slate-950 sm:px-8 md:px-12 md:py-20 lg:px-14">


        {{-- ============================================================
        SUPPLEMENTAL DECORATION
        ============================================================= --}}
        @include('components.atoms.decorations.supplemental-decoration')

        {{-- ============================================================
        HERO
        ============================================================= --}}

        <div class="relative z-10">
            @include('livewire.pages.home.sections.hero-title')

            {{-- ============================================================
            PRODUCT PREVIEW
            Lightweight HTML/CSS — no image asset
            ============================================================= --}}
            <div class="mx-auto mt-10 flex max-w-4xl flex-col items-center justify-center gap-5 sm:flex-row sm:gap-8">
                {{-- MATCH DIAGRAM (OVERLAPPING & MODERN DESIGN) --}}
                <div
                    class="relative w-full max-w-[320px] rotate-2 rounded-3xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-2xl shadow-slate-900/10 backdrop-blur-xl dark:border-slate-800/80 dark:bg-slate-900/80">

                    {{-- Header --}}
                    <div class="mb-4 flex items-center justify-between">
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                            Need → Match
                        </span>
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-2.5 py-0.5 text-[10px] font-semibold text-emerald-600 dark:bg-emerald-400/10 dark:text-emerald-400">
                            <span class="size-1.5 animate-pulse rounded-full bg-emerald-500"></span>
                            98% Match
                        </span>
                    </div>

                    {{-- Overlapping Cards Container --}}
                    <div class="relative my-2 py-4">

                        {{-- Glow background efek titik temu di tengah --}}
                        <div
                            class="absolute left-1/2 top-1/2 size-24 -translate-x-1/2 -translate-y-1/2 rounded-full bg-sky-500/20 blur-xl">
                        </div>

                        {{-- Connector Line --}}
                        <div
                            class="absolute left-1/2 top-1/2 h-16 w-0.5 -translate-x-1/2 -translate-y-1/2 bg-gradient-to-b from-sky-500/0 via-sky-500/50 to-indigo-500/0">
                        </div>

                        {{-- Match Point Indicator --}}
                        <div
                            class="absolute left-1/2 top-1/2 z-20 flex size-8 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border border-sky-400/50 bg-white/90 shadow-lg shadow-sky-500/20 backdrop-blur dark:bg-slate-900/90">
                            <svg class="size-4 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>

                        {{-- User A (Kartu Atas - Shifted Left) --}}
                        <div
                            class="relative z-10 mr-8 rounded-2xl border border-slate-200/90 bg-white/90 p-3 shadow-md backdrop-blur transition-transform hover:z-30 dark:border-slate-700/80 dark:bg-slate-800/90">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-sky-500/10 text-xs font-bold text-sky-600 dark:bg-sky-400/10 dark:text-sky-400">
                                    A
                                </div>
                                <div>
                                    <div class="text-xs font-semibold text-slate-800 dark:text-slate-100">
                                        Butuh rumah
                                    </div>
                                    <div class="mt-0.5 flex items-center gap-1.5 text-[10px] text-slate-400">
                                        <span>Bantul</span>
                                        <span>•</span>
                                        <span
                                            class="rounded bg-slate-100 px-1 py-0.5 font-medium text-slate-500 dark:bg-slate-700 dark:text-slate-300">KPR</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- User B (Kartu Bawah - Shifted Right & Overlapping Upward -mt-5) --}}
                        <div
                            class="relative z-0 -mt-5 ml-8 rounded-2xl border border-slate-200/90 bg-white/70 p-3 shadow-lg backdrop-blur transition-transform hover:z-30 dark:border-slate-700/80 dark:bg-slate-800/70">
                            <div class="flex items-center justify-end gap-3 text-right">
                                <div>
                                    <div class="text-xs font-semibold text-slate-800 dark:text-slate-100">
                                        Punya properti
                                    </div>
                                    <div
                                        class="mt-0.5 flex items-center justify-end gap-1.5 text-[10px] text-slate-400">
                                        <span
                                            class="rounded bg-slate-100 px-1 py-0.5 font-medium text-slate-500 dark:bg-slate-700 dark:text-slate-300">Rumah</span>
                                        <span>•</span>
                                        <span>Bantul</span>
                                    </div>
                                </div>
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-indigo-500/10 text-xs font-bold text-indigo-600 dark:bg-indigo-400/10 dark:text-indigo-400">
                                    B
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Footer --}}
                    <div
                        class="mt-2 border-t border-slate-200/60 pt-3 text-center text-[10px] font-medium text-slate-400 dark:border-slate-800">
                        kebutuhan bertemu properti
                    </div>
                </div>

            </div>

            <div class="mx-auto mt-12 max-w-5xl">
                <livewire:pages.home.discovery-intent variant="hero" />
            </div>
        </div>

    </div>

</x-layouts.structural-section>
