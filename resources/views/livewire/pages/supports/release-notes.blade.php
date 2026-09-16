<div class="min-h-screen bg-slate-50 pb-24 dark:bg-slate-950">

    <div class="mx-auto min-h-screen w-full max-w-4xl bg-white dark:bg-slate-900">

        {{-- Header --}}
        <header class="border-b border-slate-200 px-5 py-6 dark:border-slate-800 sm:px-8 lg:px-10">
            <div class="flex items-start justify-between gap-4">

                <div class="flex items-start gap-4">
                    <a
                        href="{{ route('home') }}"
                        wire:navigate
                        class="flex h-9 w-9 shrink-0 items-center justify-center border border-slate-200 bg-white text-slate-600 transition hover:border-slate-950 hover:text-slate-950 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-400 dark:hover:border-white dark:hover:text-white"
                        aria-label="Kembali ke beranda"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>

                    <div>
                        <span class="text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">
                            DownloadRumah / Changelog
                        </span>

                        <h1 class="mt-1 text-base font-bold text-slate-950 dark:text-white sm:text-lg">
                            Catatan Rilis
                        </h1>

                        <p class="mt-1 text-[10px] font-medium text-slate-500 dark:text-slate-400">
                            Riwayat perubahan dan perkembangan sistem.
                        </p>
                    </div>
                </div>

                <span class="hidden shrink-0 font-mono text-[9px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 sm:block">
                    Release History
                </span>

            </div>
        </header>

        {{-- Changelog --}}
        <main class="px-5 py-7 sm:px-8 sm:py-8 lg:px-10">

            <div class="space-y-0">

                {{-- v1.1.0 --}}
                <article class="relative border-l-2 border-slate-950 pl-5 dark:border-white sm:pl-6">

                    <div class="absolute -left-[5px] top-0 h-2 w-2 bg-slate-950 dark:bg-white"></div>

                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                            <span class="text-[10px] font-black uppercase tracking-wider text-slate-950 dark:text-white">
                                v1.1.0-rc
                            </span>

                            <span class="text-[10px] font-medium text-slate-400 dark:text-slate-500">
                                07 Sept 2026 • 22:34 WIB
                            </span>
                        </div>

                        <code class="w-fit bg-slate-950 px-2 py-1 font-mono text-[9px] font-bold text-white dark:bg-white dark:text-slate-950">
                            e0b9af5
                        </code>
                    </div>

                    <div class="mt-3 border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                        <span class="text-[9px] font-bold uppercase tracking-[0.12em] text-slate-400 dark:text-slate-500">
                            Photo Engine
                        </span>

                        <h2 class="mt-1 text-xs font-bold text-slate-950 dark:text-white">
                            Photo Engine & Cover Selector
                        </h2>

                        <p class="mt-2 text-[11px] leading-relaxed text-slate-600 dark:text-slate-400">
                            Refactor photo picker, instant primary cover selector
                            (<code class="font-mono text-[10px]">is_primary</code>),
                            client-side quota guard via Alpine, & fix photo duplication bug pada wizard.
                        </p>
                    </div>
                </article>

                {{-- Remaining releases --}}
                <div class="space-y-0 border-l border-slate-200 dark:border-slate-800">

                    {{-- v1.0.2 --}}
                    <article class="relative ml-5 border-b border-slate-200 py-6 pl-5 dark:border-slate-800 sm:ml-6 sm:pl-6">
                        <div class="absolute -left-[4px] top-7 h-1.5 w-1.5 bg-slate-300 dark:bg-slate-600"></div>

                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-700 dark:text-slate-300">
                                    v1.0.2
                                </span>
                                <span class="text-[10px] font-medium text-slate-400 dark:text-slate-500">
                                    07 Sept 2026 • 12:14 WIB
                                </span>
                            </div>
                            <code class="w-fit font-mono text-[9px] text-slate-400 dark:text-slate-500">1209759</code>
                        </div>

                        <h2 class="mt-2 text-xs font-bold text-slate-900 dark:text-white">
                            Admin Telemetry & User Insights
                        </h2>

                        <p class="mt-1 text-[11px] leading-relaxed text-slate-500 dark:text-slate-400">
                            Dashboard admin insight, activity log telemetry, auto-save draft wizard step,
                            & refinement UI accessibility agen.
                        </p>
                    </article>

                    {{-- v1.0.0 --}}
                    <article class="relative ml-5 border-b border-slate-200 py-6 pl-5 dark:border-slate-800 sm:ml-6 sm:pl-6">
                        <div class="absolute -left-[4px] top-7 h-1.5 w-1.5 bg-slate-300 dark:bg-slate-600"></div>

                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-700 dark:text-slate-300">
                                    v1.0.0
                                </span>
                                <span class="text-[10px] font-medium text-slate-400 dark:text-slate-500">
                                    06 Sept 2026 • 19:26 WIB
                                </span>
                            </div>
                            <code class="w-fit font-mono text-[9px] text-slate-400 dark:text-slate-500">b129951</code>
                        </div>

                        <h2 class="mt-2 text-xs font-bold text-slate-900 dark:text-white">
                            Publicity Schema & Throttling
                        </h2>

                        <p class="mt-1 text-[11px] leading-relaxed text-slate-500 dark:text-slate-400">
                            Pemisahan publicity_status & transaction_status, dynamic admin throttling settings,
                            & indexing search optimization.
                        </p>
                    </article>

                    {{-- v0.9.0 --}}
                    <article class="relative ml-5 border-b border-slate-200 py-6 pl-5 dark:border-slate-800 sm:ml-6 sm:pl-6">
                        <div class="absolute -left-[4px] top-7 h-1.5 w-1.5 bg-slate-300 dark:bg-slate-600"></div>

                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-700 dark:text-slate-300">
                                    v0.9.0
                                </span>
                                <span class="text-[10px] font-medium text-slate-400 dark:text-slate-500">
                                    05 Sept 2026 • 12:24 WIB
                                </span>
                            </div>
                            <code class="w-fit font-mono text-[9px] text-slate-400 dark:text-slate-500">80ff104</code>
                        </div>

                        <h2 class="mt-2 text-xs font-bold text-slate-900 dark:text-white">
                            Regional Data & PWA Splashscreen
                        </h2>

                        <p class="mt-1 text-[11px] leading-relaxed text-slate-500 dark:text-slate-400">
                            Standarisasi skema lokasi Laravolt (District/Kecamatan),
                            perbaikan PWA splashscreen, & halaman legalitas publik.
                        </p>
                    </article>

                    {{-- v0.5.0 --}}
                    <article class="relative ml-5 border-b border-slate-200 py-6 pl-5 dark:border-slate-800 sm:ml-6 sm:pl-6">
                        <div class="absolute -left-[4px] top-7 h-1.5 w-1.5 bg-slate-300 dark:bg-slate-600"></div>

                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-700 dark:text-slate-300">
                                    v0.5.0
                                </span>
                                <span class="text-[10px] font-medium text-slate-400 dark:text-slate-500">
                                    03 Sept 2026 • 12:38 WIB
                                </span>
                            </div>
                            <code class="w-fit font-mono text-[9px] text-slate-400 dark:text-slate-500">f236fb6</code>
                        </div>

                        <h2 class="mt-2 text-xs font-bold text-slate-900 dark:text-white">
                            Indonesian Regional Auto-Generation
                        </h2>

                        <p class="mt-1 text-[11px] leading-relaxed text-slate-500 dark:text-slate-400">
                            Generator otomatis provinsi/kota Indonesia, API obfuscation,
                            sistem logging user, dan penanganan modal Auth.
                        </p>
                    </article>

                    {{-- v0.3.0 --}}
                    <article class="relative ml-5 border-b border-slate-200 py-6 pl-5 dark:border-slate-800 sm:ml-6 sm:pl-6">
                        <div class="absolute -left-[4px] top-7 h-1.5 w-1.5 bg-slate-300 dark:bg-slate-600"></div>

                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-700 dark:text-slate-300">
                                    v0.3.0
                                </span>
                                <span class="text-[10px] font-medium text-slate-400 dark:text-slate-500">
                                    30 Ags 2026 • 18:33 WIB
                                </span>
                            </div>
                            <code class="w-fit font-mono text-[9px] text-slate-400 dark:text-slate-500">7cf86d4</code>
                        </div>

                        <h2 class="mt-2 text-xs font-bold text-slate-900 dark:text-white">
                            Form Stepper & Basic KPR Calc
                        </h2>

                        <p class="mt-1 text-[11px] leading-relaxed text-slate-500 dark:text-slate-400">
                            Wizard Form Properti bertahap (pengurang user fatigue),
                            kompresi upload foto, dan kalkulator KPR awal.
                        </p>
                    </article>

                    {{-- v0.1.0 --}}
                    <article class="relative ml-5 py-6 pl-5 sm:ml-6 sm:pl-6">
                        <div class="absolute -left-[4px] top-7 h-1.5 w-1.5 bg-slate-300 dark:bg-slate-600"></div>

                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-700 dark:text-slate-300">
                                    v0.1.0
                                </span>
                                <span class="text-[10px] font-medium text-slate-400 dark:text-slate-500">
                                    24 Ags 2026 • 11:23 WIB
                                </span>
                            </div>
                            <code class="w-fit font-mono text-[9px] text-slate-400 dark:text-slate-500">385e81d</code>
                        </div>

                        <h2 class="mt-2 text-xs font-bold text-slate-900 dark:text-white">
                            Inisialisasi Project & Core Engine
                        </h2>

                        <p class="mt-1 text-[11px] leading-relaxed text-slate-500 dark:text-slate-400">
                            Setup Laravel 11, Livewire 3, Tailwind, migrasi MVP, timezone setting,
                            homefeed, estate show page, & hosting proxies.
                        </p>
                    </article>

                </div>
            </div>

            {{-- Footer --}}
            <div class="mt-4 border-t border-slate-200 pt-5 dark:border-slate-800">
                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                    End of release history
                </p>
            </div>

        </main>
    </div>
</div>
