{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/tools/extension/buyer.blade.php
| @usage            : KPR Planning — Buyer Affordability Mode
| @type             : Alpine Extension View
|
| @ruling           : Buyer mode prioritizes affordability intent before technical loan assumptions.
| @ruling_ui        : Monthly budget is the primary input; supporting assumptions remain visually secondary.
| @ruling_result    : The estimated property price is the dominant output and leads directly to discovery.
| @ruling_motion    : Short 150–200ms transitions only.
|
| @status           : Active
| @author           : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div x-show="mode === 'buyer'" x-cloak class="space-y-6">

    {{-- Primary Affordability Input --}}

    <div>

        <div class="mb-2 flex items-center gap-2">

            <span class="h-1.5 w-1.5 bg-sky-500"></span>

            <label class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-500">
                Kemampuan utama
            </label>

        </div>

        <label class="mb-2 block text-sm font-semibold text-slate-800">
            Berapa cicilan yang nyaman setiap bulan?
        </label>

        <div
            class="relative border border-slate-300 bg-white transition-colors duration-150 focus-within:border-sky-400">

            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-xs font-semibold text-slate-400">
                Rp
            </span>

            <input type="text" :value="buyer.monthlyBudget ? buyer.monthlyBudget.toLocaleString('id-ID') : ''"
                @input="formatInput($event, buyer, 'monthlyBudget')" placeholder="5.000.000"
                class="w-full border-0 bg-transparent py-3.5 pl-10 pr-4 text-base font-semibold text-slate-900 outline-none placeholder:text-slate-300 focus:ring-0">

        </div>

        <p class="mt-1.5 pl-1 text-[10px] font-medium text-sky-600" x-text="formatTerbilangShort(buyer.monthlyBudget)">
        </p>

    </div>


    {{-- Location --}}

    <div>

        <label class="mb-2 block text-xs font-semibold text-slate-700">
            Di mana kamu ingin mencari?
        </label>

        <select x-model="buyer.location"
            class="w-full cursor-pointer border border-slate-300 bg-white px-3 py-3 text-xs font-medium text-slate-700 outline-none transition-colors duration-150 focus:border-sky-400 focus:ring-0">
            <option value="">Semua Lokasi</option>
            <option value="surabaya">Surabaya & Sekitarnya</option>
            <option value="sidoarjo">Sidoarjo</option>
            <option value="gresik">Gresik</option>
            <option value="jabodetabek">Jabodetabek</option>
        </select>

    </div>


    {{-- Planning Assumptions --}}

    <div class="border-t border-slate-200 pt-5">

        <div class="mb-3">

            <p class="text-xs font-semibold text-slate-700">
                Rencana pembiayaan
            </p>

            <p class="mt-0.5 text-[10px] text-slate-400">
                Sesuaikan asumsi untuk mendapatkan perkiraan yang lebih relevan.
            </p>

        </div>

        <div class="grid grid-cols-2 gap-3">

            {{-- Interest --}}

            <div>

                <label class="mb-1.5 block text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                    Bunga / Tahun
                </label>

                <div class="relative">

                    <input type="number" step="0.1" x-model.number="buyer.interest"
                        class="w-full border border-slate-300 bg-white px-3 py-3 pr-8 text-xs font-medium text-slate-800 outline-none transition-colors duration-150 focus:border-sky-400 focus:ring-0">

                    <span class="absolute inset-y-0 right-3 flex items-center text-xs font-semibold text-slate-400">
                        %
                    </span>

                </div>

            </div>


            {{-- Tenure --}}

            <div>

                <label class="mb-1.5 block text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                    Tenor
                </label>

                <div class="relative">

                    <input type="number" x-model.number="buyer.tenure"
                        class="w-full border border-slate-300 bg-white px-3 py-3 pr-12 text-xs font-medium text-slate-800 outline-none transition-colors duration-150 focus:border-sky-400 focus:ring-0">

                    <span class="absolute inset-y-0 right-3 flex items-center text-xs font-semibold text-slate-400">
                        Tahun
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- Down Payment --}}

    <div>

        <label class="mb-2 block text-xs font-semibold text-slate-700">
            Dana awal yang sudah disiapkan
        </label>

        <div
            class="relative border border-slate-300 bg-white transition-colors duration-150 focus-within:border-sky-400">

            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-xs font-semibold text-slate-400">
                Rp
            </span>

            <input type="text" :value="buyer.dp ? buyer.dp.toLocaleString('id-ID') : ''"
                @input="formatInput($event, buyer, 'dp')" placeholder="50.000.000"
                class="w-full border-0 bg-transparent py-3 pl-9 pr-3 text-sm font-medium text-slate-800 outline-none placeholder:text-slate-300 focus:ring-0">

        </div>

        <p class="mt-1 pl-1 text-[10px] font-medium text-slate-400" x-text="formatTerbilangShort(buyer.dp)"></p>

    </div>


    {{-- Result --}}

    <div class="border border-slate-300 bg-slate-50">

        <div class="border-b border-slate-200 px-4 py-3">

            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">
                Perkiraan kemampuan
            </p>

        </div>

        <div class="space-y-3 px-4 py-4">

            <div class="flex items-center justify-between gap-4 text-xs">

                <span class="text-slate-500">
                    Target cicilan
                </span>

                <span class="font-semibold text-slate-800"
                    x-text="formatRupiah(calcBuyer.maxMonthlyInstallment)"></span>

            </div>


            <div class="flex items-center justify-between gap-4 text-xs">

                <span class="text-slate-500">
                    Perkiraan plafon bank
                </span>

                <span class="font-semibold text-slate-800" x-text="formatRupiah(calcBuyer.maxPlafon)"></span>

            </div>


            <div class="border-t border-slate-200 pt-3">

                <div class="flex items-end justify-between gap-4">

                    <span class="text-xs font-semibold text-slate-700">
                        Kisaran harga properti
                    </span>

                    <span class="text-lg font-bold tracking-tight text-sky-600"
                        x-text="formatRupiah(calcBuyer.maxPropertyPrice)"></span>

                </div>

            </div>

        </div>

    </div>


    {{-- Discovery CTA --}}

    <a :href="searchUrl" wire:navigate
        class="group flex w-full items-center justify-between border border-slate-950 bg-slate-950 px-4 py-3.5 text-xs font-semibold text-white transition-colors duration-150 hover:border-sky-600 hover:bg-sky-600">

        <span>
            Cari properti dalam kisaran ini
        </span>

        <span class="text-slate-400 transition-colors duration-150 group-hover:text-white" aria-hidden="true">
            →
        </span>

    </a>


    <p class="text-center text-[10px] leading-5 text-slate-400">
        Perhitungan ini adalah perkiraan untuk membantu perencanaan,
        bukan keputusan persetujuan kredit dari bank.
    </p>

</div>
