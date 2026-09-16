{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/auth/partials/login-form.blade.php
| @usage            : Login Form Partial for DownloadRumah Authentication
| @parent           : resources/views/livewire/pages/auth/auth-modal.blade.php
| @type              : Blade Partial View
| @expected_data    : [$errors, $loginForm]
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Authentication UI prioritizes clarity, trust, and minimal interaction friction.
| @ruling_ui        : Hard borders, restrained geometry, no decorative card shadows or rounded controls.
| @ruling_motion    : Short 150–200ms transitions only.
| @ruling_performance : Preserve Livewire loading states and Alpine password visibility state.
|
| @status            : Active
| @author            : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div x-show="mode === 'login'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0">

    {{-- Header --}}
    <div class="mb-6">

        <div class="mb-3 flex items-center gap-2">
            <span class="h-1.5 w-1.5 bg-sky-500"></span>

            <h1 class="text-2xl font-bold tracking-tight text-slate-950">
                Selamat Datang
            </h1>
        </div>

        <p class="mt-1.5 text-xs leading-5 text-slate-500">
            Masuk untuk mengelola properti dan melanjutkan eksplorasi di DownloadRumah.
        </p>

    </div>


    {{-- Validation --}}
    @if ($errors->any())
        <div class="mb-5 flex items-start gap-2.5 border border-rose-200 bg-rose-50 px-3.5 py-3 text-xs text-rose-700">
            <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif


    {{-- Form --}}
    <form wire:submit="login" class="space-y-5">
        {{-- Email --}}
        <div>
            <label class="mb-2 block text-xs font-semibold text-slate-700">
                Email
            </label>

            <input wire:model="loginForm.email" type="email" required autocomplete="username"
                placeholder="nama@email.com"
                class="w-full border border-slate-300 bg-white px-3.5 py-3 text-sm text-slate-900 outline-none transition-colors duration-150 placeholder:text-slate-300 focus:border-sky-400 focus:ring-0">
            <x-input-error :messages="$errors->get('loginForm.email') ?: $errors->get('email')" class="mt-1.5 text-xs" />
        </div>


        {{-- Password --}}
        <div>

            <div class="mb-2 flex items-center justify-between">

                <label class="block text-xs font-semibold text-slate-700">
                    Password
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" wire:navigate
                        class="text-[11px] font-semibold text-sky-600 transition-colors duration-150 hover:text-sky-700 hover:underline">
                        Lupa Password?
                    </a>
                @endif
            </div>


            <div class="relative">
                <input wire:model="loginForm.password" :type="showPassword ? 'text' : 'password'" required
                    autocomplete="current-password" placeholder="••••••••"
                    class="w-full border border-slate-300 bg-white px-3.5 py-3 pr-11 text-sm text-slate-900 outline-none transition-colors duration-150 placeholder:text-slate-300 focus:border-sky-400 focus:ring-0">

                <button type="button" @click="showPassword = !showPassword"
                    class="absolute right-3 top-1/2 flex h-7 w-7 -translate-y-1/2 items-center justify-center text-slate-400 transition-colors duration-150 hover:text-slate-700 focus:outline-none"
                    tabindex="-1" aria-label="Tampilkan atau sembunyikan password">

                    <svg x-show="!showPassword" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>

                    <svg x-show="showPassword" x-cloak class="h-4 w-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        aria-hidden="true">
                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                        <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                        <line x1="2" y1="2" x2="22" y2="22" />
                    </svg>

                </button>

            </div>

            <x-input-error :messages="$errors->get('loginForm.password') ?: $errors->get('password')" class="mt-1.5 text-xs" />

        </div>


        {{-- Remember --}}
        <label class="flex cursor-pointer items-center gap-2">

            <input wire:model="loginForm.remember" type="checkbox"
                class="h-4 w-4 border-slate-300 text-sky-600 shadow-none focus:ring-1 focus:ring-sky-400">

            <span class="text-xs font-medium text-slate-500">
                Ingat Saya
            </span>

        </label>


        {{-- Submit --}}
        <div class="pt-1">

            <button type="submit" wire:loading.attr="disabled"
                class="relative flex h-11 w-full items-center justify-center border border-slate-950 bg-slate-950 text-xs font-bold text-white transition-colors duration-150 hover:border-sky-600 hover:bg-sky-600 disabled:cursor-wait disabled:opacity-70">

                {{-- Normal --}}
                <span wire:loading.remove wire:target="login">
                    Masuk ke Akun
                </span>


                {{-- Loading --}}
                <span wire:loading.inline-flex wire:target="login" class="items-center justify-center gap-2">

                    <svg class="h-4 w-4 shrink-0 animate-spin text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>

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
