<div>
    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Harga Jual / Sewa (Rp) <span
            class="text-red-500">*</span></label>
    <input type="text" x-data="currencyInput('form.price')" x-model="displayValue" @input="update($event)"
        placeholder="Contoh: 2.000.000.000"
        class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
    @error('form.price')
        <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
    @enderror
</div>
