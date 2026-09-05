<div class="min-h-screen bg-gray-100/60 pb-24">
    <div class="max-w-md mx-auto bg-white min-h-screen shadow-sm px-4 py-6">

        {{-- Header --}}
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('home') }}" wire:navigate class="p-2 bg-gray-100 rounded-xl text-gray-600 hover:bg-gray-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-xl font-bold text-gray-900">Catatan Rilis</h1>
        </div>

        {{-- Timeline List --}}
        <div class="relative border-s-2 border-gray-100 ms-3 space-y-6">

            {{-- Timeline 3: Status Sekarang (Internal Alpha/Testing) --}}
            <div class="mb-6 ms-6">
                <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-4 ring-white">
                    <svg class="w-3.5 h-3.5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </span>

                <div class="flex items-center gap-2 mb-1">
                    <span class="bg-blue-600 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full">v0.9.0-alpha</span>
                    <span class="text-[11px] font-medium text-gray-400">9 September 2026</span>
                </div>

                <h3 class="text-sm font-bold text-gray-900 mb-2">Internal Testing & PWA Optimization</h3>

                <ul class="bg-gray-50 p-3.5 rounded-2xl border border-gray-100 space-y-2 text-xs text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600 font-bold">•</span>
                        <span>Implementasi install prompt PWA custom dengan banner & opsi "Ingatkan Nanti".</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600 font-bold">•</span>
                        <span>Penyempurnaan splash screen Android, status bar, dan eliminasi efek flicker/double splash.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600 font-bold">•</span>
                        <span>Penyediaan halaman legalitas publik (Kebijakan Privasi, ToS, & Support Center).</span>
                    </li>
                </ul>
            </div>

            {{-- Timeline 2: Fase Development Core Features --}}
            <div class="mb-6 ms-6">
                <span class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3 ring-4 ring-white">
                    <div class="w-2.5 h-2.5 bg-gray-400 rounded-full"></div>
                </span>

                <div class="flex items-center gap-2 mb-1">
                    <span class="bg-gray-200 text-gray-700 text-[10px] font-extrabold px-2 py-0.5 rounded-full">v0.5.0-dev</span>
                    <span class="text-[11px] font-medium text-gray-400">30 Agustus 2026</span>
                </div>

                <h3 class="text-sm font-bold text-gray-900 mb-2">Pengembangan Fitur Utama & Auth</h3>

                <ul class="bg-gray-50 p-3.5 rounded-2xl border border-gray-100 space-y-2 text-xs text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="text-gray-400 font-bold">•</span>
                        <span>Pembangunan modul Autentikasi (Login & Register) dengan UI transition bawaan Alpine.js.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-gray-400 font-bold">•</span>
                        <span>Inisialisasi Service Worker dan konfigurasinya dengan `site.webmanifest`.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-gray-400 font-bold">•</span>
                        <span>Penataan layout mobile-first container beserta bottom navigation bar.</span>
                    </li>
                </ul>
            </div>

            {{-- Timeline 1: Inisiasi Proyek --}}
            <div class="mb-6 ms-6">
                <span class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3 ring-4 ring-white">
                    <div class="w-2.5 h-2.5 bg-gray-400 rounded-full"></div>
                </span>

                <div class="flex items-center gap-2 mb-1">
                    <span class="bg-gray-200 text-gray-700 text-[10px] font-extrabold px-2 py-0.5 rounded-full">v0.1.0-init</span>
                    <span class="text-[11px] font-medium text-gray-400">20 Agustus 2026</span>
                </div>

                <h3 class="text-sm font-bold text-gray-900 mb-2">Inisiasi Proyek & Arsitektur</h3>

                <ul class="bg-gray-50 p-3.5 rounded-2xl border border-gray-100 space-y-2 text-xs text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="text-gray-400 font-bold">•</span>
                        <span>Setup ekosistem awal Laravel 11, Livewire 3, Tailwind CSS, dan Vite.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-gray-400 font-bold">•</span>
                        <span>Perancangan struktur basis data, aset favicon, dan panduan arsitektur modular.</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</div>
