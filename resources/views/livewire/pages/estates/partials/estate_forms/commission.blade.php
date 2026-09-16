{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/partials/estate_forms/commission.blade.php
| @usage      : Estate commission and supporting document/property attribute form
| @version    : 1.1.6
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="space-y-3">
    <div>
        <label class="mb-1.5 block text-xs font-semibold text-slate-700 dark:text-slate-300">
            Persentase Komisi (%)
            <span class="text-rose-500">*</span>
        </label>

        <input
            type="number"
            step="0.1"
            wire:model="form.commission_percentage"
            placeholder="Contoh: 2.5"
            class="w-full rounded-md border border-slate-200 bg-slate-50/50 px-3.5 py-3
                   text-xs text-slate-800 transition-all
                   placeholder:text-slate-400 focus:border-sky-500 focus:outline-none
                   focus:ring-2 focus:ring-sky-500/20
                   dark:border-slate-700 dark:bg-slate-950/50
                   dark:text-slate-100 dark:placeholder:text-slate-600
                   dark:focus:border-sky-500"
        />
    </div>

    @foreach ([
        ['is_kpr', 'Bisa KPR?'],
        ['has_imb', 'IMB / PBG Ada?'],
        ['has_blueprint', 'Denah / Blueprint Ada?']
    ] as [$field, $label])
        <div
            class="flex items-center justify-between rounded-md border border-slate-100
                   bg-slate-50/40 p-3
                   dark:border-slate-800 dark:bg-slate-950/40"
        >
            <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">
                {{ $label }}
                <span class="text-rose-500">*</span>
            </span>

            <div class="flex items-center gap-4 text-xs">
                <label class="inline-flex cursor-pointer items-center gap-1.5">
                    <input
                        type="radio"
                        wire:model="form.attributes_list.{{ $field }}"
                        value="1"
                        class="h-4 w-4 border-slate-300 text-sky-600
                               focus:ring-sky-500
                               dark:border-slate-600 dark:bg-slate-900
                               dark:checked:bg-sky-500 dark:checked:border-sky-500"
                    >

                    <span class="font-medium text-slate-700 dark:text-slate-300">
                        Ya
                    </span>
                </label>

                <label class="inline-flex cursor-pointer items-center gap-1.5">
                    <input
                        type="radio"
                        wire:model="form.attributes_list.{{ $field }}"
                        value="0"
                        class="h-4 w-4 border-slate-300 text-sky-600
                               focus:ring-sky-500
                               dark:border-slate-600 dark:bg-slate-900
                               dark:checked:bg-sky-500 dark:checked:border-sky-500"
                    >

                    <span class="font-medium text-slate-700 dark:text-slate-300">
                        Tidak
                    </span>
                </label>
            </div>
        </div>
    @endforeach
</div>
