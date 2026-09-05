<div class="min-h-screen bg-gray-100/60 pb-24">
    {{-- Wrapper Konten Mobile --}}
    <div class="max-w-md mx-auto bg-white min-h-screen shadow-sm px-4 py-6">

        {{-- Header --}}
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('home') }}" wire:navigate class="p-2 bg-gray-100 rounded-xl text-gray-600 hover:bg-gray-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-xl font-bold text-gray-900">Kebijakan Privasi</h1>
        </div>

        {{-- Content Area --}}
        <div class="space-y-4 text-xs text-gray-600 leading-relaxed">
            <section class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <h2 class="font-bold text-gray-900 text-sm mb-1.5">1. Informasi yang Kami Kumpulkan</h2>
                <p>
                    DownloadRumah mengumpulkan informasi dasar saat Anda mendaftar, seperti nama, alamat email, dan nomor telepon untuk keperluan akun serta interaksi properti.
                </p>
            </section>

            <section class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <h2 class="font-bold text-gray-900 text-sm mb-1.5">2. Penggunaan Data</h2>
                <p>
                    Data Anda digunakan untuk memproses pengajuan atau informasi properti, memverifikasi akun, dan memberikan pengalaman penggunaan aplikasi PWA yang lebih optimal.
                </p>
            </section>

            <section class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <h2 class="font-bold text-gray-900 text-sm mb-1.5">3. Keamanan Informasi</h2>
                <p>
                    Kami menerapkan standar keamanan enkripsi SSL/HTTPS serta perlindungan data sesuai ketentuan hukum yang berlaku di Indonesia untuk menjaga data pribadi Anda tetap aman.
                </p>
            </section>

            <section class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <h2 class="font-bold text-gray-900 text-sm mb-1.5">4. Hubungi Kami</h2>
                <p>
                    Jika ada pertanyaan seputar kebijakan privasi ini, Anda dapat menghubungi tim support DownloadRumah melalui kanal komunikasi resmi kami.
                </p>
            </section>
        </div>

    </div>
</div>
