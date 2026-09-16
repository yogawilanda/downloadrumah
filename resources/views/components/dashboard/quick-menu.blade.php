<section class="space-y-2">
    <p class="px-1 text-[10px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
        Menu aplikasi
    </p>

    <div class="grid grid-cols-2 gap-2">
        <a
            href="{{ route('dashboard.estates') }}"
            wire:navigate
            class="rounded-md border border-sky-100 bg-sky-50 p-3 text-xs font-bold text-sky-700 transition
                   hover:border-sky-200 hover:bg-sky-100
                   dark:border-sky-900/70 dark:bg-sky-950/40 dark:text-sky-400
                   dark:hover:border-sky-800 dark:hover:bg-sky-950/60"
        >
            Kelola Listing Properti
        </a>

        <div
            class="rounded-md border border-slate-100 bg-white p-3 text-xs font-bold text-slate-500
                   dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400"
        >
            Properti Disimpan
            <span class="block text-[10px] text-slate-400 dark:text-slate-500">Soon</span>
        </div>

        <div
            class="rounded-md border border-slate-100 bg-white p-3 text-xs font-bold text-slate-500
                   dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400"
        >
            Riwayat KPR / Pengajuan
            <span class="block text-[10px] text-slate-400 dark:text-slate-500">Soon</span>
        </div>

        <a
            href="{{ route('profile') }}"
            wire:navigate
            class="rounded-md border border-slate-100 bg-white p-3 text-xs font-bold text-slate-500 transition
                   hover:border-slate-200 hover:bg-slate-50
                   dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400
                   dark:hover:border-slate-700 dark:hover:bg-slate-800"
        >
            Pengaturan Profil
            <span class="block text-[10px] text-slate-400 dark:text-slate-500">Soon</span>
        </a>
    </div>
</section>
