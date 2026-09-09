<div class="space-y-3">
    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Persentase Komisi (%) <span
                class="text-red-500">*</span></label>
        <input type="number" step="0.1" wire:model="form.commission_percentage" placeholder="Contoh: 2.5"
            class="w-full rounded-md border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 transition-all">
    </div>

    @foreach ([['is_kpr', 'Bisa KPR?'], ['has_imb', 'IMB / PBG Ada?'], ['has_blueprint', 'Denah / Blueprint Ada?']] as [$field, $label])
        <div class="flex items-center justify-between p-3 rounded-md border border-gray-100 bg-gray-50/40">
            <span class="text-xs font-semibold text-gray-700">{{ $label }} <span
                    class="text-red-500">*</span></span>
            <div class="flex items-center gap-4 text-xs">
                <label class="inline-flex items-center gap-1.5 cursor-pointer"><input type="radio"
                        wire:model="form.attributes_list.{{ $field }}" value="1"
                        class="text-blue-600 focus:ring-blue-500 w-4 h-4"><span
                        class="font-medium text-gray-700">Ya</span></label>
                <label class="inline-flex items-center gap-1.5 cursor-pointer"><input type="radio"
                        wire:model="form.attributes_list.{{ $field }}" value="0"
                        class="text-blue-600 focus:ring-blue-500 w-4 h-4"><span
                        class="font-medium text-gray-700">Tidak</span></label>
            </div>
        </div>
    @endforeach
</div>
