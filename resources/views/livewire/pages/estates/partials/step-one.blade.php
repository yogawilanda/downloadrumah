{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/estates/partials/step-one.blade.php
| @usage : Partial View for Estate Registration Form (Step 1: General Info)
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@php
    $primaryPhotoType = $primaryPhotoType ?? 'existing';
    $primaryPhotoIndex = $primaryPhotoIndex ?? 0;
@endphp

<div class="space-y-5">
    <h2 class="text-base font-bold text-center text-gray-900">Info Umum</h2>

    <div class="bg-blue-100/70 border border-blue-200 p-4 rounded-2xl text-xs text-blue-900 leading-relaxed">
        💡 <strong>Tips Listing Menarik:</strong> Unggah foto properti dengan posisi landscape (horizontal) supaya foto
        tampil penuh dan terlihat rapi.
    </div>

    <!-- Partial Section Foto Listing -->
    @include('livewire.pages.estates.partials.photo-picker')

    <!-- Informasi Utama Section -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-5">
        <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
            <span class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Informasi Dasar</h3>
        </div>

        <!-- Judul Listing -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Judul Listing <span class="text-red-500">*</span></label>
            <input type="text" wire:model="form.title" maxlength="70" placeholder="Contoh: RUMAH 2 LANTAI MINIMALIS SIDOARJO"
                class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
            @error('form.title') <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Deskripsi Listing -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Deskripsi Listing <span class="text-red-500">*</span></label>
            <textarea wire:model="form.description" rows="5"
                placeholder="Bisa langsung tempel / paste pesan dari WhatsApp...&#10;&#10;Contoh:&#10;🏡 Rumah Siap Huni Asri&#10;📍 Lokasi Strategis Dekat Tol&#10;✨ Bebas Banjir & Keamanan 24 Jam"
                class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all whitespace-pre-line leading-relaxed font-sans"></textarea>
            @error('form.description') <span class="text-[11px] text-red-500 block mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Tipe Transaksi -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-2">Tipe Transaksi <span class="text-red-500">*</span></label>
            <div class="flex flex-wrap gap-2">
                @foreach (['sale' => 'Dijual', 'rent' => 'Disewakan', 'sale & rent' => 'Jual & Sewa'] as $val => $txt)
                    <label class="flex-1 min-w-[100px] flex items-center justify-center gap-1.5 p-2.5 rounded-xl border border-gray-200 bg-gray-50/50 cursor-pointer hover:bg-white transition-all select-none">
                        <input type="radio" wire:model="form.transaction_type" value="{{ $val }}" class="text-blue-600 focus:ring-blue-500 w-3.5 h-3.5 shrink-0">
                        <span class="text-[11px] font-semibold text-gray-800 whitespace-nowrap">{{ $txt }}</span>
                    </label>
                @endforeach
            </div>
            @error('form.transaction_type') <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Harga -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Harga Jual / Sewa (Rp) <span class="text-red-500">*</span></label>
            <input type="text" x-data="currencyInput('form.price')" x-model="displayValue" @input="update($event)" placeholder="Contoh: 2.000.000.000"
                class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
            @error('form.price') <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Select Fields: Jenis Listing & Tipe Properti -->
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Jenis Listing <span class="text-red-500">*</span></label>
                <select wire:model="form.listing_group" class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 transition-all cursor-pointer">
                    <option value="">-- Pilih Jenis Listing --</option>
                    <option value="primary">Primary (Developer / Baru)</option>
                    <option value="secondary">Secondary (Bekas / Second)</option>
                </select>
                @error('form.listing_group') <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Tipe Properti <span class="text-red-500">*</span></label>
                <select wire:model="form.property_type" class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 transition-all cursor-pointer">
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

        <!-- Komisi & Radio Legalitas Ringkas -->
        <div class="space-y-3">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Persentase Komisi (%) <span class="text-red-500">*</span></label>
                <input type="number" step="0.1" wire:model="form.commission_percentage" placeholder="Contoh: 2.5" class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 transition-all">
            </div>

            @foreach ([['is_kpr', 'Bisa KPR?'], ['has_imb', 'IMB / PBG Ada?'], ['has_blueprint', 'Denah / Blueprint Ada?']] as [$field, $label])
                <div class="flex items-center justify-between p-3 rounded-xl border border-gray-100 bg-gray-50/40">
                    <span class="text-xs font-semibold text-gray-700">{{ $label }} <span class="text-red-500">*</span></span>
                    <div class="flex items-center gap-4 text-xs">
                        <label class="inline-flex items-center gap-1.5 cursor-pointer"><input type="radio" wire:model="form.attributes_list.{{ $field }}" value="1" class="text-blue-600 focus:ring-blue-500 w-4 h-4"><span class="font-medium text-gray-700">Ya</span></label>
                        <label class="inline-flex items-center gap-1.5 cursor-pointer"><input type="radio" wire:model="form.attributes_list.{{ $field }}" value="0" class="text-blue-600 focus:ring-blue-500 w-4 h-4"><span class="font-medium text-gray-700">Tidak</span></label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
