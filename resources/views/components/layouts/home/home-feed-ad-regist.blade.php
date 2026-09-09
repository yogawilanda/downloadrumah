<div class="px-4">
    <div class="flex items-center justify-between rounded-2xl p-4 text-blue shadow-md">
        <div class="space-y-0.5">
            <p class="text-[14px] font-medium text-slate-800">Punya Properti?</p>
            <h3 class="text-xs font-bold text-blue-600">Jual atau Sewakan Propertimu</h3>
            <p class="text-[10px] text-slate-600">Pasang iklan gratis hanya dalam 2 menit.</p>
        </div>
        <a href="{{ auth()->check() ? route('estates.create') : route('login') }}" wire:navigate
            class="shrink-0 rounded-xl bg-blue-600 px-3 py-2 text-xs font-semibold text-white shadow-sm transition active:scale-95 hover:bg-blue-500">
            + Pasang Iklan
        </a>
    </div>
</div>
