@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex gap-2 items-center justify-between">

        {{-- Previous Button --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed leading-5 rounded-xl">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-200 leading-5 rounded-xl hover:bg-gray-50 active:bg-gray-100 transition ease-in-out duration-150 shadow-sm">
                {!! __('pagination.previous') !!}
            </button>
        @endif

        {{-- Next Button --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-200 leading-5 rounded-xl hover:bg-gray-50 active:bg-gray-100 transition ease-in-out duration-150 shadow-sm">
                {!! __('pagination.next') !!}
            </button>
        @else
            <span class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed leading-5 rounded-xl">
                {!! __('pagination.next') !!}
            </span>
        @endif

    </nav>
@endif
