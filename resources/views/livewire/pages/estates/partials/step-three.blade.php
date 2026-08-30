<div class="space-y-4">
    <h2 class="text-base font-bold text-center text-gray-900">Info Tambahan</h2>
    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
        <div><label class="block text-xs font-medium text-gray-700 mb-1">Grup / Listing Pool</label><input type="text" wire:model="form.listing_group" placeholder="Contoh: Primary Citraland" class="w-full rounded-lg border-gray-300 text-sm"></div>
        <div><label class="block text-xs font-medium text-gray-700 mb-1">Kontak WA Agent</label><input type="text" wire:model="form.agent_phone" placeholder="08123456789" class="w-full rounded-lg border-gray-300 text-sm"></div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Kondisi Perabotan</label>
            <select wire:model="form.furnish_type" class="w-full rounded-lg border-gray-300 text-sm">
                <option value="">- Pilih Furnish -</option><option value="unfurnished">Kosongan (Unfurnished)</option><option value="semi_furnished">Semi Furnished</option><option value="full_furnished">Full Furnished</option>
            </select>
        </div>
    </div>
</div>
