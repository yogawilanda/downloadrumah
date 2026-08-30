<div class="w-full pb-28 pt-4 px-4 max-w-lg mx-auto">
    <div class="mb-4 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </a>
        <h1 class="text-base font-bold text-gray-900">{{ $form->isEdit() ? 'Ubah Properti' : 'Pasang Properti' }}</h1>
        <div class="w-6"></div>
    </div>

    <div class="mb-6 px-2">
        <div class="relative flex items-center justify-between">
            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-0.5 bg-gray-200 -z-10"></div>
            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-0.5 bg-blue-400 -z-10 transition-all duration-300" style="width: {{ (($currentStep - 1) / 3) * 100 }}%;"></div>
            @foreach ([1 => 'Info Umum', 2 => 'Detail Properti', 3 => 'Info Tambahan', 4 => 'Konfirmasi'] as $step => $label)
                <div class="flex flex-col items-center">
                    <button type="button" wire:click="setStep({{ $step }})" class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold transition {{ $currentStep >= $step ? 'bg-blue-400 text-gray-900 ring-4 ring-blue-100' : 'bg-gray-200 text-gray-500' }}">{{ $step }}</button>
                    <span class="text-[10px] font-medium mt-1 {{ $currentStep === $step ? 'text-gray-900 font-bold' : 'text-gray-400' }}">{{ $label }}</span>
                </div>
            @endforeach
        </div>
    </div>

    @if (session('error'))
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        @if ($currentStep === 1)
            @include('livewire.pages.estates.partials.step-one')
        @elseif ($currentStep === 2)
            @include('livewire.pages.estates.partials.step-two')
        @elseif ($currentStep === 3)
            @include('livewire.pages.estates.partials.step-three')
        @else
            @include('livewire.pages.estates.partials.step-four')
        @endif

        <div class="pt-4 flex gap-3">
            @if ($currentStep > 1)
                <button type="button" wire:click="previousStep" class="w-1/3 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-xs font-bold active:bg-gray-50 shadow-sm">Sebelumnya</button>
            @endif
            @if ($currentStep < 4)
                <button type="button" wire:click="nextStep" class="w-full py-3 rounded-xl bg-blue-600 text-white text-xs font-bold shadow-md active:bg-blue-500 transition">Selanjutnya</button>
            @else
                <button type="submit" wire:loading.attr="disabled" class="w-full py-3 rounded-xl bg-blue-400 text-gray-900 text-xs font-bold shadow-md active:bg-amber-500 transition disabled:opacity-50">
                    <span wire:loading.remove>{{ $form->isEdit() ? 'Update Properti' : 'Simpan & Terbitkan' }}</span>
                    <span wire:loading>Memproses...</span>
                </button>
            @endif
        </div>
    </form>
</div>
