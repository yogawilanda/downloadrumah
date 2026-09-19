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
        activeSlide: 0,

        nextSlide(total) {
            if (!total) return;

            this.activeSlide = (this.activeSlide + 1) % total;
        },

        previousSlide(total) {
            if (!total) return;

            this.activeSlide = (this.activeSlide - 1 + total) % total;
        }
    }"
    class="relative min-h-screen bg-slate-50 pb-28 font-sans antialiased
           dark:bg-slate-950 lg:pb-12"
>
    {{-- todo: jangan hapus dulu kalau filenya belum dihapus --}}
    {{-- <x-layouts.estate.top-nav :estate="$estate" /> --}}

    <x-layouts.estate.header-control :estate="$estate" />

    <div class="mx-auto w-full max-w-6xl px-0 pt-16 sm:px-4 sm:pt-20 md:px-6 lg:px-8 lg:pt-0">
        <div class="grid grid-cols-1 items-start gap-5 lg:grid-cols-12 lg:gap-6">

            {{-- Property Content --}}
            <main class="min-w-0 lg:col-span-8">
                <div
                    class="overflow-hidden bg-white
                           dark:bg-slate-900
                           sm:border sm:border-slate-200
                           dark:sm:border-slate-800"
                >
                    @include('livewire.pages.estates.partials.gallery')

                    <div
                        class="relative z-10 -mt-5 bg-white p-4
                               dark:bg-slate-900
                               sm:mt-0 sm:p-6
                               lg:p-8"
                    >
                        @include('livewire.pages.estates.partials.summary')
                    </div>
                </div>
            </main>

            {{-- Owner / Agent --}}
            <aside class="min-w-0 lg:sticky lg:top-22 lg:col-span-4">
                <div
                    class="border border-slate-200 bg-white p-4
                           dark:border-slate-800 dark:bg-slate-900
                           sm:p-5"
                >
                    <div class="mb-5 border-b border-slate-200 pb-4 dark:border-slate-800">
                        <div class="flex items-end justify-between gap-3">
                            <div class="min-w-0">
                                <span
                                    class="block text-[9px] font-bold uppercase
                                           tracking-[0.16em] text-slate-400
                                           dark:text-slate-500"
                                >
                                    Property / Contact
                                </span>

                                <h2
                                    class="mt-1 truncate text-sm font-bold
                                           text-slate-950 dark:text-white"
                                >
                                    Dikelola Oleh
                                </h2>
                            </div>

                            <span
                                class="shrink-0 text-[8px] font-bold uppercase
                                       tracking-wider text-slate-400
                                       dark:text-slate-500"
                            >
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
