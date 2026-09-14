 <x-layouts.structural-section framed class="border-b border-slate-300 bg-white">

     <div
         class="grid min-h-[500px] items-center px-5 py-14 sm:px-8 md:px-12 md:py-20 lg:grid-cols-[0.9fr_1.1fr] lg:gap-16 lg:px-14">

         {{-- Hero copy --}}
         <div class="max-w-xl">

             <div class="mb-5 flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-sky-600">
                 <span class="h-1.5 w-1.5 bg-sky-500"></span>
                 DownloadRumah
             </div>

             <h1
                 class="max-w-lg text-[2.4rem] font-black leading-[1.01] tracking-[-0.045em] text-slate-950 sm:text-5xl lg:text-[3.6rem]">
                 Temukan tempat yang masuk akal untukmu.
             </h1>

             <p class="mt-5 max-w-md text-base font-medium leading-7 text-slate-600 lg:text-lg">
                 Lihat apa yang tersedia, pahami pilihannya, lalu tentukan langkah berikutnya.
             </p>

             <div class="mt-8 border-l-2 border-sky-500 pl-4">
                 <p class="max-w-sm text-xs font-semibold leading-5 text-slate-500">
                     Tidak harus langsung tahu apa yang dicari.
                     Mulai dari apa yang terasa menarik.
                 </p>
             </div>

         </div>

         {{-- Discovery surface --}}
         <div class="mt-10 lg:mt-0">


             @livewire(\App\Livewire\Pages\Home\DiscoveryIntent::class)

         </div>

     </div>

     {{-- Hero footer rail --}}
     <div class="grid border-t border-slate-300 bg-slate-50 sm:grid-cols-2">

         <div class="border-b border-slate-200 px-5 py-3.5 sm:border-b-0 sm:border-r sm:px-8 md:px-12 lg:px-14">
             <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                 Explore
             </span>
         </div>

         <div class="flex items-center justify-between gap-3 px-5 py-3.5 sm:px-8 md:px-12 lg:px-14">

             <span class="text-base font-medium text-slate-400">
                 Punya properti?
             </span>

             <a href="{{ auth()->check() ? route('estates.create') : route('login') }}"
                 class="text-[11px] font-bold text-sky-700 transition-colors duration-150 hover:text-sky-900">
                 Tambahkan properti →
             </a>

         </div>

     </div>

 </x-layouts.structural-section>
