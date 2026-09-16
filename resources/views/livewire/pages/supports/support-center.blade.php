<div class="min-h-screen bg-slate-50 pb-24 dark:bg-slate-950">

    <div class="mx-auto min-h-screen w-full max-w-4xl bg-white dark:bg-slate-900">

        {{-- Header --}}
        <header class="border-b border-slate-200 px-5 py-6 dark:border-slate-800 sm:px-8 lg:px-10">
            <div class="flex items-center gap-4">

                <a
                    href="{{ route('home') }}"
                    wire:navigate
                    class="flex h-10 w-10 shrink-0 items-center justify-center border border-slate-200 bg-white text-slate-600 transition hover:border-slate-950 hover:text-slate-950 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-400 dark:hover:border-white dark:hover:text-white"
                    aria-label="Kembali ke beranda"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="square"
                            stroke-linejoin="miter"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </a>

                <div>
                    <span class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                        DownloadRumah / Support
                    </span>

                    <h1 class="mt-1 text-xl font-bold text-slate-950 dark:text-white sm:text-2xl">
                        Pusat Bantuan
                    </h1>
                </div>

            </div>
        </header>

        <main class="px-5 py-7 sm:px-8 sm:py-9 lg:px-10 lg:py-10">

            <div class="max-w-2xl space-y-8">

                {{-- About --}}
                <section class="border-l-4 border-slate-950 bg-slate-50 p-5 dark:border-white dark:bg-slate-950 sm:p-6">
                    <span class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400 dark:text-slate-500">
                        Tentang Platform
                    </span>

                    <h2 class="mt-2 text-base font-bold text-slate-950 dark:text-white sm:text-lg">
                        Tentang DownloadRumah
                    </h2>

                    <p class="mt-2 text-sm leading-7 text-slate-600 dark:text-slate-300 sm:text-[15px]">
                        Platform digital mobile-first untuk pencarian hunian impian,
                        kalkulasi KPR presisi, dan konsultasi properti secara cepat
                        & transparan.
                    </p>
                </section>

                {{-- Contact --}}
                <section>
                    <div class="mb-3 border-b border-slate-200 pb-3 dark:border-slate-800">
                        <span class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                            Support
                        </span>

                        <h2 class="mt-1 text-base font-bold text-slate-950 dark:text-white">
                            Kontak Pengembang
                        </h2>
                    </div>

                    <div class="space-y-3">

                        {{-- WhatsApp --}}
                        <a
                            href="https://wa.me/6285158986696?text=Halo%20Tim%20DownloadRumah,%20saya%20butuh%20bantuan"
                            target="_blank"
                            class="group flex items-center justify-between gap-4 border border-slate-200 bg-white p-4 transition hover:border-slate-950 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:hover:border-white dark:hover:bg-slate-950 sm:p-5"
                        >
                            <div class="flex min-w-0 items-center gap-4">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center bg-slate-950 text-white dark:bg-white dark:text-slate-950">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"
                                        />
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-slate-950 dark:text-white sm:text-[15px]">
                                        WhatsApp Support
                                    </p>

                                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400 sm:text-sm">
                                        Respon cepat via Chat
                                    </p>
                                </div>
                            </div>

                            <svg
                                class="h-5 w-5 shrink-0 text-slate-400 transition group-hover:translate-x-1 group-hover:text-slate-950 dark:group-hover:text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="square"
                                    stroke-linejoin="miter"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </a>

                        {{-- Email --}}
                        <a
                            href="https://mail.google.com/mail/?view=cm&fs=1&to=hyoga.wilanda@gmail.com&su=Bantuan%20Aplikasi%20DownloadRumah"
                            target="_blank"
                            class="group flex items-center justify-between gap-4 border border-slate-200 bg-white p-4 transition hover:border-slate-950 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:hover:border-white dark:hover:bg-slate-950 sm:p-5"
                        >
                            <div class="flex min-w-0 items-center gap-4">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center bg-slate-950 text-white dark:bg-white dark:text-slate-950">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="square"
                                            stroke-linejoin="miter"
                                            stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                        />
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-slate-950 dark:text-white sm:text-[15px]">
                                        Email Pengembang
                                    </p>

                                    <p class="mt-0.5 break-all text-xs text-slate-500 dark:text-slate-400 sm:text-sm">
                                        hyoga.wilanda@gmail.com
                                    </p>
                                </div>
                            </div>

                            <svg
                                class="h-5 w-5 shrink-0 text-slate-400 transition group-hover:translate-x-1 group-hover:text-slate-950 dark:group-hover:text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="square"
                                    stroke-linejoin="miter"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </a>

                    </div>
                </section>

                {{-- FAQ --}}
                <section>
                    <div class="mb-3 border-b border-slate-200 pb-3 dark:border-slate-800">
                        <span class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                            FAQ
                        </span>

                        <h2 class="mt-1 text-base font-bold text-slate-950 dark:text-white">
                            Pertanyaan Umum
                        </h2>
                    </div>

                    <div class="border border-slate-200 dark:border-slate-800">

                        <div class="p-5 sm:p-6">
                            <h3 class="text-sm font-bold leading-6 text-slate-950 dark:text-white sm:text-[15px]">
                                Apakah simulasi KPR di sini akurat?
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">
                                Hasil simulasi merupakan estimasi awal berdasarkan
                                suku bunga acuan bank mitra.
                            </p>
                        </div>

                        <div class="border-t border-slate-200 p-5 dark:border-slate-800 sm:p-6">
                            <h3 class="text-sm font-bold leading-6 text-slate-950 dark:text-white sm:text-[15px]">
                                Bagaimana cara melaporkan masalah/bug?
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">
                                Silakan hubungi WhatsApp Support dengan melampirkan
                                screenshot kendala Anda.
                            </p>
                        </div>

                    </div>
                </section>

            </div>

        </main>
    </div>
</div>
