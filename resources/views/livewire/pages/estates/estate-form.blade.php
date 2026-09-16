{{-- resources/views/livewire/pages/estates/estate-form.blade.php --}}

<div
    class="w-full max-w-md mx-auto px-4 pt-4 pb-32"
    x-data="{ wizardStep: $wire.entangle('currentStep') }"
    x-init="window.estateFormDirty = false"
    @input="window.estateFormDirty = true"
    @estate-form-saved.window="window.estateFormDirty = false"
    @estate-form-error.window="
        setTimeout(() => {
            const field = $event.detail.field;
            const target = document.querySelector('[wire\\:model=\'form.' + field + '\']');
            target?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            target?.focus();
        }, 50)
    "
>
    {{-- Validation --}}
    @if ($errors->any())
        <div class="mb-4 border border-red-300 bg-red-50 dark:border-red-900/60 dark:bg-red-950/30 px-3 py-3 text-xs text-red-700 dark:text-red-400">
            <p class="mb-1 font-bold uppercase tracking-wide">Input belum valid</p>
            <ul class="list-disc pl-4 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Header --}}
    <div class="mb-5 flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-4">
        <a
            href="{{ route('dashboard') }}"
            wire:navigate
            @click="if (window.estateFormDirty && !confirm('Isian belum disimpan. Keluar dari form?')) $event.preventDefault()"
            class="flex h-8 w-8 items-center justify-center border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-950 hover:text-white dark:hover:bg-white dark:hover:text-slate-950 transition"
            aria-label="Keluar"
        >
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </a>

        <div class="text-center">
            <span class="block text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">
                Estate / Form
            </span>
            <h1 class="mt-0.5 text-sm font-bold text-slate-950 dark:text-white">
                {{ $form->isEdit() ? 'Ubah Properti' : 'Pasang Properti' }}
            </h1>
        </div>

        <div class="w-8"></div>
    </div>

    {{-- Stepper --}}
    <div class="mb-6" aria-label="Progress pengisian">
        <div class="mb-3 flex items-center justify-between">
            <span class="text-[9px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                Progress
            </span>
            <span class="text-[10px] font-bold text-slate-950 dark:text-white">
                {{ str_pad($currentStep, 2, '0', STR_PAD_LEFT) }} / 04
            </span>
        </div>

        <div class="relative flex items-start justify-between">
            <div class="absolute left-0 right-0 top-3 h-px bg-slate-200 dark:bg-slate-800"></div>
            <div
                class="absolute left-0 top-3 h-px bg-slate-950 dark:bg-white transition-all duration-300"
                style="width: {{ (($currentStep - 1) / 3) * 100 }}%;"
            ></div>

            @foreach ([1 => 'Info Umum', 2 => 'Detail', 3 => 'Tambahan', 4 => 'Konfirmasi'] as $step => $label)
                <div class="relative flex flex-col items-center">
                    <button
                        type="button"
                        wire:click="setStep({{ $step }})"
                        wire:loading.attr="disabled"
                        class="flex h-6 w-6 items-center justify-center border text-[9px] font-bold transition
                            {{ $currentStep >= $step
                                ? 'border-slate-950 bg-slate-950 text-white dark:border-white dark:bg-white dark:text-slate-950'
                                : 'border-slate-300 bg-white text-slate-400 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-500' }}"
                    >
                        {{ $step }}
                    </button>

                    <span class="mt-2 text-[8px] font-bold uppercase tracking-wide
                        {{ $currentStep === $step
                            ? 'text-slate-950 dark:text-white'
                            : 'text-slate-400 dark:text-slate-600' }}">
                        {{ $label }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Flash Error --}}
    @if (session('error'))
        <div class="mb-4 border-l-2 border-red-500 bg-red-50 dark:bg-red-950/30 px-3 py-2 text-xs text-red-700 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form --}}
    <form
        wire:submit.prevent="save"
        class="space-y-4"
        onkeydown="if(event.keyCode == 13 && event.target.tagName !== 'TEXTAREA') event.preventDefault();"
    >
        <div x-show="wizardStep === 1" wire:key="estate-step-1">
            @include('livewire.pages.estates.partials.step-one')
        </div>

        <div x-show="wizardStep === 2" wire:key="estate-step-2">
            @include('livewire.pages.estates.partials.step-two')
        </div>

        <div x-show="wizardStep === 3" wire:key="estate-step-3">
            @include('livewire.pages.estates.partials.step-three')
        </div>

        <div x-show="wizardStep === 4" wire:key="estate-step-4">
            @include('livewire.pages.estates.partials.step-four')
        </div>

        {{-- Actions --}}
        <div class="fixed bottom-16 left-0 right-0 z-30 border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-950 px-4 py-3">
            <div class="mx-auto flex max-w-md gap-2">
                <button
                    type="button"
                    wire:click="saveDraft"
                    wire:loading.attr="disabled"
                    wire:target="saveDraft"
                    class="min-h-11 flex-1 border border-slate-300 bg-white px-3 text-[10px] font-bold uppercase tracking-wide text-slate-700 transition hover:border-slate-950 hover:text-slate-950 disabled:opacity-50 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300 dark:hover:border-white dark:hover:text-white"
                >
                    <span wire:loading.remove wire:target="saveDraft">Simpan Draft</span>
                    <span wire:loading wire:target="saveDraft">Menyimpan...</span>
                </button>

                @if ($currentStep > 1)
                    <button
                        type="button"
                        wire:click="previousStep"
                        wire:loading.attr="disabled"
                        class="min-h-11 w-1/4 border border-slate-300 bg-white text-[10px] font-bold uppercase tracking-wide text-slate-700 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300"
                    >
                        Kembali
                    </button>
                @endif

                @if ($currentStep < 4)
                    <button
                        type="button"
                        wire:click="nextStep"
                        wire:loading.attr="disabled"
                        class="min-h-11 flex-1 border border-slate-950 bg-slate-950 text-[10px] font-bold uppercase tracking-wide text-white transition hover:bg-slate-800 dark:border-white dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
                    >
                        Selanjutnya
                    </button>
                @else
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="save"
                        class="min-h-11 flex-1 border border-slate-950 bg-slate-950 text-[10px] font-bold uppercase tracking-wide text-white transition hover:bg-slate-800 disabled:cursor-not-allowed disabled:opacity-50 dark:border-white dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
                    >
                        <span wire:loading.remove wire:target="save">
                            {{ $form->isEdit() ? 'Update Properti' : 'Simpan & Terbitkan' }}
                        </span>
                        <span wire:loading wire:target="save">Memproses...</span>
                    </button>
                @endif
            </div>
        </div>
    </form>
</div>
