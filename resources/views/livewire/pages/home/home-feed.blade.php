{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/home/home-feed.blade.php
| @usage            : DownloadRumah Home Feed — Primary Discovery & Property Exploration Surface
| @type             : Root Livewire Page View (Stateful Container & Orchestrator)
| @layout           : components.layouts.app
|
| @expected_data    : [$recentEstates, $recommendedEstates]
| @expected_events  : [open-search-modal]
| @techstack        : Laravel 13.17, Livewire 3.6.4, Alpine.js 3.x, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
| @seo_context      : Public Home Feed
|
| @ruling           : Page orchestrates state and section composition. Structural visuals are delegated.
| @ruling_ui        : Mobile-first. Strong section boundaries. Restrained rounding.
| @ruling_modal     : Pure UI state uses Alpine.js. Stateful content remains with Livewire.
| @ruling_motion    : Snappy transitions only. No continuous decorative animation.
| @ruling_performance : Preserve LCP priority. Avoid unnecessary visual layers and eager media.
|
| @status           : Facelift — Structural Section Extraction
| @author           : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div
    x-data="{ openSearchModal: false }"
    @open-search-modal.window="openSearchModal = true"
    class="relative w-full"
>
    <x-layouts.structural-background>

        {{-- =============================================================
             01. HERO / DISCOVERY ENTRY

             Primary entry point.
             Establishes the product promise and lets the visitor begin
             exploring without requiring a fully defined intent.
             ============================================================= --}}
        @include('livewire.pages.home.sections.hero')


        {{-- =============================================================
             02. RECENT DISCOVERY

             Immediate property discovery.
             Gives the visitor something concrete to explore after the hero.
             ============================================================= --}}
        @include('livewire.pages.home.sections.recent-discovery')


        {{-- =============================================================
             03. RECOMMENDATION

             Expands discovery beyond the first visible set.
             Communicates that relevant choices are not limited to the
             newest properties.
             ============================================================= --}}
        @include('livewire.pages.home.sections.recommendation')


        {{-- =============================================================
             04. WHY DISCOVERY

             Introduces the problem behind property discovery:
             attractive does not necessarily mean suitable.
             This shifts the page from "listing catalog" into
             guided decision-making.
             ============================================================= --}}
        @include('livewire.pages.home.sections.why-discovery')


        {{-- =============================================================
             05. HOW IT WORKS

             Explains DownloadRumah's mechanism after the visitor has
             already seen the discovery experience and understood
             the problem it is trying to solve.
             ============================================================= --}}
        @include('livewire.pages.home.sections.how-it-works')


        {{-- =============================================================
             06. PROPERTY ↔ PROFESSIONAL

             Explains the relationship between a property and the person
             behind it, preparing the visitor for a contextual conversation
             rather than treating the listing as the final destination.
             ============================================================= --}}
        @include('livewire.pages.home.sections.property-professional')


        {{-- =============================================================
             07. START ANYWHERE

             Removes the assumption that visitors must already know exactly
             what they want. Provides several natural discovery entry points.
             ============================================================= --}}
        @include('livewire.pages.home.sections.start-anywhere')


        {{-- =============================================================
             08. NEXT STEP

             Converts accumulated understanding back into a concrete action:
             continue exploring properties.
             ============================================================= --}}
        @include('livewire.pages.home.sections.next-step')


        {{-- =============================================================
             09. CONTEXTUAL MESSAGE

             Supporting explanation / contextual communication.
             Keep this section lightweight so it does not compete with
             the primary discovery flow.
             ============================================================= --}}
        @include('livewire.pages.home.sections.promotion')


        {{-- =============================================================
             10. OWNER ACQUISITION

             Secondary path for property owners.
             This should remain separate from the main discovery journey
             so the homepage does not feel like an advertisement marketplace.
             ============================================================= --}}
        @include('livewire.pages.home.sections.owner-acquisition')


        {{-- =============================================================
             11. MODALS

             Search and needs-analysis interfaces.
             Kept at the root level so their state remains independent
             from individual visual sections.
             ============================================================= --}}
        <div wire:key="search-advanced-modal-wrapper">
            <x-layouts.home.home-feed-search-advanced
                :transaction_type="''"
                :cities="[]"
                :districts="[]"
            />
        </div>

        <div wire:key="needs-analysis-modal-wrapper">
            @livewire(\App\Livewire\Pages\Home\NeedsAnalysisModal::class)
        </div>


        {{-- =============================================================
             RESERVED / DEPRECATED SECTIONS

             Kept commented intentionally for possible reuse.
             Do not remove until the new homepage structure is fully locked.
             ============================================================= --}}

        {{-- @include('livewire.pages.home.sections.structural-pause') --}}

    </x-layouts.structural-background>
</div>
