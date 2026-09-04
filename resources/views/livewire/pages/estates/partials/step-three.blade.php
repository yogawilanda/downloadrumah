<div class="space-y-4">
    <h2 class="text-base font-bold text-center text-gray-900">Info Tambahan</h2>

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-4">
        <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
            <span class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </span>
            <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Kontak Pemilik (Internal)</h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <!-- Nama Pemilik -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Pemilik Properti</label>
                <input type="text" wire:model="form.owner_name" placeholder="Contoh: Bpk. Agus"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-2.5 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
                @error('form.owner_name')
                    <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Telepon Pemilik -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">No. HP Pemilik</label>
                <input type="text" wire:model="form.owner_phone" placeholder="Contoh: 081234567890"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-2.5 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
                @error('form.owner_phone')
                    <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Toggle Tampilkan Nomor HP -->
        <div class="flex items-center justify-between pt-3 border-t border-gray-100 gap-4">
            <div>
                <span class="block text-xs font-semibold text-gray-800">Tampilkan No. HP Pemilik Publik?</span>
                <span class="block text-[10px] text-gray-400">Jika aktif, pengunjung dapat menghubungi pemilik secara langsung.</span>
            </div>
            <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                <input type="checkbox" wire:model="form.show_owner_phone" class="sr-only peer">
                <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
        </div>
    </div>
</div>
