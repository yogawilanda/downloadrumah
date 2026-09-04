<div class="w-full pb-32 pt-4 px-4 max-w-lg mx-auto space-y-4">
    <!-- 1. Header & Quick Action -->
    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-base font-bold text-gray-900">Halo, {{ auth()->user()->name }} 👋</h1>
            <p class="text-xs text-gray-500 mt-0.5">Panel Kontrol Agen</p>
        </div>
        <a href="{{ route('estates.create') }}"
           class="px-3 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl active:scale-95 transition flex items-center gap-1 shadow-sm shadow-blue-200">
            <span>+ Properti</span>
        </a>
    </div>

    @if (session('success'))
        <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- 2. Ringkasan Statistik -->
    <div class="grid grid-cols-2 gap-3">
        <div class="bg-white p-3.5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Total Properti</p>
            <p class="text-2xl font-black text-blue-600 mt-0.5">{{ $activeCount }}</p>
        </div>
        <div class="bg-white p-3.5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Status Akun</p>
            <p class="text-sm font-bold text-emerald-600 mt-2">Agen Aktif</p>
        </div>
    </div>

    <!-- 3. Shortcut Tools & Navigasi Cepat -->
    <div class="bg-white p-3.5 rounded-2xl border border-gray-100 shadow-sm space-y-2">
        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Akses Cepat</p>
        <div class="grid grid-cols-2 gap-2">
            <a href="{{ route('listings.index') }}"
               class="p-2.5 bg-gray-50 hover:bg-gray-100 rounded-xl border border-gray-100 flex items-center justify-between text-xs font-bold text-gray-700 transition">
                <span>Kelola Listing</span>
                <span class="text-blue-600">→</span>
            </a>
            <a href="{{ route('mortgage.calculator') }}"
               class="p-2.5 bg-gray-50 hover:bg-gray-100 rounded-xl border border-gray-100 flex items-center justify-between text-xs font-bold text-gray-700 transition">
                <span>Kalkulator KPR</span>
                <span class="text-blue-600">→</span>
            </a>
        </div>
    </div>

    <!-- 4. Listing Terbaru (Compact Widget) -->
    <div class="space-y-2.5">
        <div class="flex items-center justify-between px-1">
            <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Properti Terbaru</h2>
            <a href="{{ route('listings.index') }}" class="text-xs font-bold text-blue-600 hover:underline">
                Lihat Semua
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm divide-y divide-gray-50 overflow-hidden">
            @forelse($estates->take(5) as $estate)
                <div class="p-3 flex items-center justify-between gap-3 hover:bg-gray-50/50 transition">
                    <div class="flex items-center gap-3 min-w-0">
                        <!-- Thumbnail Mini -->
                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden relative border border-gray-100">
                            @php
                                $cover = $estate->primaryImage ?? $estate->attachments?->first();
                                $coverUrl = null;
                                if ($cover && $cover->file_path) {
                                    $cleanPath = ltrim(str_replace('public/', '', $cover->file_path), '/');
                                    $coverUrl = url('media/' . $cleanPath);
                                }
                            @endphp

                            @if($coverUrl)
                                <img src="{{ $coverUrl }}" class="w-full h-full object-cover alt="{{ $estate->title }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[8px] text-gray-400">No Img</div>
                            @endif
                        </div>

                        <!-- Mini Info -->
                        <div class="min-w-0">
                            <h3 class="text-xs font-bold text-gray-900 truncate">{{ $estate->title }}</h3>
                            <p class="text-[11px] font-extrabold text-blue-600 mt-0.5">{{ $estate->short_price }}</p>
                        </div>
                    </div>

                    <!-- Quick Action -->
                    <a href="{{ route('estates.edit', $estate->slug) }}"
                       class="px-2.5 py-1 bg-blue-50 text-blue-600 text-[11px] font-bold rounded-lg shrink-0">
                        Edit
                    </a>
                </div>
            @empty
                <div class="p-6 text-center text-xs text-gray-400">
                    Belum ada properti diunggah.
                </div>
            @endforelse
        </div>
    </div>
</div>
