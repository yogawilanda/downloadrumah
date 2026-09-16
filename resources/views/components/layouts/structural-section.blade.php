{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/components/layouts/structural-section.blade.php
| @usage            : DownloadRumah Structural Section Frame — Responsive Content Boundary
| @type             : Blade Layout Component (Section Infrastructure)
| @parent           : components.layouts.structural-background
|
| @expected_data    : [$slot]
| @expected_events  : []
| @techstack        : Laravel 13.17, Blade Components, Tailwind CSS
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent | Dark Mode
| @seo_context      : Inherited from Parent Layout
|
| @ruling           : Provide reusable section boundaries without owning page content.
| @ruling_layout    : Standard content width is max-w-6xl. Consumers may override container classes.
| @ruling_ui        : Restrained borders. No unnecessary rounding.
| @ruling_motion    : No continuous decorative animation.
| @ruling_performance : Layout-only component with minimal DOM depth.
|
| @status           : Active — Structural Component Extraction
| @author           : yogawilanda <eaywilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

@props([
    'framed' => false,
])

<section {{ $attributes->class('w-full') }}>

    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

        <div @class([
            'border-x border-slate-300 dark:border-slate-800' => $framed,
        ])>
            {{ $slot }}
        </div>

    </div>

</section>
