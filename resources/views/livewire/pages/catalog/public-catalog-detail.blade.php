{{-- resources/views/livewire/pages/catalog/public-catalog-detail.blade.php --}}

@php
    $defaultWa = $agent->phone_number
        ? preg_replace('/[^0-9]/', '', $agent->phone_number)
        : '';

    $isOwner = auth()->check() && auth()->id() === $agent->id;
@endphp

<div class="relative min-h-screen bg-slate-50 dark:bg-slate-950 pb-28 lg:pb-12 font-sans antialiased">

    {{-- Catalog Header --}}
    <header class="sticky top-0 z-30 border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-950">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3 sm:px-6">
            <a
                href="{{ route('catalog.show', $agent->display_username) }}"
                class="flex min-w-0 items-center gap-2 text-[10px] font-bold uppercase tracking-wide text-slate-500 transition hover:text-slate-950 dark:text-slate-400 dark:hover:text-white"
            >
                <svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>

                <span class="truncate">
                    Katalog {{ $agent->display_brand_name }}
                </span>
            </a>

            <span class="shrink-0 border border-slate-200 px-2 py-1 text-[8px] font-bold uppercase tracking-[0.12em] text-slate-500 dark:border-slate-700 dark:text-slate-400">
                Etalase Resmi
            </span>
        </div>
    </header>

    <div class="mx-auto max-w-6xl px-0 sm:px-4 md:px-6 lg:px-8 pt-0 sm:pt-6">
        <div class="grid grid-cols-1 items-start gap-5 lg:grid-cols-12 lg:gap-6">

            {{-- Property --}}
            <main class="lg:col-span-8">
                <div class="overflow-hidden border-x border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900 sm:border">

                    {{-- Hero Image --}}
                    <div class="relative aspect-video w-full overflow-hidden bg-slate-950">
                        <img
                            src="{{ $estate->primaryImage?->url ?? 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=800&q=80' }}"
                            alt="{{ $estate->title }}"
                            class="h-full w-full object-cover"
                        >

                        <div class="absolute left-3 top-3 bg-slate-950 px-2 py-1 text-[8px] font-bold uppercase tracking-[0.12em] text-white">
                            {{ $estate->transaction_type === 'sale' ? 'Dijual' : 'Disewa' }}
                        </div>

                        <div class="absolute bottom-3 right-3 bg-slate-950/80 px-2 py-1 text-[8px] font-bold uppercase tracking-[0.12em] text-white">
                            {{ strtoupper($estate->property_type) }}
                        </div>
                    </div>

                    {{-- Summary --}}
                    <div class="space-y-6 bg-white p-4 dark:bg-slate-900 sm:p-6 lg:p-8">

                        <div class="space-y-3">
                            <a
                                href="{{ $this->kprUrl }}"
                                wire:navigate
                                class="inline-flex items-center gap-2 border border-slate-200 px-3 py-2 text-[9px] font-bold uppercase tracking-wide text-slate-700 transition hover:border-slate-950 hover:text-slate-950 dark:border-slate-700 dark:text-slate-300 dark:hover:border-white dark:hover:text-white"
                            >
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                Simulasi Cicilan KPR
                            </a>

                            <div>
                                <p class="text-xl font-extrabold tracking-tight text-slate-950 dark:text-white sm:text-2xl">
                                    {{ $estate->formatted_price }}
                                </p>

                                <h1 class="mt-1 text-base font-bold leading-snug text-slate-950 dark:text-white sm:text-lg">
                                    {{ $estate->title }}
                                </h1>

                                <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400">
                                    {{ $estate->short_location_label }}
                                </p>
                            </div>
                        </div>

                        {{-- Specifications --}}
                        <div class="grid grid-cols-4 border-y border-slate-200 dark:border-slate-800">
                            @foreach ([['Kamar', $estate->bedroom, 'KT'], ['Mandi', $estate->bathroom, 'KM'], ['Luas Bgn', $estate->building_size, 'm²'], ['Luas Tnh', $estate->land_size, 'm²']] as $index => [$label, $value, $unit])
                                <div class="px-2 py-3 text-center {{ $index > 0 ? 'border-l border-slate-200 dark:border-slate-800' : '' }}">
                                    <span class="block text-[8px] font-bold uppercase tracking-wide text-slate-400 dark:text-slate-500">
                                        {{ $label }}
                                    </span>

                                    <span class="mt-1 block text-[11px] font-bold text-slate-950 dark:text-white sm:text-xs">
                                        {{ $value ?? '-' }} {{ $unit }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        {{-- Description --}}
                        <div class="space-y-2 border-t border-slate-200 pt-4 dark:border-slate-800">
                            <h2 class="text-[9px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                                Deskripsi Properti
                            </h2>

                            <p class="whitespace-pre-line text-xs leading-relaxed text-slate-600 dark:text-slate-400 sm:text-sm">
                                {{ $estate->description }}
                            </p>
                        </div>

                    </div>
                </div>
            </main>

            {{-- Agent Panel --}}
            <aside class="lg:col-span-4 lg:sticky lg:top-20">
                <div class="hidden border border-slate-200 bg-white p-5 dark:border-slate-800 dark:bg-slate-900 lg:block">

                    <div class="flex items-center gap-3 border-b border-slate-200 pb-4 dark:border-slate-800">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center bg-slate-950 text-xs font-bold uppercase text-white dark:bg-white dark:text-slate-950">
                            {{ substr($agent->display_brand_name, 0, 2) }}
                        </div>

                        <div class="min-w-0">
                            <span class="block text-[8px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                                Dikelola Oleh
                            </span>

                            <h2 class="truncate text-xs font-bold text-slate-950 dark:text-white">
                                {{ $agent->display_brand_name }}
                            </h2>

                            <p class="text-[10px] text-slate-500 dark:text-slate-400">
                                Agen Resmi
                            </p>
                        </div>
                    </div>

                    @if ($defaultWa)
                        <a
                            href="https://wa.me/{{ $defaultWa }}?text={{ urlencode('Halo ' . $agent->display_brand_name . ', saya tertarik dengan properti: ' . $estate->title) }}"
                            target="_blank"
                            class="mt-5 flex min-h-11 w-full items-center justify-center border border-slate-950 bg-slate-950 px-3 text-[10px] font-bold uppercase tracking-wide text-white transition hover:bg-slate-800 dark:border-white dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
                        >
                            Hubungi Agen via WhatsApp
                        </a>
                    @endif
                </div>
            </aside>

        </div>
    </div>

    {{-- Mobile CTA --}}
    @if ($defaultWa)
        <div class="fixed bottom-0 left-0 right-0 z-40 border-t border-slate-200 bg-white px-3 py-3 dark:border-slate-800 dark:bg-slate-950 lg:hidden">
            <div class="mx-auto max-w-md">
                <a
                    href="https://wa.me/{{ $defaultWa }}?text={{ urlencode('Halo ' . $agent->display_brand_name . ', saya tertarik dengan properti: ' . $estate->title) }}"
                    target="_blank"
                    class="flex min-h-11 w-full items-center justify-center border border-slate-950 bg-slate-950 px-3 text-[10px] font-bold uppercase tracking-wide text-white dark:border-white dark:bg-white dark:text-slate-950"
                >
                    Hubungi {{ $agent->display_brand_name }} via WA
                </a>
            </div>
        </div>
    @endif

</div>
