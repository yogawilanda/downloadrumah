{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/auth/partials/register-form.blade.php
| @usage : Partial View for User Register Form with Password Toggle & Error Handling
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div
    x-show="mode === 'register'"
    x-cloak
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-200 transform absolute top-0 w-full"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
>
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Buat Akun Baru ✨</h1>
        <p class="text-xs text-gray-500 mt-1">Daftar sekarang untuk mulai mencari atau memuat properti impian Anda.</p>
    </div>

    <form wire:submit="register" class="space-y-4">
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap</label>
            <input
                wire:model="registerForm.name"
                type="text"
                required
                placeholder="John Doe"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none"
            >
            <x-input-error :messages="$errors->get('registerForm.name')" class="mt-1 text-xs" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Email</label>
            <input
                wire:model="registerForm.email"
                type="email"
                required
                placeholder="nama@email.com"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none"
            >
            <x-input-error :messages="$errors->get('registerForm.email')" class="mt-1 text-xs" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor Telepon</label>
            <input
                wire:model="registerForm.phone_number"
                type="text"
                required
                placeholder="081234567890"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none"
            >
            <x-input-error :messages="$errors->get('registerForm.phone_number')" class="mt-1 text-xs" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Password</label>
            <div class="relative">
                <input
                    wire:model="registerForm.password"
                    :type="showPassword ? 'text' : 'password'"
                    required
                    placeholder="••••••••"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none pr-11"
                >
                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition focus:outline-none"
                    tabindex="-1"
                >
                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.018 10.018 0 013.882-.863c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m-4.692-4.692a3 3 0 00-4.243-4.243"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('registerForm.password')" class="mt-1 text-xs" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
            <div class="relative">
                <input
                    wire:model="registerForm.password_confirmation"
                    :type="showPassword ? 'text' : 'password'"
                    required
                    placeholder="••••••••"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none pr-11"
                >
                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition focus:outline-none"
                    tabindex="-1"
                >
                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.018 10.018 0 013.882-.863c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m-4.692-4.692a3 3 0 00-4.243-4.243"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('registerForm.password_confirmation')" class="mt-1 text-xs" />
        </div>

        <div class="pt-2">
            <button type="submit" wire:loading.attr="disabled" class="w-full bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white font-bold py-3.5 px-4 rounded-2xl shadow-lg shadow-blue-100 transition duration-150 flex items-center justify-center disabled:opacity-70">
                <span wire:loading.remove wire:target="register" class="text-sm">Daftar Akun</span>
                <span wire:loading wire:target="register" class="text-sm flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Memproses...
                </span>
            </button>
        </div>
    </form>
</div>
