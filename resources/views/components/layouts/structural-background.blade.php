{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
    | @path : resources/views/components/layouts/structural-background.blade.php
    | @usage : DownloadRumah Structural Visual Canvas — Reusable Page-Level Background System
    | @type : Blade Layout Component (Visual Infrastructure)
    | @parent : components.layouts.app
    |
    | @expected_data : [$slot]
    | @expected_events : []
    | @techstack : Laravel 13.17, Blade Components, Tailwind CSS
    | @design_tokens : Font: Outfit | Theme: White / Slate / Sky Accent | Dark Mode
    | @seo_context : Inherited from Parent Layout
    |
    | @ruling : Own structural decoration only. Content remains controlled by consumers.
    | @ruling_layout : Never define max-width. Consumers own content containers.
    | @ruling_ui : Rails, dot fields, intersections, and negative-space structure.
    | @ruling_layer : Decorative layers remain pointer-free and behind content.
    | @ruling_motion : No continuous decorative animation.
    | @ruling_performance : CSS-only decoration. No JS, images, or content-dependent computation.
    |
    | @status : Active — Structural Component Extraction
    | @author : yogawilanda <eaywilanda@gmail.com>
        | </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

@props([
'dots' => true,
'rails' => true,
'markers' => true,
])

<div {{ $attributes->class([
    'relative w-full overflow-hidden',
    'bg-slate-100 dark:bg-slate-950',
    ]) }}>

    <div aria-hidden="true" class="pointer-events-none absolute inset-0 z-0">

        @if ($rails)
        {{-- Primary vertical rails --}}
        <div class="structural-rail absolute inset-y-0 left-[4%] w-px
                       sm:left-[6%] lg:left-[8%]"></div>

        <div class="structural-rail absolute inset-y-0 right-[4%] w-px
                       sm:right-[6%] lg:right-[8%]"></div>

        {{-- Inner desktop rails --}}
        <div class="structural-rail-light absolute inset-y-0 left-[16%]
                       hidden w-px lg:block"></div>

        <div class="structural-rail-light absolute inset-y-0 right-[16%]
                       hidden w-px lg:block"></div>

        {{-- Horizontal construction rails --}}
        <div class="structural-rail-light absolute inset-x-0 top-[8%] h-px"></div>

        <div class="structural-rail-light absolute inset-x-0 top-[27%] h-px"></div>

        <div class="structural-rail-light absolute inset-x-0 top-[51%] h-px"></div>

        <div class="structural-rail-light absolute inset-x-0 top-[74%] h-px"></div>

        <div class="structural-rail-light absolute inset-x-0 bottom-[7%] h-px"></div>
        @endif

        @if ($dots)
        {{-- Primary dot field --}}
        <div class="structural-dot-field absolute right-[2%] top-[-30px]
                       h-[460px] w-[460px] opacity-70
                       sm:right-[6%] lg:right-[10%]"></div>

        {{-- Secondary dot field --}}
        <div class="structural-dot-field-small absolute bottom-[6%] left-[1%]
                       h-[300px] w-[360px] opacity-60
                       sm:left-[5%] lg:left-[11%]"></div>
        @endif

        @if ($markers)
        {{-- Sky markers --}}
        <span class="absolute left-[4%] top-[8%] h-2 w-2 bg-sky-500
                       sm:left-[6%] lg:left-[8%]"></span>

        <span class="absolute right-[4%] top-[27%] h-2 w-2
                       border border-slate-400 bg-white
                       dark:border-slate-600 dark:bg-slate-950
                       sm:right-[6%] lg:right-[8%]"></span>

        <span class="absolute left-[4%] top-[51%] h-2 w-2
                       border border-slate-300 bg-slate-100
                       dark:border-slate-700 dark:bg-slate-950
                       sm:left-[6%] lg:left-[8%]"></span>

        <span class="absolute right-[4%] top-[74%] h-2 w-2 bg-sky-400
                       sm:right-[6%] lg:right-[8%]"></span>
        @endif

    </div>

    <div class="relative z-10">
        {{ $slot }}
    </div>

</div>
