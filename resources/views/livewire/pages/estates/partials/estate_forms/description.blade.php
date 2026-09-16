{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/partials/estate_forms/description.blade.php
| @usage      : Estate listing description input form
| @version    : 1.1.6
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div>
    <label class="mb-1.5 block text-xs font-semibold text-slate-700 dark:text-slate-300">
        Deskripsi Listing
        <span class="text-rose-500">*</span>
    </label>

    <textarea
        wire:model="form.description"
        rows="5"
        placeholder="Bisa langsung tempel / paste pesan dari WhatsApp...&#10;&#10;Contoh:&#10;🏡 Rumah Siap Huni Asri&#10;📍 Lokasi Strategis Dekat Tol&#10;✨ Bebas Banjir & Keamanan 24 Jam"
        class="w-full rounded-md border border-slate-200 bg-slate-50/50 px-3.5 py-3
               text-xs leading-relaxed text-slate-800 transition-all
               placeholder:text-slate-400 focus:bg-white focus:border-sky-500
               focus:ring-2 focus:ring-sky-100 focus:outline-none
               whitespace-pre-line font-sans
               dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-100
               dark:placeholder:text-slate-600 dark:focus:bg-slate-950
               dark:focus:border-sky-500 dark:focus:ring-sky-500/20"
    ></textarea>

    @error('form.description')
        <span class="mt-1 block text-[11px] text-rose-500 dark:text-rose-400">
            {{ $message }}
        </span>
    @enderror
</div>
