 <div>
     <label class="block text-xs font-semibold text-gray-700 mb-1.5">Deskripsi Listing <span
             class="text-red-500">*</span></label>
     <textarea wire:model="form.description" rows="5"
         placeholder="Bisa langsung tempel / paste pesan dari WhatsApp...&#10;&#10;Contoh:&#10;🏡 Rumah Siap Huni Asri&#10;📍 Lokasi Strategis Dekat Tol&#10;✨ Bebas Banjir & Keamanan 24 Jam"
         class="w-full rounded-md border border-gray-200 bg-gray-50/50 px-3.5 py-3 text-xs text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all whitespace-pre-line leading-relaxed font-sans"></textarea>
     @error('form.description')
         <span class="text-[11px] text-red-500 block mt-1">{{ $message }}</span>
     @enderror
 </div>
