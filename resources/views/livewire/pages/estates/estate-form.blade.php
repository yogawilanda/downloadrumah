{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/estates/estate-form.blade.php
| @usage : Main View Container for Estate Multi-Step Wizard Form
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="w-full pb-32 pt-4 px-4 max-w-md mx-auto" x-data="{ wizardStep: $wire.entangle('currentStep') }"
    x-init="window.estateFormDirty = false"
    @input="window.estateFormDirty = true"
    @estate-form-saved.window="window.estateFormDirty = false"
    @estate-form-error.window="setTimeout(() => { const field = $event.detail.field; const target = document.querySelector('[wire\\:model=\'form.' + field + '\']'); target?.scrollIntoView({ behavior: 'smooth', block: 'center' }); target?.focus(); }, 50)">

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 text-xs rounded-xl">
            <p class="font-bold mb-1">Ada input yang belum valid:</p>
            <ul class="list-disc pl-4 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Header Navigation --}}
    <div class="mb-4 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" wire:navigate
            @click="if (window.estateFormDirty && !confirm('Isian belum disimpan. Keluar dari form?')) $event.preventDefault()"
            class="text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
        <h1 class="text-base font-bold text-gray-900">{{ $form->isEdit() ? 'Ubah Properti' : 'Pasang Properti' }}</h1>
        <div class="w-6"></div>
    </div>

    {{-- Stepper Progress Bar --}}
    <div class="mb-6 px-2" aria-label="Progress pengisian">
        <p class="mb-2 text-center text-xs font-semibold text-gray-500">Langkah {{ $currentStep }} dari 4</p>
        <div class="relative flex items-center justify-between">
            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-0.5 bg-gray-200 -z-10"></div>
            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-0.5 bg-blue-600 -z-10 transition-all duration-300"
                style="width: {{ (($currentStep - 1) / 3) * 100 }}%;"></div>
            @foreach ([1 => 'Info Umum', 2 => 'Detail Properti', 3 => 'Info Tambahan', 4 => 'Konfirmasi'] as $step => $label)
                <div class="flex flex-col items-center">
                    <button type="button" wire:click="setStep({{ $step }})" wire:loading.attr="disabled"
                        class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold transition {{ $currentStep >= $step ? 'bg-blue-600 text-white ring-4 ring-blue-100' : 'bg-gray-200 text-gray-500' }}">{{ $step }}</button>
                    <span
                        class="text-[10px] font-medium mt-1 {{ $currentStep === $step ? 'text-gray-900 font-bold' : 'text-gray-400' }}">{{ $label }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Flash Error Message --}}
    @if (session('error'))
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700">{{ session('error') }}
        </div>
    @endif

    {{-- Form Content --}}
    <form wire:submit.prevent="save" class="space-y-4"
        onkeydown="if(event.keyCode == 13 && event.target.tagName !== 'TEXTAREA') { event.preventDefault(); }">
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

        {{-- Action Buttons --}}
        <div class="fixed bottom-16 left-0 right-0 z-30 border-t border-gray-200 bg-white/95 px-4 py-3 shadow-lg backdrop-blur-md">
            <div class="mx-auto flex max-w-md gap-2">
                <button type="button" wire:click="saveDraft" wire:loading.attr="disabled" wire:target="saveDraft"
                    class="min-h-11 flex-1 rounded-xl border border-gray-300 bg-white px-3 text-xs font-bold text-gray-700 disabled:opacity-50">
                    <span wire:loading.remove wire:target="saveDraft">Simpan Draft</span>
                    <span wire:loading wire:target="saveDraft">Menyimpan...</span>
                </button>
            @if ($currentStep > 1)
                <button type="button" wire:click="previousStep" wire:loading.attr="disabled"
                    class="min-h-11 w-1/4 rounded-xl border border-gray-300 bg-white text-xs font-bold text-gray-700 shadow-sm active:bg-gray-50">
                    Sebelumnya
                </button>
            @endif

            @if ($currentStep < 4)
                <button type="button" wire:click="nextStep" wire:loading.attr="disabled"
                    class="min-h-11 flex-1 rounded-xl bg-blue-600 text-xs font-bold text-white shadow-md transition active:bg-blue-700">
                    Selanjutnya
                </button>
            @else
                <button type="submit" wire:loading.attr="disabled" wire:target="save"
                    class="min-h-11 flex-1 rounded-xl bg-blue-600 text-xs font-bold text-white shadow-md transition hover:bg-blue-700 active:bg-blue-800 disabled:cursor-not-allowed disabled:opacity-50">
                    <span wire:loading.remove wire:target="save">
                        {{ $form->isEdit() ? 'Update Properti' : 'Simpan & Terbitkan' }}
                    </span>
                    <span wire:loading wire:target="save">
                        Memproses...
                    </span>
                </button>
            @endif
            </div>
        </div>
    </form>
</div>
