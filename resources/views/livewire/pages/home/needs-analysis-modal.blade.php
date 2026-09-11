<div x-data="{ show: @entangle('isOpen') }" x-show="show" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden p-6 space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b pb-3">
            <h3 class="font-bold text-gray-900 text-lg">Analisis Kebutuhan Hunian</h3>
            <button @click="show = false" class="text-gray-400 hover:text-gray-600 text-sm">✕</button>
        </div>

        {{-- Step 1: Target Hunian --}}
        @if($currentStep === 1)
            <div class="space-y-4">
                <label class="block font-semibold text-sm text-gray-700">Apa target hunianmu saat ini?</label>
                <div class="space-y-2">
                    @foreach(['kos' => 'Sewa Kos Bulanan/Tahunan', 'sewa_rumah' => 'Sewa Rumah / Kontrakan', 'beli_rumah' => 'Beli Rumah (Nabung DP KPR)'] as $key => $label)
                        <label class="flex items-center gap-3 p-3 border rounded-xl cursor-pointer hover:bg-indigo-50/50 transition has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50">
                            <input type="radio" wire:model="housingGoal" value="{{ $key }}" class="text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm font-medium text-gray-800">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Step 2: Target Dana --}}
        @if($currentStep === 2)
            <div class="space-y-4">
                <label class="block font-semibold text-sm text-gray-700">Berapa target dana yang kamu butuhkan?</label>
                <input type="number" wire:model="budgetTarget" step="500000" class="w-full p-3 border rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                <p class="text-xs text-gray-500">Contoh: Rp 5.000.000 untuk kos/deposit awal.</p>
            </div>
        @endif

        {{-- Step 3: Kemampuan Menabung --}}
        @if($currentStep === 3)
            <div class="space-y-4">
                <label class="block font-semibold text-sm text-gray-700">Berapa yang bisa disisihkan per bulan?</label>
                <input type="number" wire:model="monthlySaving" step="100000" class="w-full p-3 border rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
        @endif

        {{-- Footer Action Buttons --}}
        <div class="flex items-center justify-between pt-4 border-t">
            @if($currentStep > 1)
                <button wire:click="previousStep" class="px-4 py-2 text-xs font-semibold text-gray-600 hover:text-gray-900">Kembali</button>
            @else
                <div></div>
            @endif

            @if($currentStep < 3)
                <button wire:click="nextStep" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow transition">Lanjut →</button>
            @else
                <button wire:click="submitAnalysis" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow transition">Lihat Rekomendasi</button>
            @endif
        </div>

    </div>
</div>
