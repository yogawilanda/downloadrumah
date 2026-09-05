{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/auth/partials/login-form.blade.php
| @usage : Partial View for User Login Form with Google-style Transitions
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div x-show="mode === 'login'" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150 absolute top-0 w-full"
    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
    x-transition:leave-end="opacity-0 scale-95 translate-y-1">
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Selamat Datang! 👋</h1>
        <p class="text-xs text-gray-500 mt-1">Masuk untuk mengelola dan menemukan hunian di DownloadRumah.</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 text-xs rounded-xl flex items-center gap-2">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form wire:submit="login" class="space-y-4">
        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Email</label>
            <input wire:model="loginForm.email" type="email" required autocomplete="username"
                placeholder="nama@email.com"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none">
            <x-input-error :messages="$errors->get('loginForm.email') ?: $errors->get('email')" class="mt-1 text-xs" />
        </div>

        <div>
            <div class="flex items-center justify-between mb-1">
                <label class="block text-xs font-semibold text-gray-700">Password</label>
            </div>

            <div class="relative">
                <input wire:model="loginForm.password" :type="showPassword ? 'text' : 'password'" required
                    autocomplete="current-password" placeholder="••••••••"
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
            <x-input-error :messages="$errors->get('loginForm.password') ?: $errors->get('password')" class="mt-1 text-xs" />

            <div class="flex items-center justify-between mb-1 mt-2">
                @if (Route::has('password.request'))
                    <a class="text-xs text-blue-600 font-semibold hover:underline"
                        href="{{ route('password.request') }}" wire:navigate>Lupa Password?</a>
                @endif
            </div>
        </div>

        <label class="inline-flex items-center cursor-pointer">
            <input wire:model="loginForm.remember" type="checkbox"
                class="w-4 h-4 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
            <span class="ms-2 text-xs text-gray-600">Ingat Saya</span>
        </label>

        <div class="pt-2">
            <button type="submit" wire:loading.attr="disabled"
                class="relative w-full h-11 bg-blue-600 hover:bg-blue-700 active:scale-[0.99] text-white text-xs font-bold rounded-xl transition flex items-center justify-center disabled:opacity-80">

                {{-- State Normal --}}
                <span wire:loading.remove wire:target="login">
                    Masuk ke Akun
                </span>

                {{-- State Loading (Dipaksa inline-flex horizontal agar spinner selalu di samping) --}}
                <span wire:loading.inline-flex wire:target="login" class="items-center justify-center gap-2">
                    <svg class="animate-spin w-4 h-4 text-white shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span>Memproses...</span>
                </span>
            </button>
        </div>
    </form>
</div>
