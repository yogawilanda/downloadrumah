{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/partials/estate_forms/title-form.blade.php
| @usage      : Estate listing title input with validation feedback
| @version    : 1.2.0
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayoganda@gmail.com>
|--------------------------------------------------------------------------
--}}

@props(['message' => ''])

<div>

    <div class="flex items-end justify-between mb-2">

        <label class="text-[10px] font-bold uppercase tracking-[0.12em]
                      text-slate-700 dark:text-slate-300">
            Judul Listing
            <span class="text-red-500">*</span>
        </label>

        <span class="text-[9px] font-mono text-slate-400 dark:text-slate-600">
            MAX 70
        </span>

    </div>

    <div class="relative group">

        <input
            type="text"
            wire:model="form.title"
            maxlength="70"
            placeholder="Contoh: RUMAH 2 LANTAI MINIMALIS SIDOARJO"
            class="w-full border border-slate-200 bg-white px-3.5 py-3
                   text-xs text-slate-900
                   placeholder:text-slate-400
                   transition-colors
                   focus:border-slate-950 focus:outline-none focus:ring-0
                   dark:border-slate-700 dark:bg-slate-950
                   dark:text-slate-100
                   dark:placeholder:text-slate-600
                   dark:focus:border-white"
        />

        <div
            class="absolute left-0 bottom-0 h-0.5 w-0
                   bg-slate-950 dark:bg-white
                   transition-all duration-200
                   group-focus-within:w-full
                   pointer-events-none"
        ></div>

    </div>

    @error('form.title')
        <span class="mt-1.5 block text-[10px] font-medium text-red-500 dark:text-red-400">
            {{ $message }}
        </span>
    @enderror

</div>
