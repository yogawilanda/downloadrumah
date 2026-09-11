{{-- resources/views/livewire/pages/estates/partials/agent-owner-edit.blade.php --}}
<div class="z-40 pointer-events-none">
    <div class="max-w-md mx-auto px-4 pointer-events-auto">
        <div
            class="bg-white/95 backdrop-blur-md border border-slate-200/80 p-3 rounded-md shadow-xl shadow-slate-900/10 flex items-center justify-between gap-3">

            {{-- Status & Label Info --}}
            <div class="min-w-0 pl-1">
                @php
                    $badgeStyle = match ($estate->publicity_status) {
                        'published' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                        'archived' => 'bg-rose-50 text-rose-700 border-rose-200/60',
                        default => 'bg-amber-50 text-amber-700 border-amber-200/60',
                    };
                @endphp

                <div class="flex items-center gap-2">
                    <span
                        class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider border {{ $badgeStyle }}">
                        {{ $estate->publicity_status }}
                    </span>
                </div>
                <p class="text-xs text-slate-500 font-semibold truncate mt-1">Listing milik Anda</p>
            </div>

            {{-- Action Button Edit --}}
            <a href="{{ route('estates.edit', $estate->slug) }}" wire:navigate
                class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-md transition shadow-sm shadow-blue-200 flex items-center gap-1.5 shrink-0 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Edit Listing</span>
            </a>

        </div>
    </div>
</div>
