@props(['suggestions', 'search', 'city' => '', 'transaction_type' => '', 'max_price' => ''])

@php($query = array_filter(['search' => $search, 'city' => $city, 'transaction_type' => $transaction_type, 'max_price' => $max_price]))

<div x-show="searchOpen"
    class="absolute left-0 right-0 top-11 z-50 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl">
    @if ($suggestions['cities']->isNotEmpty())
        <div class="border-b border-gray-100 p-3">
            <p class="mb-2 text-[10px] font-bold uppercase tracking-wider text-gray-400">Lokasi</p>
            <div class="space-y-1">
                @foreach ($suggestions['cities'] as $city)
                    <a href="{{ route('listings.index', array_merge($query, ['city' => $city->name])) }}"
                        wire:navigate @click="searchOpen = false"
                        class="flex items-center gap-2 rounded-xl px-2 py-2 text-xs font-semibold text-gray-700 hover:bg-blue-50">
                        <span class="text-blue-600">⌖</span>{{ $city->name }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="p-3">
        <div class="mb-2 flex items-center justify-between">
            <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Properti</p>
            <a href="{{ route('listings.index', $query) }}" wire:navigate
                @click="searchOpen = false" class="text-[10px] font-bold text-blue-600">Lihat semua hasil</a>
        </div>
        @forelse ($suggestions['estates'] as $estate)
            <a href="{{ route('estates.show', $estate->slug) }}" wire:navigate @click="searchOpen = false"
                class="flex items-center gap-2 rounded-xl px-2 py-2 hover:bg-gray-50">
                <div class="h-9 w-9 shrink-0 overflow-hidden rounded-lg bg-gray-100">
                    @if ($estate->primaryImage?->url)
                        <img src="{{ $estate->primaryImage->url }}" class="h-full w-full object-cover" alt="">
                    @endif
                </div>
                <div class="min-w-0">
                    <p class="truncate text-xs font-bold text-gray-800">{{ $estate->title }}</p>
                    <p class="text-[10px] text-blue-600">{{ $estate->short_price }}</p>
                </div>
            </a>
        @empty
            <p class="py-2 text-xs text-gray-400">Belum ada properti yang cocok.</p>
        @endforelse
    </div>
</div>
