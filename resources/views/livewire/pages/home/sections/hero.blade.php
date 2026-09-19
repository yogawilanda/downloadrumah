<x-layouts.structural-section framed
    class="border-b border-slate-300 bg-slate-200/20 dark:border-slate-800 dark:bg-slate-900/20">

    <div class="
        relative
        w-full
        min-h-screen
        overflow-hidden
        bg-slate-100
        px-4
        py-10
        dark:bg-slate-950

        sm:px-8
        sm:py-14

        md:px-12
        md:py-16

        lg:px-14
    ">

        {{-- ============================================================
        SUPPLEMENTAL DECORATION
        ============================================================= --}}
        @include('components.atoms.decorations.supplemental-decoration')


        {{-- ============================================================
        CONTENT
        ============================================================= --}}
        <div class="relative z-10">

            {{-- ========================================================
            HERO TITLE
            ========================================================= --}}
            @include('livewire.pages.home.sections.hero-title')


            {{-- ========================================================
            DISCOVERY — PRIMARY ACTION
            ========================================================= --}}
            <div class="
                relative
                z-20
                mx-auto
                mt-8
                max-w-5xl

                sm:mt-10
            ">
                <livewire:pages.home.discovery-intent variant="hero" />
            </div>
            

        </div>

    </div>

</x-layouts.structural-section>
