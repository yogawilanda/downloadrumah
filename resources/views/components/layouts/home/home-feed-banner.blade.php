{{--
path: resources/views/components/layouts/home/home-feed-banner.blade.php
component for : home-feed | root path : resources/views/livewire/pages/home-feed.blade.php
--}}

<div class="px-4"
     x-data="{
         activeSlide: 1,
         totalSlides: 2,
         timer: null,
         startAutoSlide() {
             this.timer = setInterval(() => {
                 this.activeSlide = this.activeSlide === this.totalSlides ? 1 : this.activeSlide + 1;
             }, 3000);
         },
         stopAutoSlide() {
             clearInterval(this.timer);
         }
     }"
     x-init="startAutoSlide()"
     @mouseenter="stopAutoSlide()"
     @mouseleave="startAutoSlide()">

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-4 shadow-md">
        <div x-show="activeSlide === 1"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-2"
             x-transition:enter-end="opacity-100 translate-x-0"
             class="space-y-1.5">
            <span class="bg-white/20 text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-full">Program KPR</span>
            <h3 class="text-sm font-bold leading-tight">Bunga KPR Spesial 2.5% p.a. Fixed 1 Tahun</h3>
            <p class="text-[11px] text-blue-100">Simulasikan cicilan hunian impianmu sekarang.</p>
        </div>

        <div x-show="activeSlide === 2"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-2"
             x-transition:enter-end="opacity-100 translate-x-0"
             class="space-y-1.5"
             x-cloak>
            <span class="bg-amber-400/30 text-amber-200 text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-full">Hot Promo</span>
            <h3 class="text-sm font-bold leading-tight">Bebas Biaya Notaris & BPHTB 100%</h3>
            <p class="text-[11px] text-blue-100">Khusus unit pilihan di area Jabodetabek.</p>
        </div>

        <!-- Indicator Dots (Lebih Besar & Interaktif) -->
        <div class="flex items-center gap-2 mt-4 justify-center">
            <button @click="activeSlide = 1"
                    class="h-2.5 rounded-full transition-all duration-300 focus:outline-none"
                    :class="activeSlide === 1 ? 'w-7 bg-white' : 'w-2.5 bg-white/40 hover:bg-white/60'"></button>
            <button @click="activeSlide = 2"
                    class="h-2.5 rounded-full transition-all duration-300 focus:outline-none"
                    :class="activeSlide === 2 ? 'w-7 bg-white' : 'w-2.5 bg-white/40 hover:bg-white/60'"></button>
        </div>
    </div>
</div>
