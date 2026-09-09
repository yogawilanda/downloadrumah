<section class="space-y-2">
    <p class="px-1 text-[10px] font-semibold uppercase tracking-wider text-gray-400">Menu aplikasi</p>
    <div class="grid grid-cols-2 gap-2">
        <a href="{{ route('dashboard.estates') }}" wire:navigate
            class="rounded-md border border-blue-100 bg-blue-50 p-3 text-xs font-bold text-blue-700">
            Kelola Listing Properti
        </a>
        <div class="rounded-md border border-gray-100 bg-white p-3 text-xs font-bold text-gray-500">
            Properti Disimpan <span class="block text-[10px] text-gray-400">Soon</span>
        </div>
        <div class="rounded-md border border-gray-100 bg-white p-3 text-xs font-bold text-gray-500">
            Riwayat KPR / Pengajuan <span class="block text-[10px] text-gray-400">Soon</span>
        </div>
        <a href="{{ route('profile') }}" wire:navigate
            class="rounded-md border border-gray-100 bg-white p-3 text-xs font-bold text-gray-500">
            Pengaturan Profil <span class="block text-[10px] text-gray-400">Soon</span>
        </a>
    </div>
</section>
