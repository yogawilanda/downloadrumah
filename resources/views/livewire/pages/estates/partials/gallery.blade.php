{{-- @path: resources/views/livewire/pages/estates/partials/gallery.blade.php --}}

<div class="relative h-80 w-full bg-slate-950 overflow-hidden shrink-0">

    {{-- Gallery --}}
    <div
        class="h-full w-full flex overflow-x-auto snap-x snap-mandatory
               [scrollbar-width:none] [-ms-overflow-style:none]
               [&::-webkit-scrollbar]:hidden"
        @scroll.debounce.100ms="
            activeSlide = Math.round($el.scrollLeft / $el.clientWidth)
        "
    >

        @forelse($estate->attachments as $attachment)

            <div class="relative w-full h-full flex-shrink-0 snap-center">

                <img
                    src="{{ $attachment->url }}"
                    alt="{{ $estate->title }}"
                    class="w-full h-full object-cover"
                >

                {{-- Subtle image treatment --}}
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/30 via-transparent to-slate-950/10 pointer-events-none"></div>

            </div>

        @empty

            <div class="relative w-full h-full flex-shrink-0">

                <img
                    src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=1200&q=85"
                    alt="{{ $estate->title }}"
                    class="w-full h-full object-cover"
                >

                <div class="absolute inset-0 bg-slate-950/20"></div>

            </div>

        @endforelse

    </div>


    {{-- Top-left geometry --}}
    <div class="absolute top-0 left-0 z-10 pointer-events-none">

        <div class="bg-white px-4 py-2 border-r border-b border-slate-900/10">
            <span class="text-[10px] font-bold tracking-[0.18em] uppercase text-slate-900">
                Property
            </span>
        </div>

    </div>


    {{-- Top-right image counter --}}
    @if(count($estate->attachments) > 1)

        <div class="absolute top-0 right-0 z-10 pointer-events-none">

            <div class="bg-slate-950/80 backdrop-blur-sm text-white px-4 py-2 border-l border-b border-white/10">

                <span
                    x-text="String(activeSlide + 1).padStart(2, '0')"
                    class="font-mono text-xs font-semibold"
                ></span>

                <span class="mx-1 text-white/30">/</span>

                <span class="font-mono text-xs text-white/50">
                    {{ str_pad(count($estate->attachments), 2, '0', STR_PAD_LEFT) }}
                </span>

            </div>

        </div>

    @endif


    {{-- Bottom edge --}}
    <div class="absolute bottom-0 left-0 right-0 z-10 pointer-events-none">

        <div class="flex items-end justify-between">

            {{-- Progress --}}
            @if(count($estate->attachments) > 1)

                <div class="h-1 flex-1 bg-slate-950/40">

                    <div
                        class="h-full bg-white transition-all duration-200"
                        :style="`width: ${((activeSlide + 1) / {{ count($estate->attachments) }}) * 100}%`"
                    ></div>

                </div>

            @else

                <div class="h-1 flex-1 bg-white"></div>

            @endif

        </div>

    </div>


    {{-- Bottom-left corner marker --}}
    <div class="absolute bottom-5 left-5 z-10 pointer-events-none">

        <div class="flex items-center gap-2">

            <span class="w-2 h-2 bg-white"></span>

            <span class="text-[10px] font-semibold tracking-[0.16em] uppercase text-white drop-shadow">
                Photos
            </span>

        </div>

    </div>

</div>
