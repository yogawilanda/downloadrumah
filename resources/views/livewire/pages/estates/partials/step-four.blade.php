<div class="space-y-4">
    <h2 class="text-base font-bold text-center text-gray-900">Konfirmasi Listing</h2>
    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm space-y-2 text-xs">
        <p class="font-bold text-sm text-gray-800">{{ $form->title ?? '-' }}</p>
        <p class="text-amber-600 font-bold text-base">Rp {{ number_format((float)($form->price ?? 0), 0, ',', '.') }}</p>
        <p class="text-gray-500">{{ $form->city }}, {{ $form->province }}</p>
        <p class="text-gray-600 pt-2 border-t">{{ Str::limit($form->description, 100) }}</p>
    </div>
</div>
