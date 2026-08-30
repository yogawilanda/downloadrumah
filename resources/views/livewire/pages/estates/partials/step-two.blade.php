<div class="space-y-4">
    <h2 class="text-base font-bold text-center text-gray-900">Detail Properti</h2>
    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
        <h3 class="text-xs font-semibold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Lokasi</h3>
        <div class="grid grid-cols-3 gap-2">
            @foreach ([['province', 'Provinsi'], ['city', 'Kota/Kab.'], ['district', 'Kecamatan']] as [$field, $label])
                <div><label class="block text-xs font-medium text-gray-700 mb-1">{{ $label }}</label><input type="text" wire:model="form.{{ $field }}" class="w-full rounded-lg border-gray-300 text-sm"></div>
            @endforeach
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2"><label class="block text-xs font-medium text-gray-700 mb-1">Alamat</label><input type="text" wire:model="form.address" class="w-full rounded-lg border-gray-300 text-sm"></div>
            <div><label class="block text-xs font-medium text-gray-700 mb-1">No / Blok</label><input type="text" wire:model="form.block_number" class="w-full rounded-lg border-gray-300 text-sm"></div>
        </div>
    </div>
    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
        <h3 class="text-xs font-semibold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Spesifikasi Bangunan</h3>
        <div class="grid grid-cols-2 gap-3">
            @foreach ([['bedroom', 'Kamar Tidur'], ['bathroom', 'Kamar Mandi'], ['building_size', 'LB (m²)'], ['land_size', 'LT (m²)'], ['building_width', 'Lebar (m)'], ['building_length', 'Panjang (m)']] as [$field, $label])
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">{{ $label }}</label>
                    <input type="number" @if(in_array($field, ['building_width', 'building_length'])) step="0.1" @endif wire:model="form.{{ $field }}" class="w-full rounded-lg border-gray-300 text-sm">
                </div>
            @endforeach
        </div>
    </div>
</div>
