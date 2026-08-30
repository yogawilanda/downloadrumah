<div class="relative h-80 w-full bg-slate-900 overflow-hidden shrink-0">
    <div class="h-full w-full flex overflow-x-auto snap-x snap-mandatory [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden" @scroll.debounce.100ms="activeSlide = Math.round($el.scrollLeft / $el.clientWidth)">
        @forelse($estate->attachments as $attachment)
            <div class="w-full h-full flex-shrink-0 snap-center"><img src="{{ $attachment->url }}" alt="{{ $estate->title }}" class="w-full h-full object-cover"></div>
        @empty
            <div class="w-full h-full flex-shrink-0"><img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover"></div>
        @endforelse
    </div>
    @if(count($estate->attachments) > 1)
        <div class="absolute bottom-10 right-4 px-3 py-1 rounded-full bg-slate-900/60 backdrop-blur-md text-white text-[11px] font-medium z-10"><span x-text="activeSlide + 1"></span> / {{ count($estate->attachments) }}</div>
    @endif
</div>
