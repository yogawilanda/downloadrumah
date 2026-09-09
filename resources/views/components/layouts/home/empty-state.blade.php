@props(['showReset' => false])

<div class="mx-4 rounded-md border border-dashed border-blue-200 bg-blue-50/60 p-6 text-center">
    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-white text-2xl shadow-sm">⌂</div>
    <p class="text-sm font-bold text-gray-700">Belum ada properti di kategori ini</p>
    <p class="mt-1 text-xs text-gray-500">Coba ubah filter atau lihat lagi nanti.</p>
    @if ($showReset)
        <button wire:click="resetFilter" class="mt-4 rounded-md bg-blue-600 px-4 py-2 text-xs font-bold text-white">
            Reset filter
        </button>
    @endif
</div>
