{{--
loc: resources/views/livewire/pages/tools/mortgage-calculator.blade.php
usage: to view the mortgage calculator page.
--}}

<div class="min-h-screen bg-gray-50 pt-6 pb-24 px-4">
    <div x-data="kprApp()" class="max-w-md mx-auto p-5 space-y-6 bg-white rounded-2xl shadow-sm border border-gray-100">

        <!-- Tab Switcher -->
        <div class="flex p-1 bg-gray-100 rounded-xl text-xs font-semibold">
            <button type="button" @click="mode = 'buyer'" :class="mode === 'buyer' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500'" class="flex-1 py-2 rounded-lg transition-all">
                Cek Budget (Buyer)
            </button>
            <button type="button" @click="mode = 'agent'" :class="mode === 'agent' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500'" class="flex-1 py-2 rounded-lg transition-all">
                Simulasi Unit (Agent)
            </button>
        </div>

        <!-- 1. MODE BUYER: Kemampuan Bayar -->
        <div x-show="mode === 'buyer'" class="space-y-4 text-sm">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Gaji / Total Penghasilan Bersih (per Bulan)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs text-gray-400 font-semibold">Rp</span>
                    <input type="number" x-model.number="buyer.income" class="w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <!-- Fast-Pill: Pekerjaan (Affects DBR Max Ratio) -->
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Pekerjaan</label>
                <div class="grid grid-cols-3 gap-1.5">
                    <template x-for="job in jobOptions" :key="job.id">
                        <button type="button" @click="buyer.jobType = job.id"
                            :class="buyer.jobType === job.id ? 'bg-blue-50 border-blue-600 text-blue-600 font-semibold' : 'border-gray-200 text-gray-500 hover:border-gray-300'"
                            class="py-1.5 text-[11px] border rounded-lg transition text-center" x-text="job.label">
                        </button>
                    </template>
                </div>
            </div>

            <!-- Fast-Pill: Lokasi Target -->
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Target Lokasi Cari Rumah</label>
                <select x-model="buyer.location" class="w-full p-2.5 border border-gray-200 rounded-xl text-xs text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
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
                    <input type="number" step="0.1" x-model.number="buyer.interest" class="w-full p-2.5 border border-gray-200 rounded-xl text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Tenor (Tahun)</label>
                    <input type="number" x-model.number="buyer.tenure" class="w-full p-2.5 border border-gray-200 rounded-xl text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Rencana DP Siap Disediakan (Rp)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs text-gray-400 font-semibold">Rp</span>
                    <input type="number" x-model.number="buyer.dp" class="w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <!-- Output Result -->
            <div class="p-4 bg-blue-50/70 border border-blue-100 rounded-2xl space-y-2.5">
                <div class="flex justify-between text-xs text-gray-600">
                    <span>Batas Max Cicilan (<span x-text="getDbrPercentage() * 100"></span>% Gaji):</span>
                    <span class="font-semibold text-gray-800" x-text="formatRupiah(calculateBuyer().maxMonthlyInstallment)"></span>
                </div>
                <div class="flex justify-between text-xs text-gray-600">
                    <span>Plafon Pinjaman Max Bank:</span>
                    <span class="font-semibold text-gray-800" x-text="formatRupiah(calculateBuyer().maxPlafon)"></span>
                </div>
                <hr class="border-blue-100">
                <div class="flex justify-between items-center pt-0.5">
                    <span class="text-xs font-bold text-blue-900">Maksimal Harga Rumah:</span>
                    <span class="text-base font-extrabold text-blue-600" x-text="formatRupiah(calculateBuyer().maxPropertyPrice)"></span>
                </div>
            </div>

            <!-- CTA Direct to Search with Query Params -->
            <a :href="getSearchUrl()" wire:navigate class="block w-full py-3 bg-blue-600 text-white text-center font-semibold text-xs rounded-xl shadow-md shadow-blue-100 hover:bg-blue-700 active:scale-[0.98] transition">
                Cari Rumah Sesuai Budget Ini
            </a>
        </div>

        <!-- 2. MODE AGENT: Simulasi Unit -->
        <div x-show="mode === 'agent'" class="space-y-4 text-sm" x-cloak>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Harga Properti (Rp)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs text-gray-400 font-semibold">Rp</span>
                    <input type="number" x-model.number="agent.propertyPrice" class="w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <!-- Fast Toggle: Status Properti -->
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Kondisi Properti</label>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" @click="agent.condition = 'new'"
                        :class="agent.condition === 'new' ? 'bg-blue-50 border-blue-600 text-blue-600 font-semibold' : 'border-gray-200 text-gray-500'"
                        class="py-2 text-xs border rounded-xl transition text-center">
                        Baru (Primary)
                    </button>
                    <button type="button" @click="agent.condition = 'used'"
                        :class="agent.condition === 'used' ? 'bg-blue-50 border-blue-600 text-blue-600 font-semibold' : 'border-gray-200 text-gray-500'"
                        class="py-2 text-xs border rounded-xl transition text-center">
                        Second (Secondary)
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Uang Muka / DP (%)</label>
                    <input type="number" x-model.number="agent.dpPercent" class="w-full p-2.5 border border-gray-200 rounded-xl text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Bunga KPR (%/Thn)</label>
                    <input type="number" step="0.1" x-model.number="agent.interest" class="w-full p-2.5 border border-gray-200 rounded-xl text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tenor (Tahun)</label>
                <input type="number" x-model.number="agent.tenure" class="w-full p-2.5 border border-gray-200 rounded-xl text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Output Result -->
            <div class="p-4 bg-gray-50 border border-gray-200/80 rounded-2xl space-y-2">
                <div class="flex justify-between text-xs text-gray-600">
                    <span>Nilai Uang Muka (DP):</span>
                    <span class="font-semibold text-gray-800" x-text="formatRupiah(calculateAgent().dpAmount)"></span>
                </div>
                <div class="flex justify-between text-xs text-gray-600">
                    <span>Plafon Pinjaman KPR:</span>
                    <span class="font-semibold text-gray-800" x-text="formatRupiah(calculateAgent().plafon)"></span>
                </div>
                <div class="flex justify-between text-xs text-gray-500 pt-0.5">
                    <span>Est. Biaya Surat & Pajak:</span>
                    <span class="font-medium text-gray-700" x-text="formatRupiah(calculateAgent().estimatedLegalFee)"></span>
                </div>
                <hr class="border-gray-200">
                <div class="flex justify-between items-center pt-1">
                    <span class="text-xs font-bold text-gray-900">Cicilan / Bulan:</span>
                    <span class="text-base font-extrabold text-blue-600" x-text="formatRupiah(calculateAgent().monthlyInstallment)"></span>
                </div>
            </div>
        </div>

    </div>
</div>
