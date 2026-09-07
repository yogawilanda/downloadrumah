<div class="min-h-screen bg-gray-100/60 pb-24">
    <div class="max-w-md mx-auto bg-white min-h-screen shadow-sm px-4 py-6">

        {{-- Header --}}
        <div class="mb-5 flex items-center gap-3 border-b border-gray-100 pb-4">
            <a href="{{ route('home') }}" wire:navigate class="p-2 bg-gray-100 rounded-xl text-gray-600 hover:bg-gray-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-lg font-bold text-gray-900">Catatan Rilis</h1>
                <p class="text-[10px] text-gray-400 font-medium">DownloadRumah Changelog History</p>
            </div>
        </div>

        {{-- ListTile Container --}}
        <div class="space-y-3">

            {{-- Tile 1: Photo Engine (Latest) --}}
            <div class="p-3.5 bg-blue-50/40 border border-blue-100 rounded-2xl space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="bg-blue-600 text-white text-[9px] font-black px-2 py-0.5 rounded-full">v1.1.0-rc</span>
                        <span class="text-[10px] font-semibold text-gray-400">07 Sept 2026 • 22:34 WIB</span>
                    </div>
                    <span class="font-mono text-[9px] bg-blue-100/80 text-blue-700 px-1.5 py-0.5 rounded-md font-bold">e0b9af5</span>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-gray-900">Photo Engine & Cover Selector</h3>
                    <p class="text-[11px] text-gray-600 mt-1 leading-relaxed">
                        Refactor photo picker, instant primary cover selector (is_primary), client-side quota guard via Alpine, & fix photo duplication bug pada wizard.
                    </p>
                </div>
            </div>

            {{-- Tile 2: Admin Telemetry --}}
            <div class="p-3.5 bg-gray-50/80 border border-gray-100 rounded-2xl space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="bg-gray-200 text-gray-700 text-[9px] font-black px-2 py-0.5 rounded-full">v1.0.2</span>
                        <span class="text-[10px] font-semibold text-gray-400">07 Sept 2026 • 12:14 WIB</span>
                    </div>
                    <span class="font-mono text-[9px] bg-gray-200/60 text-gray-600 px-1.5 py-0.5 rounded-md">1209759</span>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-gray-900">Admin Telemetry & User Insights</h3>
                    <p class="text-[11px] text-gray-600 mt-1 leading-relaxed">
                        Dashboard admin insight, activity log telemetry, auto-save draft wizard step, & refinement UI accessibility agen.
                    </p>
                </div>
            </div>

            {{-- Tile 3: Publicity Schema --}}
            <div class="p-3.5 bg-gray-50/80 border border-gray-100 rounded-2xl space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="bg-gray-200 text-gray-700 text-[9px] font-black px-2 py-0.5 rounded-full">v1.0.0</span>
                        <span class="text-[10px] font-semibold text-gray-400">06 Sept 2026 • 19:26 WIB</span>
                    </div>
                    <span class="font-mono text-[9px] bg-gray-200/60 text-gray-600 px-1.5 py-0.5 rounded-md">b129951</span>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-gray-900">Publicity Schema & Throttling</h3>
                    <p class="text-[11px] text-gray-600 mt-1 leading-relaxed">
                        Pemisahan publicity_status & transaction_status, dynamic admin throttling settings, & indexing search optimization.
                    </p>
                </div>
            </div>

            {{-- Tile 4: Regional Data --}}
            <div class="p-3.5 bg-gray-50/80 border border-gray-100 rounded-2xl space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="bg-gray-200 text-gray-700 text-[9px] font-black px-2 py-0.5 rounded-full">v0.9.0</span>
                        <span class="text-[10px] font-semibold text-gray-400">05 Sept 2026 • 12:24 WIB</span>
                    </div>
                    <span class="font-mono text-[9px] bg-gray-200/60 text-gray-600 px-1.5 py-0.5 rounded-md">80ff104</span>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-gray-900">Regional Data & PWA Splashscreen</h3>
                    <p class="text-[11px] text-gray-600 mt-1 leading-relaxed">
                        Standarisasi skema lokasi Laravolt (District/Kecamatan), perbaikan PWA splashscreen, & halaman legalitas publik.
                    </p>
                </div>
            </div>

            {{-- Tile 5: Indonesian Regional --}}
            <div class="p-3.5 bg-gray-50/80 border border-gray-100 rounded-2xl space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="bg-gray-200 text-gray-700 text-[9px] font-black px-2 py-0.5 rounded-full">v0.5.0</span>
                        <span class="text-[10px] font-semibold text-gray-400">03 Sept 2026 • 12:38 WIB</span>
                    </div>
                    <span class="font-mono text-[9px] bg-gray-200/60 text-gray-600 px-1.5 py-0.5 rounded-md">f236fb6</span>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-gray-900">Indonesian Regional Auto-Generation</h3>
                    <p class="text-[11px] text-gray-600 mt-1 leading-relaxed">
                        Generator otomatis provinsi/kota Indonesia, API obfuscation, sistem logging user, dan penanganan modal Auth.
                    </p>
                </div>
            </div>

            {{-- Tile 6: Form Stepper --}}
            <div class="p-3.5 bg-gray-50/80 border border-gray-100 rounded-2xl space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="bg-gray-200 text-gray-700 text-[9px] font-black px-2 py-0.5 rounded-full">v0.3.0</span>
                        <span class="text-[10px] font-semibold text-gray-400">30 Ags 2026 • 18:33 WIB</span>
                    </div>
                    <span class="font-mono text-[9px] bg-gray-200/60 text-gray-600 px-1.5 py-0.5 rounded-md">7cf86d4</span>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-gray-900">Form Stepper & Basic KPR Calc</h3>
                    <p class="text-[11px] text-gray-600 mt-1 leading-relaxed">
                        Wizard Form Properti bertahap (pengurang user fatigue), kompresi upload foto, dan kalkulator KPR awal.
                    </p>
                </div>
            </div>

            {{-- Tile 7: Init --}}
            <div class="p-3.5 bg-gray-50/80 border border-gray-100 rounded-2xl space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="bg-gray-200 text-gray-700 text-[9px] font-black px-2 py-0.5 rounded-full">v0.1.0</span>
                        <span class="text-[10px] font-semibold text-gray-400">24 Ags 2026 • 11:23 WIB</span>
                    </div>
                    <span class="font-mono text-[9px] bg-gray-200/60 text-gray-600 px-1.5 py-0.5 rounded-md">385e81d</span>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-gray-900">Inisialisasi Project & Core Engine</h3>
                    <p class="text-[11px] text-gray-600 mt-1 leading-relaxed">
                        Setup Laravel 11, Livewire 3, Tailwind, migrasi MVP, timezone setting, homefeed, estate show page, & hosting proxies.
                    </p>
                </div>
            </div>

        </div>

    </div>
</div>
