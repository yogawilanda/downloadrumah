<div x-data="{ shareModal: false, waModal: false, toastModal: false, shareTargetNumber: '' }" class="max-w-md mx-auto min-h-screen bg-gray-50 pb-24 relative">

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
                <svg class="w-4 h-4 mr-1 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

        <!-- Agent Info & Action Box -->
        <div class="p-4 border border-gray-100 rounded-2xl bg-gray-50/50 space-y-3">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-sm">
                    {{ substr($estate->user->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-gray-900 truncate">{{ $estate->user->name ?? 'Agen' }}</p>
                    <p class="text-[10px] text-gray-500">Pemilik Listing / Agen</p>
                </div>
            </div>

            @php
                $agentName = $estate->user->name ?? 'Agen';
                $waMessage = rawurlencode("Halo {$agentName}, saya tertarik dengan properti '{$estate->title}' di DownloadRumah: " . url()->current());
                $waNumber = preg_replace('/[^0-9]/', '', $estate->user->phone_number ?? '6281259990179');
            @endphp

            <!-- Inline Action Buttons -->
            <div class="grid grid-cols-2 gap-2 pt-1">
                <a href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}"
                   target="_blank"
                   class="bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-bold py-2.5 px-3 rounded-xl flex items-center justify-center space-x-1.5 shadow-sm transition-all duration-200 text-xs">
                    <x-icons.icons-chat class="w-4 h-4 fill-current"/>
                    <span>Hubungi WA</span>
                </a>

                <button @click="shareModal = true"
                        type="button"
                        class="bg-gray-200 hover:bg-gray-300 active:scale-95 text-gray-700 font-bold py-2.5 px-3 rounded-xl flex items-center justify-center space-x-1.5 transition-all duration-200 text-xs">
                    <svg class="w-4 h-4 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                    </svg>
                    <span>Bagikan</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal 1: Opsi Bagikan -->
    <div x-show="shareModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-end sm:items-center justify-center bg-black/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <div @click.away="shareModal = false" class="bg-white w-full max-w-md rounded-t-3xl sm:rounded-2xl p-5 space-y-4">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="font-bold text-gray-900 text-sm">Bagikan Properti Ini</h3>
                <button @click="shareModal = false" class="text-gray-400 hover:text-gray-600 text-lg">&times;</button>
            </div>

            <div class="space-y-2">
                <!-- Option 1: Copy Link -->
                <button @click="
                            navigator.clipboard.writeText('{{ url()->current() }}');
                            shareModal = false;
                            toastModal = true;
                            setTimeout(() => toastModal = false, 2000);
                        "
                        class="w-full text-left p-3 border border-gray-100 rounded-xl hover:bg-gray-50 flex items-center space-x-3 transition">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-700">1. Salin Link Properti</span>
                </button>

                <!-- Option 2: Forward ke WA Lain -->
                <button @click="shareModal = false; waModal = true;"
                        class="w-full text-left p-3 border border-gray-100 rounded-xl hover:bg-gray-50 flex items-center space-x-3 transition">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <x-icons.icons-chat class="w-4 h-4 fill-current"/>
                    </div>
                    <span class="text-xs font-semibold text-gray-700">2. Bagikan ke Nomor WhatsApp Lain</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal 2: Input Nomor WA Tujuan -->
    <div x-show="waModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-end sm:items-center justify-center bg-black/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <div @click.away="waModal = false" class="bg-white w-full max-w-md rounded-t-3xl sm:rounded-2xl p-5 space-y-4">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="font-bold text-gray-900 text-sm">Kirim via WhatsApp</h3>
                <button @click="waModal = false" class="text-gray-400 hover:text-gray-600 text-lg">&times;</button>
            </div>

            <div class="space-y-3">
                <label class="block text-xs font-medium text-gray-600">Masukkan Nomor WhatsApp Tujuan:</label>
                <input type="number"
                       x-model="shareTargetNumber"
                       placeholder="Contoh: 08123456789"
                       class="w-full text-xs p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500">

                @php
                    $shareText = rawurlencode("Lihat properti '{$estate->title}' di DownloadRumah ini: " . url()->current());
                @endphp

                <button @click="
                    let num = shareTargetNumber.replace(/[^0-9]/g, '');
                    if(num.startsWith('0')) num = '62' + num.slice(1);
                    if(!num) { alert('Masukkan nomor WA yang valid'); return; }
                    window.open('https://wa.me/' + num + '?text={{ $shareText }}', '_blank');
                    waModal = false;
                "
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 rounded-xl text-xs flex items-center justify-center space-x-1 transition">
                    <span>Kirim Sekarang</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal 3: Toast Notifikasi Link Berhasil Disalin -->
    <div x-show="toastModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/30 backdrop-blur-xs"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90">

        <div class="bg-gray-900/90 text-white px-5 py-3.5 rounded-2xl shadow-xl flex items-center space-x-2.5 max-w-xs border border-gray-700">
            <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="text-xs font-medium">Link properti berhasil disalin!</span>
        </div>
    </div>

</div>
