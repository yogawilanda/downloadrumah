{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
    1. path__________________: resources/views/livewire/pages/admin/settings/index.blade.php
    2. usage_________________: Super Admin — Application Settings Dashboard
    3. type__________________: Root Livewire Page View
    4. expected_data_________: [$flash, $this->grouped, $drafts]
    5. purpose_______________: Manage runtime parameters and global application configuration.
    6. ruling________________: Settings persistence and cache operations are delegated to Livewire.
    7. ruling_structure______: Livewire Component → Settings Dashboard
    8. ruling_ui_____________: Presentation only; no fallback data preparation in the view.
    9. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

<div class="min-h-screen bg-slate-50/50 px-4 py-8 dark:bg-slate-950 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl space-y-6">

        {{-- Header & Global Actions --}}
        <div
            class="flex flex-col justify-between gap-4 border-b border-slate-200 pb-4
                   dark:border-slate-800 sm:flex-row sm:items-center"
        >
            <div>
                <h1
                    class="text-2xl font-bold tracking-tight text-slate-900
                           dark:text-slate-100"
                >
                    Pengaturan Aplikasi
                </h1>

                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                    Kelola parameter runtime dan konfigurasi global sistem secara langsung.
                </p>
            </div>

            <button
                wire:click="flushCache"
                wire:loading.attr="disabled"
                class="inline-flex items-center justify-center gap-2 rounded-md border
                       border-slate-300 bg-white px-3.5 py-2 text-xs font-semibold
                       text-slate-700 shadow-sm transition hover:bg-slate-50
                       focus:outline-none focus:ring-2 focus:ring-sky-500
                       dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200
                       dark:hover:bg-slate-800"
            >
                <svg
                    wire:loading.remove
                    wire:target="flushCache"
                    class="h-4 w-4 text-slate-500 dark:text-slate-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                    />
                </svg>

                <svg
                    wire:loading
                    wire:target="flushCache"
                    class="h-4 w-4 animate-spin text-sky-600 dark:text-sky-400"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>

                <span>Flush Cache</span>
            </button>
        </div>

        {{-- Flash Notification --}}
        @if ($flash)
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 3000)"
                class="flex items-center justify-between rounded-md border border-emerald-200
                       bg-emerald-50 p-3.5 text-xs font-medium text-emerald-800
                       dark:border-emerald-900/70 dark:bg-emerald-950/40
                       dark:text-emerald-300"
            >
                <div class="flex items-center gap-2">
                    <svg
                        class="h-4 w-4 text-emerald-600 dark:text-emerald-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    <span>{{ $flash }}</span>
                </div>
            </div>
        @endif

        {{-- Settings Grouped Container --}}
        <div class="space-y-6">
            @forelse ($this->grouped as $group => $rows)
                <div
                    class="overflow-hidden rounded-md border border-slate-200/80 bg-white
                           shadow-sm dark:border-slate-800 dark:bg-slate-900"
                >
                    {{-- Group Header --}}
                    <div
                        class="flex items-center justify-between border-b border-slate-200
                               bg-slate-50/80 px-5 py-3 dark:border-slate-800
                               dark:bg-slate-800/60"
                    >
                        <h2
                            class="text-xs font-bold uppercase tracking-wider
                                   text-slate-600 dark:text-slate-300"
                        >
                            {{ $group }}
                        </h2>

                        <span
                            class="rounded-full bg-slate-200/70 px-2 py-0.5 text-[10px]
                                   font-medium text-slate-600 dark:bg-slate-700
                                   dark:text-slate-400"
                        >
                            {{ count($rows) }} Item
                        </span>
                    </div>

                    <div class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach ($rows as $row)
                            <div
                                class="flex flex-col gap-4 p-5 transition hover:bg-slate-50/50
                                       dark:hover:bg-slate-800/40 md:flex-row
                                       md:items-center md:justify-between"
                            >
                                {{-- Setting Information --}}
                                <div class="flex-1 space-y-1">
                                    <div class="flex items-center gap-2">
                                        <label
                                            for="s-{{ $row->id }}"
                                            class="text-sm font-semibold text-slate-800
                                                   dark:text-slate-200"
                                        >
                                            {{ $row->label }}
                                        </label>

                                        @if ($row->is_public)
                                            <span
                                                class="rounded border border-sky-200/60
                                                       bg-sky-50 px-1.5 py-0.5 text-[10px]
                                                       font-semibold text-sky-600
                                                       dark:border-sky-900/70
                                                       dark:bg-sky-950/40
                                                       dark:text-sky-400"
                                            >
                                                Public
                                            </span>
                                        @endif
                                    </div>

                                    <p
                                        class="font-mono text-[11px] text-slate-400
                                               dark:text-slate-500"
                                    >
                                        {{ $row->key }}
                                    </p>

                                    @if ($row->description)
                                        <p class="pt-0.5 text-xs text-slate-500 dark:text-slate-400">
                                            {{ $row->description }}
                                        </p>
                                    @endif
                                </div>

                                {{-- Setting Control --}}
                                <div class="flex items-center justify-end gap-3 md:w-80">
                                    @if ($row->type === 'boolean')
                                        {{-- Instant Auto-Save Toggle --}}
                                        <label class="relative inline-flex cursor-pointer items-center">
                                            <input
                                                type="checkbox"
                                                id="s-{{ $row->id }}"
                                                wire:model.boolean="drafts.{{ $row->id }}"
                                                wire:change="save({{ $row->id }})"
                                                class="peer sr-only"
                                            >

                                            <div
                                                class="peer h-5 w-10 rounded-full bg-slate-200
                                                       after:absolute after:left-[2px] after:top-[2px]
                                                       after:h-4 after:w-4 after:rounded-full
                                                       after:border after:border-slate-300
                                                       after:bg-white after:content-['']
                                                       after:transition-all
                                                       peer-focus:outline-none
                                                       peer-checked:bg-sky-600
                                                       peer-checked:after:translate-x-full
                                                       peer-checked:after:border-white
                                                       dark:bg-slate-700"
                                            ></div>
                                        </label>
                                    @else
                                        {{-- Text/Number Input with Action Button --}}
                                        <input
                                            type="{{ $row->type === 'integer' ? 'number' : 'text' }}"
                                            id="s-{{ $row->id }}"
                                            wire:model="drafts.{{ $row->id }}"
                                            class="min-w-0 flex-1 rounded-md border border-slate-300
                                                   bg-white px-3 py-1.5 text-xs text-slate-800
                                                   transition focus:border-transparent
                                                   focus:outline-none focus:ring-2
                                                   focus:ring-sky-500
                                                   dark:border-slate-700 dark:bg-slate-800
                                                   dark:text-slate-200"
                                        >

                                        <button
                                            wire:click="save({{ $row->id }})"
                                            wire:loading.attr="disabled"
                                            wire:target="save({{ $row->id }})"
                                            class="inline-flex items-center gap-1 rounded-md
                                                   bg-sky-600 px-3 py-1.5 text-xs font-semibold
                                                   text-white shadow-sm transition
                                                   hover:bg-sky-700 disabled:bg-sky-300
                                                   dark:bg-sky-500 dark:hover:bg-sky-600
                                                   dark:disabled:bg-sky-800"
                                        >
                                            <svg
                                                wire:loading
                                                wire:target="save({{ $row->id }})"
                                                class="h-3 w-3 animate-spin"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                            >
                                                <circle
                                                    class="opacity-25"
                                                    cx="12"
                                                    cy="12"
                                                    r="10"
                                                    stroke="currentColor"
                                                    stroke-width="4"
                                                ></circle>
                                                <path
                                                    class="opacity-75"
                                                    fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                                                ></path>
                                            </svg>

                                            <span>Simpan</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div
                    class="rounded-md border border-dashed border-slate-300 bg-white p-12
                           text-center dark:border-slate-700 dark:bg-slate-900"
                >
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Belum ada pengaturan tersimpan. Silakan jalankan database seeder.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
