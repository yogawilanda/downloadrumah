<div class="min-h-screen bg-gray-100/60 pb-24">
    <div class="max-w-md mx-auto bg-white min-h-screen shadow-sm px-4 py-6">

        {{-- Header --}}
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('home') }}" wire:navigate
                class="p-2 bg-gray-100 rounded-xl text-gray-600 hover:bg-gray-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xl font-bold text-gray-900">Pusat Bantuan</h1>
        </div>

        <div class="space-y-4">
            {{-- About Section --}}
            <section class="bg-blue-50/60 p-4 rounded-2xl border border-blue-100">
                <h2 class="font-bold text-blue-900 text-sm mb-1">Tentang DownloadRumah</h2>
                <p class="text-xs text-blue-700/80 leading-relaxed">
                    Platform digital mobile-first untuk pencarian hunian impian, kalkulasi KPR presisi, dan konsultasi
                    properti secara cepat & transparan.
                </p>
            </section>

            {{-- Direct Contact Buttons --}}
            <section class="space-y-2">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-1">Kontak Pengembang</h3>

                <a href="https://wa.me/6285158986696?text=Halo%20Tim%20DownloadRumah,%20saya%20butuh%20bantuan"
                    target="_blank"
                    class="flex items-center justify-between p-3.5 bg-gray-50 hover:bg-gray-100/80 rounded-2xl border border-gray-100 transition group">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 bg-green-100 text-green-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-900">WhatsApp Support</p>
                            <p class="text-[11px] text-gray-500">Respon cepat via Chat</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 group-hover:translate-x-0.5 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=hyoga.wilanda@gmail.com&su=Bantuan%20Aplikasi%20DownloadRumah"
                    target="_blank"
                    class="flex items-center justify-between p-3.5 bg-gray-50 hover:bg-gray-100/80 rounded-2xl border border-gray-100 transition group">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-900">Email Pengembang</p>
                            <p class="text-[11px] text-gray-500">hyoga.wilanda@gmail.com</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 group-hover:translate-x-0.5 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </section>

            {{-- Quick FAQ --}}
            <section class="space-y-2 pt-2">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-1">Pertanyaan Umum</h3>

                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 space-y-3 text-xs text-gray-600">
                    <div>
                        <p class="font-bold text-gray-900 mb-0.5">Apakah simulasi KPR di sini akurat?</p>
                        <p class="text-gray-500">Hasil simulasi merupakan estimasi awal berdasarkan suku bunga acuan
                            bank mitra.</p>
                    </div>
                    <div class="border-t border-gray-200/60 pt-2.5">
                        <p class="font-bold text-gray-900 mb-0.5">Bagaimana cara melaporkan masalah/bug?</p>
                        <p class="text-gray-500">Silakan hubungi WhatsApp Support dengan melampirkan screenshot kendala
                            Anda.</p>
                    </div>
                </div>
            </section>
        </div>

    </div>
</div>
