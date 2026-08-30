{{-- loc: resources/views/livewire/pages/estates/estate-form.blade.php --}}
{{-- usage: multi-step create and update listing/estate view --}}

<div class="w-full pb-28 pt-4 px-4 max-w-lg mx-auto">
    <!-- Header -->
    <div class="mb-4 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
        <h1 class="text-base font-bold text-gray-900">
            {{ $form->isEdit() ? 'Ubah Properti' : 'Pasang Properti' }}
        </h1>
        <div class="w-6"></div> {{-- Spacer --}}
    </div>

    <!-- Progress Wizard Stepper -->
    <div class="mb-6 px-2">
        <div class="relative flex items-center justify-between">
            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-0.5 bg-gray-200 -z-10"></div>
            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-0.5 bg-amber-400 -z-10 transition-all duration-300"
                style="width: {{ (($currentStep - 1) / 3) * 100 }}%;"></div>

            <!-- Step 1 -->
            <div class="flex flex-col items-center">
                <button type="button" wire:click="setStep(1)"
                    class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold transition {{ $currentStep >= 1 ? 'bg-amber-400 text-gray-900 ring-4 ring-amber-100' : 'bg-gray-200 text-gray-500' }}">
                    1
                </button>
                <span class="text-[10px] font-medium mt-1 {{ $currentStep === 1 ? 'text-gray-900 font-bold' : 'text-gray-400' }}">Info Umum</span>
            </div>

            <!-- Step 2 -->
            <div class="flex flex-col items-center">
                <button type="button" wire:click="setStep(2)"
                    class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold transition {{ $currentStep >= 2 ? 'bg-amber-400 text-gray-900 ring-4 ring-amber-100' : 'bg-gray-200 text-gray-500' }}">
                    2
                </button>
                <span class="text-[10px] font-medium mt-1 {{ $currentStep === 2 ? 'text-gray-900 font-bold' : 'text-gray-400' }}">Detail Properti</span>
            </div>

            <!-- Step 3 -->
            <div class="flex flex-col items-center">
                <button type="button" wire:click="setStep(3)"
                    class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold transition {{ $currentStep >= 3 ? 'bg-amber-400 text-gray-900 ring-4 ring-amber-100' : 'bg-gray-200 text-gray-500' }}">
                    3
                </button>
                <span class="text-[10px] font-medium mt-1 {{ $currentStep === 3 ? 'text-gray-900 font-bold' : 'text-gray-400' }}">Info Tambahan</span>
            </div>

            <!-- Step 4 -->
            <div class="flex flex-col items-center">
                <button type="button" wire:click="setStep(4)"
                    class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold transition {{ $currentStep >= 4 ? 'bg-amber-400 text-gray-900 ring-4 ring-amber-100' : 'bg-gray-200 text-gray-500' }}">
                    4
                </button>
                <span class="text-[10px] font-medium mt-1 {{ $currentStep === 4 ? 'text-gray-900 font-bold' : 'text-gray-400' }}">Konfirmasi</span>
            </div>
        </div>
    </div>

    <form wire:submit="save" class="space-y-4">

        <!-- STEP 1: INFO UMUM -->
        @if ($currentStep === 1)
            <div class="space-y-4">
                <h2 class="text-base font-bold text-center text-gray-900">Info Umum</h2>

                <!-- Banner Hint Foto -->
                <div class="bg-amber-100/70 border border-amber-200 p-3 rounded-xl text-xs text-amber-900 leading-relaxed">
                    Tips Listing Menarik: Unggah foto properti dengan posisi landscape (horizontal) supaya foto tampil penuh dan listing terlihat lebih menarik.
                </div>

                <!-- Foto Listing -->
                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
                    <label class="block text-xs font-bold text-gray-800">Foto Listing<span class="text-red-500">*</span></label>
                    @error('photos') <span class="text-xs text-red-500 block mb-1">{{ $message }}</span> @enderror

                    <div class="grid grid-cols-4 gap-2">
                        <!-- Upload Trigger Box -->
                        <label class="aspect-square border-2 border-dashed border-amber-400 bg-amber-50/50 rounded-xl flex items-center justify-center cursor-pointer hover:bg-amber-100/50 transition">
                            <span class="text-amber-600 font-bold text-xl">+</span>
                            <input type="file" wire:model="photos" multiple class="hidden" accept="image/*" />
                        </label>

                        <!-- Existing Photos -->
                        @foreach($existingPhotos as $photo)
                            @php
                                $filePath = is_array($photo) ? $photo['file_path'] : $photo->file_path;
                                $photoId = is_array($photo) ? $photo['id'] : $photo->id;
                                $cleanPath = ltrim(str_replace('public/', '', $filePath), '/');
                                $photoUrl = url('media/' . $cleanPath);
                            @endphp
                            <div class="relative aspect-square rounded-xl overflow-hidden border border-gray-200">
                                <img src="{{ $photoUrl }}" class="w-full h-full object-cover">
                                <button type="button" wire:click="deleteExistingPhoto({{ $photoId }})"
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-[10px] shadow">✕</button>
                            </div>
                        @endforeach

                        <!-- Temp Upload Photos -->
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

                <!-- Detail Utama Form -->
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

                    <!-- Radio Tipe Transaksi -->
                    <div>
                        <label class="block text-xs font-bold text-gray-800 mb-1">Tipe Transaksi<span class="text-red-500">*</span></label>
                        <div class="flex items-center space-x-4 text-xs">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" wire:model="form.transaction_type" value="sale" class="text-amber-500 focus:ring-amber-400">
                                <span class="ml-2">Jual</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" wire:model="form.transaction_type" value="rent" class="text-amber-500 focus:ring-amber-400">
                                <span class="ml-2">Sewa</span>
                            </label>
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
                            <option value="house">Rumah</option>
                            <option value="apartment">Apartemen</option>
                            <option value="land">Tanah</option>
                            <option value="shophouse">Ruko</option>
                            <option value="villa">Villa</option>
                            <option value="warehouse">Gudang</option>
                            <option value="office">Kantor</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-800 mb-1">Persentase Komisi (%)<span class="text-red-500">*</span></label>
                        <input type="number" step="0.1" wire:model="form.commission_percentage" placeholder="2"
                            class="w-full rounded-lg border-gray-300 focus:border-amber-400 focus:ring-amber-400 text-sm">
                    </div>

                    <!-- Checkbox Radio Attributes List -->
                    <div class="space-y-3 pt-2">
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1">Bisa KPR?<span class="text-red-500">*</span></label>
                            <div class="flex items-center space-x-4 text-xs">
                                <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.is_kpr" :value="true" class="text-amber-500"><span class="ml-2">Ya</span></label>
                                <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.is_kpr" :value="false" class="text-amber-500"><span class="ml-2">Tidak</span></label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1">IMB / PBG?<span class="text-red-500">*</span></label>
                            <div class="flex items-center space-x-4 text-xs">
                                <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.has_imb" :value="true" class="text-amber-500"><span class="ml-2">Ya</span></label>
                                <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.has_imb" :value="false" class="text-amber-500"><span class="ml-2">Tidak</span></label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1">Ada Blueprint?<span class="text-red-500">*</span></label>
                            <div class="flex items-center space-x-4 text-xs">
                                <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.has_blueprint" :value="true" class="text-amber-500"><span class="ml-2">Ya</span></label>
                                <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.has_blueprint" :value="false" class="text-amber-500"><span class="ml-2">Tidak</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-3 space-y-3">
                        <h3 class="text-xs font-bold text-gray-800">Promosi dan Kerjasama</h3>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Dokumen Legal<span class="text-red-500">*</span></label>
                            <select wire:model="form.attributes_list.legal_docs" class="w-full rounded-lg border-gray-300 focus:border-amber-400 focus:ring-amber-400 text-sm">
                                <option value="SHM">SHM</option>
                                <option value="HGB">HGB</option>
                                <option value="HP">Hak Pakai</option>
                                <option value="Girik">Girik / Petok D</option>
                                <option value="PPJB">PPJB</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Kerjasama dengan agent lain</label>
                            <div class="flex items-center space-x-4 text-xs">
                                <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.agent_cooperation" :value="true" class="text-amber-500"><span class="ml-2">Ya</span></label>
                                <label class="inline-flex items-center"><input type="radio" wire:model="form.attributes_list.agent_cooperation" :value="false" class="text-amber-500"><span class="ml-2">Tidak</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- STEP 2: DETAIL PROPERTI -->
        @if ($currentStep === 2)
            <div class="space-y-4">
                <h2 class="text-base font-bold text-center text-gray-900">Detail Properti</h2>

                <!-- Lokasi -->
                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
                    <h3 class="text-xs font-semibold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Lokasi</h3>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Provinsi</label>
                            <input type="text" wire:model="form.province" class="w-full rounded-lg border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Kota/Kab.</label>
                            <input type="text" wire:model="form.city" class="w-full rounded-lg border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Kecamatan</label>
                            <input type="text" wire:model="form.district" class="w-full rounded-lg border-gray-300 text-sm">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <div class="col-span-2">
                            <label class="block text-xs font-medium text-gray-700 mb-1">Alamat</label>
                            <input type="text" wire:model="form.address" class="w-full rounded-lg border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">No / Blok</label>
                            <input type="text" wire:model="form.block_number" class="w-full rounded-lg border-gray-300 text-sm">
                        </div>
                    </div>
                </div>

                <!-- Spesifikasi Fisik -->
                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
                    <h3 class="text-xs font-semibold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Spesifikasi Bangunan</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Kamar Tidur</label>
                            <input type="number" wire:model="form.bedroom" class="w-full rounded-lg border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Kamar Mandi</label>
                            <input type="number" wire:model="form.bathroom" class="w-full rounded-lg border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">LB (m²)</label>
                            <input type="number" wire:model="form.building_size" class="w-full rounded-lg border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">LT (m²)</label>
                            <input type="number" wire:model="form.land_size" class="w-full rounded-lg border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Lebar (m)</label>
                            <input type="number" step="0.1" wire:model="form.building_width" class="w-full rounded-lg border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Panjang (m)</label>
                            <input type="number" step="0.1" wire:model="form.building_length" class="w-full rounded-lg border-gray-300 text-sm">
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- STEP 3: INFO TAMBAHAN -->
        @if ($currentStep === 3)
            <div class="space-y-4">
                <h2 class="text-base font-bold text-center text-gray-900">Info Tambahan</h2>

                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Grup / Listing Pool</label>
                        <input type="text" wire:model="form.listing_group" placeholder="Contoh: Primary Citraland" class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Kontak WA Agent</label>
                        <input type="text" wire:model="form.agent_phone" placeholder="08123456789" class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Kondisi Perabotan</label>
                        <select wire:model="form.furnish_type" class="w-full rounded-lg border-gray-300 text-sm">
                            <option value="">- Pilih Furnish -</option>
                            <option value="unfurnished">Kosongan (Unfurnished)</option>
                            <option value="semi_furnished">Semi Furnished</option>
                            <option value="full_furnishedfull_furnished">Full Furnished</option>
                        </select>
                    </div>
                </div>
            </div>
        @endif

        <!-- STEP 4: KONFIRMASI -->
        @if ($currentStep === 4)
            <div class="space-y-4">
                <h2 class="text-base font-bold text-center text-gray-900">Konfirmasi Listing</h2>
                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-2 text-xs">
                    <p class="font-bold text-sm text-gray-800">{{ $form->title ?? '-' }}</p>
                    <p class="text-amber-600 font-bold text-base">Rp {{ number_format((float)($form->price ?? 0), 0, ',', '.') }}</p>
                    <p class="text-gray-500">{{ $form->city }}, {{ $form->province }}</p>
                    <p class="text-gray-600 pt-2 border-t">{{ Str::limit($form->description, 100) }}</p>
                </div>
            </div>
        @endif

        <!-- Footer Navigation Controls -->
        <div class="pt-4 flex gap-3">
            @if ($currentStep > 1)
                <button type="button" wire:click="previousStep"
                    class="w-1/3 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-xs font-bold active:bg-gray-50 shadow-sm">
                    Sebelumnya
                </button>
            @endif

            @if ($currentStep < 4)
                <button type="button" wire:click="nextStep"
                    class="w-full py-3 rounded-xl bg-amber-400 text-gray-900 text-xs font-bold shadow-md active:bg-amber-500 transition">
                    Selanjutnya
                </button>
            @else
                <button type="submit" wire:loading.attr="disabled"
                    class="w-full py-3 rounded-xl bg-amber-400 text-gray-900 text-xs font-bold shadow-md active:bg-amber-500 transition disabled:opacity-50">
                    <span wire:loading.remove>{{ $form->isEdit() ? 'Update Properti' : 'Simpan & Terbitkan' }}</span>
                    <span wire:loading>Memproses...</span>
                </button>
            @endif
        </div>
    </form>
</div>
