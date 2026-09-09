<div>
    <label class="block text-xs font-semibold text-gray-700 mb-2">Tipe Transaksi <span
            class="text-red-500">*</span></label>
    <div class="flex flex-wrap gap-2">
        @foreach (['sale' => 'Dijual', 'rent' => 'Disewakan', 'sale & rent' => 'Jual & Sewa'] as $val => $txt)
            <label
                class="flex-1 min-w-[100px] flex items-center justify-center gap-1.5 p-2.5 rounded-md border border-gray-200 bg-gray-50/50 cursor-pointer hover:bg-white transition-all select-none">
                <input type="radio" wire:model="form.transaction_type" value="{{ $val }}"
                    class="text-blue-600 focus:ring-blue-500 w-3.5 h-3.5 shrink-0">
                <span class="text-[11px] font-semibold text-gray-800 whitespace-nowrap">{{ $txt }}</span>
            </label>
        @endforeach
    </div>
    @error('form.transaction_type')
        <span class="text-[11px] text-red-500 mt-1 block">{{ $message }}</span>
    @enderror
</div>
