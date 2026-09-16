{{-- resources/views/livewire/pages/estates/estate-show.blade.php --}}

@php
    $defaultWa = $estate->user->phone_number ?? '';
    $isOwner = auth()->check() && auth()->id() === $estate->user_id;
@endphp

<div
    x-data="{
        shareModal: false,
        waModal: false,
        toastModal: false,
        shareTargetNumber: '{{ $defaultWa }}',
        activeSlide: 0
    }"
    class="relative min-h-screen bg-slate-50 dark:bg-slate-950 pb-28 lg:pb-12 font-sans antialiased"
>
    {{-- todo: jangan hapus dulu kalau filenya belum dihapus --}}
    {{-- <x-layouts.estate.top-nav :estate="$estate" /> --}}

    <x-layouts.estate.header-control :estate="$estate" />

    <div class="mx-auto max-w-6xl px-0 sm:px-4 md:px-6 lg:px-8 pt-0 sm:pt-6">
        <div class="grid grid-cols-1 items-start gap-5 lg:grid-cols-12 lg:gap-6">

            {{-- Gallery & Property Detail --}}
            <main class="lg:col-span-8">
                <div class="overflow-hidden bg-white dark:bg-slate-900 sm:border sm:border-slate-200 dark:sm:border-slate-800">
                    @include('livewire.pages.estates.partials.gallery')

                    <div class="relative z-10 -mt-5 space-y-6 bg-white p-4 dark:bg-slate-900 sm:mt-0 sm:p-6 lg:p-8">
                        @include('livewire.pages.estates.partials.summary')
                    </div>
                </div>
            </main>

            {{-- Contact / Owner Panel --}}
            <aside class="lg:col-span-4 lg:sticky lg:top-22">
                <div class="hidden space-y-5 border border-slate-200 bg-white p-5 dark:border-slate-800 dark:bg-slate-900 lg:block">

                    <div class="border-b border-slate-200 pb-4 dark:border-slate-800">
                        <div class="flex items-end justify-between gap-3">
                            <div>
                                <span class="block text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">
                                    Property / Contact
                                </span>
                                <h2 class="mt-1 text-sm font-bold text-slate-950 dark:text-white">
                                    Dikelola Oleh
                                </h2>
                            </div>

                            <span class="text-[8px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                                {{ $isOwner ? 'Owner' : 'Agent' }}
                            </span>
                        </div>
                    </div>

                    @if ($isOwner)
                        @include('livewire.pages.estates.partials.agent-owner-edit')
                    @else
                        @include('livewire.pages.estates.partials.agent-contact')
                    @endif
                </div>
            </aside>

        </div>
    </div>
</div>
