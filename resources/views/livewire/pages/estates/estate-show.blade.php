{{-- loc: resources/views/livewire/pages/estates/estate-show.blade.php --}}
{{-- usage: view untuk modul estate (dimata user ini namanya listing, namun tetap gunakan nama estate untuk membuat
penamaan tidak ambigu) --}}
@php
    $defaultWa = $estate->user->phone_number ?? '';
@endphp

<div x-data="{
    shareModal: false,
    waModal: false,
    toastModal: false,
    shareTargetNumber: '{{ $defaultWa }}',
    activeSlide: 0
}" class="max-w-md mx-auto min-h-screen bg-white pb-24 relative font-sans antialiased">

    <x-layouts.estate.top-nav :estate="$estate" />

    <!-- Image Carousel / Gallery Hero -->
    <div class="relative h-80 w-full bg-slate-900 overflow-hidden shrink-0">
        <div class="h-full w-full flex overflow-x-auto snap-x snap-mandatory [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden"
            @scroll.debounce.100ms="activeSlide = Math.round($el.scrollLeft / $el.clientWidth)">
            @forelse($estate->attachments as $index => $attachment)
                <div class="w-full h-full flex-shrink-0 snap-center">
                    <img src="{{ $attachment->url }}" alt="{{ $estate->title }}" class="w-full h-full object-cover">
                </div>
            @empty
                <div class="w-full h-full flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=800&q=80"
                        class="w-full h-full object-cover">
                </div>
            @endforelse
        </div>


        <!-- Image Counter Indicator (M3 Style) -->
        @if(count($estate->attachments) > 1)
            <div
                class="absolute bottom-10 right-4 px-3 py-1 rounded-full bg-slate-900/60 backdrop-blur-md text-white text-[11px] font-medium z-10">
                <span x-text="activeSlide + 1"></span> / {{ count($estate->attachments) }}
            </div>
        @endif
    </div>

    <!-- Content Body (M3 Bottom Sheet Surface) -->
    <div class="p-5 bg-white rounded-t-[32px] -mt-6 relative z-10 space-y-5">

        <!-- Drag Handle Indicator -->
        <div class="w-10 h-1 bg-slate-200 rounded-full mx-auto -mt-1 mb-1"></div>



        <!-- Price & Title -->
        <div>
            <div class="flex items-center justify-between mb-1">
                {{-- price --}}
                <h1 class="text-2xl font-black text-indigo-600 tracking-tight">{{ $estate->formatted_price }}</h1>

                <!-- M3 Transaction Type Chip -->
                <span
                    class="inline-flex items-center justify-center px-3 py-1 text-[11px] font-bold tracking-wider uppercase rounded-full text-white shadow-sm {{ $estate->transaction_type === 'sale' ? 'bg-emerald-600' : 'bg-amber-600' }}">
                    {{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}
                </span>
            </div>

            <h2 class="text-base font-bold text-slate-900 leading-snug">{{ $estate->title }}</h2>
            <p class="text-xs text-slate-500 mt-1.5 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                </svg>
                <span>{{ $estate->address ?? ($estate->city . ', ' . $estate->district) }}</span>
            </p>
        </div>

        <!-- Spec Quick Grid (M3 Container Style) -->
        <div class="grid grid-cols-4 gap-2 py-3 px-2 bg-slate-50 rounded-2xl text-center border border-slate-100">
            <div class="space-y-0.5">
                <span class="block text-[11px] font-medium text-slate-400">Kamar</span>
                <span class="font-bold text-xs text-slate-800">{{ $estate->bedroom ?? '-' }} KT</span>
            </div>
            <div class="space-y-0.5 border-l border-slate-200/60">
                <span class="block text-[11px] font-medium text-slate-400">Mandi</span>
                <span class="font-bold text-xs text-slate-800">{{ $estate->bathroom ?? '-' }} KM</span>
            </div>
            <div class="space-y-0.5 border-l border-slate-200/60">
                <span class="block text-[11px] font-medium text-slate-400">Luas Bgn</span>
                <span class="font-bold text-xs text-slate-800">{{ $estate->building_size ?? '-' }} m²</span>
            </div>
            <div class="space-y-0.5 border-l border-slate-200/60">
                <span class="block text-[11px] font-medium text-slate-400">Luas Tnh</span>
                <span class="font-bold text-xs text-slate-800">{{ $estate->land_size ?? '-' }} m²</span>
            </div>
        </div>

        <!-- Description -->
        <div class="space-y-1.5">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Deskripsi Properti</h3>
            <p class="text-xs text-slate-600 leading-relaxed whitespace-pre-line font-normal">{{ $estate->description }}
            </p>
        </div>

        <!-- Additional Attributes (M3 Chips) -->
        @if(!empty($estate->attributes))
            <div class="space-y-2">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Informasi Tambahan</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($estate->attributes as $key => $value)
                        @if($value)
                            <span
                                class="px-3 py-1.5 bg-indigo-50/70 text-indigo-700 border border-indigo-100/80 text-xs font-semibold rounded-full flex items-center gap-1">
                                <span class="capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                <span>{{ $value }}</span>
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Agent Info & Action Box -->
        <div class="p-4 border border-slate-200/60 rounded-3xl bg-slate-50/70 space-y-4">
            <div class="flex items-center space-x-3">
                {{-- TODO IMPROVEMENT: Icon User Harusnya pakai gambar--}}
                <div
                    class="w-11 h-11 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-sm shadow-sm shrink-0">
                    {{ substr($estate->user->name ?? 'Unknown', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-slate-900 truncate">{{ $estate->user->name ?? 'Agen' }}</p>

                    {{-- TODO BACKEND IMPROVEMENT: BELUM MEMILIKI KOLOM DATABASE UNTUK TITLE/JABATAN USER --}}
                    <p class="text-[11px] text-slate-500">
                        {{ $estate->user->user_title ?? "Pemilik Listing / Agen" }}
                    </p>
                </div>
            </div>

            @php
                $agentName = $estate->user->name ?? 'Agen';
                $waMessage = rawurlencode("Halo {$agentName}, saya tertarik dengan properti '{$estate->title}' di
                            DownloadRumah: " . url()->current());
                $waNumber = preg_replace('/[^0-9]/', '', $estate->user->phone_number ?? '6281259990179');
            @endphp

            <!-- Single Primary Action (Future-proof for Co-Broker grid later) -->
            <div class="grid grid-cols-2 gap-2.5">
                <!-- Tombol Utama: WhatsApp -->
                <a href="https://wa.me/{{ $waNumber ?? "" }}?text={{ $waMessage ?? "" }}" target="_blank"
                    class="h-11 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] text-white font-semibold rounded-full flex items-center justify-center space-x-2 shadow-sm shadow-emerald-600/20 transition-all text-xs">
                    <x-icons.icons-chat class="w-4 h-4 fill-current" />
                    <span>Hubungi WA</span>
                </a>

                <!-- Slot Future: Co-Broker / Aksi Lain -->
                <button type="button" disabled
                    class="h-11 bg-slate-100 text-slate-400 border border-slate-200 font-semibold rounded-full flex items-center justify-center space-x-1.5 text-xs cursor-not-allowed">
                    <svg class="w-4 h-4 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Co-Broker (Segera)</span>
                </button>
            </div>
        </div>

    </div>
</div>
