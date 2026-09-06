@props(['estate', 'tab'])

<article class="space-y-3 rounded-2xl border border-gray-100 bg-white p-3 shadow-sm">
    <div class="flex items-center gap-3">
        <div class="relative h-20 w-20 shrink-0 overflow-hidden rounded-xl bg-gray-100">
            @if ($estate->primaryImage?->url)
                <img src="{{ $estate->primaryImage->url }}" class="h-full w-full object-cover" alt="{{ $estate->title }}">
            @else
                <div class="flex h-full items-center justify-center text-[10px] text-gray-400">No Image</div>
            @endif
        </div>
        <div class="min-w-0 flex-1">
            <div class="flex items-center gap-1.5">
                <h3 class="truncate text-xs font-bold text-gray-900">{{ $estate->title }}</h3>
                @if ($tab === 'my_listings')
                    <span class="rounded bg-gray-100 px-1.5 py-0.5 text-[9px] font-semibold text-gray-600">
                        {{ ucfirst($estate->publicity_status ?? 'draft') }}
                    </span>
                @endif
            </div>
            <p class="mt-0.5 text-xs font-black text-blue-600">{{ $estate->short_price }}</p>
            <p class="mt-0.5 truncate text-[10px] text-gray-400">{{ $estate->short_location_label }}</p>
            @if ($tab === 'co_broke' && $estate->commission_percentage)
                <span class="mt-1 inline-block text-[10px] font-semibold text-emerald-600">Komisi Agen: {{ $estate->commission_percentage }}%</span>
            @endif
        </div>
    </div>
    <div class="border-t border-gray-50 pt-2">
        @if ($tab === 'my_listings')
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('estates.edit', $estate->slug) }}" class="rounded-xl bg-blue-50 py-2 text-center text-xs font-bold text-blue-600">Edit</a>
                <button wire:click="deleteEstate({{ $estate->id }})" class="rounded-xl bg-red-50 py-2 text-xs font-bold text-red-600">Hapus</button>
            </div>
        @else
            <a href="{{ route('estates.show', $estate->slug) }}" class="block w-full rounded-xl bg-emerald-50 py-2 text-center text-xs font-bold text-emerald-600">Hubungi Agen (Co-Broke)</a>
        @endif
    </div>
</article>
