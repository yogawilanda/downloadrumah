<div class="max-w-md mx-auto min-h-screen bg-gray-50 pb-24 relative">
    <!-- Top Bar Navigation (Fixed) -->
    <div class="fixed top-0 left-0 right-0 z-40 max-w-md mx-auto px-4 py-3 flex items-center justify-between pointer-events-none">
        <a href="{{ route('home') }}" wire:navigate class="p-2 rounded-full bg-white/80 backdrop-blur-md shadow-md text-gray-700 pointer-events-auto">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
    </div>

    <!-- Image Carousel / Gallery Hero -->
    <div class="relative h-72 w-full bg-gray-900 overflow-x-auto flex snap-x snap-mandatory [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
        @forelse($estate->attachments as $attachment)
            <div class="w-full h-full flex-shrink-0 snap-center">
                <img src="{{ $attachment->url }}" alt="{{ $estate->title }}" class="w-full h-full object-cover">
            </div>
        @empty
            <div class="w-full h-full flex-shrink-0">
                <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover">
            </div>
        @endforelse

        <span class="absolute bottom-3 left-3 px-2.5 py-1 text-[10px] font-bold tracking-wide uppercase rounded-lg text-white backdrop-blur-md {{ $estate->transaction_type === 'sale' ? 'bg-emerald-600/90' : 'bg-amber-600/90' }}">
            {{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}
        </span>
    </div>

    <!-- Content Body -->
    <div class="p-4 bg-white rounded-t-3xl -mt-5 relative z-10 space-y-5">
        <!-- Price & Title -->
        <div>
            <h1 class="text-2xl font-extrabold text-indigo-600 mb-1">{{ $estate->formatted_price }}</h1>
            <h2 class="text-lg font-bold text-gray-900 leading-snug">{{ $estate->title }}</h2>
            <p class="text-xs text-gray-500 mt-1 flex items-center">
                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                {{ $estate->address ?? ($estate->city . ', ' . $estate->district) }}
            </p>
        </div>

        <!-- Spec Quick Grid -->
        <div class="grid grid-cols-4 gap-2 py-3 px-4 bg-gray-50 rounded-2xl text-center border border-gray-100">
            <div>
                <span class="block text-xs text-gray-400">Kamar</span>
                <span class="font-bold text-sm text-gray-800">{{ $estate->bedroom ?? '-' }} KT</span>
            </div>
            <div>
                <span class="block text-xs text-gray-400">Mandi</span>
                <span class="font-bold text-sm text-gray-800">{{ $estate->bathroom ?? '-' }} KM</span>
            </div>
            <div>
                <span class="block text-xs text-gray-400">Luas Bangunan</span>
                <span class="font-bold text-sm text-gray-800">{{ $estate->building_size ?? '-' }} m²</span>
            </div>
            <div>
                <span class="block text-xs text-gray-400">Luas Tanah</span>
                <span class="font-bold text-sm text-gray-800">{{ $estate->land_size ?? '-' }} m²</span>
            </div>
        </div>

        <!-- Description -->
        <div>
            <h3 class="text-sm font-bold text-gray-900 mb-2">Deskripsi Properti</h3>
            <p class="text-xs text-gray-600 leading-relaxed whitespace-pre-line">{{ $estate->description }}</p>
        </div>

        <!-- Additional JSON Attributes -->
        @if(!empty($estate->attributes))
            <div>
                <h3 class="text-sm font-bold text-gray-900 mb-2">Informasi Tambahan</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($estate->attributes as $key => $value)
                        @if($value)
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-medium rounded-xl">
                                {{ ucfirst($key) }}: {{ $value }}
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Agent Info Box -->
        <div class="flex items-center space-x-3 p-3 border border-gray-100 rounded-2xl bg-gray-50/50">
            <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-sm">
                {{ substr($estate->user->name ?? 'A', 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-bold text-gray-900 truncate">{{ $estate->user->name ?? 'Agen' }}</p>
                <p class="text-[10px] text-gray-500">Agen Resmi DownloadRumah</p>
            </div>
        </div>
    </div>

    <!-- Floating Bottom Action Bar (WhatsApp CTA) -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 p-3 max-w-md mx-auto z-40 shadow-lg">
        @php
            $agentName = $estate->user->name ?? 'Agen';
            $waMessage = rawurlencode("Halo {$agentName}, saya tertarik dengan properti '{$estate->title}' di DownloadRumah: " . url()->current());
            $waNumber = preg_replace('/[^0-9]/', '', $estate->user->phone_number ?? '6281259990179');
        @endphp
        <a href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}" target="_blank" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center space-x-2 shadow-md transition-colors">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
            </svg>
            <span class="text-sm">Hubungi Agen via WhatsApp</span>
        </a>
    </div>
</div>
