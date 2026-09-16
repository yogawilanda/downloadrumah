{{-- resources/views/livewire/pages/estates/estate-listing.blade.php --}}

<div class="w-full max-w-md mx-auto px-4 pt-4 pb-32 space-y-5">

    {{-- Header --}}
    <div class="flex items-end justify-between gap-4 border-b border-slate-200 dark:border-slate-800 pb-4">
        <div>
            <span class="text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">
                Estate / Portfolio
            </span>
            <h1 class="mt-1 text-lg font-bold tracking-tight text-slate-950 dark:text-white">
                Listing Properti
            </h1>
            <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                Kelola seluruh portofolio listing Anda
            </p>
        </div>

        <a
            href="{{ route('estates.create') }}"
            wire:navigate
            class="flex h-9 items-center gap-1.5 border border-slate-950 bg-slate-950 px-3 text-[10px] font-bold uppercase tracking-wide text-white transition hover:bg-slate-800 dark:border-white dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
        >
            <span class="text-sm leading-none">+</span>
            Properti
        </a>
    </div>

    {{-- Success --}}
    @if (session('success'))
        <div class="border-l-2 border-slate-950 bg-slate-50 px-3 py-2.5 text-xs font-semibold text-slate-700 dark:border-white dark:bg-slate-900 dark:text-slate-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabs --}}
    <div class="grid grid-cols-2 border-b border-slate-200 dark:border-slate-800">
        <button
            wire:click="setTab('my_listings')"
            class="relative py-3 text-[10px] font-bold uppercase tracking-[0.08em] transition
                {{ $tab === 'my_listings'
                    ? 'text-slate-950 dark:text-white'
                    : 'text-slate-400 hover:text-slate-700 dark:text-slate-500 dark:hover:text-slate-300' }}"
        >
            Properti Saya

            @if ($tab === 'my_listings')
                <span class="absolute bottom-[-1px] left-0 right-0 h-0.5 bg-slate-950 dark:bg-white"></span>
            @endif
        </button>

        <button
            wire:click="setTab('co_broke')"
            class="relative py-3 text-[10px] font-bold uppercase tracking-[0.08em] transition
                {{ $tab === 'co_broke'
                    ? 'text-slate-950 dark:text-white'
                    : 'text-slate-400 hover:text-slate-700 dark:text-slate-500 dark:hover:text-slate-300' }}"
        >
            Co-Broke

            @if ($tab === 'co_broke')
                <span class="absolute bottom-[-1px] left-0 right-0 h-0.5 bg-slate-950 dark:bg-white"></span>
            @endif
        </button>
    </div>

    {{-- Listings --}}
    <div class="space-y-2">
        @forelse($estates as $estate)
            @php
                $publicityStyle = match ($estate->publicity_status) {
                    'published' => 'border-slate-950 text-slate-950 dark:border-white dark:text-white',
                    'archived' => 'border-red-300 text-red-600 dark:border-red-900 dark:text-red-400',
                    default => 'border-slate-300 text-slate-500 dark:border-slate-700 dark:text-slate-400',
                };

                $transStyle = match ($estate->transaction_status) {
                    'sold' => 'text-slate-500 dark:text-slate-400',
                    'rented' => 'text-slate-600 dark:text-slate-300',
                    default => 'text-slate-400 dark:text-slate-500',
                };
            @endphp

            <a
                href="{{ route('estates.show', $estate->slug) }}"
                wire:navigate
                wire:key="listing-estate-{{ $estate->id }}"
                class="group flex items-center gap-3 border border-slate-200 bg-white p-3 transition hover:border-slate-950 dark:border-slate-800 dark:bg-slate-900 dark:hover:border-white"
            >
                {{-- Thumbnail --}}
                <div class="relative h-16 w-16 shrink-0 overflow-hidden border border-slate-200 bg-slate-100 dark:border-slate-700 dark:bg-slate-950">
                    @if ($estate->primaryImage?->url)
                        <img
                            src="{{ $estate->primaryImage->url }}"
                            class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                            alt="{{ $estate->title }}"
                        >
                    @else
                        <div class="flex h-full w-full items-center justify-center text-[8px] font-bold uppercase tracking-wide text-slate-400">
                            No Image
                        </div>
                    @endif

                    <span class="absolute left-0 top-0 bg-slate-950 px-1.5 py-0.5 text-[7px] font-bold uppercase tracking-wide text-white dark:bg-white dark:text-slate-950">
                        {{ strtoupper($estate->property_type) }}
                    </span>
                </div>

                {{-- Details --}}
                <div class="min-w-0 flex-1">
                    <h3 class="truncate text-xs font-bold leading-snug text-slate-950 group-hover:underline dark:text-white">
                        {{ $estate->title }}
                    </h3>

                    <p class="mt-1 text-xs font-black text-slate-950 dark:text-white">
                        {{ $estate->short_price }}
                    </p>

                    <p class="mt-0.5 truncate text-[10px] text-slate-500 dark:text-slate-400">
                        {{ $estate->short_location_label }}
                    </p>

                    <div class="mt-1.5 flex items-center gap-2">
                        <span class="border px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide {{ $publicityStyle }}">
                            {{ $estate->publicity_status }}
                        </span>

                        @if ($estate->transaction_status !== 'available')
                            <span class="text-[8px] font-bold uppercase tracking-wide {{ $transStyle }}">
                                {{ $estate->transaction_status }}
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Arrow --}}
                <svg
                    class="h-3.5 w-3.5 shrink-0 text-slate-300 transition group-hover:translate-x-0.5 group-hover:text-slate-950 dark:text-slate-600 dark:group-hover:text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

        @empty
            <div class="border border-dashed border-slate-300 bg-slate-50 px-6 py-10 text-center dark:border-slate-700 dark:bg-slate-900">
                <div class="mx-auto mb-3 flex h-8 w-8 items-center justify-center bg-slate-950 text-xs text-white dark:bg-white dark:text-slate-950">
                    +
                </div>
                <p class="text-xs font-bold text-slate-900 dark:text-white">
                    Belum ada listing
                </p>
                <p class="mt-1 text-[10px] text-slate-400 dark:text-slate-500">
                    Tidak ada properti pada kategori ini saat ini.
                </p>
            </div>
        @endforelse

        <div class="pt-2">
            {{ $estates->links() }}
        </div>
    </div>
</div>
