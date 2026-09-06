<section class="mx-4 overflow-hidden rounded-2xl bg-blue-600 p-4 text-white shadow-sm">
    <p class="text-[10px] font-bold uppercase tracking-wider text-blue-100">DownloadRumah</p>
    <h1 class="mt-1 text-xl font-black leading-tight">Cari hunian yang terasa cocok</h1>
    <p class="mt-1 text-xs text-blue-100">Lihat-lihat dulu berdasarkan lokasi, kebutuhan, dan budget.</p>

    <div class="mt-4 grid grid-cols-3 gap-2">
        <a href="{{ route('mortgage.calculator') }}" wire:navigate
            class="rounded-xl bg-white p-2.5 text-left shadow-sm transition active:scale-[.98]">
            <span class="text-lg text-blue-600">⌂</span>
            <span class="mt-1 block text-[11px] font-bold text-gray-800">Beli</span>
            <span class="block text-[10px] text-gray-500">Susun rencana</span>
        </a>
        <a href="{{ route('listings.index', ['transaction_type' => 'rent']) }}" wire:navigate
            class="rounded-xl bg-white p-2.5 text-left shadow-sm transition active:scale-[.98]">
            <span class="text-lg text-blue-600">↔</span>
            <span class="mt-1 block text-[11px] font-bold text-gray-800">Sewa</span>
            <span class="block text-[10px] text-gray-500">Cari yang cocok</span>
        </a>
        <a href="{{ route('listings.index') }}" wire:navigate
            class="rounded-xl bg-white p-2.5 text-left shadow-sm transition active:scale-[.98]">
            <span class="text-lg text-blue-600">⌕</span>
            <span class="mt-1 block text-[11px] font-bold text-gray-800">Lihat-lihat</span>
            <span class="block text-[10px] text-gray-500">Belum menentukan</span>
        </a>
    </div>
</section>
