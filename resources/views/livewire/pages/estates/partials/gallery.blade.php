{{-- ------------------------------------------------------------------------------------------------------
| @path : resources/views/livewire/pages/estates/partials/gallery.blade.php
| @usage : Estate evidence gallery
| @design : Mobile swipe / Desktop arrows / Fullscreen lightbox
| @ruling : No decorative labels without context
-------------------------------------------------------------------------------------------------------- --}}

@php
    $attachments = $estate->attachments;
    $imageCount = $attachments->count();

    /*
     * Match context:
     * - $matchRate should only exist when a real matching calculation
     *   has been performed for the current user/session.
     * - Never fabricate a percentage.
     */
    $matchRate = $matchRate ?? null;
    $hasMatchRate = is_numeric($matchRate);

    $matchLabel = auth()->check()
        ? ($hasMatchRate ? 'MATCH ' . round($matchRate) . '%' : 'CEK KECOCOKAN')
        : 'LOGIN UNTUK MATCH';
@endphp

<div
    x-data="{
        lightbox: false,

        openLightbox() {
            this.lightbox = true;
            document.body.classList.add('overflow-hidden');
        },

        closeLightbox() {
            this.lightbox = false;
            document.body.classList.remove('overflow-hidden');
        },

        nextImage(total) {
            if (!total) return;

            this.activeSlide = (this.activeSlide + 1) % total;
            this.scrollToSlide();
        },

        previousImage(total) {
            if (!total) return;

            this.activeSlide = (this.activeSlide - 1 + total) % total;
            this.scrollToSlide();
        },

        scrollToSlide() {
            const gallery = this.$refs.gallery;

            if (!gallery) return;

            gallery.scrollTo({
                left: this.activeSlide * gallery.clientWidth,
                behavior: 'smooth'
            });
        },

        handleKeydown(event, total) {
            if (!this.lightbox) return;

            if (event.key === 'Escape') {
                this.closeLightbox();
            }

            if (event.key === 'ArrowRight') {
                this.nextImage(total);
            }

            if (event.key === 'ArrowLeft') {
                this.previousImage(total);
            }
        }
    }"
    @keydown.window="handleKeydown($event, {{ max($imageCount, 1) }})"
    class="relative h-[18rem] w-full shrink-0 overflow-hidden bg-slate-950
           sm:h-[24rem] lg:h-[32rem]"
