```blade
{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
    | @path : resources/views/livewire/pages/home/sections/intent-flow.blade.php
    | @usage : DownloadRumah — Buyer / Seller Relationship
    | @type : Blade Partial
    | @design : Buyer ↔ Deal ↔ Seller + DownloadRumah System Layer
    | @motion : Entry / interaction only. No continuous animation.
    -------------------------------------------------------------------------------------------------------- --}}

<section x-data="{ visible: false }" x-intersect.once="visible = true"
    class="relative overflow-hidden border-y border-slate-100 bg-white py-20 sm:py-28">

    <div class="mx-auto max-w-6xl px-6 lg:px-8">

        {{-- Heading --}}
        <div class="max-w-2xl">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-500">
                Dua sisi. Satu proses.
            </p>

            <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-950 sm:text-5xl">
                Kamu menentukan kebutuhan.
                <span class="text-sky-500">Kami membantu membuat prosesnya lebih jelas.</span>
            </h2>

            <p class="mt-5 max-w-xl text-sm leading-6 text-slate-500 sm:text-base">
                DownloadRumah membantu keduanya bertemu dengan informasi yang lebih jelas,
                tanpa harus buru-buru membuka identitas atau bertransaksi.
            </p>
        </div>

        {{-- Relationship --}}
        <div class="relative mt-16"
            :class="visible ? 'opacity-100' : 'opacity-0'"
            class="transition-opacity duration-700">

            {{-- Buyer / Deal / Seller --}}
            <div class="grid items-center gap-4 md:grid-cols-[1fr_auto_1fr]">

                {{-- Buyer --}}
                <div class="border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-400">
                        Pembeli
                    </p>

                    <p class="mt-4 text-xl font-semibold tracking-tight text-slate-900">
                        Punya kebutuhan
                    </p>

                    <div class="mt-4 space-y-2 text-sm text-slate-500">
                        <p>Butuh kos dekat kampus</p>
                        <p>Budget sekitar 2 juta</p>
                    </div>
                </div>

                {{-- Deal --}}
                <div class="flex items-center gap-3 px-2">
                    <div class="h-px w-8 bg-slate-300 lg:w-16"></div>

                    <span class="shrink-0 text-[10px] font-semibold uppercase tracking-[0.18em] text-slate-400">
                        Deal
                    </span>

                    <div class="h-px w-8 bg-slate-300 lg:w-16"></div>
                </div>

                {{-- Seller --}}
                <div class="border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-400">
                        Pemilik / Penjual
                    </p>

                    <p class="mt-4 text-xl font-semibold tracking-tight text-slate-900">
                        Punya properti
                    </p>

                    <div class="mt-4 space-y-2 text-sm text-slate-500">
                        <p>Rumah di Sidoarjo</p>
                        <p>Ingin dijual</p>
                    </div>
                </div>

            </div>

            {{-- System Connections --}}
            <div class="relative mx-auto mt-8 max-w-4xl">

                {{-- Lines pointing toward DownloadRumah --}}
                <div class="pointer-events-none absolute inset-x-0 -top-8 hidden h-8 md:block">

                    <div class="absolute left-[18%] top-0 h-8 border-l border-sky-300"></div>

                    <div class="absolute right-[18%] top-0 h-8 border-r border-sky-300"></div>

                </div>

                {{-- DownloadRumah System --}}
                <div class="mx-auto w-fit border border-sky-200 bg-sky-50 px-5 py-4 text-center shadow-sm">

                    <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-sky-500">
                        System
                    </p>

                    <p class="mt-1 text-sm font-bold tracking-tight text-slate-900">
                        DownloadRumah
                    </p>

                </div>

                {{-- System explanation --}}
                <p class="mx-auto mt-4 max-w-md text-center text-xs leading-5 text-slate-400">
                    Membantu memahami kebutuhan, memeriksa informasi,
                    dan menjaga proses tetap jelas sebelum mereka melanjutkan.
                </p>

            </div>

        </div>

    </div>
</section>
```
