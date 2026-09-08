{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/auth/partials/register-form.blade.php
| @usage : Partial View for User Register Form with Live Password Criteria
| @parent : resources/views/livewire/pages/auth/auth-modal.blade.php
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div x-show="mode === 'register'" x-cloak x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-200 transform absolute top-0 w-full"
    x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0">
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Buat Akun Baru ✨</h1>
        <p class="text-xs text-gray-500 mt-1">Daftar sekarang untuk mulai mencari atau memuat properti impian Anda.</p>
    </div>

    <form wire:submit="register" class="space-y-4">
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap</label>
            <input wire:model="registerForm.name" type="text" required placeholder="John Doe"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none">
            <x-input-error :messages="$errors->get('registerForm.name')" class="mt-1 text-xs" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Email</label>
            <input wire:model="registerForm.email" type="email" required placeholder="nama@email.com"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none">
            <x-input-error :messages="$errors->get('registerForm.email')" class="mt-1 text-xs" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor Telepon <span
                    class="text-red-500">*</span></label>
            <input wire:model="registerForm.phone_number" type="tel" inputmode="numeric" required
                placeholder="contoh: +628123456789 atau 08123456789"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none">
            <x-input-error :messages="$errors->get('registerForm.phone_number')" class="mt-1 text-xs" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Password</label>
            <div class="relative">
                <input wire:model.live="registerForm.password" :type="showPassword ? 'text' : 'password'" required
                    placeholder="••••••••"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none pr-11">
                <button type="button" @click="showPassword = !showPassword"
                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition focus:outline-none"
                    tabindex="-1">
                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                        <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                        <line x1="2" y1="2" x2="22" y2="22" />
                    </svg>
                </button>
            </div>

            {{-- Real-time Kriteria Password --}}
            <div class="mt-2 p-2.5 bg-gray-50 rounded-xl text-xs space-y-1 text-gray-600 border border-gray-100">
                <p class="font-medium text-gray-700">Kriteria kata sandi:</p>
                <div class="grid grid-cols-2 gap-1">
                    <span class="{{ strlen($registerForm->password) >= 8 ? 'text-emerald-600 font-medium' : '' }}">•
                        Min. 8 Karakter {{ strlen($registerForm->password) >= 8 ? '✓' : '' }}</span>
                    <span
                        class="{{ preg_match('/[A-Z]/', $registerForm->password) && preg_match('/[a-z]/', $registerForm->password) ? 'text-emerald-600 font-medium' : '' }}">•
                        Huruf Besar & Kecil
                        {{ preg_match('/[A-Z]/', $registerForm->password) && preg_match('/[a-z]/', $registerForm->password) ? '✓' : '' }}</span>
                    <span
                        class="{{ preg_match('/[0-9]/', $registerForm->password) ? 'text-emerald-600 font-medium' : '' }}">•
                        Mengandung Angka {{ preg_match('/[0-9]/', $registerForm->password) ? '✓' : '' }}</span>
                    <span
                        class="{{ preg_match('/[\W_]/', $registerForm->password) ? 'text-emerald-600 font-medium' : '' }}">•
                        Simbol (@$!%*#?&) {{ preg_match('/[\W_]/', $registerForm->password) ? '✓' : '' }}</span>
                </div>
            </div>
            <x-input-error :messages="$errors->get('registerForm.password')" class="mt-1 text-xs" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
            <div class="relative">
                <input wire:model.live="registerForm.password_confirmation" :type="showPassword ? 'text' : 'password'"
                    required placeholder="••••••••"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none pr-11">
            </div>
            @if (strlen($registerForm->password_confirmation) > 0)
                <p
                    class="mt-1 text-xs {{ $registerForm->password === $registerForm->password_confirmation ? 'text-emerald-600' : 'text-red-500' }}">
                    {{ $registerForm->password === $registerForm->password_confirmation ? '✓ Kata sandi cocok' : '✗ Kata sandi belum cocok' }}
                </p>
            @endif
            <x-input-error :messages="$errors->get('registerForm.password_confirmation')" class="mt-1 text-xs" />
        </div>

        <div class="pt-2">
            <button type="submit" wire:loading.attr="disabled"
                class="w-full bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white font-bold py-3.5 px-4 rounded-2xl shadow-lg shadow-blue-100 transition duration-150 flex items-center justify-center disabled:opacity-70">
                <span wire:loading.remove wire:target="register" class="text-sm">Daftar Akun</span>
                <span wire:loading wire:target="register" class="text-sm flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Memproses...
                </span>
            </button>
        </div>
    </form>
</div>