>

    {{-- Gallery --}}
    <div
        x-ref="gallery"
        class="flex h-full w-full snap-x snap-mandatory overflow-x-auto
               [scrollbar-width:none] [-ms-overflow-style:none]
               [&::-webkit-scrollbar]:hidden"
        @scroll.debounce.100ms="
            activeSlide = Math.round($el.scrollLeft / $el.clientWidth)
        "
    >

        @forelse($attachments as $attachment)

            <button
                type="button"
                @click="openLightbox()"
                class="relative h-full w-full shrink-0 snap-center
                       cursor-zoom-in text-left"
                aria-label="Lihat foto {{ $loop->iteration }} dari {{ $imageCount }}"
                oncontextmenu="return false"
            >

                <img
                    src="{{ $attachment->url }}"
                    alt="{{ $estate->title }} — Foto {{ $loop->iteration }}"
                    class="h-full w-full select-none object-cover"
                    draggable="false"
                    loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                >

                <div
                    class="pointer-events-none absolute inset-0
                           bg-gradient-to-t from-slate-950/30
                           via-transparent to-slate-950/10"
                ></div>

            </button>

        @empty

            {{-- Fallback --}}
            <button
                type="button"
                @click="openLightbox()"
                class="relative h-full w-full shrink-0 cursor-zoom-in"
                aria-label="Lihat foto properti"
                oncontextmenu="return false"
            >

                <img
                    src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=1200&q=85"
                    alt="{{ $estate->title }}"
                    class="h-full w-full select-none object-cover"
                    draggable="false"
                >

                <div
                    class="pointer-events-none absolute inset-0
                           bg-slate-950/20"
                ></div>

            </button>

        @endforelse

    </div>


    {{-- Context / Match Badge --}}
    <div class="pointer-events-none absolute left-0 top-0 z-10">

        <div
            class="border-b border-r border-slate-900/10 bg-white
                   px-3 py-2 dark:border-white/10 dark:bg-slate-950"
        >
            <span
                class="text-[9px] font-bold uppercase tracking-[0.14em]
                       text-slate-900 dark:text-white"
            >
                {{ $matchLabel }}
            </span>
        </div>

    </div>


    {{-- Image Counter --}}
    @if ($imageCount > 1)

        <div class="pointer-events-none absolute right-0 top-0 z-10">

            <div
                class="border-b border-l border-white/10 bg-slate-950/80
                       px-3 py-2 text-white backdrop-blur-sm"
            >
                <span
                    x-text="String(activeSlide + 1).padStart(2, '0')"
                    class="font-mono text-xs font-semibold"
                ></span>

                <span class="mx-1 text-white/30">/</span>

                <span class="font-mono text-xs text-white/50">
                    {{ str_pad($imageCount, 2, '0', STR_PAD_LEFT) }}
                </span>
            </div>

        </div>

    @endif


    {{-- Desktop Previous --}}
    @if ($imageCount > 1)

        <button
            type="button"
            @click.stop="previousImage({{ $imageCount }})"
            class="absolute left-4 top-1/2 z-20 hidden h-11 w-11
                   -translate-y-1/2 items-center justify-center
                   border border-white/30 bg-slate-950/60 text-white
                   backdrop-blur-sm transition hover:bg-slate-950/85
                   active:scale-95 lg:flex"
            aria-label="Foto sebelumnya"
        >
            <svg
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="square"
                    stroke-linejoin="miter"
                    d="M15 18l-6-6 6-6"
                />
            </svg>
        </button>


        {{-- Desktop Next --}}
        <button
            type="button"
            @click.stop="nextImage({{ $imageCount }})"
            class="absolute right-4 top-1/2 z-20 hidden h-11 w-11
                   -translate-y-1/2 items-center justify-center
                   border border-white/30 bg-slate-950/60 text-white
                   backdrop-blur-sm transition hover:bg-slate-950/85
                   active:scale-95 lg:flex"
            aria-label="Foto berikutnya"
        >
            <svg
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="square"
                    stroke-linejoin="miter"
                    d="M9 18l6-6-6-6"
                />
            </svg>
        </button>

    @endif


    {{-- Progress --}}
    @if ($imageCount > 1)

        <div
            class="pointer-events-none absolute bottom-0 left-0 right-0
                   z-10 h-1 bg-slate-950/40"
        >
            <div
                class="h-full bg-white transition-all duration-200"
                :style="`width: ${((activeSlide + 1) / {{ $imageCount }}) * 100}%`"
            ></div>
        </div>

    @else

        <div
            class="pointer-events-none absolute bottom-0 left-0 right-0
                   z-10 h-1 bg-white"
        ></div>

    @endif


    {{-- Fullscreen Lightbox --}}
    <div
        x-show="lightbox"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] flex items-center justify-center
               bg-slate-950/95 p-3 sm:p-6"
        @click.self="closeLightbox()"
    >

        {{-- Close --}}
        <button
            type="button"
            @click="closeLightbox()"
            class="absolute right-4 top-4 z-30 flex h-10 w-10
                   items-center justify-center border border-white/20
                   bg-slate-950/70 text-white backdrop-blur-sm
                   transition hover:bg-white hover:text-slate-950
                   active:scale-95"
            aria-label="Tutup foto"
        >
            <svg
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="square"
                    d="M6 6l12 12M18 6L6 18"
                />
            </svg>
        </button>


        {{-- Counter --}}
        @if ($imageCount > 1)

            <div
                class="absolute left-4 top-4 z-30 border border-white/20
                       bg-slate-950/70 px-3 py-2 font-mono text-xs
                       text-white backdrop-blur-sm"
            >
                <span x-text="activeSlide + 1"></span>
                <span class="text-white/40">/</span>
                <span>{{ $imageCount }}</span>
            </div>

        @endif


        {{-- Previous --}}
        @if ($imageCount > 1)

            <button
                type="button"
                @click.stop="previousImage({{ $imageCount }})"
                class="absolute left-3 top-1/2 z-30 flex h-12 w-12
                       -translate-y-1/2 items-center justify-center
                       border border-white/20 bg-slate-950/70 text-white
                       backdrop-blur-sm transition hover:bg-white
                       hover:text-slate-950 active:scale-95 sm:left-6"
                aria-label="Foto sebelumnya"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="square"
                        stroke-linejoin="miter"
                        d="M15 18l-6-6 6-6"
                    />
                </svg>
            </button>


            {{-- Next --}}
            <button
                type="button"
                @click.stop="nextImage({{ $imageCount }})"
                class="absolute right-3 top-1/2 z-30 flex h-12 w-12
                       -translate-y-1/2 items-center justify-center
                       border border-white/20 bg-slate-950/70 text-white
                       backdrop-blur-sm transition hover:bg-white
                       hover:text-slate-950 active:scale-95 sm:right-6"
                aria-label="Foto berikutnya"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="square"
                        stroke-linejoin="miter"
                        d="M9 18l6-6-6-6"
                    />
                </svg>
            </button>

        @endif


        {{-- Large Image --}}
        @forelse($attachments as $attachment)

            <img
                x-show="activeSlide === {{ $loop->index }}"
                src="{{ $attachment->url }}"
                alt="{{ $estate->title }} — Foto {{ $loop->iteration }}"
                class="max-h-[90vh] max-w-[92vw] select-none object-contain
                       shadow-2xl"
                draggable="false"
                oncontextmenu="return false"
            >

        @empty

            <img
                x-show="activeSlide === 0"
                src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=1600&q=90"
                alt="{{ $estate->title }}"
                class="max-h-[90vh] max-w-[92vw] select-none object-contain
                       shadow-2xl"
                draggable="false"
                oncontextmenu="return false"
            >

        @endforelse

    </div>

</div>
