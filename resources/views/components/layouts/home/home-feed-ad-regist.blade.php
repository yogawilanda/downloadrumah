{{-- resources/views/components/layouts/home/home-feed-ad-regist.blade.php --}}

<div
    class="flex flex-col gap-5 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6
           dark:bg-slate-950"
>

    <div class="max-w-xl">

        <div class="mb-2 flex items-center gap-2">
            <span class="h-1 w-5 bg-sky-500"></span>

            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                Untuk pemilik properti
            </p>
        </div>

        <h3 class="text-lg font-bold tracking-tight text-slate-900 dark:text-slate-100">
            Punya properti untuk ditawarkan?
        </h3>

        <p class="mt-1.5 text-xs leading-5 text-slate-500 dark:text-slate-400">
            Temukan orang yang memang sedang mencari, lalu biarkan percakapan dimulai dari kebutuhan yang jelas.
        </p>

    </div>

    <a
        href="{{ auth()->check() ? route('estates.create') : route('login') }}"
        wire:navigate
        class="inline-flex shrink-0 items-center justify-center border border-slate-300 bg-white
               px-4 py-2.5 text-xs font-bold text-slate-800
               shadow-[3px_3px_0_0_rgba(15,23,42,0.05)]
               transition duration-150 hover:border-sky-300 hover:text-sky-700
               dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200
               dark:shadow-[3px_3px_0_0_rgba(0,0,0,0.2)]
               dark:hover:border-sky-600 dark:hover:text-sky-400"
    >
        Tambahkan properti
        <span class="ml-2">→</span>
    </a>

</div>
