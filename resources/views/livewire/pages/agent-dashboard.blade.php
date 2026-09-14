{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/agent-dashboard.blade.php
| @usage            : Main Responsive Dashboard View for Real Estate Agents
| @type             : Livewire Page View
| @expected_data    : [$listingCount, $publishedListingCount, $estates]
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Dashboard prioritizes listing management and current property status.
| @ruling_ui        : Hard borders, restrained geometry, no decorative card shadows or rounded cards.
| @ruling_motion    : Short 150–200ms transitions only.
| @ruling_performance : Preserve existing Livewire navigation and lazy image loading.
|
| @status            : Active
| @author            : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div class="mx-auto w-full max-w-6xl space-y-8 px-4 pb-32 pt-6 sm:px-6 lg:px-8 lg:pt-8">

    {{-- Header --}}
    <header class="border-b border-slate-300 pb-6">

        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <div class="mb-3 flex items-center gap-2">
                    <span class="h-1.5 w-1.5 bg-sky-500"></span>

                    <span class="text-[10px] font-semibold uppercase tracking-[0.16em] text-slate-400">
                        Ruang kerja properti
                    </span>
                </div>

                <h1 class="text-xl font-bold tracking-tight text-slate-950 sm:text-2xl">
                    Halo, {{ auth()->user()->name }}
                </h1>

                <p class="mt-1 text-xs text-slate-500 sm:text-sm">
                    Kelola properti dan pantau status listing Anda.
                </p>
            </div>

            <a
                href="{{ route('estates.create') }}"
                wire:navigate
                class="flex items-center justify-center gap-2 border border-slate-950 bg-slate-950 px-4 py-3 text-xs font-semibold text-white transition-colors duration-150 hover:border-sky-600 hover:bg-sky-600"
            >
                <span class="text-base leading-none">+</span>
                <span>Properti Baru</span>
            </a>

        </div>

    </header>


    {{-- Feedback --}}
    @if (session('success'))

        <div class="flex items-center gap-3 border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs font-semibold text-emerald-700">

            <span class="h-1.5 w-1.5 shrink-0 bg-emerald-500"></span>

            <span>{{ session('success') }}</span>

        </div>

    @endif


    {{-- Overview --}}
    <section>

        <div class="mb-3 flex items-center gap-2">
            <span class="h-px w-5 bg-sky-500"></span>

            <h2 class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                Ringkasan
            </h2>
        </div>

        <div class="grid border-l border-t border-slate-300 sm:grid-cols-3">

            <div class="border-b border-r border-slate-300 bg-white p-4 sm:p-5">

                <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">
                    Iklan Saya
                </p>

                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-bold tracking-tight text-slate-950">
                        {{ $listingCount }}
                    </span>

                    <span class="text-xs font-semibold text-sky-600">
                        / {{ $publishedListingCount ?? 0 }}
                    </span>
                </div>

                <p class="mt-1 text-[11px] text-slate-400">
                    Total / Tayang
                </p>

            </div>


            <div class="border-b border-r border-slate-300 bg-white p-4 sm:p-5">

                <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">
                    Performa
                </p>

                <div class="mt-3 flex items-center gap-2">

                    <span class="text-sm font-semibold text-slate-400">
                        Belum tersedia
                    </span>

                    <span class="border border-slate-200 bg-slate-50 px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide text-slate-400">
                        Soon
                    </span>

                </div>

                <p class="mt-1 text-[11px] text-slate-400">
                    Tayangan listing
                </p>

            </div>


            <div class="border-b border-r border-slate-300 bg-white p-4 sm:p-5">

                <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">
                    Status Akun
                </p>

                <div class="mt-3 flex items-center gap-2">

                    <span class="h-1.5 w-1.5 bg-sky-500"></span>

                    <span class="text-sm font-semibold text-slate-800">
                        Aktif
                    </span>

                </div>

                <p class="mt-1 text-[11px] text-slate-400">
                    Akun Agen Verified
                </p>

            </div>

        </div>

    </section>


    {{-- Application Menu --}}
    <section>

        <div class="mb-3 flex items-center gap-2">
            <span class="h-px w-5 bg-sky-500"></span>

            <h2 class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                Menu Aplikasi
            </h2>
        </div>

        <div class="grid border-l border-t border-slate-300 sm:grid-cols-2 lg:grid-cols-4">

            <a
                href="{{ route('dashboard.estates') }}"
                wire:navigate
                class="group border-b border-r border-slate-300 bg-white p-4 transition-colors duration-150 hover:bg-slate-50"
            >
                <div class="flex items-start justify-between gap-3">

                    <div>
                        <p class="text-xs font-bold text-slate-900 transition-colors group-hover:text-sky-600 sm:text-sm">
                            Kelola Listing
                        </p>

                        <p class="mt-1 text-[11px] leading-5 text-slate-400">
                            Atur & publikasikan
                        </p>
                    </div>

                    <span class="text-sm font-bold text-slate-300 transition-colors group-hover:text-sky-500">
                        →
                    </span>

                </div>
            </a>


            <div class="border-b border-r border-slate-300 bg-slate-50 p-4">

                <div class="flex items-start justify-between gap-2">

                    <div>
                        <p class="text-xs font-bold text-slate-500 sm:text-sm">
                            Insight Performa
                        </p>

                        <p class="mt-1 text-[11px] leading-5 text-slate-400">
                            Statistik penonton
                        </p>
                    </div>

                    <span class="border border-slate-200 bg-white px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide text-slate-400">
                        Soon
                    </span>

                </div>

            </div>


            <div class="border-b border-r border-slate-300 bg-slate-50 p-4">

                <div class="flex items-start justify-between gap-2">

                    <div>
                        <p class="text-xs font-bold text-slate-500 sm:text-sm">
                            Properti Disimpan
                        </p>

                        <p class="mt-1 text-[11px] leading-5 text-slate-400">
                            Favorit saya
                        </p>
                    </div>

                    <span class="border border-slate-200 bg-white px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide text-slate-400">
                        Soon
                    </span>

                </div>

            </div>


            <div class="border-b border-r border-slate-300 bg-slate-50 p-4">

                <div class="flex items-start justify-between gap-2">

                    <div>
                        <p class="text-xs font-bold text-slate-500 sm:text-sm">
                            Pengaturan Profil
                        </p>

                        <p class="mt-1 text-[11px] leading-5 text-slate-400">
                            Identitas kontak
                        </p>
                    </div>

                    <span class="border border-slate-200 bg-white px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide text-slate-400">
                        Soon
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- Listings --}}
    <section>

        <div class="mb-3 flex items-center justify-between gap-4">

            <div class="flex items-center gap-2">
                <span class="h-px w-5 bg-sky-500"></span>

                <h2 class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                    Listing Properti Anda
                </h2>
            </div>

            <a
                href="{{ route('dashboard.estates') }}"
                wire:navigate
                class="text-[11px] font-semibold text-sky-600 transition-colors hover:text-sky-700"
            >
                Lihat Semua →
            </a>

        </div>


        <div class="border-l border-t border-slate-300">

            @forelse($estates->take(5) as $estate)

                <a
                    href="{{ route('estates.show', $estate->slug) }}"
                    wire:navigate
                    wire:key="dashboard-estate-{{ $estate->id }}"
                    class="group flex items-center gap-3 border-b border-r border-slate-300 bg-white p-3.5 transition-colors duration-150 hover:bg-slate-50 sm:gap-4 sm:p-4"
                >

                    <div class="h-14 w-14 shrink-0 overflow-hidden border border-slate-200 bg-slate-100 sm:h-16 sm:w-16">

                        @if ($estate->primaryImage?->url)

                            <img
                                src="{{ $estate->primaryImage->url }}"
                                alt="{{ $estate->title }}"
                                loading="lazy"
                                decoding="async"
                                class="h-full w-full object-cover transition-transform duration-200 group-hover:scale-[1.02]"
                            >

                        @else

                            <div class="flex h-full w-full items-center justify-center text-[9px] font-medium text-slate-400">
                                No Img
                            </div>

                        @endif

                    </div>


                    <div class="min-w-0 flex-1">

                        <h3 class="truncate text-xs font-bold leading-snug text-slate-800 transition-colors duration-150 group-hover:text-sky-600 sm:text-sm">
                            {{ $estate->title }}
                        </h3>

                        <div class="mt-1 flex items-center gap-2">

                            <span class="text-xs font-bold text-sky-600">
                                {{ $estate->short_price }}
                            </span>

                            @php
                                $statusLabel = match ($estate->publicity_status) {
                                    'published' => 'Tayang',
                                    'archived' => 'Diarsipkan',
                                    default => ucfirst($estate->publicity_status),
                                };
                            @endphp

                            <span class="border border-slate-200 bg-slate-50 px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide text-slate-500">
                                {{ $statusLabel }}
                            </span>

                        </div>

                        <p class="mt-1 truncate text-[11px] font-medium text-slate-400">
                            {{ $estate->short_location_label }}
                        </p>

                    </div>


                    <span class="shrink-0 text-sm font-bold text-slate-300 transition-all duration-150 group-hover:translate-x-0.5 group-hover:text-sky-500">
                        →
                    </span>

                </a>

            @empty

                <div class="border-b border-r border-slate-300 bg-white px-5 py-10 text-center">

                    <p class="text-xs font-medium text-slate-400">
                        Belum ada properti diunggah.
                    </p>

                    <a
                        href="{{ route('estates.create') }}"
                        wire:navigate
                        class="mt-3 inline-flex border border-slate-300 px-3 py-2 text-[11px] font-semibold text-slate-600 transition-colors hover:border-sky-400 hover:text-sky-600"
                    >
                        Tambahkan properti
                    </a>

                </div>

            @endforelse

        </div>

    </section>

</div>
