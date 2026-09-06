@props(['title', 'subtitle', 'estates'])

<section class="space-y-1">
    <div class="flex items-center justify-between px-4 pt-2">
        <div>
            <h2 class="text-base font-bold leading-tight text-gray-800">{{ $title }}</h2>
            <p class="text-xs text-gray-500">{{ $subtitle }}</p>
        </div>
        <a href="{{ route('listings.index') }}" wire:navigate class="text-xs font-bold text-blue-600">Lihat Semua</a>
    </div>
    <x-layouts.home.home-feed-listing :estates="$estates" />
</section>
