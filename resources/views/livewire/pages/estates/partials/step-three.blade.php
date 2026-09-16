<div class="space-y-6">

    {{-- Step Header --}}
    <div class="flex items-end justify-between gap-4 border-b border-slate-200 dark:border-slate-800 pb-4">
        <div>
            <div class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">
                Langkah 03
            </div>
            <h2 class="mt-1 text-lg font-bold tracking-tight text-slate-950 dark:text-white">
                Info Tambahan
            </h2>
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                Kontak internal dan pengaturan visibilitas properti.
            </p>
        </div>

        <div class="hidden sm:block text-right text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">
            ESTATE / ACCESS
        </div>
    </div>

    {{-- Internal Contact --}}
    <section class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800">

        <div class="flex items-center gap-3 px-5 py-4 border-b border-slate-200 dark:border-slate-800">
            <span class="flex h-7 w-7 items-center justify-center bg-slate-950 dark:bg-white text-white dark:text-slate-950">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </span>

            <div>
                <h3 class="text-[11px] font-bold uppercase tracking-[0.12em] text-slate-900 dark:text-white">
                    Kontak Pemilik
                </h3>
                <p class="mt-0.5 text-[10px] text-slate-500 dark:text-slate-400">
                    Data ini bersifat internal kecuali nomor diaktifkan untuk publik.
                </p>
            </div>
        </div>

        <div class="p-5 space-y-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                {{-- Nama Pemilik --}}
                <div class="relative group">
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-700 dark:text-slate-300">
                            Nama Pemilik
                        </label>
                        <span class="text-[9px] text-slate-400 dark:text-slate-500">INTERNAL</span>
                    </div>

                    <input
                        type="text"
                        wire:model="form.owner_name"
                        placeholder="Contoh: Bpk. Agus"
                        class="w-full border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 px-3 py-2.5 text-xs text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-600 focus:border-slate-950 dark:focus:border-white focus:outline-none transition-colors"
                    >

                    <div class="absolute left-0 bottom-0 h-0.5 w-0 bg-slate-950 dark:bg-white transition-all duration-200 group-focus-within:w-full"></div>

                    @error('form.owner_name')
                        <span class="mt-1 block text-[10px] text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Telepon Pemilik --}}
                <div class="relative group">
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-700 dark:text-slate-300">
                            No. HP Pemilik
                        </label>
                        <span class="text-[9px] text-slate-400 dark:text-slate-500">INTERNAL</span>
                    </div>

                    <input
                        type="text"
                        wire:model="form.owner_phone"
                        placeholder="Contoh: 081234567890"
                        class="w-full border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 px-3 py-2.5 text-xs text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-600 focus:border-slate-950 dark:focus:border-white focus:outline-none transition-colors"
                    >

                    <div class="absolute left-0 bottom-0 h-0.5 w-0 bg-slate-950 dark:bg-white transition-all duration-200 group-focus-within:w-full"></div>

                    @error('form.owner_phone')
                        <span class="mt-1 block text-[10px] text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            {{-- Public Phone --}}
            <div class="flex items-center justify-between gap-4 border-t border-slate-200 dark:border-slate-800 pt-4">
                <div>
                    <span class="block text-[11px] font-bold text-slate-900 dark:text-white">
                        Tampilkan No. HP Pemilik Publik?
                    </span>
                    <span class="block mt-1 text-[10px] text-slate-500 dark:text-slate-400">
                        Pengunjung dapat menghubungi pemilik secara langsung.
                    </span>
                </div>

                <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                    <input type="checkbox" wire:model="form.show_owner_phone" class="sr-only peer">

                    <div class="w-10 h-5 border border-slate-300 dark:border-slate-600 bg-slate-200 dark:bg-slate-800 peer-checked:bg-slate-950 dark:peer-checked:bg-white transition-colors relative">
                        <span class="absolute top-[3px] left-[3px] h-3 w-3 bg-white dark:bg-slate-400 peer-checked:bg-white dark:peer-checked:bg-slate-950 transition-transform peer-checked:translate-x-5"></span>
                    </div>
                </label>
            </div>

            {{-- Publicity Status --}}
            <div class="flex items-center justify-between gap-4 border-t border-slate-200 dark:border-slate-800 pt-4">
                <div>
                    <span class="block text-[11px] font-bold text-slate-900 dark:text-white">
                        Status Publisitas Properti
                    </span>
                    <span class="block mt-1 text-[10px] text-slate-500 dark:text-slate-400">
                        Atur visibilitas properti antara Draft atau Published.
                    </span>
                </div>

                <div class="flex items-center gap-3 flex-shrink-0">
                    <span class="text-[9px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 w-16 text-right">
                        {{ $form->publicity_status === 'published' ? 'Published' : 'Draft' }}
                    </span>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input
                            type="checkbox"
                            wire:change="updatePublicityStatus"
                            @checked($form->publicity_status === 'published')
                            class="sr-only peer"
                            @disabled($form->publicity_status === 'archived')
                        >

                        <div class="w-10 h-5 border border-slate-300 dark:border-slate-600 bg-slate-200 dark:bg-slate-800 peer-checked:bg-slate-950 dark:peer-checked:bg-white peer-disabled:opacity-40 peer-disabled:cursor-not-allowed transition-colors relative">
                            <span class="absolute top-[3px] left-[3px] h-3 w-3 bg-white dark:bg-slate-400 peer-checked:bg-white dark:peer-checked:bg-slate-950 transition-transform peer-checked:translate-x-5"></span>
                        </div>
                    </label>
                </div>
            </div>

        </div>
    </section>
</div>
