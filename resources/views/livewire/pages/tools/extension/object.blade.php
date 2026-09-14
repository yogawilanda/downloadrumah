
{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/tools/extension/object.blade.php
| @usage            : KPR Planning — Property Installment Mode
| @type             : Alpine Extension View
|
| @ruling           : Property mode starts from a known property price and estimates financing needs.
| @ruling_ui        : Property price is the primary input; installment is the dominant output.
| @ruling_result    : Financing breakdown remains secondary to the estimated monthly installment.
| @ruling_motion    : Short 150–200ms transitions only.
|
| @status           : Active
| @author           : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div
    x-show="mode === 'agent'"
    x-cloak
    class="space-y-6"
>

    {{-- Primary Property Input --}}

    <div>

        <div class="mb-2 flex items-center gap-2">

            <span class="h-1.5 w-1.5 bg-sky-500"></span>

            <label class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-500">
                Properti
            </label>

        </div>

        <label class="mb-2 block text-sm font-semibold text-slate-800">
            Berapa harga properti yang ingin dihitung?
        </label>

        <div class="relative border border-slate-300 bg-white transition-colors duration-150 focus-within:border-sky-400">

            <span
                class="absolute inset-y-0 left-0 flex items-center pl-4 text-xs font-semibold text-slate-400"
            >
                Rp
            </span>

            <input
                type="text"
                :value="agent.propertyPrice ? agent.propertyPrice.toLocaleString('id-ID') : ''"
                @input="formatInput($event, agent, 'propertyPrice')"
                placeholder="650.000.000"
                class="w-full border-0 bg-transparent py-3.5 pl-10 pr-4 text-base font-semibold text-slate-900 outline-none placeholder:text-slate-300 focus:ring-0"
            >

        </div>

        <p
            class="mt-1.5 pl-1 text-[10px] font-medium text-sky-600"
            x-text="formatTerbilangShort(agent.propertyPrice)"
        ></p>

    </div>


    {{-- Property Condition --}}

    <div>

        <label class="mb-2 block text-xs font-semibold text-slate-700">
            Kondisi properti
        </label>

        <div class="grid grid-cols-2 border border-slate-300">

            <button
                type="button"
                @click="agent.condition = 'new'"
                :class="agent.condition === 'new'
                    ? 'bg-slate-50 text-slate-950 border-b-2 border-sky-500'
                    : 'text-slate-400 hover:bg-slate-50 hover:text-slate-700'"
                class="px-3 py-3 text-xs font-semibold transition-colors duration-150"
            >
                Properti baru
            </button>

            <button
                type="button"
                @click="agent.condition = 'used'"
                :class="agent.condition === 'used'
                    ? 'bg-slate-50 text-slate-950 border-b-2 border-sky-500'
                    : 'text-slate-400 hover:bg-slate-50 hover:text-slate-700'"
                class="border-l border-slate-300 px-3 py-3 text-xs font-semibold transition-colors duration-150"
            >
                Properti bekas
            </button>

        </div>

    </div>


    {{-- Financing Assumptions --}}

    <div class="border-t border-slate-200 pt-5">

        <div class="mb-3">

            <p class="text-xs font-semibold text-slate-700">
                Rencana pembiayaan
            </p>

            <p class="mt-0.5 text-[10px] text-slate-400">
                Tentukan uang muka dan asumsi KPR untuk memperkirakan cicilan.
            </p>

        </div>

        <div class="grid grid-cols-2 gap-3">

            {{-- Down Payment --}}

            <div>

                <label class="mb-1.5 block text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                    Uang muka
                </label>

                <div class="relative">

                    <input
                        type="number"
                        x-model.number="agent.dpPercent"
                        class="w-full border border-slate-300 bg-white px-3 py-3 pr-8 text-xs font-medium text-slate-800 outline-none transition-colors duration-150 focus:border-sky-400 focus:ring-0"
                    >

                    <span class="absolute inset-y-0 right-3 flex items-center text-xs font-semibold text-slate-400">
                        %
                    </span>

                </div>

            </div>


            {{-- Interest --}}

            <div>

                <label class="mb-1.5 block text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                    Bunga / Tahun
                </label>

                <div class="relative">

                    <input
                        type="number"
                        step="0.1"
                        x-model.number="agent.interest"
                        class="w-full border border-slate-300 bg-white px-3 py-3 pr-8 text-xs font-medium text-slate-800 outline-none transition-colors duration-150 focus:border-sky-400 focus:ring-0"
                    >

                    <span class="absolute inset-y-0 right-3 flex items-center text-xs font-semibold text-slate-400">
                        %
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- Tenure --}}

    <div>

        <label class="mb-2 block text-xs font-semibold text-slate-700">
            Tenor KPR
        </label>

        <div class="relative">

            <input
                type="number"
                x-model.number="agent.tenure"
                class="w-full border border-slate-300 bg-white px-3 py-3 pr-16 text-xs font-medium text-slate-800 outline-none transition-colors duration-150 focus:border-sky-400 focus:ring-0"
            >

            <span class="absolute inset-y-0 right-3 flex items-center text-xs font-semibold text-slate-400">
                Tahun
            </span>

        </div>

    </div>


    {{-- Result --}}

    <div class="border border-slate-300 bg-slate-50">

        <div class="border-b border-slate-200 px-4 py-3">

            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">
                Perkiraan pembiayaan
            </p>

        </div>

        <div class="space-y-3 px-4 py-4">

            <div class="flex items-center justify-between gap-4 text-xs">

                <span class="text-slate-500">
                    Uang muka
                </span>

                <span
                    class="font-semibold text-slate-800"
                    x-text="formatRupiah(calcAgent.dpAmount)"
                ></span>

            </div>


            <div class="flex items-center justify-between gap-4 text-xs">

                <span class="text-slate-500">
                    Plafon pinjaman KPR
                </span>

                <span
                    class="font-semibold text-slate-800"
                    x-text="formatRupiah(calcAgent.plafon)"
                ></span>

            </div>


            <div class="flex items-center justify-between gap-4 text-xs">

                <span class="text-slate-500">
                    Estimasi surat & pajak
                </span>

                <span
                    class="font-medium text-slate-600"
                    x-text="formatRupiah(calcAgent.estimatedLegalFee)"
                ></span>

            </div>


            <div class="border-t border-slate-200 pt-3">

                <div class="flex items-end justify-between gap-4">

                    <span class="text-xs font-semibold text-slate-700">
                        Estimasi cicilan / bulan
                    </span>

                    <span
                        class="text-lg font-bold tracking-tight text-sky-600"
                        x-text="formatRupiah(calcAgent.monthlyInstallment)"
                    ></span>

                </div>

            </div>

        </div>

    </div>


    {{-- Context Note --}}

    <p class="text-center text-[10px] leading-5 text-slate-400">
        Hasil merupakan estimasi berdasarkan asumsi yang kamu masukkan dan
        dapat berbeda dari perhitungan bank.
    </p>

</div>
