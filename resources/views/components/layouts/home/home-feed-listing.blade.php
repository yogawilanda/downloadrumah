{{--
loc: resources\views\components\layouts\home\home-feed-listing.blade.php
usage: component for home-feed.blade.php
--}}
@props(['estates'])
<div class="px-4 pt-4 space-y-4">
    @forelse ($estates as $estate)
        <a href="{{ route('estates.show', $estate->slug) }}" wire:navigate
            class="block bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow">

            <!-- Image Container with Badges -->
            <div class="relative h-48 w-full bg-gray-200">
                <img src="{{ $estate->primaryImage?->url ?? 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=800&q=80' }}"
                    alt="{{ $estate->title }}" class="w-full h-full object-cover" />

                <!-- Transaction Badge -->
                <span
                    class="absolute top-3 left-3 px-2.5 py-1 text-[10px] font-bold tracking-wide uppercase rounded-lg text-white backdrop-blur-md {{ $estate->transaction_type === 'sale' ? 'bg-emerald-600/90' : 'bg-amber-600/90' }}">
                    {{ match ($estate->transaction_type) {
                        'sale' => 'Dijual',
                        'rent' => 'Disewakan',
                        'sale & rent' => 'Dijual & Disewakan',
                        default => 'Dijual',
                    } }}
                </span>

                <!-- Short Price Tag -->
                <div
                    class="absolute bottom-3 right-3 bg-gray-900/80 backdrop-blur-md text-white px-3 py-1 rounded-xl text-sm font-bold">
                    {{ $estate->short_price }}
                </div>
            </div>

            <!-- Content -->
            <div class="p-4">
                <h2 class="font-bold text-gray-900 text-base line-clamp-1 mb-1">{{ $estate->title }}</h2>

                <!-- Location Display (Fixed: Fetch City Name from Laravolt Relation) -->
                <p class="text-xs text-gray-500 flex items-center mb-3">
                    <svg class="w-3.5 h-3.5 mr-1 text-gray-400 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ $estate->city?->name }}{{ $estate->district ? ', ' . $estate->district : '' }}
                </p>

                <!-- Specs Strip -->
                <div class="flex items-center space-x-4 pt-3 border-t border-gray-100 text-xs text-gray-600">
                    @if ($estate->bedroom)
                        <div class="flex items-center space-x-1">
                            <span class="font-bold text-gray-800">{{ $estate->bedroom }}</span>
                            <span class="text-gray-400">KT</span>
                        </div>
                    @endif
                    @if ($estate->bathroom)
                        <div class="flex items-center space-x-1">
                            <span class="font-bold text-gray-800">{{ $estate->bathroom }}</span>
                            <span class="text-gray-400">KM</span>
                        </div>
                    @endif
                    @if ($estate->building_size)
                        <div class="flex items-center space-x-1">
                            <span class="font-bold text-gray-800">{{ $estate->building_size }}</span>
                            <span class="text-gray-400">m² (LB)</span>
                        </div>
                    @endif
                    @if ($estate->land_size)
                        <div class="flex items-center space-x-1">
                            <span class="font-bold text-gray-800">{{ $estate->land_size }}</span>
                            <span class="text-gray-400">m² (LT)</span>
                        </div>
                    @endif
                </div>
            </div>
        </a>
    @empty
        <div class="text-center py-12 bg-white rounded-2xl border border-gray-100">
            <p class="text-sm font-medium text-gray-500">Properti tidak ditemukan.</p>
            <p class="text-xs text-gray-400 mt-1">Coba ubah kata kunci atau filter pencarianmu.</p>
        </div>
    @endforelse

    <!-- Pagination -->
    <div class="pt-2">
        {{ $estates->links() }}
    </div>
</div>
