{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/tools/mortgage-calculator.blade.php
| @usage : Responsive View Component for KPR Mortgage Calculator Tool
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
|--------------------------------------------------------------------------
--}}

<div class="bg-gray-50/50 min-h-screen py-6 md:py-10 px-3 sm:px-6 lg:px-8">
    <div x-data="kprApp"
        class="max-w-md md:max-w-3xl lg:max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 bg-white rounded-md md:rounded-md shadow-sm border border-gray-100 transition-all duration-300">

        <!-- Tab Switcher Header -->
        <div class="flex p-1 bg-gray-100/80 rounded-md text-xs sm:text-sm font-semibold max-w-md mx-auto mb-6">
            <button type="button"
                @click="mode = 'buyer'"
                :class="mode === 'buyer' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-2.5 rounded-md transition-all duration-200 text-center">
                Cari Sesuai Budget
            </button>

            <button type="button"
                @click="mode = 'agent'"
                :class="mode === 'agent' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-2.5 rounded-md transition-all duration-200 text-center">
                Hitung Cicilan Unit
            </button>
        </div>

        <!-- Mode Extension Renderers -->
        @include('livewire.pages.tools.extension.buyer')
        @include('livewire.pages.tools.extension.object')

    </div>
</div>
