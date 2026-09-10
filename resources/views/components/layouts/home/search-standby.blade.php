{{-- KONDISI A: Input Masih Kosong (< 2 Karakter)
resources/views/components/layouts/home/search-standby.blade.php
--}}
<div class="p-3 space-y-3">
    <div class="flex items-center justify-between px-1">
        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Pencarian Populer</p>
        <span class="text-[10px] font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">Rekomendasi</span>
    </div>

    <div class="space-y-1">
        @forelse ($popularCities as $pCity)
            <button type="button" wire:click="selectCitySuggestion('{{ $pCity->code }}')" @click="searchOpen = false"
                class="w-full text-left flex items-center justify-between rounded-md px-2.5 py-2 text-xs font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition group">
                <div class="flex items-center gap-2">
                    <span class="text-blue-500 font-bold">⌖</span>
                    <span>{{ $pCity->name }}</span>
                </div>
                <span class="text-[10px] text-gray-400 group-hover:text-blue-500">Cari ›</span>
            </button>
        @empty
            @for ($i = 0; $i < 3; $i++)
                <div class="flex items-center justify-between p-2 rounded-md bg-gray-50/80 animate-pulse">
                    <div class="h-3.5 w-32 bg-gray-200 rounded"></div>
                    <div class="h-3 w-8 bg-gray-200 rounded"></div>
                </div>
            @endfor
        @endforelse
    </div>
</div>
