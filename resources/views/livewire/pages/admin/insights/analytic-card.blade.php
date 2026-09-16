{{-- -------------------- Context & Meta Configuration ---------------------
| Created | Updated : 25/08/26, 15.30 | 13/09/26, 13.33
|--------------------------------------------------------------------------
| @path      : resources/views/livewire/pages/admin/insights/analytic-card.blade.php
| @usage     : 4-Card Consolidated Insights Section
| @techstack : Laravel 13, Livewire 4, Alpine.js
| @ruling    : max 100 lines. Ask first before changing code.
| @author    : yogawilanda <eayogawilanda@gmail.com>
|----------------------------------------------------------------------- --}}

<div class="grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4">
    {{-- Card 1: Volume & Velocity --}}
    <x-admin.stats-card
        title="Volume & Velocity"
        :value="number_format($totalHits)"
        :badge="'~' . round($totalHits / 6) . '/hr'"
        :subtitle="'Total interaksi (' . number_format($totalHits) . ' hits)'"
        tooltip="Total trafik & rata-rata kecepatan pengguna berinteraksi dengan aplikasi tiap harinya."
        icon-bg="bg-sky-50 dark:bg-sky-950/40"
        icon-color="text-sky-600 dark:text-sky-400"
        action-target="pages"
        action-label="Rincian Event"
    >
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M13 10V3L4 14h7v7l9-11h-7z"
            />
        </svg>
    </x-admin.stats-card>

    {{-- Card 2: Konversi Identity --}}
    <x-admin.stats-card
        title="Konversi Identity"
        :value="($totalHits > 0 ? round(($authenticatedLogs / $totalHits) * 100, 1) : 0) . '%'"
        :badge="number_format($authenticatedLogs) . ' Auth'"
        :subtitle="number_format($authenticatedLogs) . ' Auth / ' . number_format($guestLogs) . ' Guest'"
        tooltip="Rasio persentase & perbandingan total pengunjung terotentikasi (login) vs anonim (guest)."
        icon-bg="bg-emerald-50 dark:bg-emerald-950/40"
        icon-color="text-emerald-600 dark:text-emerald-400"
        action-target="users"
        action-label="Detail User Log"
    >
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
            />
        </svg>
    </x-admin.stats-card>

    {{-- Card 3: Session Depth --}}
    <x-admin.stats-card
        title="Session Depth"
        :value="$uniqueSessions > 0 ? round($totalHits / $uniqueSessions, 1) : 0"
        badge="Hits/Sesi"
        :subtitle="'Dari ' . number_format($uniqueSessions) . ' sesi unik aktif'"
        tooltip="Tingkat keaktifan user: rata-rata jumlah interaksi per sesi dari total sesi unik."
        icon-bg="bg-sky-50 dark:bg-sky-950/40"
        icon-color="text-sky-600 dark:text-sky-400"
        action-target="sessions"
        action-label="Daftar Sesi"
    >
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
            />
        </svg>
    </x-admin.stats-card>

    {{-- Card 4: Area Terpopuler --}}
    <x-admin.stats-card
        title="Area Terpopuler"
        :value="$topPage"
        subtitle="Paling sering dikunjungi"
        tooltip="Halaman atau fitur aplikasi yang paling mendominasi trafik dan menjadi pusat aktivitas user."
        icon-bg="bg-amber-50 dark:bg-amber-950/40"
        icon-color="text-amber-600 dark:text-amber-400"
    >
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
            />
        </svg>
    </x-admin.stats-card>
</div>
