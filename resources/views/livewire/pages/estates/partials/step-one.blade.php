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

    <div class="bg-blue-100/70 border border-blue-200 p-4 rounded-md text-xs text-blue-900 leading-relaxed">
        💡 <strong>Tips Listing Menarik:</strong> Unggah foto properti dengan posisi landscape (horizontal) supaya foto
        tampil penuh dan terlihat rapi.
    </div>

    <!-- Partial Section Foto Listing -->
    @include('livewire.pages.estates.partials.photo-picker')

    <!-- Informasi Utama Section -->
    <div class="bg-white p-5 rounded-md border border-gray-100 shadow-sm space-y-5">
        <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
            <span class="p-2 bg-blue-50 text-blue-600 rounded-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Informasi Dasar</h3>
        </div>

        <!-- Judul Listing -->
        @include('livewire.pages.estates.partials.estate_forms.title-form')

        <!-- Deskripsi Listing -->
        @include('livewire.pages.estates.partials.estate_forms.description')

        <!-- Tipe Transaksi -->
        @include('livewire.pages.estates.partials.estate_forms.transaction-type')

        <!-- Harga -->
        @include('livewire.pages.estates.partials.estate_forms.price')

        <!-- Select Fields: Jenis Listing & Tipe Properti -->
        @include('livewire.pages.estates.partials.estate_forms.listing-and-property-type')

        <!-- Komisi & Radio Legalitas Ringkas -->
        @include('livewire.pages.estates.partials.estate_forms.commission')
    </div>
</div>
