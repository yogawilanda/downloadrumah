{{-- disini juga butuh listing_status, aku belum mikir apa aja, tapi availibity status juga kepake disini --}}
<div class="w-full pb-32 pt-4 px-4 max-w-md mx-auto space-y-4">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-base font-bold text-gray-900">Listing Properti Saya</h1>
        <a href="{{ route('estates.create') }}"
            class="px-3 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-xl active:scale-95 transition">
            + Properti
        </a>
    </div>

    <!-- Navigation Tab -->
    <div class="flex bg-gray-100 p-1 rounded-xl">
        <button wire:click="setTab('my_listings')"
            class="flex-1 py-1.5 text-xs font-bold rounded-lg transition {{ $tab === 'my_listings' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500' }}">
            Properti Saya
        </button>
        <button wire:click="setTab('co_broke')"
            class="flex-1 py-1.5 text-xs font-bold rounded-lg transition {{ $tab === 'co_broke' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500' }}">
            Co-Broke (Networking)
        </button>
    </div>

    <div class="space-y-3">
        @forelse($estates as $estate)
            <x-estates.management-card :estate="$estate" :tab="$tab" />
        @empty
            <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center text-xs text-gray-400">
                Belum ada listing pada kategori ini.
            </div>
        @endforelse

        {{ $estates->links() }}
    </div>
</div>
