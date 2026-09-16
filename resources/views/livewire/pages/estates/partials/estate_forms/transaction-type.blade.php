{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/partials/estate_forms/transaction-type.blade.php
| @usage      : Estate transaction type selection input
| @version    : 1.1.6
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div>
    <label class="mb-2 block text-xs font-semibold text-slate-700 dark:text-slate-300">
        Tipe Transaksi
        <span class="text-rose-500">*</span>
    </label>

    <div class="flex flex-wrap gap-2">
        @foreach (['sale' => 'Dijual', 'rent' => 'Disewakan', 'sale & rent' => 'Jual & Sewa'] as $val => $txt)
            <label
                class="flex min-w-[100px] flex-1 cursor-pointer select-none items-center justify-center
                       gap-1.5 rounded-md border border-slate-200 bg-slate-50/50 p-2.5
                       transition-all hover:border-slate-300 hover:bg-white
                       dark:border-slate-700 dark:bg-slate-950/50
                       dark:hover:border-slate-600 dark:hover:bg-slate-800/60"
            >
                <input
                    type="radio"
                    wire:model="form.transaction_type"
                    value="{{ $val }}"
                    class="h-3.5 w-3.5 shrink-0 text-sky-600
                           focus:ring-sky-500 dark:border-slate-600
                           dark:bg-slate-900 dark:ring-offset-slate-900"
                >

                <span class="whitespace-nowrap text-[11px] font-semibold text-slate-800 dark:text-slate-200">
                    {{ $txt }}
                </span>
            </label>
        @endforeach
    </div>

    @error('form.transaction_type')
        <span class="mt-1 block text-[11px] text-rose-500 dark:text-rose-400">
            {{ $message }}
        </span>
    @enderror
</div>
