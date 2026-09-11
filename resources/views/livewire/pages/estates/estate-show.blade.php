{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/estates/estate-show.blade.php
| @usage      : Responsive View for Estate Detail (Mobile, Tablet, Desktop)
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

@php($defaultWa = $estate->user->phone_number ?? '')
@php($isOwner = auth()->check() && auth()->id() === $estate->user_id)

<div x-data="{ shareModal: false, waModal: false, toastModal: false, shareTargetNumber: '{{ $defaultWa }}', activeSlide: 0 }" class="min-h-screen bg-slate-50/50 pb-28 lg:pb-12 relative font-sans antialiased">
    {{-- todo: jangan hapus dulu kalau filenya belum dihapus --}}
    {{-- <x-layouts.estate.top-nav :estate="$estate" /> --}}
    <x-layouts.estate.header-control :estate="$estate" />

    <div class="max-w-6xl mx-auto px-0 sm:px-4 md:px-6 lg:px-8 pt-0 sm:pt-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">

            {{-- KOLOM KIRI (Gallery & Content Detail) --}}
            <div
                class="lg:col-span-8 bg-white sm:rounded-md sm:border sm:border-slate-200/80 sm:shadow-sm overflow-hidden">
                @include('livewire.pages.estates.partials.gallery')

                <div class="p-4 sm:p-6 lg:p-8 bg-white -none -mt-5 sm:mt-0 relative z-10 space-y-6">
                    @include('livewire.pages.estates.partials.summary')
                </div>
            </div>

            {{-- KOLOM KANAN (Desktop/Tablet Sticky Contact Card & Bottom Bar Mobile) --}}
            <div class="lg:col-span-4 lg:sticky lg:top-22">
                {{-- Desktop Side Card Container --}}
                <div class="hidden lg:block bg-white p-6 rounded-md border border-slate-200/80 shadow-sm space-y-5">
                    <div class="pb-4 border-b border-slate-100">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Dikelola
                            Oleh</span>

                    </div>

                    @if ($isOwner)
                        @include('livewire.pages.estates.partials.agent-owner-edit')
                    @else
                        @include('livewire.pages.estates.partials.agent-contact')
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
