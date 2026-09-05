@section('has_custom_meta', true)

@push('meta')
    @php
        $coverImage = $estate->primaryImage?->url
            ?? ($estate->attachments->first()?->file_path ? asset('storage/' . $estate->attachments->first()->file_path) : asset('images/og-preview.jpg'));

        $formattedPrice = $estate->short_price;
        $location = $estate->short_location_label;
        $ogTitle = "{$estate->title} - {$formattedPrice}";
        $ogDescription = "Di{$estate->transaction_type_label} properti di {$location}. " . Str::limit(strip_tags($estate->description ?? ''), 120);
    @endphp

    <!-- Dynamic Open Graph Meta untuk Estate Detail -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    <meta property="og:image" content="{{ $coverImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDescription }}">
    <meta name="twitter:image" content="{{ $coverImage }}">
@endpush

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
