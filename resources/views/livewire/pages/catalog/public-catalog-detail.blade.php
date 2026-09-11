{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/catalog/public-catalog-detail.blade.php
| @usage      : Isolated Responsive View for Estate Detail under Agent Brand
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@php($defaultWa = $agent->phone_number ? preg_replace('/[^0-9]/', '', $agent->phone_number) : '')
@php($isOwner = auth()->check() && auth()->id() === $agent->id)

<div class="min-h-screen bg-slate-50/50 pb-28 lg:pb-12 relative font-sans antialiased">

    {{-- Top Bar Terisolasi (Locked ke Katalog Agen) --}}
    <div class="bg-white border-b border-slate-200/80 sticky top-0 z-30 px-4 py-3 sm:px-6">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <a href="{{ route('catalog.show', $agent->display_username) }}"
                class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-slate-900 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span>Kembali ke Katalog {{ $agent->display_brand_name }}</span>
            </a>

            <span class="text-[11px] font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-md">
                Etalase Resmi
            </span>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-0 sm:px-4 md:px-6 lg:px-8 pt-0 sm:pt-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">

            {{-- KOLOM KIRI (Gallery & Main Content) --}}
            <div
                class="lg:col-span-8 bg-white sm:rounded-md sm:border sm:border-slate-200/80 sm:shadow-sm overflow-hidden">

                {{-- Single / Primary Image Showcase --}}
                <div class="aspect-video w-full bg-slate-100 relative overflow-hidden">
                    <img src="{{ $estate->primaryImage?->url ?? 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=800&q=80' }}"
                        alt="{{ $estate->title }}" class="w-full h-full object-cover">

                    <span
                        class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-white text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-md tracking-wider">
                        {{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}
                    </span>
                </div>

                {{-- Summary Info --}}
                <div class="p-4 sm:p-6 lg:p-8 bg-white space-y-6">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between gap-3">
                            <a href="{{ $this->kprUrl }}" wire:navigate
                                class="inline-flex items-center gap-2 px-3.5 py-2 bg-blue-50 text-blue-600 font-bold text-xs rounded-md hover:bg-blue-100 transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>Simulasi Cicilan KPR</span>
                            </a>
                        </div>

                        <div>
                            <h1 class="text-2xl sm:text-3xl font-black text-blue-600 tracking-tight mb-1">
                                {{ $estate->formatted_price }}</h1>
                            <h2 class="text-base sm:text-lg font-bold text-slate-900 leading-snug">{{ $estate->title }}
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1.5 flex items-center gap-1.5">
                                <span>{{ $estate->short_location_label }}</span>
                            </p>
                        </div>
                    </div>

                    {{-- Specs Grid (4 Columns) --}}
                    <div
                        class="grid grid-cols-4 gap-2 sm:gap-4 py-3.5 px-3 bg-slate-50 rounded-lg text-center ">
                        @foreach ([['Kamar', $estate->bedroom, 'KT'], ['Mandi', $estate->bathroom, 'KM'], ['Luas Bgn', $estate->building_size, 'm²'], ['Luas Tnh', $estate->land_size, 'm²']] as $index => [$label, $value, $unit])
                            <div class="space-y-0.5 {{ $index > 0 ? 'border-l border-slate-200/60' : '' }}">
                                <span
                                    class="block text-[10px] sm:text-xs font-semibold text-slate-400 uppercase tracking-wider">{{ $label }}</span>
                                <span class="font-bold text-xs sm:text-sm text-slate-800">{{ $value ?? '-' }}
                                    {{ $unit }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Description --}}
                    <div class="space-y-2 pt-2 border-t border-slate-100">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Deskripsi Properti</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line font-normal">
                            {{ $estate->description }}</p>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN (Desktop Sticky Sidebar Kontak Agen) --}}
            <div class="lg:col-span-4 lg:sticky lg:top-22">
                <div class="hidden lg:block bg-white p-6 rounded-md   space-y-5">
                    <div class="pb-4 border-b border-slate-100 flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 font-bold flex items-center justify-center shrink-0 border border-slate-100">
                            {{ substr($agent->display_brand_name, 0, 2) }}
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Dikelola
                                Oleh</span>
                            <h3 class="text-sm font-bold text-slate-800">{{ $agent->display_brand_name }}</h3>
                            <p class="text-xs text-slate-500">Agen Resmi</p>
                        </div>
                    </div>

                    @if ($defaultWa)
                        <a href="https://wa.me/{{ $defaultWa }}?text={{ urlencode('Halo ' . $agent->display_brand_name . ', saya tertarik dengan properti: ' . $estate->title) }}"
                            target="_blank"
                            class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-lg transition text-center flex items-center justify-center gap-2 shadow-sm">
                            <span>Hubungi Agen via WhatsApp</span>
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- Mobile WA CTA --}}
    @if ($defaultWa)
        <div class="lg:hidden z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/80 p-3">
            <div class="max-w-md mx-auto">
                <a href="https://wa.me/{{ $defaultWa }}?text={{ urlencode('Halo ' . $agent->display_brand_name . ', saya tertarik dengan properti: ' . $estate->title) }}"
                    target="_blank"
                    class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-lg transition text-center flex items-center justify-center gap-2 shadow-sm">
                    <span>Hubungi {{ $agent->display_brand_name }} via WA</span>
                </a>
            </div>
        </div>
    @endif

</div>
