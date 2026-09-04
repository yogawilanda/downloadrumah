{{-- path: resources/views/components/layouts/home/home-feed-banner.blade.php --}}
<div class="px-4"
     x-data="{
         activeSlide: 1,
         totalSlides: 2,
         timer: null,
         startAutoSlide() {
             this.timer = setInterval(() => {
                 this.activeSlide = this.activeSlide === this.totalSlides ? 1 : this.activeSlide + 1;
             }, 4000);
         },
         stopAutoSlide() {
             clearInterval(this.timer);
         }
     }"
     x-init="startAutoSlide()"
     @mouseenter="stopAutoSlide()"
     @mouseleave="startAutoSlide()">

    {{-- Gradient Option A: Slate Navy to Indigo (Sangat Elegan) --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-800 to-indigo-900 text-white p-5 shadow-lg border border-slate-800/50">

        {{-- Slide 1: Untuk Pengunjung / Pencari Properti --}}
        <div x-show="activeSlide === 1"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-2"
             x-transition:enter-end="opacity-100 translate-x-0"
             class="space-y-2">
            <span class="inline-block bg-amber-400/20 border border-amber-400/30 text-amber-300 text-xs font-bold tracking-wide px-2.5 py-0.5 rounded-full">
                🔥 Enggak Perlu Panas-Panasan
            </span>
            <h3 class="text-base font-bold leading-snug tracking-tight text-white">
                Cek Properti Lengkap Cukup dari HP
            </h3>
            <p class="text-xs md:text-sm text-slate-200 leading-relaxed">
                Lihat-lihat dulu aja! Temukan pilihan hunian dengan harga yang paling pas sebelum survey lokasi.
            </p>
        </div>

        {{-- Slide 2: Untuk Marketing / Agen --}}
        <div x-show="activeSlide === 2"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-2"
             x-transition:enter-end="opacity-100 translate-x-0"
             class="space-y-2"
             x-cloak>
            <span class="inline-block bg-white/15 border border-white/20 text-blue-200 text-xs font-bold tracking-wide px-2.5 py-0.5 rounded-full">
                💼 Untuk Marketing & Agen
            </span>
            <h3 class="text-base font-bold leading-snug tracking-tight text-white">
                Simpan & Kelola Semua Listingmu
            </h3>
            <p class="text-xs md:text-sm text-slate-200 leading-relaxed">
                Jadikan platform ini alat marketing andalanmu untuk pajang properti dan jangkau calon pembeli.
            </p>
        </div>

        {{-- Indicator Dots --}}
        <div class="flex items-center gap-2 mt-4 justify-center">
            <button @click="activeSlide = 1"
                    class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                    :class="activeSlide === 1 ? 'w-7 bg-white' : 'w-2 bg-white/40 hover:bg-white/60'"></button>
            <button @click="activeSlide = 2"
                    class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                    :class="activeSlide === 2 ? 'w-7 bg-white' : 'w-2 bg-white/40 hover:bg-white/60'"></button>
        </div>
    </div>
</div>
