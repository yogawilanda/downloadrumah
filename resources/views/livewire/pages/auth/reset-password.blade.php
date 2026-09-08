{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/auth/reset-password.blade.php
| @usage : Livewire Volt component for user password reset page
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
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

<div class="w-full max-w-md mx-auto p-6 bg-white rounded-xl shadow-md border border-slate-100">
    <div class="mb-6 text-center">
        <h2 class="text-xl font-semibold text-slate-800">Atur Ulang Kata Sandi</h2>
        <p class="mt-2 text-sm text-slate-600">Silakan buat kata sandi baru untuk akun kamu.</p>
    </div>

    <form wire:submit="resetPassword" class="space-y-4">
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Alamat Email</label>
            <input wire:model="email" id="email" type="email" required class="w-full px-3 py-2 border rounded-lg text-sm bg-slate-50 border-slate-300" readonly />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Kata Sandi Baru</label>
            <input wire:model.live="password" id="password" type="password" required autofocus placeholder="••••••••"
                class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @else border-slate-300 @enderror" />

            <div class="mt-2 p-2.5 bg-slate-50 rounded-lg text-xs space-y-1 text-slate-600 border border-slate-200">
                <p class="font-medium text-slate-700">Kriteria kata sandi:</p>
                <div class="grid grid-cols-2 gap-1">
                    <span class="{{ strlen($password) >= 8 ? 'text-emerald-600 font-medium' : '' }}">
                        • Min. 8 Karakter {{ strlen($password) >= 8 ? '✓' : '' }}
                    </span>
                    <span class="{{ preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) ? 'text-emerald-600 font-medium' : '' }}">
                        • Huruf Besar & Kecil {{ preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) ? '✓' : '' }}
                    </span>
                    <span class="{{ preg_match('/[0-9]/', $password) ? 'text-emerald-600 font-medium' : '' }}">
                        • Mengandung Angka {{ preg_match('/[0-9]/', $password) ? '✓' : '' }}
                    </span>
                    <span class="{{ preg_match('/[\W_]/', $password) ? 'text-emerald-600 font-medium' : '' }}">
                        • Simbol (@$!%*#?&) {{ preg_match('/[\W_]/', $password) ? '✓' : '' }}
                    </span>
                </div>
            </div>

            @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Kata Sandi</label>
            <input wire:model.live="password_confirmation" id="password_confirmation" type="password" required placeholder="••••••••"
                class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 @error('password_confirmation') border-red-500 @else border-slate-300 @enderror" />

            @if(strlen($password_confirmation) > 0)
                <p class="mt-1 text-xs {{ $password === $password_confirmation ? 'text-emerald-600' : 'text-red-500' }}">
                    {{ $password === $password_confirmation ? '✓ Kata sandi cocok' : '✗ Kata sandi belum cocok' }}
                </p>
            @endif
            @error('password_confirmation') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled"
            class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-lg shadow-sm transition disabled:opacity-50">
            <span wire:loading.remove wire:target="resetPassword">Simpan Kata Sandi Baru</span>
            <span wire:loading wire:target="resetPassword">Memproses...</span>
        </button>
    </form>
</div>
