{{--
|--------------------------------------------------------------------------
| Extension: Buyer Mode (Cari Sesuai Budget)
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/tools/extension/buyer.blade.php
--}}
<div x-show="mode === 'buyer'" class="space-y-4 text-sm">
    <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Kemampuan Cicilan Maksimal/Bulan</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs text-gray-400 font-semibold">Rp</span>
            <input type="text" :value="buyer.monthlyBudget ? buyer.monthlyBudget.toLocaleString('id-ID') : ''"
                @input="formatInput($event, buyer, 'monthlyBudget')" placeholder="5.000.000"
                class="w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-md text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <p class="text-sm text-blue-600 font-semibold mt-1 pl-1" x-text="formatTerbilangShort(buyer.monthlyBudget)"></p>
    </div>

    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Target Lokasi Cari Rumah</label>
        <select x-model="buyer.location"
            class="w-full p-2.5 border border-gray-200 rounded-md text-xs text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
            <option value="">Semua Lokasi</option>
            <option value="surabaya">Surabaya & Sekitarnya</option>
            <option value="sidoarjo">Sidoarjo</option>
            <option value="gresik">Gresik</option>
            <option value="jabodetabek">Jabodetabek</option>
        </select>
    </div>

    <div class="grid grid-cols-2 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Bunga KPR (%/Thn)</label>
            <input type="number" step="0.1" x-model.number="buyer.interest"
                class="w-full p-2.5 border border-gray-200 rounded-md text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Tenor (Tahun)</label>
            <input type="number" x-model.number="buyer.tenure"
                class="w-full p-2.5 border border-gray-200 rounded-md text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
    </div>

    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Rencana DP Siap Disediakan (Rp)</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs text-gray-400 font-semibold">Rp</span>
            <input type="text" :value="buyer.dp ? buyer.dp.toLocaleString('id-ID') : ''"
                @input="formatInput($event, buyer, 'dp')" placeholder="50.000.000"
                class="w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-md text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <p class="text-[10px] text-blue-600 font-semibold mt-1 pl-1" x-text="formatTerbilangShort(buyer.dp)"></p>
    </div>

    <!-- Output Result -->
    <div class="p-4 bg-blue-50/70 border border-blue-100 rounded-md space-y-2.5">
        <div class="flex justify-between text-xs text-gray-600">
            <span>Target Cicilan/Bulan:</span>
            <span class="font-semibold text-gray-800" x-text="formatRupiah(calcBuyer.maxMonthlyInstallment)"></span>
        </div>
        <div class="flex justify-between text-xs text-gray-600">
            <span>Plafon Pinjaman Max Bank:</span>
            <span class="font-semibold text-gray-800" x-text="formatRupiah(calcBuyer.maxPlafon)"></span>
        </div>
        <hr class="border-blue-100">
        <div class="flex justify-between items-center pt-0.5">
            <span class="text-xs font-bold text-blue-900">Maksimal Harga Rumah:</span>
            <span class="text-base font-extrabold text-blue-600" x-text="formatRupiah(calcBuyer.maxPropertyPrice)"></span>
        </div>
    </div>

    <!-- CTA Direct to Search -->
    <a :href="searchUrl" wire:navigate
        class="block w-full py-3 bg-blue-600 text-white text-center font-semibold text-xs rounded-md shadow-md shadow-blue-100 hover:bg-blue-700 active:scale-[0.98] transition">
        Cari Rumah Sesuai Budget Ini
    </a>
</div>
