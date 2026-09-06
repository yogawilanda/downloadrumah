<?php
/**
 * <meta_config>
 * @path : resources/views/livewire/pages/admin/settings/index.blade.php
 * @usage : Super admin settings dashboard view
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * </meta_config>
 */
?>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
                    <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Pengaturan Aplikasi
                    </span>
                </h1>
                <p class="mt-2 text-sm text-slate-600">
                    Atur parameter runtime aplikasi tanpa perlu mengubah kode.
                </p>
            </div>
            <button wire:click="flushCache"
                class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Flush Cache
            </button>
        </div>

        {{-- Flash --}}
        @if ($flash)
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
                {{ $flash }}
            </div>
        @endif

        {{-- Settings grouped by group --}}
        <div class="space-y-6">
            @forelse ($this->grouped as $group => $rows)
                <section class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <header class="px-6 py-4 bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200">
                        <h2 class="text-xs font-semibold uppercase tracking-wider text-slate-700">
                            {{ ucfirst($group) }}
                        </h2>
                    </header>
                    <ul class="divide-y divide-slate-100">
                        @foreach ($rows as $row)
                            <li class="p-6 hover:bg-slate-50/50 transition">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <label for="s-{{ $row->id }}" class="text-sm font-semibold text-slate-900">
                                                {{ $row->label }}
                                            </label>
                                            @if ($row->is_public)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-100 text-blue-700">
                                                    public
                                                </span>
                                            @endif
                                        </div>
                                        <code class="text-xs text-slate-500">{{ $row->key }}</code>
                                        @if ($row->description)
                                            <p class="mt-1 text-xs text-slate-600">{{ $row->description }}</p>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-3 md:w-96">
                                        @if ($row->type === 'boolean')
                                            {{-- Boolean: pretty toggle --}}
                                            <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                                                <input type="checkbox" id="s-{{ $row->id }}"
                                                    wire:model.boolean="drafts.{{ $row->id }}"
                                                    class="sr-only peer">
                                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                            </label>
                                        @else
                                            {{-- String / Integer / JSON --}}
                                            <input type="{{ $row->type === 'integer' ? 'number' : 'text' }}"
                                                id="s-{{ $row->id }}"
                                                wire:model="drafts.{{ $row->id }}"
                                                class="flex-1 px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        @endif

                                        <button wire:click="save({{ $row->id }})"
                                            wire:loading.attr="disabled"
                                            wire:target="save({{ $row->id }})"
                                            class="inline-flex items-center gap-1.5 px-3 py-2 bg-blue-600 hover:bg-blue-700 disabled:bg-blue-400 text-white text-xs font-medium rounded-lg transition shadow-sm">
                                            <svg wire:loading wire:target="save({{ $row->id }})"
                                                class="animate-spin w-3.5 h-3.5" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                            </svg>
                                            <span>Simpan</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @empty
                <div class="p-8 text-center bg-white rounded-xl border border-dashed border-slate-300">
                    <p class="text-slate-600">Belum ada pengaturan. Jalankan seeder untuk memuat nilai default.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
