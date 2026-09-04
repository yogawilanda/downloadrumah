{{--
loc : resources\views\livewire\pages\estates\partials\step-one.blade.php
usage : to display form that user fills for estate listing registration to the system
dependency : Laravel 13, Tailwind CSS, Alpine JS.
singular deps : photo_uploads.js on the public/js/photo_uploads.js
--}}

<div class="space-y-5">
    <h2 class="text-base font-bold text-center text-gray-900">Info Umum</h2>

    <div class="bg-blue-100/70 border border-blue-200 p-4 rounded-2xl text-xs text-blue-900 leading-relaxed">
        💡 <strong>Tips Listing Menarik:</strong> Unggah foto properti dengan posisi landscape (horizontal) supaya foto tampil penuh dan terlihat rapi.
    </div>

    <!-- Foto Listing Section -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-4" x-data="photoUploader({ maxPhotos: 8 })">
        <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
            <span class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </span>
            <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Foto Properti <span class="text-red-500">*</span></h3>
        </div>

        @error('photos')
            <span class="text-xs text-red-500 block mb-1">{{ $message }}</span>
        @enderror

        <div class="grid grid-cols-4 gap-2.5">
            {{-- Hide after reach max limits --}}
            <label x-show="(existingCount + currentUploadedCount) < maxPhotos"
                class="aspect-square border-2 border-dashed border-blue-300 bg-blue-50/40 rounded-xl flex flex-col items-center justify-center cursor-pointer hover:bg-blue-100/50 transition-all">
                <template x-if="!uploading">
                    <span class="text-blue-600 font-bold text-2xl">+</span>
                </template>
                <template x-if="uploading">
                    <div class="flex flex-col items-center gap-1 p-1 text-center">
                        <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span class="text-[9px] text-blue-600 font-medium leading-tight" x-text="progressText"></span>
                    </div>
                </template>
                <input type="file" @change="compressAndUpload" multiple class="hidden" accept="image/*"
                    :disabled="uploading" />
            </label>

            @foreach ($existingPhotos as $photo)
                @php
                    $filePath = is_array($photo) ? $photo['file_path'] : $photo->file_path;
                    $photoId = is_array($photo) ? $photo['id'] : $photo->id;
                    $cleanPath = ltrim(str_replace('public/', '', $filePath), '/');
                    $photoUrl = is_array($photo) && !empty($photo['url']) ? $photo['url'] : url('media/' . $cleanPath);
                @endphp
                <div class="relative aspect-square rounded-xl overflow-hidden border border-gray-200">
                    <img src="{{ $photoUrl }}" class="w-full h-full object-cover">
                    <button type="button" wire:click="deleteExistingPhoto({{ $photoId }})"
                        class="absolute top-1.5 right-1.5 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow hover:bg-red-600 transition">✕</button>
                </div>
            @endforeach

            @if ($photos)
                @foreach ($photos as $index => $photo)
                    <div class="relative aspect-square rounded-xl overflow-hidden border border-gray-200">
                        <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                        <button type="button" wire:click="removePhoto({{ $index }})"
                            class="absolute top-1.5 right-1.5 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow hover:bg-red-600 transition">✕</button>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Informasi Utama Section -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-5">
        <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
            <span class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Informasi Dasar</h3>
        </div>

        <!-- Judul Listing -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Judul Listing <span class="text-red-500">*</span></label>
            <input type="text" wire:model="form.title" maxlength="70" placeholder="Contoh: RUMAH 2 LANTAI MINIMALIS SIDOARJO"
                class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
            @error('form.title')
                <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Deskripsi Listing (Format WA / Emoji Friendly) -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Deskripsi Listing <span class="text-red-500">*</span></label>
            <textarea wire:model="form.description" rows="5"
                placeholder="Bisa langsung tempel / paste pesan dari WhatsApp...&#10;&#10;Contoh:&#10;🏡 Rumah Siap Huni Asri&#10;📍 Lokasi Strategis Dekat Tol&#10;✨ Bebas Banjir & Keamanan 24 Jam"
                class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all whitespace-pre-line leading-relaxed font-sans"></textarea>
            @error('form.description')
                <span class="text-[11px] text-red-500 block mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tipe Transaksi -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-2">Tipe Transaksi <span class="text-red-500">*</span></label>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                <label class="flex items-center justify-center gap-2 p-3 rounded-xl border border-gray-200 bg-gray-50/50 cursor-pointer hover:bg-white transition-all">
                    <input type="radio" wire:model="form.transaction_type" value="sale"
                        class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                    <span class="text-xs font-semibold text-gray-800">Dijual</span>
                </label>

                <label class="flex items-center justify-center gap-2 p-3 rounded-xl border border-gray-200 bg-gray-50/50 cursor-pointer hover:bg-white transition-all">
                    <input type="radio" wire:model="form.transaction_type" value="rent"
                        class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                    <span class="text-xs font-semibold text-gray-800">Disewakan</span>
                </label>

                <label class="flex items-center justify-center gap-2 p-3 rounded-xl border border-gray-200 bg-gray-50/50 cursor-pointer hover:bg-white transition-all">
                    <input type="radio" wire:model="form.transaction_type" value="sale & rent"
                        class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                    <span class="text-xs font-semibold text-gray-800">Jual & Sewa</span>
                </label>
            </div>
            @error('form.transaction_type')
                <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Harga -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Harga Jual / Sewa (Rp) <span class="text-red-500">*</span></label>
            <input type="number" wire:model="form.price" placeholder="Contoh: 2000000000"
                class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
            @error('form.price')
                <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Jenis Listing -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Jenis Listing <span class="text-red-500">*</span></label>
            <div class="relative">
                <select wire:model="form.listing_group"
                    style="-webkit-appearance: none; -moz-appearance: none; appearance: none;"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50/50 pl-3.5 pr-9 py-3 text-xs text-gray-800 truncate focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all cursor-pointer">
                    <option value="">-- Pilih Jenis Listing --</option>
                    <option value="primary">Primary (Developer / Baru)</option>
                    <option value="secondary">Secondary (Bekas / Second)</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            @error('form.listing_group')
                <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tipe Properti -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Tipe Properti <span class="text-red-500">*</span></label>
            <div class="relative">
                <select wire:model="form.property_type"
                    style="-webkit-appearance: none; -moz-appearance: none; appearance: none;"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50/50 pl-3.5 pr-9 py-3 text-xs text-gray-800 truncate focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all cursor-pointer">
                    <option value="house">Rumah</option>
                    <option value="apartment">Apartemen</option>
                    <option value="land">Tanah</option>
                    <option value="shophouse">Ruko</option>
                    <option value="villa">Villa</option>
                    <option value="warehouse">Gudang</option>
                    <option value="office">Kantor</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Kondisi Perabotan -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Kondisi Perabotan</label>
            <div class="relative">
                <select wire:model="form.furnish_type"
                    style="-webkit-appearance: none; -moz-appearance: none; appearance: none;"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50/50 pl-3.5 pr-9 py-3 text-xs text-gray-800 truncate focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all cursor-pointer">
                    <option value="">-- Pilih Kondisi Perabotan --</option>
                    <option value="unfurnished">Kosongan (Unfurnished)</option>
                    <option value="semi_furnished">Semi Furnished</option>
                    <option value="full_furnished">Full Furnished</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Komisi -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Persentase Komisi (%) <span class="text-red-500">*</span></label>
            <input type="number" step="0.1" wire:model="form.commission_percentage" placeholder="Contoh: 2.5"
                class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
        </div>

        <!-- Radio Buttons Legalitas Ringkas -->
        <div class="space-y-3 pt-1">
            @foreach ([['is_kpr', 'Bisa KPR?'], ['has_imb', 'IMB / PBG Ada?'], ['has_blueprint', 'Denah / Blueprint Ada?']] as [$field, $label])
                <div class="flex items-center justify-between p-3 rounded-xl border border-gray-100 bg-gray-50/40">
                    <span class="text-xs font-semibold text-gray-700">{{ $label }} <span class="text-red-500">*</span></span>
                    <div class="flex items-center gap-4 text-xs">
                        <label class="inline-flex items-center gap-1.5 cursor-pointer">
                            <input type="radio" wire:model="form.attributes_list.{{ $field }}" value="1"
                                class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                            <span class="font-medium text-gray-700">Ya</span>
                        </label>
                        <label class="inline-flex items-center gap-1.5 cursor-pointer">
                            <input type="radio" wire:model="form.attributes_list.{{ $field }}" value="0"
                                class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                            <span class="font-medium text-gray-700">Tidak</span>
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Sub-section Kerjasama -->
        <div class="border-t border-gray-100 pt-4 space-y-4">
            <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Promosi & Kerjasama</h3>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Dokumen Legalitas Utama <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select wire:model="form.attributes_list.legal_docs"
                        style="-webkit-appearance: none; -moz-appearance: none; appearance: none;"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50/50 pl-3.5 pr-9 py-3 text-xs text-gray-800 truncate focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all cursor-pointer">
                        <option value="SHM">Sertifikat Hak Milik (SHM)</option>
                        <option value="HGB">Hak Guna Bangunan (HGB)</option>
                        <option value="HP">Hak Pakai (HP)</option>
                        <option value="Girik">Girik / Petok D</option>
                        <option value="PPJB">PPJB</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-3 rounded-xl border border-gray-100 bg-gray-50/40">
                <span class="text-xs font-semibold text-gray-700">Kerjasama Agen Lain?</span>
                <div class="flex items-center gap-4 text-xs">
                    <label class="inline-flex items-center gap-1.5 cursor-pointer">
                        <input type="radio" wire:model="form.attributes_list.agent_cooperation" value="1"
                            class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                        <span class="font-medium text-gray-700">Ya</span>
                    </label>
                    <label class="inline-flex items-center gap-1.5 cursor-pointer">
                        <input type="radio" wire:model="form.attributes_list.agent_cooperation" value="0"
                            class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                        <span class="font-medium text-gray-700">Tidak</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
