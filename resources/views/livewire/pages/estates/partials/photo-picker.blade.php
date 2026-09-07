{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/estates/partials/photo-picker.blade.php
| @usage : Estate Attachment Photo Grid Manager Component
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@php
    $primaryPhotoType = $primaryPhotoType ?? 'existing';
    $primaryPhotoIndex = $primaryPhotoIndex ?? 0;
@endphp

<div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-4 relative" x-data="photoUploader({ maxPhotos: 8 })">
    <!-- Toast Warning Client-side (Soft Contrast) -->
    <div x-show="toast.show" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="absolute top-3 left-4 right-4 z-20 flex items-center gap-2 bg-amber-50 border border-amber-200/80 text-amber-800 text-[12px] font-medium px-3.5 py-2.5 rounded-xl shadow-sm backdrop-blur-sm">
        <span class="text-amber-600 text-sm">⚠️</span>
        <span x-text="toast.message" class="leading-tight"></span>
    </div>

    <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
        <span class="p-2 bg-blue-50 text-blue-600 rounded-xl">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </span>
        <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Foto Properti <span class="text-red-500">*</span></h3>
    </div>

    @error('photos')
        <span class="text-xs text-red-500 block mb-1">{{ $message }}</span>
    @enderror

    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
        {{-- Button Add Photo --}}
        <label x-show="(existingCount + currentUploadedCount) < maxPhotos"
            class="aspect-square border-2 border-dashed border-blue-300 bg-blue-50/40 rounded-xl flex flex-col items-center justify-center cursor-pointer hover:bg-blue-100/50 transition-all">
            <template x-if="!uploading"><span class="text-blue-600 font-bold text-2xl">+</span></template>
            <template x-if="uploading">
                <div class="flex flex-col items-center gap-1 p-1 text-center">
                    <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-[9px] text-blue-600 font-medium leading-tight" x-text="progressText"></span>
                </div>
            </template>
            <input type="file" @change="compressAndUpload" multiple class="hidden" accept="image/*" :disabled="uploading" />
        </label>

        {{-- Photos from Database --}}
        @foreach ($existingPhotos as $photo)
            @php
                $filePath = is_array($photo) ? $photo['file_path'] : $photo->file_path;
                $photoId = is_array($photo) ? $photo['id'] : $photo->id;
                $isPrimary = is_array($photo) ? ($photo['is_primary'] ?? false) : $photo->is_primary;
                $cleanPath = ltrim(str_replace('public/', '', $filePath), '/');
                $photoUrl = is_array($photo) && !empty($photo['url']) ? $photo['url'] : url('media/' . $cleanPath);
            @endphp
            <div class="flex flex-col rounded-xl overflow-hidden border {{ $isPrimary ? 'border-2 border-blue-600 ring-2 ring-blue-100' : 'border-gray-200' }}">
                <div class="relative aspect-square">
                    <img src="{{ $photoUrl }}" class="w-full h-full object-cover">
                    <button type="button" wire:click="deleteExistingPhoto({{ $photoId }})"
                        class="absolute right-1.5 top-1.5 flex h-6 w-6 items-center justify-center rounded-full bg-red-500/80 text-white text-xs shadow hover:bg-red-600 transition">✕</button>
                </div>
                <button type="button" @if (!$isPrimary) wire:click="setPrimaryPhoto('existing', {{ $photoId }})" @endif
                    class="w-full py-1.5 text-[10px] font-bold text-center transition {{ $isPrimary ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $isPrimary ? '★ Foto Utama' : 'Jadikan Utama' }}
                </button>
            </div>
        @endforeach

        {{-- Photos Temporary (Upload Baru) --}}
        @if ($photos)
            @foreach ($photos as $index => $photo)
                @php $isPrimaryTemp = ($primaryPhotoType === 'new' && $primaryPhotoIndex == $index); @endphp
                <div class="flex flex-col rounded-xl overflow-hidden border {{ $isPrimaryTemp ? 'border-2 border-blue-600 ring-2 ring-blue-100' : 'border-gray-200' }}">
                    <div class="relative aspect-square">
                        <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                        <button type="button" wire:click="removePhoto({{ $index }})"
                            class="absolute right-1.5 top-1.5 flex h-6 w-6 items-center justify-center rounded-full bg-red-500/80 text-white text-xs shadow hover:bg-red-600 transition">✕</button>
                    </div>
                    <button type="button" @if (!$isPrimaryTemp) wire:click="setPrimaryPhoto('new', {{ $index }})" @endif
                        class="w-full py-1.5 text-[10px] font-bold text-center transition {{ $isPrimaryTemp ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ $isPrimaryTemp ? '★ Foto Utama' : 'Jadikan Utama' }}
                    </button>
                </div>
            @endforeach
        @endif
    </div>
</div>
