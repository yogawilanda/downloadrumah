<?php
/**
 * <meta_config>
 * @path : resources/views/livewire/pages/admin/settings/index.blade.php
 * @usage : Super admin settings dashboard view
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * </meta_config>
 */
?>
<div class="min-h-screen bg-slate-50/50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Header & Global Actions --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-slate-200">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Pengaturan Aplikasi</h1>
                <p class="text-xs text-slate-500 mt-1">Kelola parameter runtime dan konfigurasi global sistem secara langsung.</p>
            </div>
            <button wire:click="flushCache" wire:loading.attr="disabled"
                class="inline-flex items-center justify-center gap-2 px-3.5 py-2 bg-white border border-slate-300 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-50 transition shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg wire:loading.remove wire:target="flushCache" class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                <svg wire:loading wire:target="flushCache" class="animate-spin w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                <span>Flush Cache</span>
            </button>
        </div>

        {{-- Flash Notification --}}
        @if ($flash)
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                class="flex items-center justify-between p-3.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-medium">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    <span>{{ $flash }}</span>
                </div>
            </div>
        @endif

        {{-- Settings Grouped Container --}}
        <div class="space-y-6">
            @forelse ($this->grouped as $group => $rows)
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 overflow-hidden">
                    <div class="px-5 py-3 bg-slate-50/80 border-b border-slate-200 flex items-center justify-between">
                        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-600">{{ $group }}</h2>
                        <span class="text-[10px] font-medium px-2 py-0.5 rounded-full bg-slate-200/70 text-slate-600">{{ count($rows) }} Item</span>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @foreach ($rows as $row)
                            <div class="p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4 hover:bg-slate-50/50 transition">
                                <div class="flex-1 space-y-1">
                                    <div class="flex items-center gap-2">
                                        <label for="s-{{ $row->id }}" class="text-sm font-semibold text-slate-800">{{ $row->label }}</label>
                                        @if ($row->is_public)
                                            <span class="px-1.5 py-0.5 rounded text-[10px] font-semibold bg-blue-50 text-blue-600 border border-blue-200/60">Public</span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] font-mono text-slate-400">{{ $row->key }}</p>
                                    @if ($row->description)
                                        <p class="text-xs text-slate-500 pt-0.5">{{ $row->description }}</p>
                                    @endif
                                </div>

                                <div class="flex items-center gap-3 md:w-80 justify-end">
                                    @if ($row->type === 'boolean')
                                        {{-- Instant Auto-Save Toggle --}}
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" id="s-{{ $row->id }}"
                                                wire:model.boolean="drafts.{{ $row->id }}"
                                                wire:change="save({{ $row->id }})"
                                                class="sr-only peer">
                                            <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600"></div>
                                        </label>
                                    @else
                                        {{-- Text/Number Input with Action Button --}}
                                        <input type="{{ $row->type === 'integer' ? 'number' : 'text' }}"
                                            id="s-{{ $row->id }}" wire:model="drafts.{{ $row->id }}"
                                            class="flex-1 min-w-0 px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">

                                        <button wire:click="save({{ $row->id }})" wire:loading.attr="disabled" wire:target="save({{ $row->id }})"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 disabled:bg-blue-300 text-white text-xs font-semibold rounded-lg transition shadow-sm">
                                            <svg wire:loading wire:target="save({{ $row->id }})" class="animate-spin w-3 h-3" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                            <span>Simpan</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="p-12 text-center bg-white rounded-xl border border-dashed border-slate-300">
                    <p class="text-xs text-slate-500">Belum ada pengaturan tersimpan. Silakan jalankan database seeder.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
