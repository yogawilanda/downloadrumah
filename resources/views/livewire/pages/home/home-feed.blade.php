{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
    | @path : resources/views/livewire/pages/home/home-feed.blade.php
    | @usage : DownloadRumah Home — Intent Discovery Entry
    | @type : Root Livewire Page View
    | @layout : components.layouts.app
    |
    | @expected_data : []
    | @expected_events : [open-search-modal]
    | @techstack : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
    | @design_tokens : Font: Outfit | Theme: White / Slate / Sky Accent
    | @seo_context : Public Home
    |
    | @ruling : Homepage currently focuses on demonstrating the core
    | intent-discovery experience before introducing the
    | broader DownloadRumah ecosystem.
    |
    | @ruling_ui : Mobile-first. Strong section boundaries. Restrained rounding.
    | @ruling_modal : Pure UI state uses Alpine.js. Stateful content remains with Livewire.
    | @ruling_motion : Snappy transitions only. No continuous decorative animation.
    | @ruling_performance : Keep homepage lightweight during intent-experience development.
    | Avoid eager recommendation queries and unnecessary media.
    |
    | @status : Intent Experience — Prototype / Refactor
    | @author : yogawilanda <eaywilanda@gmail.com>
        | </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div x-data="{ openSearchModal: false }" @open-search-modal.window="openSearchModal = true" class="relative w-full">

    <x-layouts.structural-background>

        {{-- =============================================================
        01. INTENT EXPERIENCE

        Primary homepage experience.

        The visitor is not asked to understand DownloadRumah first.
        Instead, the interface lets them demonstrate what they need
        or what property they have.

        Current focus:
        - Saya mencari
        - Saya punya properti
        - Guided questions
        - Intent summary

        Matching and authentication will be connected later.
        ============================================================= --}}
        <livewire:pages.home.sections.hero>
            {{--
            <livewire:pages.home.guest-matching /> --}}



            {{-- =============================================================
            TEMPORARILY DISABLED

            The sections below are intentionally disabled while the
            intent experience becomes the primary homepage entry point.

            Do not delete yet. They may be reintroduced after the new
            interaction and information hierarchy are validated.
            ============================================================= --}}
            {{-- @include('livewire.pages.home.sections.intent-flow') work on this later --}}

            {{-- 02. RECENT DISCOVERY --}}

            {{-- @include('livewire.pages.home.sections.recent-discovery') --}}


            {{-- 03. RECOMMENDATION --}}
            {{--
            @include('livewire.pages.home.sections.recommendation')
            --}}

            {{-- 04. WHY DISCOVERY --}}

            {{-- @include('livewire.pages.home.sections.why-discovery') --}}


            {{-- 05. HOW IT WORKS --}}
            {{--
            @include('livewire.pages.home.sections.how-it-works')
            --}}

            {{-- 06. PROPERTY ↔ PROFESSIONAL --}}
            {{--
            @include('livewire.pages.home.sections.property-professional')
            --}}

            {{-- 07. START ANYWHERE --}}
            {{--
            @include('livewire.pages.home.sections.start-anywhere')
            --}}

            {{-- 08. NEXT STEP --}}
            {{--
            @include('livewire.pages.home.sections.next-step')
            --}}

            {{-- 09. CONTEXTUAL MESSAGE --}}
            {{--
            @include('livewire.pages.home.sections.promotion')
            --}}

            {{-- 10. OWNER ACQUISITION --}}
            {{--
            @include('livewire.pages.home.sections.owner-acquisition')
            --}}


            {{-- =============================================================
            TEMPORARILY DISABLED

            Existing search / needs-analysis modals are not part of the
            current homepage experiment.

            The new hero interaction will eventually replace or connect
            to the appropriate discovery flow.
            ============================================================= --}}

            {{--
            <div wire:key="search-advanced-modal-wrapper">
                <x-layouts.home.home-feed-search-advanced :transaction_type="''" :cities="[]" :districts="[]" />
            </div>

            <div wire:key="needs-analysis-modal-wrapper">
                @livewire(\App\Livewire\Pages\Home\NeedsAnalysisModal::class)
            </div>
            --}}


            {{-- =============================================================
            RESERVED / DEPRECATED

            Kept for possible future structural reuse.
            ============================================================= --}}

            {{--
            @include('livewire.pages.home.sections.structural-pause')
            --}}

    </x-layouts.structural-background>
</div>
