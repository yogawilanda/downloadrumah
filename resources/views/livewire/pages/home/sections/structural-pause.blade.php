<x-layouts.structural-section framed class="border-y border-slate-300 bg-white">

    <div class="grid md:grid-cols-[1.3fr_0.7fr]">

        <div class="relative min-h-[280px] overflow-hidden px-5 py-12 sm:px-8 md:flex md:items-center md:px-12 md:py-16">

            <div class="absolute bottom-0 left-0 h-32 w-48 opacity-60">
                <div class="structural-dot-field-small h-full w-full"></div>
            </div>

            <div class="relative max-w-xl">

                <div class="mb-3 flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.18em] text-sky-600">
                    <span class="h-1.5 w-1.5 bg-sky-500"></span>
                    Jangan buru-buru memilih
                </div>

                <h2 class="text-2xl font-black leading-[1.08] tracking-tight text-slate-950 sm:text-3xl md:text-4xl">
                    Yang terlihat menarik belum tentu cocok.
                </h2>

                <p class="mt-4 max-w-lg text-sm leading-6 text-slate-500 md:text-base">
                    Luangkan waktu untuk memahami kebutuhanmu sebelum menentukan langkah berikutnya.
                </p>

            </div>

        </div>

        {{-- Geometric Side --}}

        <div class="relative hidden overflow-hidden border-l border-slate-300 bg-slate-50 md:block">

            <div class="absolute inset-0">
                <div class="structural-dot-field h-full w-full opacity-30"></div>
            </div>

            <div class="absolute left-1/2 top-1/2 h-28 w-28 -translate-x-1/2 -translate-y-1/2 border border-slate-300">

                <div class="absolute -bottom-4 -right-4 h-28 w-28 border border-sky-300 bg-white"></div>

                <div class="absolute left-0 top-7 h-px w-16 bg-sky-500"></div>

                <div class="absolute bottom-0 right-7 h-16 w-px bg-slate-300"></div>

            </div>

        </div>

    </div>

</x-layouts.structural-section>
