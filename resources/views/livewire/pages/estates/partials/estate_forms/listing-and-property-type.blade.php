<div class="space-y-4">
    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Jenis Listing <span
                class="text-red-500">*</span></label>
        <select wire:model="form.listing_group"
            class="w-full rounded-md border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 transition-all cursor-pointer">
            <option value="">-- Pilih Jenis Listing --</option>
            <option value="primary">Primary (Developer / Baru)</option>
            <option value="secondary">Secondary (Bekas / Second)</option>
        </select>
        @error('form.listing_group')
            <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Tipe Properti <span
                class="text-red-500">*</span></label>
        <select wire:model="form.property_type"
            class="w-full rounded-md border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 transition-all cursor-pointer">
            <option value="house">Rumah</option>
            <option value="apartment">Apartemen</option>
            <option value="land">Tanah</option>
            <option value="shophouse">Ruko</option>
            <option value="villa">Villa</option>
            <option value="warehouse">Gudang</option>
            <option value="office">Kantor</option>
        </select>
    </div>
</div>
