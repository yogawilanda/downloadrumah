{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/agent-dashboard.blade.php
| @usage      : Main Responsive Dashboard View for Real Estate Agents
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="w-full pb-32 pt-4 sm:pt-6 md:pt-8 px-3.5 sm:px-6 lg:px-8 max-w-full md:max-w-4xl lg:max-w-6xl mx-auto space-y-6">

    <!-- 1. Header & Quick Action -->
    <div class="bg-white p-4 sm:p-6 rounded-md border border-slate-100 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-base sm:text-xl font-bold text-slate-900">Halo, {{ auth()->user()->name }} 👋</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Ruang kerja properti</p>
            <span class="mt-2 inline-block rounded-md bg-blue-50/80 px-2.5 py-0.5 text-[11px] font-bold text-blue-600 border border-blue-100">
                User / Agent MVP
            </span>
        </div>
        <a href="{{ route('estates.create') }}" wire:navigate
            class="w-full sm:w-auto px-4 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white text-xs font-bold rounded-md transition flex items-center justify-center gap-1 shadow-sm shadow-blue-200">
            <span>+ Properti Baru</span>
        </a>
    </div>

    @if (session('success'))
        <div class="p-3.5 bg-emerald-50/80 border border-emerald-200/60 text-emerald-700 text-xs rounded-md font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <!-- 2. Ringkasan Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div class="bg-white p-4 rounded-md border border-slate-100 shadow-sm flex flex-col justify-between">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Iklan Saya</p>
            <div class="mt-2 flex items-baseline gap-1">
                <span class="text-2xl sm:text-3xl font-black text-blue-600">{{ $listingCount }}</span>
                <span class="text-xs font-bold text-emerald-600" title="Terpublikasi">
                    / {{ $publishedListingCount ?? 0 }}
                </span>
            </div>
            <p class="text-[11px] font-medium text-slate-400 mt-1">Total / Tayang</p>
        </div>

        <div class="bg-white p-4 rounded-md border border-slate-100 shadow-sm flex flex-col justify-between">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Performa</p>
            <div class="mt-2 flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400">Soon</span>
                <span class="text-[10px] px-1.5 py-0.5 rounded-md bg-amber-50 text-amber-600 font-bold border border-amber-200/50">New</span>
            </div>
            <p class="text-[11px] font-medium text-slate-400 mt-1">Tayangan Listing</p>
        </div>

        <div class="bg-white p-4 rounded-md border border-slate-100 shadow-sm flex flex-col justify-between">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status Akun</p>
            <p class="text-xs sm:text-sm font-bold text-emerald-600 mt-2">Aktif</p>
            <p class="text-[11px] font-medium text-slate-400 mt-1">Akun Agen Verified</p>
        </div>
    </div>

    <!-- 3. Quick Menu Aplikasi -->
    <div class="space-y-2.5">
        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-1">Menu Aplikasi</p>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
            <a href="{{ route('dashboard.estates') }}" wire:navigate
                class="p-4 bg-white rounded-md border border-slate-100 shadow-sm hover:border-blue-200 transition flex flex-col justify-between">
                <p class="text-xs sm:text-sm font-bold text-slate-800">Kelola Listing</p>
                <p class="text-[11px] text-slate-400 mt-0.5">Atur & Publikasikan</p>
            </a>

            <div class="p-4 bg-white rounded-md border border-slate-100 shadow-sm opacity-80 flex flex-col justify-between relative overflow-hidden">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-xs sm:text-sm font-bold text-slate-800 truncate">Insight Performa</p>
                    <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded-md border border-amber-200/50 shrink-0">Soon</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-0.5">Statistik Penonton</p>
            </div>

            <div class="p-4 bg-white rounded-md border border-slate-100 shadow-sm opacity-80 flex flex-col justify-between">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-xs sm:text-sm font-bold text-slate-800 truncate">Properti Disimpan</p>
                    <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded-md border border-amber-200/50 shrink-0">Soon</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-0.5">Favorit Saya</p>
            </div>

            <div class="p-4 bg-white rounded-md border border-slate-100 shadow-sm opacity-80 flex flex-col justify-between">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-xs sm:text-sm font-bold text-slate-800 truncate">Pengaturan Profil</p>
                    <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded-md border border-amber-200/50 shrink-0">Soon</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-0.5">Identitas Kontak</p>
            </div>
        </div>
    </div>

    <!-- 4. Listing Terbaru -->
    <div class="space-y-3">
        <div class="flex items-center justify-between px-1">
            <h2 class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Listing Properti Anda</h2>
            <a href="{{ route('dashboard.estates') }}" wire:navigate
                class="text-xs font-bold text-blue-600 hover:underline">
                Lihat Semua
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-3">
            @forelse($estates->take(5) as $estate)
                <a href="{{ route('estates.show', $estate->slug) }}" wire:navigate
                    wire:key="dashboard-estate-{{ $estate->id }}"
                    class="p-3.5 sm:p-4 bg-white rounded-md border border-slate-100 shadow-sm hover:border-blue-200 hover:shadow-md transition-all flex items-center justify-between gap-3.5 group cursor-pointer">

                    <div class="flex items-center gap-3.5 min-w-0 flex-1">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-md bg-slate-100 flex-shrink-0 overflow-hidden relative border border-slate-100">
                            @if ($estate->primaryImage?->url)
                                <img src="{{ $estate->primaryImage->url }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                    alt="{{ $estate->title }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[10px] font-medium text-slate-400">
                                    No Img
                                </div>
                            @endif
                        </div>

                        <div class="min-w-0 flex-1 space-y-0.5">
                            <h3 class="text-xs sm:text-sm font-bold text-slate-800 truncate group-hover:text-blue-600 transition leading-snug">
                                {{ $estate->title }}
                            </h3>

                            <div class="flex items-center gap-2 pt-0.5">
                                <p class="text-xs font-black text-blue-600">{{ $estate->short_price }}</p>

                                @php
                                    $badgeStyle = match ($estate->publicity_status) {
                                        'published' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                                        'archived' => 'bg-rose-50 text-rose-700 border-rose-200/60',
                                        default => 'bg-amber-50 text-amber-700 border-amber-200/60',
                                    };
                                @endphp

                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider border {{ $badgeStyle }}">
                                    {{ $estate->publicity_status }}
                                </span>
                            </div>

                            <p class="text-xs text-slate-500 font-medium truncate pt-0.5">
                                {{ $estate->short_location_label }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center shrink-0 text-slate-300 group-hover:text-blue-600 group-hover:translate-x-0.5 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            @empty
                <div class="p-6 bg-white rounded-md border border-slate-100 text-center text-xs font-medium text-slate-400">
                    Belum ada properti diunggah.
                </div>
            @endforelse
        </div>
    </div>
</div>
