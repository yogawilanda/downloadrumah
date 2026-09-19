{{-- resources/views/components/atoms/decorations/quick-presentation.blade.php --}}

<div
    x-data="{
        matched: false,
        interval: null,

        init() {
            this.interval = setInterval(() => {
                this.matched = !this.matched;
            }, 3000);
        },

        destroy() {
            clearInterval(this.interval);
        }
    }"
    class="
        relative
        mx-auto
        w-full
        max-w-md
        border
        border-slate-300
        bg-slate-50
        p-4
        antialiased
        transition-colors
        duration-500

        sm:max-w-lg
        sm:p-5

        dark:border-slate-800
        dark:bg-slate-900
    "
>

    {{-- ================================================================
    HEADER
    ================================================================= --}}
    <div class="
        mb-3
        flex
        items-center
        justify-between
        border-b
        border-slate-300
        pb-2.5

        dark:border-slate-800
    ">
        <span class="
            text-xs
            font-bold
            uppercase
            tracking-[0.18em]
            text-slate-500

            sm:text-sm

            dark:text-slate-400
        ">
            Need → Match
        </span>

        <span class="
            size-2
            bg-sky-500
            transition-all
            duration-500
        "
            :class="matched ? 'scale-125' : 'scale-75 opacity-50'"
        ></span>
    </div>


    {{-- ================================================================
    MATCH DIAGRAM
    ================================================================= --}}
    <div class="relative my-3 py-3 sm:py-4">

        {{-- Connector --}}
        <div
            class="
                absolute
                left-1/2
                top-1/2
                h-14
                w-px
                -translate-x-1/2
                -translate-y-1/2
                bg-slate-300
                transition-all
                duration-700

                sm:h-16

                dark:bg-slate-700
            "
            :class="matched ? 'bg-sky-400 dark:bg-sky-500' : ''"
        ></div>


        {{-- Match Point --}}
        <div
            class="
                absolute
                left-1/2
                top-1/2
                z-20
                flex
                size-8
                -translate-x-1/2
                -translate-y-1/2
                items-center
                justify-center
                border
                border-slate-400
                bg-slate-50
                text-slate-400
                transition-all
                duration-500

                sm:size-9

                dark:border-slate-600
                dark:bg-slate-900
            "
            :class="matched
                ? 'scale-110 border-sky-500 text-sky-500'
                : 'scale-90'"
        >
            <svg
                class="
                    size-4
                    transition-transform
                    duration-700

                    sm:size-5
                "
                :class="matched
                    ? 'rotate-180 text-sky-500'
                    : 'rotate-0 text-slate-400'"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2.5"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 10-5.656-5.656l-1.1 1.1"
                />
            </svg>
        </div>


        {{-- ============================================================
        USER A
        ============================================================= --}}
        <div
            class="
                relative
                z-10
                max-w-[85%]
                border
                border-slate-300
                bg-white
                p-3
                transition-all
                duration-700

                sm:max-w-[82%]
                sm:p-3.5

                dark:border-slate-700
                dark:bg-slate-800
            "
            :class="matched
                ? 'translate-x-1.5 translate-y-1 border-sky-400 dark:border-sky-500'
                : '-translate-x-1 -translate-y-0.5'"
        >
            <div class="flex items-center gap-3">

                <div class="
                    flex
                    size-8
                    shrink-0
                    items-center
                    justify-center
                    border
                    border-sky-200
                    bg-sky-50
                    text-xs
                    font-bold
                    text-sky-600

                    sm:size-9
                    sm:text-sm

                    dark:border-sky-900
                    dark:bg-sky-950
                    dark:text-sky-400
                ">
                    A
                </div>

                <div class="min-w-0">
                    <div class="
                        truncate
                        text-sm
                        font-semibold
                        text-slate-800

                        sm:text-base

                        dark:text-slate-100
                    ">
                        Butuh rumah
                    </div>

                    <div class="
                        mt-1
                        flex
                        items-center
                        gap-2
                        text-xs
                        text-slate-500

                        sm:text-sm

                        dark:text-slate-400
                    ">
                        <span>Bantul</span>
                        <span>•</span>

                        <span class="
                            border
                            border-slate-300
                            px-1.5
                            py-0.5
                            text-[10px]
                            font-semibold
                            uppercase
                            tracking-wide
                            text-slate-600

                            dark:border-slate-600
                            dark:text-slate-300
                        ">
                            KPR
                        </span>
                    </div>
                </div>

            </div>
        </div>


        {{-- ============================================================
        USER B
        ============================================================= --}}
        <div
            class="
                relative
                z-0
                -mt-4
                ml-auto
                max-w-[85%]
                border
                border-slate-300
                bg-slate-50
                p-3
                transition-all
                duration-700

                sm:-mt-5
                sm:max-w-[82%]
                sm:p-3.5

                dark:border-slate-700
                dark:bg-slate-800/90
            "
            :class="matched
                ? '-translate-x-1.5 -translate-y-1 border-indigo-400 bg-white dark:border-indigo-500 dark:bg-slate-800'
                : 'translate-x-1 translate-y-0.5'"
        >
            <div class="flex items-center justify-end gap-3 text-right">

                <div class="min-w-0">
                    <div class="
                        truncate
                        text-sm
                        font-semibold
                        text-slate-800

                        sm:text-base

                        dark:text-slate-100
                    ">
                        Punya properti
                    </div>

                    <div class="
                        mt-1
                        flex
                        items-center
                        justify-end
                        gap-2
                        text-xs
                        text-slate-500

                        sm:text-sm

                        dark:text-slate-400
                    ">
                        <span class="
                            border
                            border-slate-300
                            px-1.5
                            py-0.5
                            text-[10px]
                            font-semibold
                            uppercase
                            tracking-wide
                            text-slate-600

                            dark:border-slate-600
                            dark:text-slate-300
                        ">
                            Rumah
                        </span>

                        <span>•</span>
                        <span>Bantul</span>
                    </div>
                </div>

                <div class="
                    flex
                    size-8
                    shrink-0
                    items-center
                    justify-center
                    border
                    border-indigo-200
                    bg-indigo-50
                    text-xs
                    font-bold
                    text-indigo-600

                    sm:size-8
                    sm:text-sm

                    dark:border-indigo-900
                    dark:bg-indigo-950
                    dark:text-indigo-400
                ">
                    B
                </div>

            </div>
        </div>

    </div>


    {{-- ================================================================
    FOOTER
    ================================================================= --}}
    <div class="
        mt-3
        border-t
        border-slate-300
        pt-2.5
        text-center
        text-[10px]
        font-bold
        uppercase
        tracking-[0.18em]
        text-slate-500

        sm:text-xs

        dark:border-slate-800
        dark:text-slate-400
    ">
        DownloadRumah
    </div>

</div>
