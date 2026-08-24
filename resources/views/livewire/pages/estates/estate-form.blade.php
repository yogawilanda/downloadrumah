<div class="w-full pb-28 pt-4 px-4 max-w-lg mx-auto">
    <!-- Header -->
    <div class="mb-5">
        <h1 class="text-xl font-bold text-gray-900">
            {{ $isEdit ? 'Edit Properti' : 'Pasang Iklan Properti' }}
        </h1>
        <p class="text-xs text-gray-500 mt-0.5">
            Isi detail informasi properti kamu di bawah ini.
        </p>
    </div>

    <form wire:submit="save" class="space-y-4">
        <!-- Informasi Utama -->
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
            <h2 class="text-xs font-semibold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Informasi Utama</h2>

            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Judul Iklan</label>
                <input type="text" wire:model="title" placeholder="Contoh: Rumah Minimalis 2 Lantai"
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                @error('title') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Tipe Transaksi</label>
                <select wire:model="transaction_type" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <option value="sale">Dijual</option>
                    <option value="rent">Disewakan</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Harga (Rp)</label>
                <input type="number" wire:model="price" placeholder="850000000"
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                @error('price') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Lokasi -->
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
            <h2 class="text-xs font-semibold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Lokasi</h2>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Kota/Kab.</label>
                    <input type="text" wire:model="city" placeholder="Surabaya"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    @error('city') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Kecamatan</label>
                    <input type="text" wire:model="district" placeholder="Wonocolo"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    @error('district') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Alamat (Opsional)</label>
                <textarea wire:model="address" rows="2" placeholder="Jl. Raya Ketintang No. 10"
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"></textarea>
            </div>
        </div>

        <!-- Spesifikasi -->
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
            <h2 class="text-xs font-semibold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Spesifikasi</h2>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Kamar Tidur</label>
                    <input type="number" wire:model="bedroom" min="0" placeholder="0"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Kamar Mandi</label>
                    <input type="number" wire:model="bathroom" min="0" placeholder="0"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">LB (m²)</label>
                    <input type="number" wire:model="building_size" min="0" placeholder="0"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">LT (m²)</label>
                    <input type="number" wire:model="land_size" min="0" placeholder="0"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </div>
            </div>
        </div>

        <!-- Fasilitas & Legalitas -->
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
            <h2 class="text-xs font-semibold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Fasilitas & Legalitas</h2>

            <div class="grid grid-cols-2 gap-3">
                <label class="flex items-center space-x-2 text-xs text-gray-700">
                    <input type="checkbox" wire:model="attributes_list.garage" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span>Garasi</span>
                </label>

                <label class="flex items-center space-x-2 text-xs text-gray-700">
                    <input type="checkbox" wire:model="attributes_list.swimming_pool" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span>Kolam Renang</span>
                </label>

                <label class="flex items-center space-x-2 text-xs text-gray-700">
                    <input type="checkbox" wire:model="attributes_list.garden" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span>Taman</span>
                </label>

                <label class="flex items-center space-x-2 text-xs text-gray-700">
                    <input type="checkbox" wire:model="attributes_list.pam" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span>Air PAM</span>
                </label>
            </div>

            <div class="pt-2">
                <label class="block text-xs font-medium text-gray-700 mb-1">Sertifikat</label>
                <select wire:model="attributes_list.certificate" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <option value="SHM">SHM (Sertifikat Hak Milik)</option>
                    <option value="HGB">HGB (Hak Guna Bangunan)</option>
                    <option value="Girik">Girik / Petok D</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
            <h2 class="text-xs font-semibold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Deskripsi</h2>
            <textarea wire:model="description" rows="4" placeholder="Jelaskan detail keunggulan rumah..."
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"></textarea>
            @error('description') <span class="text-xs text-red-500 block">{{ $message }}</span> @enderror
        </div>

        <!-- Foto Properti -->
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
            <h2 class="text-xs font-semibold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Foto Properti</h2>

            <!-- Foto yang sudah tersimpan di Database -->
            @if(!empty($existingPhotos))
                <div class="grid grid-cols-3 gap-2">
                    @foreach($existingPhotos as $photo)
                        @php
                            // Ambil file path dan hilangkan 'public/' kalau tidak sengaja terikut
                            $cleanPath = ltrim(str_replace('public/', '', is_array($photo) ? $photo['file_path'] : $photo->file_path), '/');
                            $photoUrl = asset('storage/' . $cleanPath);
                            $photoId = is_array($photo) ? $photo['id'] : $photo->id;
                        @endphp
                        <div class="relative aspect-square rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ $photoUrl }}" class="w-full h-full object-cover">
                            <button type="button" wire:click="deleteExistingPhoto({{ $photoId }})"
                                class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 opacity-90 text-xs">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Input Upload Foto Baru -->
            <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 active:bg-gray-100">
                <div class="flex flex-col items-center justify-center pt-2 pb-2">
                    <svg class="w-6 h-6 text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="text-xs text-gray-500 font-medium">Tambah Foto</p>
                </div>
                <input type="file" wire:model="photos" multiple class="hidden" accept="image/*" />
            </label>

            <!-- Preview Foto Baru yang baru dipilik (Belum Disimpan) -->
            @if ($photos)
                <div class="grid grid-cols-3 gap-2 pt-2">
                    @foreach ($photos as $index => $photo)
                        <div class="relative aspect-square rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                            <button type="button" wire:click="removePhoto({{ $index }})"
                                class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 opacity-90 text-xs">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Submit & Cancel Buttons Inline -->
        <div class="pt-2 flex gap-3">
            <a href="{{ route('dashboard') }}" class="w-1/3 text-center py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-xs font-semibold flex items-center justify-center active:bg-gray-50 shadow-sm">
                Batal
            </a>
            <button type="submit" wire:loading.attr="disabled"
                class="w-2/3 py-3 rounded-xl bg-indigo-600 text-white text-xs font-semibold shadow-md active:bg-indigo-700 transition disabled:opacity-50 flex items-center justify-center">
                <span wire:loading.remove>{{ $isEdit ? 'Update Properti' : 'Simpan & Terbitkan' }}</span>
                <span wire:loading>Memproses...</span>
            </button>
        </div>
    </form>
</div>
