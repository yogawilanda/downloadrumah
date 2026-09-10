{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/auth/reset-password.blade.php
| @usage      : Livewire Volt component for user password reset page
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
                'required', 'string', 'confirmed',
                Rules\Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(),
            ],
        ]);

        $status = Password::reset($this->only('email', 'password', 'password_confirmation', 'token'), function ($user) {
            $user->forceFill([
                'password' => Hash::make($this->password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        });

        if ($status !== Password::PASSWORD_RESET) {
            $this->addError('email', __($status));
            return;
        }

        Session::flash('status', __($status));
        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div class="min-h-screen bg-gray-50/50 py-6 sm:py-8 md:py-12 px-3.5 sm:px-4 flex items-center justify-center">

    <!-- Container Card -->
    <div class="w-full max-w-full sm:max-w-lg md:max-w-2xl lg:max-w-4xl xl:max-w-5xl bg-white rounded-md sm:shadow-lg border border-gray-100 overflow-hidden grid grid-cols-1 lg:grid-cols-12 h-auto">

        <!-- LEFT COLUMN: Desktop Visual Branding Hero -->
        <div class="hidden lg:flex lg:col-span-5 bg-gradient-to-br from-blue-600 to-blue-800 p-8 text-white flex-col justify-between relative overflow-hidden">
            <div class="relative z-10">
                <a href="{{ route('login') }}" wire:navigate class="inline-flex items-center gap-2 text-white/80 hover:text-white text-xs font-semibold transition">
                    <span>← Kembali ke Masuk</span>
                </a>
                <div class="mt-10 space-y-3">
                    <h2 class="text-2xl font-black tracking-tight leading-tight">Buat Kata Sandi Baru.</h2>
                    <p class="text-xs text-blue-100/90 leading-relaxed">Amankan akun kamu dengan kata sandi yang kuat dan mudah kamu ingat.</p>
                </div>
            </div>

            <!-- Aesthetic Badge -->
            <div class="relative z-10 bg-white/10 backdrop-blur-md p-4 rounded-md border border-white/15">
                <p class="text-xs font-medium text-blue-50">🔑 "Gunakan kombinasi simbol, angka, dan huruf untuk keamanan maksimal."</p>
            </div>

            <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-blue-500/30 rounded-full blur-2xl pointer-events-none"></div>
        </div>

        <!-- RIGHT COLUMN: Auth Form Area -->
        <div class="lg:col-span-7 p-5 sm:p-8 pb-8 flex flex-col justify-start bg-white relative">
            <!-- Top Navigation Header -->
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <a href="{{ route('login') }}" wire:navigate class="p-2 -ml-2 rounded-full text-gray-600 hover:bg-gray-100 transition lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <span class="text-xs font-bold text-gray-400 tracking-wider uppercase">Atur Ulang Kata Sandi</span>
                <div class="w-8 lg:hidden"></div>
            </div>

            <div class="mb-5">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Atur Ulang Kata Sandi</h2>
                <p class="mt-1 text-xs text-gray-500 leading-relaxed">
                    Silakan buat kata sandi baru untuk akun kamu.
                </p>
            </div>

            <!-- Form Wrapper (Auto Height) -->
            <form wire:submit="resetPassword" class="space-y-4">
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 mb-1.5">Alamat Email</label>
                    <input wire:model="email" id="email" type="email" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-md text-xs bg-gray-50 text-gray-500 cursor-not-allowed" readonly />
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-gray-700 mb-1.5">Kata Sandi Baru</label>
                    <input wire:model.live="password" id="password" type="password" required autofocus placeholder="••••••••"
                        class="w-full px-3.5 py-2.5 border rounded-md text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none transition @error('password') border-red-500 @else border-gray-200 @enderror" />

                    <div class="mt-2 p-3 bg-gray-50 rounded-md text-xs space-y-1.5 text-gray-600 border border-gray-100">
                        <p class="font-bold text-gray-700">Kriteria kata sandi:</p>
                        <div class="grid grid-cols-2 gap-1.5 text-[11px]">
                            <span class="{{ strlen($password) >= 8 ? 'text-emerald-600 font-semibold' : 'text-gray-500' }}">
                                • Min. 8 Karakter {{ strlen($password) >= 8 ? '✓' : '' }}
                            </span>
                            <span class="{{ preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) ? 'text-emerald-600 font-semibold' : 'text-gray-500' }}">
                                • Huruf Besar & Kecil {{ preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) ? '✓' : '' }}
                            </span>
                            <span class="{{ preg_match('/[0-9]/', $password) ? 'text-emerald-600 font-semibold' : 'text-gray-500' }}">
                                • Mengandung Angka {{ preg_match('/[0-9]/', $password) ? '✓' : '' }}
                            </span>
                            <span class="{{ preg_match('/[\W_]/', $password) ? 'text-emerald-600 font-semibold' : 'text-gray-500' }}">
                                • Simbol (@$!%*#?&) {{ preg_match('/[\W_]/', $password) ? '✓' : '' }}
                            </span>
                        </div>
                    </div>

                    @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-gray-700 mb-1.5">Konfirmasi Kata Sandi</label>
                    <input wire:model.live="password_confirmation" id="password_confirmation" type="password" required placeholder="••••••••"
                        class="w-full px-3.5 py-2.5 border rounded-md text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none transition @error('password_confirmation') border-red-500 @else border-gray-200 @enderror" />

                    @if(strlen($password_confirmation) > 0)
                        <p class="mt-1.5 text-xs font-medium {{ $password === $password_confirmation ? 'text-emerald-600' : 'text-red-500' }}">
                            {{ $password === $password_confirmation ? '✓ Kata sandi cocok' : '✗ Kata sandi belum cocok' }}
                        </p>
                    @endif
                    @error('password_confirmation') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <button type="submit" wire:loading.attr="disabled"
                    class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-md shadow-sm transition disabled:opacity-50">
                    <span wire:loading.remove wire:target="resetPassword">Simpan Kata Sandi Baru</span>
                    <span wire:loading wire:target="resetPassword">Memproses...</span>
                </button>
            </form>

            <!-- Bottom Action: Menempel rapat tepat di bawah form -->
            <div class="pt-4 border-t border-gray-100 mt-4 text-center">
                <p class="text-xs text-gray-500">
                    Batal mengatur ulang?
                    <a href="{{ route('login') }}" wire:navigate class="text-blue-600 font-bold hover:underline">
                        Kembali ke Masuk
                    </a>
                </p>
            </div>
        </div>

    </div>
</div>
