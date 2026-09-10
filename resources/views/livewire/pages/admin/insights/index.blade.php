{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/admin/insights/index.blade.php
| @usage      : Mobile-First Insights Dashboard with Adaptive Desktop Layout
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="w-full min-h-screen bg-slate-50/50 p-3 sm:p-6 lg:p-8 space-y-4 sm:space-y-6">

    {{-- Page Header --}}
    @include('volt-livewire::pages.admin.insights.page-header')

    {{-- Analytics Cards: 2 Kolom (Mobile) -> 4 Kolom (Desktop) --}}
    @include('volt-livewire::pages.admin.insights.analytic-card')

    {{-- Main Stream Activity Container --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden p-4 sm:p-6 space-y-4">
        {{-- Search & Filter Toolbar --}}
        @include('volt-livewire::pages.admin.insights.search-filter-toolbar')

        {{-- Mobile List Tile View (< lg) --}}
        @include('volt-livewire::pages.admin.insights.mobile-view-tile-view')

        {{-- Desktop Table View (>= lg) --}}
        @include('volt-livewire::pages.admin.insights.desktop-view-table-view')

        <div class="pt-2 border-t border-slate-100">{{ $logs->links() }}</div>
    </div>

    {{-- Center Modal 1: User Journey Timeline --}}
    @if ($selectedSessionId)
        @include('volt-livewire::pages.admin.insights.selected-session-id')
    @endif

    {{-- Bottom Sheet / Modal 2: Card Breakdown Details --}}
    @if ($activeCardDetail)
        @include('volt-livewire::pages.admin.insights.active-card-detail')
    @endif

    {{-- ketika menjadi include warnanya jadi hitam bgnya, kenapa ya? --}}
    {{-- resources/views/livewire/pages/admin/insights/index.blade.php --}}
    @include('volt-livewire::pages.admin.insights.details-card')
</div>
