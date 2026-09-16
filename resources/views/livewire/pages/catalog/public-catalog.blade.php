{{-- loc: resources/views/livewire/pages/catalog/public-catalog.blade.php --}}

<div class="min-h-screen bg-slate-50 dark:bg-slate-950 py-6 pb-24 sm:py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Agent Identity --}}
        <header class="mb-8 border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
            <div class="flex flex-col gap-5 p-5 sm:p-6 md:flex-row md:items-center md:justify-between">

                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 shrink-0 overflow-hidden border border-slate-200 bg-slate-100 dark:border-slate-700 dark:bg-slate-950">
                        @if ($agent->profile_photo_url)
                            <img
                                src="{{ $agent->profile_photo_url }}"
                                alt="{{ $agent->display_brand_name }}"
                                class="h-full w-full object-cover"
                            >
                        @else
                            <div class="flex h-full w-full items-center justify-center bg-slate-950 text-sm font-bold uppercase text-white dark:bg-white dark:text-slate-950">
                                {{ substr($agent->display_brand_name, 0, 2) }}
                            </div>
                        @endif
                    </div>

                    <div class="min-w-0">
                        <span class="block text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">
                            Katalog / Agen
                        </span>

                        <h1 class="mt-1 truncate text-lg font-bold tracking-tight text-slate-950 dark:text-white sm:text-xl">
                            {{ $agent->display_brand_name }}
                        </h1>

                        <p class="mt-0.5 text-[10px] text-slate-500 dark:text-slate-400 sm:text-xs">
                            {{ $agent->title ?? 'Agen Properti Resmi' }}
                        </p>
                    </div>
                </div>

                @if ($agent->phone_number)
                    <a
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->phone_number) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex min-h-10 w-full items-center justify-center gap-2 border border-slate-950 bg-slate-950 px-5 text-[10px] font-bold uppercase tracking-wide text-white transition hover:bg-slate-800 dark:border-white dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200 md:w-auto"
                    >
                        <x-icons.icons-chat-2 />
                        Hubungi via WhatsApp
                    </a>
                @endif
            </div>
        </header>

        {{-- Listing Header --}}
        <div class="mb-5 flex items-end justify-between gap-4 border-b border-slate-200 pb-3 dark:border-slate-800">
            <div>
                <span class="block text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">
                    Property Inventory
                </span>

                <h2 class="mt-1 text-base font-bold text-slate-950 dark:text-white sm:text-lg">
                    Properti Pilihan
                </h2>
            </div>

            <span class="text-[9px] font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                {{ $estates->total() }} Unit
            </span>
        </div>

        {{-- Property Grid --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($estates as $estate)
                <article class="group overflow-hidden border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">

                    {{-- Image --}}
                    <a
                        href="{{ route('catalog.detail', ['username' => $agent->username, 'estate' => $estate->slug]) }}"
                        class="block"
                    >
                        <div class="relative aspect-video overflow-hidden bg-slate-950">
                            <img
                                src="{{ $estate->primaryImage?->url ?? 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=800&q=80' }}"
                                alt="{{ $estate->title }}"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                            >

                            <span class="absolute left-3 top-3 bg-slate-950 px-2 py-1 text-[8px] font-bold uppercase tracking-[0.12em] text-white">
                                {{ $estate->transaction_type_label }}
                            </span>

                            <span class="absolute bottom-3 right-3 bg-slate-950/80 px-2 py-1 text-[8px] font-bold uppercase tracking-wide text-white">
                                {{ strtoupper($estate->property_type) }}
                            </span>
                        </div>
                    </a>

                    {{-- Property Info --}}
                    <div class="p-4">
                        <p class="text-sm font-extrabold tracking-tight text-slate-950 dark:text-white sm:text-base">
                            {{ $estate->short_price }}
                        </p>

                        <h3 class="mt-1 line-clamp-2 text-xs font-bold leading-snug text-slate-800 dark:text-slate-200">
                            {{ $estate->title }}
                        </h3>

                        <p class="mt-2 flex items-center gap-1.5 truncate text-[10px] text-slate-500 dark:text-slate-400">
                            <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $estate->short_location_label }}
                        </p>

                        <a
                            href="{{ route('catalog.detail', ['username' => $agent->username, 'estate' => $estate->slug]) }}"
                            class="mt-4 flex min-h-9 w-full items-center justify-center border border-slate-200 text-[9px] font-bold uppercase tracking-[0.08em] text-slate-700 transition hover:border-slate-950 hover:bg-slate-950 hover:text-white dark:border-slate-700 dark:text-slate-300 dark:hover:border-white dark:hover:bg-white dark:hover:text-slate-950"
                        >
                            Lihat Detail
                        </a>
                    </div>
                </article>

            @empty
                <div class="col-span-full border border-dashed border-slate-300 bg-white px-6 py-12 text-center dark:border-slate-700 dark:bg-slate-900">
                    <div class="mx-auto mb-3 flex h-8 w-8 items-center justify-center bg-slate-950 text-xs text-white dark:bg-white dark:text-slate-950">
                        —
                    </div>

                    <p class="text-xs font-bold text-slate-900 dark:text-white">
                        Belum Ada Properti
                    </p>

                    <p class="mt-1 text-[10px] text-slate-400 dark:text-slate-500">
                        Agen ini belum mempublikasikan unit properti di etalasenya.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($estates->hasPages())
            <div class="mt-6">
                {{ $estates->links() }}
            </div>
        @endif

    </div>
</div>
