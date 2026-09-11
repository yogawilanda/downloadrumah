{{-- loc: resources/views/livewire/pages/catalog/public-catalog.blade.php --}}
<div class="min-h-screen bg-slate-50 py-8 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header Profile & Brand Agen --}}
        <div
            class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-100 mb-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left">
                <div
                    class="w-20 h-20 rounded-full bg-slate-100 overflow-hidden shrink-0 border-2 border-slate-100 shadow-inner flex items-center justify-center">
                    @if ($agent->profile_photo_url)
                        <img src="{{ $agent->profile_photo_url }}" alt="{{ $agent->display_brand_name }}"
                            class="w-full h-full object-cover">
                    @else
                        <div
                            class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-600 font-bold text-2xl uppercase">
                            {{ substr($agent->display_brand_name, 0, 2) }}
                        </div>
                    @endif
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900">
                        {{ $agent->display_brand_name }}
                    </h1>
                    <p class="text-xs sm:text-sm font-medium text-slate-500 mt-0.5">
                        {{ $agent->title ?? 'Agen Properti Resmi' }}</p>
                </div>
            </div>

            {{-- CTA Kontak Agen --}}
            @if ($agent->phone_number)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->phone_number) }}" target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-bold text-xs sm:text-sm rounded-md transition-all shadow-sm w-full md:w-auto justify-center">
                    <x-icons.icons-chat-2 />
                    <span>Hubungi via WhatsApp</span>
                </a>
            @endif
        </div>

        {{-- Section Bar --}}
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-base sm:text-lg font-bold text-slate-900">Daftar Properti Pilihan</h2>
            <span class="text-xs font-bold text-slate-600 bg-slate-200/70 px-3 py-1 rounded-full">
                {{ $estates->total() }} Unit
            </span>
        </div>

        {{-- Grid Listing Properti Terisolasi --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @forelse($estates as $estate)
                <div
                    class="bg-white rounded-md border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition-all group flex flex-col justify-between">
                    <div>
                        <div class="aspect-video bg-slate-100 relative overflow-hidden">
                            <img src="{{ $estate->primaryImage?->url ?? 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=800&q=80' }}"
                                alt="{{ $estate->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

                            <span
                                class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-white text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-md tracking-wider">
                                {{ $estate->transaction_type_label }}
                            </span>
                        </div>

                        <div class="p-4 space-y-1">
                            <p class="text-base sm:text-lg font-extrabold text-blue-600">{{ $estate->short_price }}</p>
                            <h3 class="text-xs sm:text-sm font-bold text-slate-800 line-clamp-2 leading-snug">
                                {{ $estate->title }}
                            </h3>
                            <p class="text-[11px] font-medium text-slate-500 pt-1 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="truncate">{{ $estate->short_location_label }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="p-4 pt-2">
                        <a href="{{ route('catalog.detail', ['username' => $agent->username, 'estate' => $estate->slug]) }}"
                            class="block w-full text-center py-2 px-4 bg-slate-50 hover:bg-slate-100 border border-slate-200/80 text-slate-700 font-bold text-xs rounded-lg transition-colors active:scale-95">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-2xl p-12 text-center border border-slate-100 space-y-2">
                    <p class="text-sm font-bold text-slate-700">Belum Ada Properti</p>
                    <p class="text-xs font-medium text-slate-400">Agen ini belum mempublikasikan unit properti di
                        etalasenya.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($estates->hasPages())
            <div class="mt-8">
                {{ $estates->links() }}
            </div>
        @endif

    </div>
</div>
