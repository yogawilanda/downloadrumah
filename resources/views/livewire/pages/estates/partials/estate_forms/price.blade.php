{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/partials/estate_forms/price.blade.php
| @usage      : Estate sale/rental price input with currency formatting
| @version    : 1.1.6
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div>
    <label class="mb-1.5 block text-xs font-semibold text-slate-700 dark:text-slate-300">
        Harga Jual / Sewa (Rp)
        <span class="text-rose-500">*</span>
    </label>

    <input
        type="text"
        x-data="currencyInput('form.price')"
        x-model="displayValue"
        @input="update($event)"
        placeholder="Contoh: 2.000.000.000"
        class="w-full rounded-md border border-slate-200 bg-slate-50/50 px-3.5 py-3
               text-xs text-slate-800 transition-all
               placeholder:text-slate-400 focus:bg-white focus:border-sky-500
               focus:ring-2 focus:ring-sky-100 focus:outline-none
               dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-100
               dark:placeholder:text-slate-600 dark:focus:bg-slate-950
               dark:focus:border-sky-500 dark:focus:ring-sky-500/20"
    />

    @error('form.price')
        <span class="mt-1 block text-[11px] text-rose-500 dark:text-rose-400">
            {{ $message }}
        </span>
    @enderror
</div>
