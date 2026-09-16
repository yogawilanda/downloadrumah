<div
    x-data="{ show: @entangle('isOpen') }"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/70 p-4"
>
    <div
        class="w-full max-w-md overflow-hidden border border-slate-200 bg-white dark:border-slate-700 dark:bg-slate-900"
    >

        {{-- Header --}}
        <div class="border-b border-slate-200 px-5 py-4 dark:border-slate-800">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <span class="block text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">
                        Housing Analysis
                    </span>

                    <h3 class="mt-1 text-base font-bold tracking-tight text-slate-950 dark:text-white">
                        Analisis Kebutuhan Hunian
                    </h3>
                </div>

                <button
                    @click="show = false"
                    type="button"
                    class="flex h-8 w-8 shrink-0 items-center justify-center border border-slate-200 text-xs font-bold text-slate-500 transition hover:border-slate-950 hover:bg-slate-950 hover:text-white dark:border-slate-700 dark:text-slate-400 dark:hover:border-white dark:hover:bg-white dark:hover:text-slate-950"
                    aria-label="Tutup"
                >
                    ×
                </button>
            </div>

            {{-- Step Indicator --}}
            <div class="mt-4 flex items-center gap-1">
                @for($step = 1; $step <= 3; $step++)
                    <div class="flex items-center gap-1">
                        <div
                            class="flex h-6 w-6 items-center justify-center text-[9px] font-bold
                            {{ $currentStep === $step
                                ? 'bg-slate-950 text-white dark:bg-white dark:text-slate-950'
                                : ($currentStep > $step
                                    ? 'border border-slate-950 text-slate-950 dark:border-white dark:text-white'
                                    : 'border border-slate-200 text-slate-400 dark:border-slate-700 dark:text-slate-500') }}"
                        >
                            0{{ $step }}
                        </div>

                        @if($step < 3)
                            <div class="h-px w-6 bg-slate-200 dark:bg-slate-700"></div>
                        @endif
                    </div>
                @endfor

                <span class="ml-2 text-[9px] font-bold uppercase tracking-wide text-slate-400 dark:text-slate-500">
                    Langkah {{ str_pad($currentStep, 2, '0', STR_PAD_LEFT) }} / 03
                </span>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-5">

            {{-- Step 1: Target Hunian --}}
            @if($currentStep === 1)
                <div class="space-y-4">
                    <div>
                        <span class="text-[9px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                            01 / Tujuan
                        </span>

                        <label class="mt-1 block text-sm font-bold text-slate-950 dark:text-white">
                            Apa target hunianmu saat ini?
                        </label>
                    </div>

                    <div class="space-y-2">
                        @foreach([
                            'kos' => 'Sewa Kos Bulanan/Tahunan',
                            'sewa_rumah' => 'Sewa Rumah / Kontrakan',
                            'beli_rumah' => 'Beli Rumah (Nabung DP KPR)'
                        ] as $key => $label)
                            <label
                                class="group flex cursor-pointer items-center gap-3 border p-3 transition
                                {{ $housingGoal === $key
                                    ? 'border-slate-950 bg-slate-950 text-white dark:border-white dark:bg-white dark:text-slate-950'
                                    : 'border-slate-200 bg-white hover:border-slate-400 dark:border-slate-700 dark:bg-slate-950 dark:hover:border-slate-500' }}"
                            >
                                <input
                                    type="radio"
                                    wire:model="housingGoal"
                                    value="{{ $key }}"
                                    class="h-4 w-4 rounded-none border-slate-400 text-slate-950 focus:ring-0 focus:ring-offset-0 dark:border-slate-600 dark:bg-slate-950"
                                >

                                <span class="text-xs font-semibold">
                                    {{ $label }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Step 2: Target Dana --}}
            @if($currentStep === 2)
                <div class="space-y-4">
                    <div>
                        <span class="text-[9px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                            02 / Dana
                        </span>

                        <label class="mt-1 block text-sm font-bold text-slate-950 dark:text-white">
                            Berapa target dana yang kamu butuhkan?
                        </label>
                    </div>

                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">
                            Rp
                        </span>

                        <input
                            type="number"
                            wire:model="budgetTarget"
                            step="500000"
                            class="w-full border border-slate-200 bg-white py-3 pl-10 pr-3 text-sm text-slate-950 outline-none transition focus:border-slate-950 focus:ring-0 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:border-white"
                        >
                    </div>

                    <p class="border-l-2 border-slate-950 pl-3 text-[10px] leading-relaxed text-slate-500 dark:border-white dark:text-slate-400">
                        Contoh: Rp 5.000.000 untuk kos atau deposit awal.
                    </p>
                </div>
            @endif

            {{-- Step 3: Kemampuan Menabung --}}
            @if($currentStep === 3)
                <div class="space-y-4">
                    <div>
                        <span class="text-[9px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                            03 / Kemampuan
                        </span>

                        <label class="mt-1 block text-sm font-bold text-slate-950 dark:text-white">
                            Berapa yang bisa disisihkan per bulan?
                        </label>
                    </div>

                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">
                            Rp
                        </span>

                        <input
                            type="number"
                            wire:model="monthlySaving"
                            step="100000"
                            class="w-full border border-slate-200 bg-white py-3 pl-10 pr-3 text-sm text-slate-950 outline-none transition focus:border-slate-950 focus:ring-0 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:border-white"
                        >
                    </div>

                    <p class="text-[10px] leading-relaxed text-slate-500 dark:text-slate-400">
                        Masukkan angka yang realistis setelah kebutuhan bulanan utama.
                    </p>
                </div>
            @endif

        </div>

        {{-- Footer --}}
        <div class="flex items-center justify-between border-t border-slate-200 bg-slate-50 px-5 py-4 dark:border-slate-800 dark:bg-slate-950">

            @if($currentStep > 1)
                <button
                    wire:click="previousStep"
                    type="button"
                    class="text-[10px] font-bold uppercase tracking-wide text-slate-500 transition hover:text-slate-950 dark:text-slate-400 dark:hover:text-white"
                >
                    ← Kembali
                </button>
            @else
                <div></div>
            @endif

            @if($currentStep < 3)
                <button
                    wire:click="nextStep"
                    type="button"
                    class="border border-slate-950 bg-slate-950 px-5 py-2.5 text-[10px] font-bold uppercase tracking-wide text-white transition hover:bg-slate-800 dark:border-white dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
                >
                    Lanjut →
                </button>
            @else
                <button
                    wire:click="submitAnalysis"
                    type="button"
                    class="border border-slate-950 bg-slate-950 px-5 py-2.5 text-[10px] font-bold uppercase tracking-wide text-white transition hover:bg-slate-800 dark:border-white dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
                >
                    Lihat Rekomendasi →
                </button>
            @endif

        </div>
    </div>
</div>
