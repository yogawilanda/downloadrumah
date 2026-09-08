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

new #[Layout('components.layouts.app')] class extends Component
{
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
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
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

<div class="w-full max-w-md mx-auto p-6 bg-white rounded-xl shadow-md border border-slate-100">
    <div class="mb-6 text-center">
        <h2 class="text-xl font-semibold text-slate-800">Atur Ulang Kata Sandi</h2>
        <p class="mt-2 text-sm text-slate-600">
            Silakan buat kata sandi baru untuk akun kamu.
        </p>
    </div>

    <form wire:submit="resetPassword" class="space-y-4">
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Alamat Email</label>
            <input
                wire:model="email"
                id="email"
                type="email"
                required
                class="w-full px-3 py-2 border rounded-lg text-sm bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('email') border-red-500 @else border-slate-300 @enderror"
                readonly
            />
            @error('email')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Kata Sandi Baru</label>
            <input
                wire:model="password"
                id="password"
                type="password"
                required
                autofocus
                placeholder="••••••••"
                class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('password') border-red-500 @else border-slate-300 @enderror"
            />
            @error('password')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Kata Sandi</label>
            <input
                wire:model="password_confirmation"
                id="password_confirmation"
                type="password"
                required
                placeholder="••••••••"
                class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('password_confirmation') border-red-500 @else border-slate-300 @enderror"
            />
            @error('password_confirmation')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            wire:loading.attr="disabled"
            class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm transition duration-150 disabled:opacity-50"
        >
            <span wire:loading.remove wire:target="resetPassword">Simpan Kata Sandi Baru</span>
            <span wire:loading wire:target="resetPassword">Memproses...</span>
        </button>
    </form>
</div>
