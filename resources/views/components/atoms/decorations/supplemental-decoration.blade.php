<div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
    <svg viewBox="0 0 1200 760" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="absolute left-1/2 top-20 h-auto w-[900px] -translate-x-1/2 opacity-60 sm:w-[1100px]">
        {{-- architectural grid --}}
        <path d="M80 170H1120
                       M80 250H1120
                       M80 330H1120
                       M80 410H1120
                       M80 490H1120
                       M80 570H1120" stroke="currentColor" stroke-width="1"
            class="text-slate-300 dark:text-slate-800" />

        <path d="M180 90V650
                       M300 90V650
                       M420 90V650
                       M540 90V650
                       M660 90V650
                       M780 90V650
                       M900 90V650
                       M1020 90V650" stroke="currentColor" stroke-width="1"
            class="text-slate-300 dark:text-slate-800" />

        {{-- floor-plan fragments --}}
        <path d="M180 250H420V410H300V490H180V250Z
                       M660 170H900V330H780V410H660V170Z
                       M420 490H660V570H540V650H420V490Z" stroke="currentColor" stroke-width="1.25"
            class="text-slate-400/60 dark:text-slate-700" />

        {{-- connection lines --}}
        <path d="M300 330L540 250L780 330L900 250" stroke="currentColor" stroke-width="1.5" stroke-dasharray="4 7"
            class="text-sky-500/35" />

        {{-- nodes --}}
        <circle cx="300" cy="330" r="4" class="fill-sky-500/40" />

        <circle cx="540" cy="250" r="4" class="fill-sky-500/40" />

        <circle cx="780" cy="330" r="4" class="fill-sky-500/40" />

        <circle cx="900" cy="250" r="4" class="fill-sky-500/40" />

        {{-- corner markers --}}
        <path d="M110 140H150V180
                       M1050 140H1090V180
                       M110 580V620H150
                       M1050 620H1090V580" stroke="currentColor" stroke-width="1.5"
            class="text-slate-400/50 dark:text-slate-700" />
    </svg>
</div>
