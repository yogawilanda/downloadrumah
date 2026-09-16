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
                        DownloadRumah / Legal
                    </span>

                    <h1 class="mt-1 text-xl font-bold text-slate-950 dark:text-white sm:text-2xl">
                        Syarat & Ketentuan
                    </h1>

                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400 sm:text-sm">
                        Ketentuan penggunaan layanan DownloadRumah.
                    </p>
                </div>

            </div>
        </header>

        {{-- Content --}}
        <main class="px-5 py-8 sm:px-8 sm:py-10 lg:px-10">

            <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_180px]">

                {{-- Document --}}
                <article class="max-w-2xl space-y-0">

                    {{-- Section 01 --}}
                    <section class="border-l-2 border-slate-950 py-1 pl-5 dark:border-white sm:pl-6">
                        <span class="font-mono text-[10px] font-bold text-slate-400 dark:text-slate-500">
                            01
                        </span>

                        <h2 class="mt-1 text-base font-bold text-slate-950 dark:text-white sm:text-lg">
                            Ketentuan Penggunaan
                        </h2>

                        <p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300 sm:text-[15px]">
                            Dengan mengakses dan menggunakan platform DownloadRumah,
                            Anda menyetujui untuk mematuhi seluruh syarat dan ketentuan
                            yang berlaku di dalam layanan ini.
                        </p>
                    </section>

                    <div class="my-8 border-t border-slate-200 dark:border-slate-800"></div>

                    {{-- Section 02 --}}
                    <section class="border-l-2 border-slate-200 py-1 pl-5 dark:border-slate-700 sm:pl-6">
                        <span class="font-mono text-[10px] font-bold text-slate-400 dark:text-slate-500">
                            02
                        </span>

                        <h2 class="mt-1 text-base font-bold text-slate-950 dark:text-white sm:text-lg">
                            Akun & Keamanan
                        </h2>

                        <p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300 sm:text-[15px]">
                            Pengguna bertanggung jawab penuh atas kerahasiaan informasi
                            akun, kata sandi, serta seluruh aktivitas transaksi atau
                            pengajuan yang terjadi di dalam akun tersebut.
                        </p>
                    </section>

                    <div class="my-8 border-t border-slate-200 dark:border-slate-800"></div>

                    {{-- Section 03 --}}
                    <section class="border-l-2 border-slate-200 py-1 pl-5 dark:border-slate-700 sm:pl-6">
                        <span class="font-mono text-[10px] font-bold text-slate-400 dark:text-slate-500">
                            03
                        </span>

                        <h2 class="mt-1 text-base font-bold text-slate-950 dark:text-white sm:text-lg">
                            Informasi Properti & Layanan KPR
                        </h2>

                        <p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300 sm:text-[15px]">
                            Seluruh data listings properti dan simulasi KPR disajikan
                            untuk tujuan informasi. Keputusan akhir persetujuan kredit
                            tetap menjadi wewenang pihak perbankan mitra.
                        </p>
                    </section>

                    <div class="my-8 border-t border-slate-200 dark:border-slate-800"></div>

                    {{-- Section 04 --}}
                    <section class="border-l-2 border-slate-200 py-1 pl-5 dark:border-slate-700 sm:pl-6">
                        <span class="font-mono text-[10px] font-bold text-slate-400 dark:text-slate-500">
                            04
                        </span>

                        <h2 class="mt-1 text-base font-bold text-slate-950 dark:text-white sm:text-lg">
                            Perubahan Ketentuan
                        </h2>

                        <p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300 sm:text-[15px]">
                            DownloadRumah berhak untuk memperbarui atau mengubah syarat
                            dan ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya.
                            Pengguna dianjurkan memeriksa halaman ini secara berkala.
                        </p>
                    </section>

                    {{-- Footer --}}
                    <div class="mt-10 border-t border-slate-200 pt-5 dark:border-slate-800">
                        <p class="text-xs leading-6 text-slate-400 dark:text-slate-500">
                            Dengan terus menggunakan DownloadRumah, Anda dianggap telah
                            membaca dan memahami ketentuan yang berlaku.
                        </p>
                    </div>

                </article>

                {{-- Document Index --}}
                <aside class="hidden lg:block">
                    <div class="sticky top-24 border-l border-slate-200 pl-5 dark:border-slate-800">

                        <span class="text-[9px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                            Dalam Dokumen
                        </span>

                        <nav class="mt-4 space-y-3 text-[11px]">
                            <a href="#"
                               class="block font-bold text-slate-950 dark:text-white">
                                01 &nbsp; Ketentuan Penggunaan
                            </a>

                            <a href="#"
                               class="block text-slate-500 hover:text-slate-950 dark:text-slate-400 dark:hover:text-white">
                                02 &nbsp; Akun & Keamanan
                            </a>

                            <a href="#"
                               class="block text-slate-500 hover:text-slate-950 dark:text-slate-400 dark:hover:text-white">
                                03 &nbsp; Informasi Properti & KPR
                            </a>

                            <a href="#"
                               class="block text-slate-500 hover:text-slate-950 dark:text-slate-400 dark:hover:text-white">
                                04 &nbsp; Perubahan Ketentuan
                            </a>
                        </nav>

                    </div>
                </aside>

            </div>

        </main>
    </div>
</div>
