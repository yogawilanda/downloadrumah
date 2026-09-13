{{-- TODO: diagnose this again before working further --}}
{{--------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/admin/insights/index.blade.php
| @usage            : Admin Analytics & Telemetry Insights Dashboard Container
| @type             : Root Livewire Page View (Stateful Container & Orchestrator)
| @layout           : components.layouts.app (Extends: App Layout with navigation -> bottom navigation style)
|
| @expected_data    : [MAX 5-7 Data Payload -> WARN: Currently 8 items, pending refactor]
|   - $totalHits (int)            : Total raw request/event counts
|   - $uniqueSessions (int)       : Count of unique active session IDs
|   - $authenticatedLogs (int)    : Count of logs linked to logged-in users
|   - $guestLogs (int)            : Count of logs linked to anonymous visitors
|   - $topPage (string)           : Most visited relative URL path
|   - $logs (LengthAwarePaginator): Paginated collection of ActivityLog models
|   - $journeyLogs (Collection)   : Session trace logs (empty if no session selected)
|   - $cardDetailsData (Collection): Breakdown data collection for active card modal
|
| @expected_events  : [Max 4-6 Wire & Alpine State Handlers]
|   - inspectJourney(sessionId)   : Loads session trace & triggers journey modal
|   - openCardDetail(type)        : Loads breakdown data & triggers active card modal
|   - closeJourney()              : Resets selected session state
|   - closeCardDetail()           : Resets active card detail modal state
|
| @techstack        : Laravel 13 Blade, Livewire 4, Alpine.js 3.x, Tailwind CSS 3/4
| @dependencies     : Composer: livewire/livewire | NPM: alpinejs, @tailwindcss/vite
| @design_tokens    : Font: Outfit 400 - 700 | Theme: White And Blue Neutral (Light Mode)
| @seo_context      : Admin Internal (No Index/Follow, Secured via Auth & Admin Middleware)
|
| @status_tech_debt : On standby.
| @tech_debt        : [max 3. exceed? Should fix it first to reduce more tech debt]
|   - Scattered data across it's child/component, some using literal data, without mapping, some even redundant.
|   - Table view supposed to be leaner, in desktop view, instead of reducing the paginate(10), make the table become have tigther view with vertical scrollable view (separated scroll focus form main table)
|   - Analytic Card Component should be open new blade component modal or livewire, to increase ux when using mobile, instead of using tooltips to check, since there is action target that behaves like clickable function
|
| @ruling           : Max 100 total lines. Exceed? Modularize via @include / <x-components>.
| @ruling_ui        : NO DATA FALLBACK LOGIC HERE. Expect clean data from Backend. Handle empty states visually only.
| @ruling_modal     : Pure UI modals/tooltips MUST use Alpine.js + x-teleport="body". Avoid Livewire for UI state.
| @ruling_comment   : Use right-side inline comments where applicable to keep line count compact.
|
| @created | updated : 25/09/2026 | 12/09/2026
| @author           : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

{{-- total 3 perubahan di component nanti dan ini banyak --}}
<div class="w-full min-h-screen bg-slate-50/50 p-3 sm:p-6 lg:p-8 space-y-4 sm:space-y-6">

    {{-- Page Header --}}
    @include('livewire.pages.admin.insights.page-header')

    {{-- Analytics Cards: ini kena, banyak perubahan kalau ada changes di index.php. 1. --}}
    @include('livewire.pages.admin.insights.analytic-card')

    {{-- Main Stream Activity Container --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden p-4 sm:p-6 space-y-4">
        {{-- Search & Export Toolbar --}}
        @include('livewire.pages.admin.insights.search-filter-toolbar')

        {{-- Mobile List Tile View (< lg), 2. ini juga kena perubahan karena dia logs yang didalamnya ada payload --}}
        @include('livewire.pages.admin.insights.mobile-view-tile-view')

        {{-- Desktop Table View (>= lg) ,3. ini juga kena perubahan karena dia manggil logs--}}
        @include('livewire.pages.admin.insights.desktop-view-table-view')

        <div class="pt-2 border-t border-slate-100">
            {{ $logs->links() }}
        </div>
    </div>

    {{-- Center Modal 1: User Journey Timeline, 4. ini juga kena perubahan karena dia manggil selected session, journeylogs,  --}}
    @if ($selectedSessionId)
        @include('livewire.pages.admin.insights.selected-session-id')
    @endif

    {{-- Bottom Sheet / Modal 2: Card Breakdown Details. --}}
    @if ($activeCardDetail)
    {{--  5. ini juga kena pasti kena karena dia juga manggil --}}
        @include('livewire.pages.admin.insights.active-card-detail')
        {{-- 6. ini juga pasti kena --}}
        @include('livewire.pages.admin.insights.details-card')
    @endif

</div>
