{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/components/layouts/home/home-feed-banner.blade.php
| @usage            : Home Feed — Contextual Discovery Message
| @type             : Presentational Component
| @techstack        : Laravel 13.17, Alpine.js 3.x, Tailwind CSS
|
| @ruling           : Do not position DownloadRumah as a listing marketplace or advertising platform.
| @ruling_ui        : Quiet supporting surface; no promotional carousel.
| @ruling_motion    : No continuous animation.
| @ruling_performance : Static content only.
|
| @status           : Active
| @author           : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}





<div class="grid gap-6 md:grid-cols-[1fr_auto] md:items-center">

    <div class="max-w-2xl">

        <div class="mb-2 flex items-center gap-2">

            <span class="h-1 w-5 bg-sky-500"></span>

            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                Cara kami bekerja
            </p>

        </div>

        <h3 class="text-base font-bold leading-snug tracking-tight text-slate-900 sm:text-lg">
            Tidak semua orang datang dengan kebutuhan yang sudah jelas.
        </h3>

        <p class="mt-2 text-xs leading-5 text-slate-500 sm:text-sm">
            Karena itu, DownloadRumah membantu mempertemukan kebutuhan,
            properti, dan orang yang tepat sebelum percakapan dimulai.
        </p>

    </div>

    <div class="hidden md:block">

        <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">

            <span>Intent</span>
            <span class="text-sky-500">→</span>
            <span>Match</span>
            <span class="text-sky-500">→</span>
            <span>Conversation</span>

        </div>

    </div>

</div>
