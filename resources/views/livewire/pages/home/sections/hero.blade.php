{{-- ----------- Yoga Wilanda Documentation v1.1.7 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogwilanda@gmail.com>
        1. path__________________: resources/views/livewire/pages/home/sections/hero.blade.php
        2. controller____________:
        <livewire:pages.home.guest-intent-controller />
        <livewire:pages.home.discovery-intent />

        3. view_dependency_______:
        <livewire:pages.home.home-feed />
        4. usage_________________: DownloadRumah — Guest Intent Experience
        5. type__________________: Livewire View
        6. expected_data_________: [intent, step, propertyType, searchState, location, budget, purpose]
        7. purpose_______________: Render the homepage Hero orientation and Discovery entry surface.
        8. ruling________________: State and business logic remain in GuestIntentController;
        semantic mapping remains in GuestIntentMap.
        9. ruling_structure______: Hero → Discovery Intent → Guest Intent Controller
        10. status_______________: Active
</meta_config>
------------------- For Blade With Params ----------------------
--}}

<x-layouts.structural-section framed
    class="border-b border-slate-300 bg-slate-200/20 dark:border-slate-800 dark:bg-slate-900/20">

    <div class="bg-slate-100 px-5 py-14 dark:bg-slate-950 sm:px-8 md:px-12 md:py-20 lg:px-14">

        {{-- ============================================================
        HERO
        ============================================================= --}}

        @include('livewire.pages.home.sections.hero-title')


        {{-- ============================================================
        DISCOVERY
        Free search + intent gateways
        ============================================================= --}}

        {{-- ============================================================
        DISCOVERY
        Free search + intent gateways
        ============================================================= --}}

        <div class="mx-auto mt-12 max-w-5xl">

           <livewire:pages.home.discovery-intent variant="hero" />

        </div>

    </div>

</x-layouts.structural-section>
