{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/estates/estate-listing.blade.php
| @usage : Full Estate Listing View for Real Estate Agents (Tabbed & Accessible)
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}
<div class="w-full pb-32 pt-4 px-4 max-w-md mx-auto space-y-5">
    <!-- Header & Quick Action -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-base font-bold text-slate-800">Listing Properti Saya</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola seluruh portofolio listing Anda</p>
        </div>
        <a href="{{ route('estates.create') }}" wire:navigate
            class="px-3.5 py-2.5 bg-blue-600 text-white text-xs font-bold rounded-md active:scale-95 transition shadow-sm shadow-blue-200">
            + Properti
        </a>
    </div>

    @if (session('success'))
        <div class="p-3.5 bg-emerald-50/80 border border-emerald-200/60 text-emerald-700 text-xs rounded-md font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <!-- Navigation Tabs (Satu Baris Ringkas) -->
    <div class="flex bg-slate-100 p-1 rounded-md border border-slate-200/50">
        <button wire:click="setTab('my_listings')"
            class="flex-1 py-2 text-xs font-bold rounded-md transition {{ $tab === 'my_listings' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
            Properti Saya
        </button>
        <button wire:click="setTab('co_broke')"
            class="flex-1 py-2 text-xs font-bold rounded-md transition {{ $tab === 'co_broke' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
            Co-Broke
        </button>
    </div>

    <!-- List Items (Separated Card Pattern) -->
    <div class="space-y-3">
        @forelse($estates as $estate)
            <a href="{{ route('estates.show', $estate->slug) }}" wire:navigate
                wire:key="listing-estate-{{ $estate->id }}"
                class="p-3.5 bg-white rounded-md border border-slate-100 shadow-sm hover:border-blue-200 hover:shadow-md transition-all flex items-center justify-between gap-3.5 group cursor-pointer">

                <div class="flex items-center gap-3.5 min-w-0 flex-1">
                    <!-- Thumbnail Mini -->
                    <div class="w-16 h-16 rounded-md bg-slate-100 flex-shrink-0 overflow-hidden relative border border-slate-100">
                        @if ($estate->primaryImage?->url)
                            <img src="{{ $estate->primaryImage->url }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                alt="{{ $estate->title }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[10px] font-medium text-slate-400">
                                No Img
                            </div>
                        @endif
                    </div>

                    <!-- Details Info -->
                    <div class="min-w-0 flex-1 space-y-0.5">
                        <h3 class="text-sm font-bold text-slate-800 truncate group-hover:text-blue-600 transition leading-snug">
                            {{ $estate->title }}
                        </h3>

                        {{-- Price & Dual Badges --}}
                        <div class="flex items-center gap-1.5 flex-wrap pt-0.5">
                            <p class="text-xs font-black text-blue-600">{{ $estate->short_price }}</p>

                            @php
                                $publicityStyle = match ($estate->publicity_status) {
                                    'published' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                                    'archived' => 'bg-rose-50 text-rose-700 border-rose-200/60',
                                    default => 'bg-amber-50 text-amber-700 border-amber-200/60',
                                };

                                $transStyle = match ($estate->transaction_status) {
                                    'sold' => 'bg-slate-100 text-slate-600 border-slate-200',
                                    'rented' => 'bg-purple-50 text-purple-700 border-purple-200/60',
                                    default => 'bg-blue-50 text-blue-600 border-blue-200/60',
                                };
                            @endphp

                            <span class="px-1.5 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider border {{ $publicityStyle }}">
                                {{ $estate->publicity_status }}
                            </span>

                            @if($estate->transaction_status !== 'available')
                                <span class="px-1.5 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider border {{ $transStyle }}">
                                    {{ $estate->transaction_status }}
                                </span>
                            @endif
                        </div>

                        <p class="text-xs text-slate-500 font-medium truncate pt-0.5">
                            {{ $estate->short_location_label }}
                        </p>
                    </div>
                </div>

                <!-- Chevron Action -->
                <div class="flex items-center shrink-0 text-slate-300 group-hover:text-blue-600 group-hover:translate-x-0.5 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        @empty
            <div class="p-8 bg-white rounded-md border border-slate-100 text-center space-y-1">
                <p class="text-xs font-bold text-slate-700">Belum ada listing</p>
                <p class="text-[11px] text-slate-400">Tidak ada properti pada kategori ini saat ini.</p>
            </div>
        @endforelse

        <div class="pt-2">
            {{ $estates->links() }}
        </div>
    </div>
</div>
