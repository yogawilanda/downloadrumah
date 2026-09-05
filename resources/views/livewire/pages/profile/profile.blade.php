{{--
loc: resources/views/livewire/pages/profile/profile.blade.php
usage: User profile settings page layout inside mobile container
--}}
<div class="min-h-screen bg-gray-100 flex justify-center items-start">
    <div class="w-full max-w-md bg-white min-h-screen md:min-h-[844px] md:shadow-xl md:border md:border-gray-200 relative overflow-hidden pb-24">

        <!-- Header / Top Nav Bar -->
        <div class="sticky top-0 z-30 bg-white/95 backdrop-blur-md px-4 pt-4 pb-3 border-b border-gray-100 shadow-sm flex items-center justify-between">
            <h1 class="text-base font-bold text-gray-900">Pengaturan Akun</h1>
            <a href="{{ route('home') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">
                Ke Beranda
            </a>
        </div>

        <!-- Main Content Area -->
        <div class="p-4 space-y-4">
            <!-- Header Kartu Profil Ringkas -->
            <div class="flex items-center gap-3 p-3 bg-blue-50/50 rounded-2xl border border-blue-100">
                <div class="w-12 h-12 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center text-lg shadow-sm shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="space-y-0.5 overflow-hidden">
                    <h2 class="text-sm font-bold text-gray-800 truncate">{{ auth()->user()->name }}</h2>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <!-- Form 1: Informasi Profil -->
            <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-2xl space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Informasi Pribadi</h3>
                <livewire:pages.profile.partials.update-profile-information-form />
            </div>

            <!-- Form 2: Ubah Password -->
            <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-2xl space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Keamanan & Sandi</h3>
                <livewire:pages.profile.partials.update-password-form />
            </div>

            <!-- Form 3: Hapus Akun -->
            <div class="p-4 bg-red-50/50 border border-red-100 rounded-2xl space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-red-400">Zona Bahaya</h3>
                <livewire:pages.profile.partials.delete-user-form />
            </div>
        </div>

        <!-- Bottom Navigation Bar -->
        <x-layouts.navigation />
    </div>
</div>
