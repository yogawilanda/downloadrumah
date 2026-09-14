<x-layouts.structural-section framed class="border-y border-slate-300 bg-white">

    <div class="relative overflow-hidden px-5 py-14 sm:px-8 md:px-12 md:py-18">

        <div
            class="structural-dot-field absolute -right-16 bottom-[-80px] h-[300px] w-[420px] opacity-45"
            aria-hidden="true"
        ></div>

        <div class="relative grid gap-10 md:grid-cols-[1fr_auto] md:items-center">

            <div class="max-w-xl">

                <div
                    class="mb-3 flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.18em] text-sky-600"
                >
                    <span class="h-1.5 w-1.5 bg-sky-500"></span>
                    Langkah berikutnya
                </div>

                <h2 class="text-2xl font-black leading-[1.08] tracking-tight text-slate-950 md:text-3xl">
                    Sudah menemukan sesuatu yang ingin kamu lihat lebih jauh?
                </h2>

                <p class="mt-4 max-w-lg text-sm leading-6 text-slate-500">
                    Buka pilihannya, pahami detailnya, lalu tentukan apakah ini layak kamu lanjutkan.
                </p>

            </div>

            <a
                href="{{ route('listings.index') }}"
                class="inline-flex w-full items-center justify-center border border-slate-300 bg-white px-6 py-3.5 text-xs font-bold text-slate-800 shadow-[5px_5px_0_0_rgba(15,23,42,0.06)] transition duration-150 hover:border-slate-400 hover:shadow-[2px_2px_0_0_rgba(15,23,42,0.06)] md:w-auto"
            >
                Jelajahi properti
                <span class="ml-2">→</span>
            </a>

        </div>

    </div>

</x-layouts.structural-section>
