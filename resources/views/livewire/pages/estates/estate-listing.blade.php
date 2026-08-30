<div class="w-full pb-32 pt-4 px-4 max-w-lg mx-auto space-y-4">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-base font-bold text-gray-900">Listing Properti Saya</h1>
        <a href="{{ route('estates.create') }}" class="px-3 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-xl active:scale-95 transition">
            + Properti
        </a>
    </div>

    <!-- Navigation Tab -->
    <div class="flex bg-gray-100 p-1 rounded-xl">
        <button wire:click="setTab('my_listings')"
            class="flex-1 py-1.5 text-xs font-bold rounded-lg transition {{ $tab === 'my_listings' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500' }}">
            Properti Saya
        </button>
        <button wire:click="setTab('co_broke')"
            class="flex-1 py-1.5 text-xs font-bold rounded-lg transition {{ $tab === 'co_broke' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500' }}">
            Co-Broke (Networking)
        </button>
    </div>

    <!-- Feed Content -->
    <div class="space-y-3">
        @forelse($estates as $estate)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-3 space-y-3">
                <div class="flex gap-3 items-center">
                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0 relative">
                        @if($estate->primaryImage?->url)
                            <img src="{{ $estate->primaryImage->url }}" class="w-full h-full object-cover" alt="{{ $estate->title }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400">No Image</div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-1.5">
                            <h3 class="text-xs font-bold text-gray-900 truncate">{{ $estate->title }}</h3>
                            @if($tab === 'my_listings')
                                <span class="px-1.5 py-0.5 text-[9px] rounded font-semibold {{ $estate->is_published ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $estate->is_published ? 'Publik' : 'Draft' }}
                                </span>
                            @endif
                        </div>
                        <p class="text-xs font-black text-blue-600 mt-0.5">{{ $estate->short_price }}</p>
                        <p class="text-[10px] text-gray-400 truncate mt-0.5">{{ $estate->city }}, {{ $estate->district }}</p>
                    </div>
                </div>

                <!-- Action Button Kondisional -->
                <div class="pt-2 border-t border-gray-50">
                    @if($tab === 'my_listings')
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('estates.edit', $estate->slug) }}" class="py-2 bg-blue-50 text-blue-600 text-xs font-bold text-center rounded-xl">Edit</a>
                            <button wire:click="deleteEstate({{ $estate->id }})" class="py-2 bg-red-50 text-red-600 text-xs font-bold text-center rounded-xl">Hapus</button>
                        </div>
                    @else
                        <!-- Action khusus Co-Broke -->
                        <a href="{{ route('estates.show', $estate->slug) }}" class="block w-full py-2 bg-emerald-50 text-emerald-600 text-xs font-bold text-center rounded-xl">
                            Hubungi Agen (Co-Broke)
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white p-6 rounded-2xl text-center text-xs text-gray-400 border border-gray-100">
                Tidak ada properti ditemukan.
            </div>
        @endforelse

        {{ $estates->links() }}
    </div>
</div>
