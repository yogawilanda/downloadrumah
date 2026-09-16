{{-- ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path             : resources/views/livewire/pages/auth/partials/register-form.blade.php
| @usage            : Registration Form Partial for DownloadRumah Authentication
| @parent           : resources/views/livewire/pages/auth/auth-modal.blade.php
| @type              : Blade Partial View
| @expected_data    : [$errors, $registerForm]
| @design_tokens    : Font: Outfit | Theme: White / Slate / Sky Accent
|
| @ruling           : Registration UI prioritizes clarity, trust, and low interaction friction.
| @ruling_ui        : Hard borders, restrained geometry, no decorative card shadows or rounded controls.
| @ruling_motion    : Short 150–200ms transitions only.
| @ruling_performance : Preserve Livewire validation and real-time password feedback.
|
| @status            : Active
| @author            : yogawilanda <eayogawilanda@gmail.com>
| </meta_config>
-------------------------------------------------------------------------------------------------------- --}}

<div
    x-show="mode === 'register'"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
>

    {{-- Header --}}
    <div class="mb-5">

        <div class="mb-3 flex items-center gap-2">
            <span class="h-1.5 w-1.5 bg-sky-500"></span>

            <h1 class="text-2xl font-bold tracking-tight text-slate-950">
                Buat Akun Baru
            </h1>
        </div>

        <p class="mt-1.5 text-xs leading-5 text-slate-500">
            Daftar untuk mulai mencari, menyimpan, atau menawarkan properti di DownloadRumah.
        </p>

    </div>


    <form wire:submit="register" class="space-y-4">

        {{-- Name & Phone --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <div>

                <label class="mb-2 block text-xs font-semibold text-slate-700">
                    Nama Lengkap
                </label>

                <input
                    wire:model="registerForm.name"
                    type="text"
                    required
                    placeholder="John Doe"
                    class="w-full border border-slate-300 bg-white px-3.5 py-3 text-sm text-slate-900 outline-none transition-colors duration-150 placeholder:text-slate-300 focus:border-sky-400 focus:ring-0"
                >

                <x-input-error
                    :messages="$errors->get('registerForm.name')"
                    class="mt-1.5 text-xs"
                />

            </div>


            <div>

                <label class="mb-2 block text-xs font-semibold text-slate-700">
                    Nomor Telepon
                </label>

                <input
                    wire:model="registerForm.phone_number"
                    type="tel"
                    inputmode="numeric"
                    required
                    placeholder="08123456789"
                    class="w-full border border-slate-300 bg-white px-3.5 py-3 text-sm text-slate-900 outline-none transition-colors duration-150 placeholder:text-slate-300 focus:border-sky-400 focus:ring-0"
                >

                <x-input-error
                    :messages="$errors->get('registerForm.phone_number')"
                    class="mt-1.5 text-xs"
                />

            </div>

        </div>


        {{-- Email --}}
        <div>

            <label class="mb-2 block text-xs font-semibold text-slate-700">
                Email
            </label>

            <input
                wire:model="registerForm.email"
                type="email"
                required
                placeholder="nama@email.com"
                class="w-full border border-slate-300 bg-white px-3.5 py-3 text-sm text-slate-900 outline-none transition-colors duration-150 placeholder:text-slate-300 focus:border-sky-400 focus:ring-0"
            >

            <x-input-error
                :messages="$errors->get('registerForm.email')"
                class="mt-1.5 text-xs"
            />

        </div>


        {{-- Passwords --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <div>

                <label class="mb-2 block text-xs font-semibold text-slate-700">
                    Password
                </label>

                <div class="relative">

                    <input
                        wire:model.live="registerForm.password"
                        :type="showPassword ? 'text' : 'password'"
                        required
                        placeholder="••••••••"
                        class="w-full border border-slate-300 bg-white px-3.5 py-3 pr-11 text-sm text-slate-900 outline-none transition-colors duration-150 placeholder:text-slate-300 focus:border-sky-400 focus:ring-0"
                    >

                    <button
                        type="button"
                        @click="showPassword = !showPassword"
                        class="absolute right-3 top-1/2 flex h-7 w-7 -translate-y-1/2 items-center justify-center text-slate-400 transition-colors duration-150 hover:text-slate-700 focus:outline-none"
                        tabindex="-1"
                        aria-label="Tampilkan atau sembunyikan password"
                    >

                        <svg
                            x-show="!showPassword"
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>

                        <svg
                            x-show="showPassword"
                            x-cloak
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                            <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                            <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                            <line x1="2" y1="2" x2="22" y2="22" />
                        </svg>

                    </button>

                </div>

                <x-input-error
                    :messages="$errors->get('registerForm.password')"
                    class="mt-1.5 text-xs"
                />

            </div>


            <div>

                <label class="mb-2 block text-xs font-semibold text-slate-700">
                    Konfirmasi Password
                </label>

                <input
                    wire:model.live="registerForm.password_confirmation"
                    :type="showPassword ? 'text' : 'password'"
                    required
                    placeholder="••••••••"
                    class="w-full border border-slate-300 bg-white px-3.5 py-3 text-sm text-slate-900 outline-none transition-colors duration-150 placeholder:text-slate-300 focus:border-sky-400 focus:ring-0"
                >

                <x-input-error
                    :messages="$errors->get('registerForm.password_confirmation')"
                    class="mt-1.5 text-xs"
                />

            </div>

        </div>


        {{-- Password Requirements --}}
        <div class="border-y border-slate-200 py-3">

            <div class="mb-2 flex items-center gap-2">
                <span class="h-1 w-1 bg-slate-300"></span>

                <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">
                    Kriteria Password
                </p>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-1.5 text-[10px]">

                <span class="{{ strlen($registerForm->password) >= 8 ? 'font-semibold text-emerald-600' : 'text-slate-400' }}">
                    {{ strlen($registerForm->password) >= 8 ? '✓' : '•' }}
                    Min. 8 karakter
                </span>

                <span class="{{ preg_match('/[A-Z]/', $registerForm->password) && preg_match('/[a-z]/', $registerForm->password) ? 'font-semibold text-emerald-600' : 'text-slate-400' }}">
                    {{ preg_match('/[A-Z]/', $registerForm->password) && preg_match('/[a-z]/', $registerForm->password) ? '✓' : '•' }}
                    Huruf besar & kecil
                </span>

                <span class="{{ preg_match('/[0-9]/', $registerForm->password) ? 'font-semibold text-emerald-600' : 'text-slate-400' }}">
                    {{ preg_match('/[0-9]/', $registerForm->password) ? '✓' : '•' }}
                    Mengandung angka
                </span>

                <span class="{{ preg_match('/[\W_]/', $registerForm->password) ? 'font-semibold text-emerald-600' : 'text-slate-400' }}">
                    {{ preg_match('/[\W_]/', $registerForm->password) ? '✓' : '•' }}
                    Mengandung simbol
                </span>

            </div>

        </div>


        {{-- Password Match --}}
        @if (strlen($registerForm->password_confirmation) > 0)

            <p class="text-[11px] font-medium {{ $registerForm->password === $registerForm->password_confirmation ? 'text-emerald-600' : 'text-rose-500' }}">
                {{ $registerForm->password === $registerForm->password_confirmation
                    ? '✓ Kata sandi cocok'
                    : '✗ Kata sandi belum cocok' }}
            </p>

        @endif


        {{-- Submit --}}
        <div class="pt-1">

            <button
                type="submit"
                wire:loading.attr="disabled"
                class="flex h-11 w-full items-center justify-center border border-slate-950 bg-slate-950 px-4 text-xs font-bold text-white transition-colors duration-150 hover:border-sky-600 hover:bg-sky-600 disabled:cursor-wait disabled:opacity-70"
            >

                <span
                    wire:loading.remove
                    wire:target="register"
                >
                    Daftar Akun
                </span>

                <span
                    wire:loading.inline-flex
                    wire:target="register"
                    class="items-center justify-center gap-2"
                >

                    <svg
                        class="h-4 w-4 shrink-0 animate-spin text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>

                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018 8V0C5.373 0 0 5.373 0 12h4z"
                        ></path>

                    </svg>

                    <span>Memproses...</span>

                </span>

            </button>

        </div>

    </form>

</div>
