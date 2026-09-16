<div class="min-h-screen bg-slate-50 pb-24 dark:bg-slate-950">

    {{-- Document Wrapper --}}
    <div class="mx-auto min-h-screen w-full max-w-4xl bg-white dark:bg-slate-900">

        {{-- Content Container --}}
        <div class="px-5 py-6 sm:px-8 sm:py-8 lg:px-12 lg:py-10">

            {{-- Header --}}
            <header class="mb-8 border-b border-slate-200 pb-6 dark:border-slate-800">
                <div class="mb-6">
                    <a
                        href="{{ route('home') }}"
                        wire:navigate
                        class="inline-flex h-9 w-9 items-center justify-center border border-slate-200 text-slate-500 transition hover:border-slate-950 hover:bg-slate-950 hover:text-white dark:border-slate-700 dark:text-slate-400 dark:hover:border-white dark:hover:bg-white dark:hover:text-slate-950"
                        aria-label="Kembali ke beranda"
                    >
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="square"
                                stroke-linejoin="miter"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>
                    </a>
                </div>

                <div class="max-w-2xl">
                    <span class="block text-[9px] font-bold uppercase tracking-[0.18em] text-slate-400 dark:text-slate-500">
                        DownloadRumah / Legal
                    </span>

                    <h1 class="mt-1 text-xl font-bold tracking-tight text-slate-950 sm:text-2xl dark:text-white">
                        Kebijakan Privasi
                    </h1>

                    <p class="mt-2 max-w-xl text-[11px] leading-relaxed text-slate-400 dark:text-slate-500 sm:text-xs">
                        Informasi mengenai pengumpulan, penggunaan, dan perlindungan data pengguna.
                    </p>
                </div>
            </header>

            {{-- Main Document --}}
            <main class="grid grid-cols-1 gap-8 lg:grid-cols-[minmax(0,1fr)_180px]">

                {{-- Policy Content --}}
                <div class="max-w-2xl space-y-8 text-xs leading-7 text-slate-600 dark:text-slate-400">

                    {{-- 01 --}}
                    <section class="border-l-2 border-slate-950 pl-4 dark:border-white sm:pl-5">
                        <div class="mb-2 flex items-baseline gap-3">
                            <span class="text-[9px] font-bold tracking-[0.12em] text-slate-400 dark:text-slate-500">
                                01
                            </span>

                            <h2 class="text-sm font-bold leading-tight text-slate-950 dark:text-white">
                                Informasi yang Kami Kumpulkan
                            </h2>
                        </div>

                        <p>
                            DownloadRumah mengumpulkan informasi dasar saat Anda mendaftar,
                            seperti nama, alamat email, dan nomor telepon untuk keperluan akun
                            serta interaksi properti.
                        </p>
                    </section>

                    {{-- 02 --}}
                    <section class="border-l-2 border-slate-200 pl-4 dark:border-slate-700 sm:pl-5">
                        <div class="mb-2 flex items-baseline gap-3">
                            <span class="text-[9px] font-bold tracking-[0.12em] text-slate-400 dark:text-slate-500">
                                02
                            </span>

                            <h2 class="text-sm font-bold leading-tight text-slate-950 dark:text-white">
                                Data Teknis & Telemetry
                            </h2>
                        </div>

                        <p>
                            Untuk keperluan keamanan sistem, analisis performa, dan peningkatan
                            pengalaman pengguna, aplikasi mencatat informasi teknis non-sensitif
                            secara otomatis meliputi alamat IP, tipe peramban (user agent),
                            halaman yang dikunjungi, serta nilai simulasi kalkulator KPR anonim.
                        </p>
                    </section>

                    {{-- 03 --}}
                    <section class="border-l-2 border-slate-200 pl-4 dark:border-slate-700 sm:pl-5">
                        <div class="mb-2 flex items-baseline gap-3">
                            <span class="text-[9px] font-bold tracking-[0.12em] text-slate-400 dark:text-slate-500">
                                03
                            </span>

                            <h2 class="text-sm font-bold leading-tight text-slate-950 dark:text-white">
                                Penggunaan Data
                            </h2>
                        </div>

                        <p>
                            Data Anda digunakan untuk memproses pengajuan atau informasi properti,
                            memverifikasi akun, mendeteksi potensi serangan siber, serta memberikan
                            pengalaman penggunaan aplikasi PWA yang lebih optimal.
                        </p>
                    </section>

                    {{-- 04 --}}
                    <section class="border-l-2 border-slate-200 pl-4 dark:border-slate-700 sm:pl-5">
                        <div class="mb-2 flex items-baseline gap-3">
                            <span class="text-[9px] font-bold tracking-[0.12em] text-slate-400 dark:text-slate-500">
                                04
                            </span>

                            <h2 class="text-sm font-bold leading-tight text-slate-950 dark:text-white">
                                Keamanan & Retensi Informasi
                            </h2>
                        </div>

                        <p>
                            Kami menerapkan standar enkripsi SSL/HTTPS serta perlindungan data
                            sesuai ketentuan UU No. 27 Tahun 2022 tentang Perlindungan Data
                            Pribadi (UU PDP). Data aktivitas teknis disimpan secara berkala
                            dan diakses secara terbatas oleh tim internal yang berwenang.
                        </p>
                    </section>

                    {{-- 05 --}}
                    <section class="border-l-2 border-slate-200 pl-4 dark:border-slate-700 sm:pl-5">
                        <div class="mb-2 flex items-baseline gap-3">
                            <span class="text-[9px] font-bold tracking-[0.12em] text-slate-400 dark:text-slate-500">
                                05
                            </span>

                            <h2 class="text-sm font-bold leading-tight text-slate-950 dark:text-white">
                                Hubungi Kami
                            </h2>
                        </div>

                        <p>
                            Jika ada pertanyaan seputar kebijakan privasi ini, Anda dapat
                            menghubungi tim support DownloadRumah melalui kanal komunikasi
                            resmi kami.
                        </p>
                    </section>

                </div>

                {{-- Desktop Document Index --}}
                <aside class="hidden lg:block">
                    <div class="sticky top-6 border-l border-slate-200 pl-4 dark:border-slate-800">
                        <span class="block text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">
                            Dokumen
                        </span>

                        <div class="mt-3 space-y-2 text-[9px] font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500">
                            <div>01 / Informasi</div>
                            <div>02 / Telemetry</div>
                            <div>03 / Penggunaan</div>
                            <div>04 / Keamanan</div>
                            <div>05 / Kontak</div>
                        </div>
                    </div>
                </aside>

            </main>

            {{-- Footer --}}
            <footer class="mt-10 border-t border-slate-200 pt-4 dark:border-slate-800">
                <div class="flex flex-col gap-2 text-[9px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                    <span>Privacy / Policy</span>
                    <span>DownloadRumah</span>
                </div>
            </footer>

        </div>
    </div>
</div>
