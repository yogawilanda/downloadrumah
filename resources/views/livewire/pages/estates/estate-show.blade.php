@php($defaultWa = $estate->user->phone_number ?? '')
<div x-data="{ shareModal: false, waModal: false, toastModal: false, shareTargetNumber: '{{ $defaultWa }}', activeSlide: 0 }" class="max-w-md mx-auto min-h-screen bg-white pb-24 relative font-sans antialiased">
    <x-layouts.estate.top-nav :estate="$estate" />
    @include('livewire.pages.estates.partials.gallery')
    <div class="p-5 bg-white rounded-t-[32px] -mt-6 relative z-10 space-y-5">
        <div class="w-10 h-1 bg-slate-200 rounded-full mx-auto -mt-1 mb-1"></div>
        @include('livewire.pages.estates.partials.summary')
        @include('livewire.pages.estates.partials.agent-contact')
    </div>
</div>
