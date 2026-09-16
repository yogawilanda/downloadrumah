{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/auth/reset-password.blade.php
| @usage      : Livewire Volt component for user password reset page
| @version    : 1.1.6
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] class extends Component {
    #[Locked]
    public string $token = '';

    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->string('email');
    }

    public function resetPassword(): void
    {
        $this->email = preg_replace('/[\'%"<>]/', '', trim($this->email));

        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Rules\Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);

        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            $this->addError('email', __($status));
            return;
        }

        Session::flash('status', __($status));
        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div class="flex min-h-screen items-center justify-center bg-slate-50/50 px-3.5 py-6
            sm:px-4 sm:py-8 md:py-12 dark:bg-slate-950">

    {{-- Container Card --}}
    <div class="grid h-auto w-full max-w-full grid-cols-1 overflow-hidden rounded-md
                border border-slate-200 bg-white sm:max-w-lg sm:shadow-lg md:max-w-2xl
                lg:max-w-4xl lg:grid-cols-12 xl:max-w-5xl
                dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">

        {{-- LEFT COLUMN: Desktop Visual Branding Hero --}}
        <div class="relative hidden flex-col justify-between overflow-hidden bg-gradient-to-br
                    from-sky-600 to-sky-800 p-8 text-white lg:col-span-5 lg:flex">

            <div class="relative z-10">
                <a
                    href="{{ route('login') }}"
                    wire:navigate
                    class="inline-flex items-center gap-2 text-xs font-semibold text-white/80
                           transition hover:text-white"
                >
                    <span>← Kembali ke Masuk</span>
                </a>

                <div class="mt-10 space-y-3">
                    <h2 class="text-2xl font-black leading-tight tracking-tight">
                        Buat Kata Sandi Baru.
                    </h2>

                    <p class="text-xs leading-relaxed text-sky-100/90">
                        Amankan akun kamu dengan kata sandi yang kuat dan mudah kamu ingat.
                    </p>
                </div>
            </div>

            {{-- Aesthetic Badge --}}
            <div class="relative z-10 rounded-md border border-white/15 bg-white/10 p-4 backdrop-blur-md">
                <p class="text-xs font-medium text-sky-50">
                    🔑 "Gunakan kombinasi simbol, angka, dan huruf untuk keamanan maksimal."
                </p>
            </div>

            <div
                class="pointer-events-none absolute -bottom-16 -right-16 h-64 w-64
                       rounded-full bg-sky-400/30 blur-2xl"
            ></div>
        </div>

        {{-- RIGHT COLUMN: Auth Form Area --}}
        <div class="relative flex flex-col justify-start bg-white p-5 pb-8
                    sm:p-8 lg:col-span-7 dark:bg-slate-900">

            {{-- Top Navigation Header --}}
            <div class="mb-4 flex items-center justify-between sm:mb-6">
                <a
                    href="{{ route('login') }}"
                    wire:navigate
                    class="-ml-2 rounded-full p-2 text-slate-600 transition hover:bg-slate-100
                           lg:hidden dark:text-slate-400 dark:hover:bg-slate-800"
                >
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </a>

                <span class="text-xs font-bold uppercase tracking-wider text-slate-400
                             dark:text-slate-500">
                    Atur Ulang Kata Sandi
                </span>

                <div class="w-8 lg:hidden"></div>
            </div>

            <div class="mb-5">
                <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                    Atur Ulang Kata Sandi
                </h2>

                <p class="mt-1 text-xs leading-relaxed text-slate-500 dark:text-slate-400">
                    Silakan buat kata sandi baru untuk akun kamu.
                </p>
            </div>

            {{-- Form Wrapper --}}
            <form wire:submit="resetPassword" class="space-y-4">

                {{-- Email --}}
                <div>
                    <label
                        for="email"
                        class="mb-1.5 block text-xs font-bold text-slate-700 dark:text-slate-300"
                    >
                        Alamat Email
                    </label>

                    <input
                        wire:model="email"
                        id="email"
                        type="email"
                        required
                        readonly
                        class="w-full cursor-not-allowed rounded-md border border-slate-200
                               bg-slate-50 px-3.5 py-2.5 text-xs text-slate-500
                               dark:border-slate-700 dark:bg-slate-950
                               dark:text-slate-500"
                    />
                </div>

                {{-- New Password --}}
                <div>
                    <label
                        for="password"
                        class="mb-1.5 block text-xs font-bold text-slate-700 dark:text-slate-300"
                    >
                        Kata Sandi Baru
                    </label>

                    <input
                        wire:model.live="password"
                        id="password"
                        type="password"
                        required
                        autofocus
                        placeholder="••••••••"
                        class="w-full rounded-md border px-3.5 py-2.5 text-xs text-slate-900
                               transition placeholder:text-slate-400 focus:outline-none
                               focus:ring-2 focus:ring-sky-500
                               dark:bg-slate-950 dark:text-slate-100
                               dark:placeholder:text-slate-600
                               @error('password')
                                   border-rose-500 dark:border-rose-500
                               @else
                                   border-slate-200 dark:border-slate-700
                                   focus:border-sky-500 dark:focus:border-sky-500
                               @enderror"
                    />

                    {{-- Password Criteria --}}
                    <div
                        class="mt-2 space-y-1.5 rounded-md border border-slate-100
                               bg-slate-50 p-3 text-xs text-slate-600
                               dark:border-slate-800 dark:bg-slate-950 dark:text-slate-400"
                    >
                        <p class="font-bold text-slate-700 dark:text-slate-300">
                            Kriteria kata sandi:
                        </p>

                        <div class="grid grid-cols-2 gap-1.5 text-[11px]">
                            <span class="{{ strlen($password) >= 8
                                ? 'font-semibold text-emerald-600 dark:text-emerald-400'
                                : 'text-slate-500 dark:text-slate-500' }}">
                                • Min. 8 Karakter
                                {{ strlen($password) >= 8 ? '✓' : '' }}
                            </span>

                            <span class="{{ preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password)
                                ? 'font-semibold text-emerald-600 dark:text-emerald-400'
                                : 'text-slate-500 dark:text-slate-500' }}">
                                • Huruf Besar & Kecil
                                {{ preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) ? '✓' : '' }}
                            </span>

                            <span class="{{ preg_match('/[0-9]/', $password)
                                ? 'font-semibold text-emerald-600 dark:text-emerald-400'
                                : 'text-slate-500 dark:text-slate-500' }}">
                                • Mengandung Angka
                                {{ preg_match('/[0-9]/', $password) ? '✓' : '' }}
                            </span>

                            <span class="{{ preg_match('/[\W_]/', $password)
                                ? 'font-semibold text-emerald-600 dark:text-emerald-400'
                                : 'text-slate-500 dark:text-slate-500' }}">
                                • Simbol (@$!%*#?&)
                                {{ preg_match('/[\W_]/', $password) ? '✓' : '' }}
                            </span>
                        </div>
                    </div>

                    @error('password')
                        <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password Confirmation --}}
                <div>
                    <label
                        for="password_confirmation"
                        class="mb-1.5 block text-xs font-bold text-slate-700 dark:text-slate-300"
                    >
                        Konfirmasi Kata Sandi
                    </label>

                    <input
                        wire:model.live="password_confirmation"
                        id="password_confirmation"
                        type="password"
                        required
                        placeholder="••••••••"
                        class="w-full rounded-md border px-3.5 py-2.5 text-xs text-slate-900
                               transition placeholder:text-slate-400 focus:outline-none
                               focus:ring-2 focus:ring-sky-500
                               dark:bg-slate-950 dark:text-slate-100
                               dark:placeholder:text-slate-600
                               @error('password_confirmation')
                                   border-rose-500 dark:border-rose-500
                               @else
                                   border-slate-200 dark:border-slate-700
                                   focus:border-sky-500 dark:focus:border-sky-500
                               @enderror"
                    />

                    @if (strlen($password_confirmation) > 0)
                        <p class="mt-1.5 text-xs font-medium
                            {{ $password === $password_confirmation
                                ? 'text-emerald-600 dark:text-emerald-400'
                                : 'text-rose-500 dark:text-rose-400' }}"
                        >
                            {{ $password === $password_confirmation
                                ? '✓ Kata sandi cocok'
                                : '✗ Kata sandi belum cocok' }}
                        </p>
                    @endif

                    @error('password_confirmation')
                        <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="w-full rounded-md bg-sky-600 px-4 py-2.5 text-xs font-bold
                           text-white shadow-sm transition hover:bg-sky-700
                           disabled:opacity-50 focus:outline-none focus:ring-2
                           focus:ring-sky-500 focus:ring-offset-2
                           focus:ring-offset-white dark:focus:ring-offset-slate-900"
                >
                    <span wire:loading.remove wire:target="resetPassword">
                        Simpan Kata Sandi Baru
                    </span>

                    <span wire:loading wire:target="resetPassword">
                        Memproses...
                    </span>
                </button>
            </form>

            {{-- Bottom Action --}}
            <div class="mt-4 border-t border-slate-100 pt-4 text-center dark:border-slate-800">
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Batal mengatur ulang?

                    <a
                        href="{{ route('login') }}"
                        wire:navigate
                        class="font-bold text-sky-600 hover:underline dark:text-sky-400"
                    >
                        Kembali ke Masuk
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
