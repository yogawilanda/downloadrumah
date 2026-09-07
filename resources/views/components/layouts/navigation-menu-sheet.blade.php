{{--
loc: resources/views/components/layouts/navigation-menu-sheet.blade.php
usage: Center modal menu dialog for navigation
--}}
<div x-show="openMenu" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">

    <!-- Backdrop (Fade-In Only) -->
    <div x-show="openMenu"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        @click="openMenu = false"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

    <!-- Panel Content Modal Tengah (Dengan Margin Horisontal / Inset Space) -->
    <div x-show="openMenu"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="w-full max-w-sm bg-white rounded-3xl shadow-2xl z-10 p-5 space-y-4 max-h-[85vh] overflow-y-auto relative mx-auto">

        <!-- Header Modal -->
        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
            <h3 class="text-sm font-bold text-slate-800">Menu & Informasi</h3>
            <button @click="openMenu = false" class="text-slate-400 hover:text-slate-600 focus:outline-none p-1.5 rounded-xl hover:bg-slate-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Header Status Akun -->
        @guest
            <div class="p-3.5 bg-blue-50/70 border border-blue-100 rounded-2xl flex items-center justify-between">
                <div class="space-y-0.5">
                    <p class="text-xs font-bold text-slate-800">Ingin Pasang Iklan?</p>
                    <p class="text-xs text-slate-500">Masuk untuk kelola propertimu.</p>
                </div>
                <a href="{{ route('login') }}" wire:navigate @click="openMenu = false"
                    class="px-3.5 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-xl shadow-sm hover:bg-blue-700 transition shrink-0">
                    Masuk
                </a>
            </div>
        @else
            <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0 flex-1">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center text-sm shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="space-y-0.5 overflow-hidden">
                        <p class="text-xs font-bold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                {{-- Tombol Keluar Ringkas --}}
                <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                    @csrf
                    <button type="submit"
                        class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200/60 rounded-xl transition text-xs font-bold flex items-center gap-1 active:scale-95">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        @endguest

        <!-- Section 1: Menu utama Pengguna -->
        @auth
            <div class="space-y-2">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider px-1">Navigasi Utama</p>
                <div class="grid grid-cols-1 gap-2">

                    {{-- Dashboard Card --}}
                    <a href="{{ route('dashboard') }}" wire:navigate @click="openMenu = false"
                        class="p-3 bg-blue-50/60 border border-blue-100 hover:bg-blue-100/70 rounded-2xl transition flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-sm shadow-blue-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 group-hover:text-blue-700 transition">Dashboard Agen</p>
                                <p class="text-[11px] font-medium text-slate-500">Ringkasan properti & statistik</p>
                            </div>
                        </div>
                        <span class="text-slate-400 group-hover:text-blue-600 text-xs font-bold">›</span>
                    </a>

                    {{-- Pengaturan Profil Card --}}
                    <a href="{{ route('profile') }}" wire:navigate @click="openMenu = false"
                        class="p-3 bg-slate-50 border border-slate-100 hover:bg-slate-100/80 rounded-2xl transition flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-slate-200 text-slate-700 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition">Pengaturan Akun</p>
                                <p class="text-[11px] font-medium text-slate-500">Ubah nama, foto & kontak</p>
                            </div>
                        </div>
                        <span class="text-slate-400 group-hover:text-blue-600 text-xs font-bold">›</span>
                    </a>

                    {{-- Khusus Super Admin --}}
                    @if (auth()->user()->isSuperAdmin())
                        <a href="{{ route('admin.insights.index') }}" wire:navigate @click="openMenu = false"
                            class="p-3 bg-purple-50/70 border border-purple-100 hover:bg-purple-100/70 rounded-2xl transition flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-purple-600 text-white flex items-center justify-center shrink-0 shadow-sm shadow-purple-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <p class="text-xs font-bold text-slate-800 group-hover:text-purple-700 transition">Admin Dashboard</p>
                                        <span class="text-[9px] bg-purple-600 text-white font-extrabold px-1.5 py-0.2 rounded uppercase">Admin</span>
                                    </div>
                                    <p class="text-[11px] font-medium text-slate-500">Telemetri & statistik sistem</p>
                                </div>
                            </div>
                            <span class="text-slate-400 group-hover:text-purple-600 text-xs font-bold">›</span>
                        </a>
                    @endif

                </div>
            </div>
        @endauth

        <!-- Tombol Dynamic PWA Install -->
        <div x-show="$store.pwa && $store.pwa.canInstall">
            <button @click="$store.pwa.installApp(); openMenu = false" type="button"
                class="w-full flex items-center justify-between p-3 text-blue-700 bg-emerald-50/80 border border-emerald-100 hover:bg-emerald-100/70 rounded-2xl transition text-left group">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-sm shadow-emerald-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14a2 2 0 002-2v-3M3 16v3a2 2 0 002 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Simpan Aplikasi di HP</p>
                        <p class="text-[11px] font-medium text-slate-500">Akses lebih cepat tanpa buka browser</p>
                    </div>
                </div>
                <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-md uppercase border border-emerald-200/60">Gratis</span>
            </button>
        </div>

        <!-- Informasi Umum & Hukum -->
        <div class="pt-2 border-t border-slate-100 space-y-1">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider px-1 mb-1">Informasi Aplikasi</p>

            <a href="{{ route('privacy') }}" wire:navigate @click="openMenu = false"
                class="flex items-center justify-between p-2.5 text-slate-700 hover:bg-slate-50 rounded-xl transition text-xs font-semibold">
                <span>Kebijakan Privasi</span>
                <span class="text-slate-400 text-xs">›</span>
            </a>

            <a href="{{ route('support') }}" wire:navigate @click="openMenu = false"
                class="flex items-center justify-between p-2.5 text-slate-700 hover:bg-slate-50 rounded-xl transition text-xs font-semibold">
                <span>Bantuan / Konsultasi Aplikasi</span>
                <span class="text-slate-400 text-xs">›</span>
            </a>

            <a href="{{ route('terms') }}" wire:navigate @click="openMenu = false"
                class="flex items-center justify-between p-2.5 text-slate-700 hover:bg-slate-50 rounded-xl transition text-xs font-semibold">
                <span>Syarat & Ketentuan</span>
                <span class="text-slate-400 text-xs">›</span>
            </a>

            <a href="{{ route('release-notes') }}" wire:navigate @click="openMenu = false"
                class="flex items-center justify-between p-2.5 text-slate-700 hover:bg-slate-50 rounded-xl transition text-xs font-semibold">
                <span>Release Notes</span>
                <span class="text-xs text-blue-600 font-bold">v0.9.0-alpha</span>
            </a>
        </div>

    </div>
</div>
