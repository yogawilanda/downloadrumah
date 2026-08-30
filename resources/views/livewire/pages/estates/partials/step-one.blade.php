<div class="space-y-4">
    <h2 class="text-base font-bold text-center text-gray-900">Info Umum</h2>

    <div class="bg-amber-100/70 border border-amber-200 p-3 rounded-xl text-xs text-amber-900 leading-relaxed">
        Tips Listing Menarik: Unggah foto properti dengan posisi landscape (horizontal) supaya foto tampil penuh dan listing terlihat lebih menarik.
    </div>

    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
        <label class="block text-xs font-bold text-gray-800">Foto Listing<span class="text-red-500">*</span></label>
        @error('photos') <span class="text-xs text-red-500 block mb-1">{{ $message }}</span> @enderror

        <div class="grid grid-cols-4 gap-2">
            <label class="aspect-square border-2 border-dashed border-amber-400 bg-amber-50/50 rounded-xl flex items-center justify-center cursor-pointer hover:bg-amber-100/50 transition">
                <span class="text-amber-600 font-bold text-xl">+</span>
                <input type="file" wire:model="photos" multiple class="hidden" accept="image/*" />
            </label>

            @foreach($existingPhotos as $photo)
                @php
                    $filePath = is_array($photo) ? $photo['file_path'] : $photo->file_path;
                    $photoId = is_array($photo) ? $photo['id'] : $photo->id;
                    $cleanPath = ltrim(str_replace('public/', '', $filePath), '/');
                    $photoUrl = is_array($photo) && !empty($photo['url'])
                        ? $photo['url']
                        : url('media/' . $cleanPath);
                @endphp
                <div class="relative aspect-square rounded-xl overflow-hidden border border-gray-200">
                    <img src="{{ $photoUrl }}" class="w-full h-full object-cover">
                    <button type="button" wire:click="deleteExistingPhoto({{ $photoId }})"
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-[10px] shadow">✕</button>
                </div>
            @endforeach

            @if ($photos)
                @foreach ($photos as $index => $photo)
                    <div class="relative aspect-square rounded-xl overflow-hidden border border-gray-200">
                        <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                        <button type="button" wire:click="removePhoto({{ $index }})"
                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-[10px] shadow">✕</button>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-4">
        <div>
            <label class="block text-xs font-bold text-gray-800 mb-1">Judul Listing<span class="text-red-500">*</span></label>
            <input type="text" wire:model="form.title" maxlength="70" placeholder="Contoh: RUMAH BURUNG WALET PANDAAN"
                class="w-full rounded-lg border-gray-300 focus:border-amber-400 focus:ring-amber-400 text-sm">
            @error('form.title') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-800 mb-1">Deskripsi Listing<span class="text-red-500">*</span></label>
            <textarea wire:model="form.description" rows="3" placeholder="Jelaskan detail keunggulan properti..."
                class="w-full rounded-lg border-gray-300 focus:border-amber-400 focus:ring-amber-400 text-sm"></textarea>
            @error('form.description') <span class="text-xs text-red-500 block mt-1">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-800 mb-1">Tipe Transaksi<span class="text-red-500">*</span></label>
            <div class="flex items-center space-x-4 text-xs">
                <label class="inline-flex items-center cursor-pointer"><input type="radio" wire:model="form.transaction_type" value="sale" class="text-amber-500 focus:ring-amber-400"><span class="ml-2">Jual</span></label>
                <label class="inline-flex items-center cursor-pointer"><input type="radio" wire:model="form.transaction_type" value="rent" class="text-amber-500 focus:ring-amber-400"><span class="ml-2">Sewa</span></label>
            </div>
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-800 mb-1">Harga Jual / Sewa (Rp)<span class="text-red-500">*</span></label>
            <input type="number" wire:model="form.price" placeholder="2.000.000.000"
                class="w-full rounded-lg border-gray-300 focus:border-amber-400 focus:ring-amber-400 text-sm">
            @error('form.price') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-800 mb-1">Tipe Properti<span class="text-red-500">*</span></label>
            <select wire:model="form.property_type" class="w-full rounded-lg border-gray-300 focus:border-amber-400 focus:ring-amber-400 text-sm">
                <option value="house">Rumah</option><option value="apartment">Apartemen</option><option value="land">Tanah</option>
                <option value="shophouse">Ruko</option><option value="villa">Villa</option><option value="warehouse">Gudang</option><option value="office">Kantor</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-800 mb-1">Persentase Komisi (%)<span class="text-red-500">*</span></label>
            <input type="number" step="0.1" wire:model="form.commission_percentage" placeholder="2"
                class="w-full rounded-lg border-gray-300 focus:border-amber-400 focus:ring-amber-400 text-sm">
        </div>
        @foreach ([['is_kpr', 'Bisa KPR?'], ['has_imb', 'IMB / PBG?'], ['has_blueprint', 'Ada Blueprint?']] as [$field, $label])
            <div>
                <label class="block text-xs font-bold text-gray-800 mb-1">{{ $label }}<span class="text-red-500">*</span></label>
                <div class="flex items-center space-x-4 text-xs">
                    <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.{{ $field }}" value="1" class="text-amber-500"><span class="ml-2">Ya</span></label>
                    <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.{{ $field }}" value="0" class="text-amber-500"><span class="ml-2">Tidak</span></label>
                </div>
            </div>
        @endforeach
        <div class="border-t border-gray-100 pt-3 space-y-3">
            <h3 class="text-xs font-bold text-gray-800">Promosi dan Kerjasama</h3>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Dokumen Legal<span class="text-red-500">*</span></label>
                <select wire:model="form.attributes_list.legal_docs" class="w-full rounded-lg border-gray-300 focus:border-amber-400 focus:ring-amber-400 text-sm">
                    <option value="SHM">SHM</option><option value="HGB">HGB</option><option value="HP">Hak Pakai</option><option value="Girik">Girik / Petok D</option><option value="PPJB">PPJB</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Kerjasama dengan agent lain</label>
                <div class="flex items-center space-x-4 text-xs">
                    <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.agent_cooperation" value="1" class="text-amber-500"><span class="ml-2">Ya</span></label>
                    <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.agent_cooperation" value="0" class="text-amber-500"><span class="ml-2">Tidak</span></label>
                </div>
            </div>
        </div>
    </div>
</div>
