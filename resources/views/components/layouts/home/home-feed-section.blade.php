@props(['title', 'subtitle', 'estates'])

<section class="space-y-2" x-data="{
    scrollNext() {
            $refs.container.scrollBy({ left: 280, behavior: 'smooth' });
        },
        scrollPrev() {
            $refs.container.scrollBy({ left: -280, behavior: 'smooth' });
        }
}">
    <!-- Header Section -->
    <div class="flex items-center justify-between px-4 pt-2">
        <div>
            <h2 class="text-base font-bold leading-tight text-gray-800">{{ $title }}</h2>
            <p class="text-xs text-gray-500">{{ $subtitle }}</p>
        </div>

        <div class="flex items-center gap-2">
            <div class="flex items-center gap-1">
                <button type="button" @click="scrollPrev"
                    class="p-1 text-gray-500 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none transition-colors"
                    aria-label="Previous">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button type="button" @click="scrollNext"
                    class="p-1 text-gray-500 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none transition-colors"
                    aria-label="Next">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            <a href="{{ route('listings.index') }}" wire:navigate class="text-xs font-bold text-blue-600 ml-1">
                Lihat Semua
            </a>
        </div>
    </div>

    <!-- Container Carousel: Ganti px-4 dengan px-4 dan after:w-1 -->
    <div x-ref="container"
        class="flex gap-3 overflow-x-auto [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden px-4 scroll-px-4 scroll-smooth snap-x snap-mandatory">
        <x-layouts.home.home-feed-listing :estates="$estates" />
    </div>
</section>
