<div class="w-full pb-32 pt-4 px-4 max-w-lg mx-auto space-y-4">
    <!-- Header Agen -->
    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
        <h1 class="text-base font-bold text-gray-900">Halo, {{ auth()->user()->name }} 👋</h1>
        <p class="text-xs text-gray-500 mt-0.5">Panel Agen Properti</p>
    </div>

    @if (session('success'))
        <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Ringkasan Statistik -->
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

    <!-- Daftar Properti Agen -->
    <div class="space-y-3">
        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider px-1">Properti Saya</h2>

        @forelse($estates as $estate)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-3 space-y-3">
                <div class="flex gap-3 items-center">
                    <!-- Image Thumbnail menggunakan Accessor ->url dari EstateAttachment -->
                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0 relative border border-gray-100">
                       @php
    $cover = $estate->primaryImage ?? $estate->attachments?->first();
    $coverUrl = null;

    if ($cover && $cover->file_path) {
        $cleanPath = ltrim(str_replace('public/', '', $cover->file_path), '/');
        $coverUrl = url('media/' . $cleanPath);
    }
@endphp

@if($coverUrl)
    <img src="{{ $coverUrl }}" class="w-full h-full object-cover" alt="{{ $estate->title }}">
@else
                            <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400 font-medium">
                                No Image
                            </div>
                        @endif

                        <span class="absolute top-1 left-1 px-1.5 py-0.5 text-[9px] font-bold rounded-md {{ $estate->transaction_type === 'sale' ? 'bg-emerald-500 text-white' : 'bg-blue-500 text-white' }}">
                            {{ $estate->transaction_type === 'sale' ? 'Jual' : 'Sewa' }}
                        </span>
                    </div>

                    <!-- Info Properti -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-xs font-bold text-gray-900 truncate">{{ $estate->title }}</h3>
                        <p class="text-xs font-black text-blue-600 mt-0.5">{{ $estate->short_price }}</p>
                        <p class="text-[10px] text-gray-400 truncate mt-0.5">{{ $estate->city }}, {{ $estate->district }}</p>
                    </div>
                </div>

                <!-- Action Buttons Mobile -->
                <div class="grid grid-cols-2 gap-2 pt-1 border-t border-gray-50">
                    <a href="{{ route('estates.edit', $estate->slug) }}"
                        class="py-2.5 rounded-xl bg-blue-50 text-blue-600 text-xs font-bold text-center active:scale-95 transition">
                        Edit
                    </a>
                    <button wire:click="deleteEstate({{ $estate->id }})" wire:confirm="Yakin ingin menghapus properti ini?"
                        class="py-2.5 rounded-xl bg-red-50 text-red-600 text-xs font-bold text-center active:scale-95 transition">
                        Hapus
                    </button>
                </div>
            </div>
        @empty
            <div class="bg-white p-6 rounded-2xl border border-gray-100 text-center space-y-2">
                <p class="text-xs text-gray-400">Kamu belum mengunggah properti apapun.</p>
            </div>
        @endforelse

        <div class="pt-2">
            {{ $estates->links() }}
        </div>
    </div>
</div>
