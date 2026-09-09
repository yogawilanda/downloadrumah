{{-- resources/views/livewire/pages/tools/extension/object.blade.php --}}

<div x-show="mode === 'agent'" class="space-y-4 text-sm" x-cloak>
    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Harga Properti (Rp)</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs text-gray-400 font-semibold">Rp</span>
            <input type="text" :value="agent.propertyPrice ? agent.propertyPrice.toLocaleString('id-ID') : ''"
                @input="formatInput($event, agent, 'propertyPrice')" placeholder="650.000.000"
                class="w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-md text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <p class="text-sm text-blue-600 font-semibold mt-1 pl-1" x-text="formatTerbilangShort(agent.propertyPrice)"></p>
    </div>

    <!-- Fast Toggle: Status Properti -->
    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1.5">Kondisi Properti</label>
        <div class="grid grid-cols-2 gap-2">
            <button type="button" @click="agent.condition = 'new'"
                :class="agent.condition === 'new' ? 'bg-blue-50 border-blue-600 text-blue-600 font-semibold' : 'border-gray-200 text-gray-500'"
                class="py-2 text-xs border rounded-md transition text-center">
                Baru (Primary)
            </button>
            <button type="button" @click="agent.condition = 'used'"
                :class="agent.condition === 'used' ? 'bg-blue-50 border-blue-600 text-blue-600 font-semibold' : 'border-gray-200 text-gray-500'"
                class="py-2 text-xs border rounded-md transition text-center">
                Second (Secondary)
            </button>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Uang Muka / DP (%)</label>
            <input type="number" x-model.number="agent.dpPercent"
                class="w-full p-2.5 border border-gray-200 rounded-md text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Bunga KPR (%/Thn)</label>
            <input type="number" step="0.1" x-model.number="agent.interest"
                class="w-full p-2.5 border border-gray-200 rounded-md text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
    </div>

    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Tenor (Tahun)</label>
        <input type="number" x-model.number="agent.tenure"
            class="w-full p-2.5 border border-gray-200 rounded-md text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <!-- Output Result -->
    <div class="p-4 bg-gray-50 border border-gray-200/80 rounded-md space-y-2">
        <div class="flex justify-between text-xs text-gray-600">
            <span>Nilai Uang Muka (DP):</span>
            <span class="font-semibold text-gray-800" x-text="formatRupiah(calcAgent.dpAmount)"></span>
        </div>
        <div class="flex justify-between text-xs text-gray-600">
            <span>Plafon Pinjaman KPR:</span>
            <span class="font-semibold text-gray-800" x-text="formatRupiah(calcAgent.plafon)"></span>
        </div>
        <div class="flex justify-between text-xs text-gray-500 pt-0.5">
            <span>Est. Biaya Surat & Pajak:</span>
            <span class="font-medium text-gray-700" x-text="formatRupiah(calcAgent.estimatedLegalFee)"></span>
        </div>
        <hr class="border-gray-200">
        <div class="flex justify-between items-center pt-1">
            <span class="text-xs font-bold text-gray-900">Cicilan / Bulan:</span>
            <span class="text-base font-extrabold text-blue-600" x-text="formatRupiah(calcAgent.monthlyInstallment)"></span>
        </div>
    </div>
</div>
