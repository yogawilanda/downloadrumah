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
       @include('livewire.pages.estates.partials.estate-forms.title-form')

        <!-- Deskripsi Listing -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Deskripsi Listing <span class="text-red-500">*</span></label>
            <textarea wire:model="form.description" rows="5"
                placeholder="Bisa langsung tempel / paste pesan dari WhatsApp...&#10;&#10;Contoh:&#10;🏡 Rumah Siap Huni Asri&#10;📍 Lokasi Strategis Dekat Tol&#10;✨ Bebas Banjir & Keamanan 24 Jam"
                class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all whitespace-pre-line leading-relaxed font-sans"></textarea>
            @error('form.description') <span class="text-[11px] text-red-500 block mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Tipe Transaksi -->
        @include('livewire.pages.estates.partials.estate-forms.transaction-type')

        <!-- Harga -->
        @include('livewire.pages.estates.partials.estate_forms.price')

        <!-- Select Fields: Jenis Listing & Tipe Properti -->
        @include('livewire.pages.estates.partials.estate_forms.listing-and-property-type')

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
