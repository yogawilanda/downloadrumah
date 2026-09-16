{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/partials/estate_forms/listing-and-property-type.blade.php
| @usage      : Estate listing group and property type selection form
| @version    : 1.1.6
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="space-y-4">
    <div>
        <label class="mb-1.5 block text-xs font-semibold text-slate-700 dark:text-slate-300">
            Jenis Listing
            <span class="text-rose-500">*</span>
        </label>

        <select
            wire:model="form.listing_group"
            class="w-full cursor-pointer rounded-md border border-slate-200 bg-slate-50/50
                   px-3.5 py-3 text-xs text-slate-800 transition-all
                   focus:border-sky-500 focus:bg-white focus:outline-none
                   focus:ring-2 focus:ring-sky-100
                   dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-100
                   dark:focus:border-sky-500 dark:focus:bg-slate-950
                   dark:focus:ring-sky-500/20"
        >
            <option value="">-- Pilih Jenis Listing --</option>
            <option value="primary">Primary (Developer / Baru)</option>
            <option value="secondary">Secondary (Bekas / Second)</option>
        </select>

        @error('form.listing_group')
            <span class="mt-1 block text-[11px] text-rose-500 dark:text-rose-400">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-xs font-semibold text-slate-700 dark:text-slate-300">
            Tipe Properti
            <span class="text-rose-500">*</span>
        </label>

        <select
            wire:model="form.property_type"
            class="w-full cursor-pointer rounded-md border border-slate-200 bg-slate-50/50
                   px-3.5 py-3 text-xs text-slate-800 transition-all
                   focus:border-sky-500 focus:bg-white focus:outline-none
                   focus:ring-2 focus:ring-sky-100
                   dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-100
                   dark:focus:border-sky-500 dark:focus:bg-slate-950
                   dark:focus:ring-sky-500/20"
        >
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
