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
    $tempPhotos = $tempPhotos ?? [];
@endphp

<div
    class="relative bg-white border border-slate-200 p-5 space-y-4"
    x-data="photoUploader({ maxPhotos: 8 })"
>
    {{-- Toast Warning --}}
    <div
        x-show="toast.show"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute top-3 left-4 right-4 z-20 flex items-center gap-2
               bg-slate-950 text-white border border-slate-800
               text-[11px] font-medium px-3 py-2.5 shadow-lg"
    >
        <span class="text-amber-400 text-xs">▲</span>
        <span x-text="toast.message" class="leading-tight"></span>
    </div>

    {{-- Section Header --}}
    <div class="flex items-center justify-between border-b border-slate-200 pb-3">

        <div class="flex items-center gap-3">

            <div class="w-7 h-7 bg-slate-950 text-white flex items-center justify-center">
                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="square"
                        stroke-linejoin="miter"
                        stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                    />
                </svg>
            </div>

            <div>
                <h3 class="text-[11px] font-bold text-slate-900 uppercase tracking-[0.14em]">
                    Foto Properti
                    <span class="text-red-500">*</span>
                </h3>

                <p class="text-[10px] text-slate-400 mt-0.5">
                    Maksimal 8 foto
                </p>
            </div>

        </div>

        <div class="text-[10px] font-mono text-slate-400">
            <span x-text="existingCount + currentUploadedCount"></span>/08
        </div>

    </div>

    @error('photos')
        <span class="text-xs text-red-500 block mb-1">{{ $message }}</span>
    @enderror


    {{-- Photo Grid --}}
    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">

        {{-- Add Photo --}}
        <label
            x-show="(existingCount + currentUploadedCount) < maxPhotos"
            class="relative aspect-square border border-dashed border-slate-300
                   bg-slate-50 flex flex-col items-center justify-center
                   cursor-pointer group hover:border-slate-900 hover:bg-slate-100
                   transition-colors"
        >

            <template x-if="!uploading">

                <div class="flex flex-col items-center gap-2">

                    <div
                        class="w-9 h-9 border border-slate-300 bg-white
                               flex items-center justify-center
                               group-hover:border-slate-900 transition-colors"
                    >
                        <span class="text-slate-900 text-xl font-light leading-none">
                            +
                        </span>
                    </div>

                    <span
                        class="text-[9px] font-bold tracking-[0.12em]
                               uppercase text-slate-500"
                    >
                        Tambah Foto
                    </span>

                </div>

            </template>

            <template x-if="uploading">

                <div class="flex flex-col items-center gap-2 p-1 text-center">

                    <svg
                        class="animate-spin h-5 w-5 text-slate-900"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-20"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="3"
                        ></circle>

                        <path
                            class="opacity-80"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8v3a5 5 0 00-5 5H4z"
                        ></path>
                    </svg>

                    <span
                        class="text-[9px] text-slate-600 font-medium leading-tight"
                        x-text="progressText"
                    ></span>

                </div>

            </template>

            <input
                type="file"
                @change="compressAndUpload"
                multiple
                class="hidden"
                accept="image/*"
                :disabled="uploading"
            />

        </label>


        {{-- Existing Photos --}}
        @foreach ($existingPhotos as $photo)

            @php
                $filePath = is_array($photo) ? $photo['file_path'] : $photo->file_path;
                $photoId = is_array($photo) ? $photo['id'] : $photo->id;
                $isPrimary = is_array($photo)
                    ? $photo['is_primary'] ?? false
                    : $photo->is_primary;

                $cleanPath = ltrim(str_replace('public/', '', $filePath), '/');

                $photoUrl = is_array($photo) && !empty($photo['url'])
                    ? $photo['url']
                    : url('media/' . $cleanPath);
            @endphp

            <div
                class="group flex flex-col overflow-hidden border
                    {{ $isPrimary
                        ? 'border-slate-950'
                        : 'border-slate-200' }}"
            >

                <div class="relative aspect-square bg-slate-100">

                    <img
                        src="{{ $photoUrl }}"
                        alt="{{ $estate->title }}"
                        class="w-full h-full object-cover"
                    >

                    {{-- Primary Marker --}}
                    @if ($isPrimary)
                        <div
                            class="absolute left-0 top-0 bg-slate-950 text-white
                                   px-2.5 py-1 text-[8px] font-bold
                                   tracking-[0.12em] uppercase"
                        >
                            Utama
                        </div>
                    @endif

                    {{-- Delete --}}
                    <button
                        type="button"
                        wire:click="deleteExistingPhoto({{ $photoId }})"
                        class="absolute right-0 top-0 w-7 h-7
                               flex items-center justify-center
                               bg-red-600 text-white text-xs
                               opacity-90 hover:bg-red-700 transition-colors"
                    >
                        ×
                    </button>

                </div>

                {{-- Primary Action --}}
                <button
                    type="button"
                    @if (!$isPrimary)
                        wire:click="setPrimaryPhoto('existing', {{ $photoId }})"
                    @endif
                    class="w-full py-2 text-[9px] font-bold uppercase
                           tracking-[0.1em] text-center transition-colors
                           {{ $isPrimary
                                ? 'bg-slate-950 text-white'
                                : 'bg-white text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}"
                >
                    {{ $isPrimary ? '★ Foto Utama' : 'Jadikan Utama' }}
                </button>

            </div>

        @endforeach


        {{-- Temporary Photos --}}
        @if ($tempPhotos)

            @foreach ($tempPhotos as $index => $photo)

                @php
                    $isPrimaryTemp =
                        $primaryPhotoType === 'new' &&
                        $primaryPhotoIndex == $index;
                @endphp

                <div
                    class="group flex flex-col overflow-hidden border
                        {{ $isPrimaryTemp
                            ? 'border-slate-950'
                            : 'border-slate-200' }}"
                >

                    <div class="relative aspect-square bg-slate-100">

                        <img
                            src="{{ $photo->temporaryUrl() }}"
                            alt="Foto properti baru"
                            class="w-full h-full object-cover"
                        >

                        {{-- Primary Marker --}}
                        @if ($isPrimaryTemp)

                            <div
                                class="absolute left-0 top-0 bg-slate-950 text-white
                                       px-2.5 py-1 text-[8px] font-bold
                                       tracking-[0.12em] uppercase"
                            >
                                Utama
                            </div>

                        @endif

                        {{-- Remove --}}
                        <button
                            type="button"
                            wire:click="removePhoto({{ $index }})"
                            class="absolute right-0 top-0 w-7 h-7
                                   flex items-center justify-center
                                   bg-red-600 text-white text-xs
                                   opacity-90 hover:bg-red-700 transition-colors"
                        >
                            ×
                        </button>

                    </div>

                    {{-- Primary Action --}}
                    <button
                        type="button"
                        @if (!$isPrimaryTemp)
                            wire:click="setPrimaryPhoto('new', {{ $index }})"
                        @endif
                        class="w-full py-2 text-[9px] font-bold uppercase
                               tracking-[0.1em] text-center transition-colors
                               {{ $isPrimaryTemp
                                    ? 'bg-slate-950 text-white'
                                    : 'bg-white text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}"
                    >
                        {{ $isPrimaryTemp ? '★ Foto Utama' : 'Jadikan Utama' }}
                    </button>

                </div>

            @endforeach

        @endif

    </div>

</div>
