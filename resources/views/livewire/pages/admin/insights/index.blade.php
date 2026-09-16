{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
    1. path__________________: resources/views/livewire/pages/admin/insights/index.blade.php
    2. usage_________________: Admin Analytics & Telemetry Insights Dashboard Container
    3. type__________________: Root Livewire Page View / Stateful Orchestrator
    4. layout________________: components.layouts.app
    5. expected_data_________: [$totalHits, $uniqueSessions, $authenticatedLogs, $guestLogs, $topPage, $logs, $journeyLogs, $cardDetailsData]
    6. expected_events_______: [inspectJourney, openCardDetail, closeJourney, closeCardDetail]
    7. purpose_______________: Compose analytics cards, telemetry streams, filters, pagination, and detail modals.
    8. ruling________________: Keep orchestration lean; data preparation belongs to the Livewire backend.
    9. ruling_ui_____________: No data fallback logic here. Empty states are handled by child views.
    10. ruling_modal_________: Modal UI is delegated to child views.
    11. tech_debt____________: Backend payload/state refactor is pending. Do not restructure until index.php is refactored.
    12. status_______________: On Standby
</meta_config>
------------------------------------------------------------------ --}}

{{-- Root analytics & telemetry container --}}
<div
    class="min-h-screen w-full space-y-4 bg-slate-50/50 p-3
           dark:bg-slate-950 sm:space-y-6 sm:p-6 lg:p-8"
>
    {{-- Page Header --}}
    @include('livewire.pages.admin.insights.page-header')

    {{-- Analytics Cards --}}
    @include('livewire.pages.admin.insights.analytic-card')

    {{-- Main Stream Activity Container --}}
    <div
        class="space-y-4 overflow-hidden rounded-2xl border border-slate-200/80
               bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900
               sm:p-6"
    >
        {{-- Search & Export Toolbar --}}
        @include('livewire.pages.admin.insights.search-filter-toolbar')

        {{-- Mobile List Tile View (< lg) --}}
        @include('livewire.pages.admin.insights.mobile-view-tile-view')

        {{-- Desktop Table View (>= lg) --}}
        @include('livewire.pages.admin.insights.desktop-view-table-view')

        {{-- Pagination --}}
        <div class="border-t border-slate-100 pt-2 dark:border-slate-800">
            {{ $logs->links() }}
        </div>
    </div>

    {{-- User Journey Timeline --}}
    @if ($selectedSessionId)
        @include('livewire.pages.admin.insights.selected-session-id')
    @endif

    {{-- Card Breakdown Details --}}
    @if ($activeCardDetail)
        @include('livewire.pages.admin.insights.active-card-detail')
        @include('livewire.pages.admin.insights.details-card')
    @endif
</div>
