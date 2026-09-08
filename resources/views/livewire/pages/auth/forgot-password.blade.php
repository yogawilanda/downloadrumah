{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/auth/forgot-password.blade.php
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] class extends Component
{
    #[Validate(['required', 'string', 'email'])]
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate();

        $status = Password::sendResetLink($this->only('email'));

        if ($status !== Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }

        $this->reset('email');
        session()->flash('status', __($status));
    }
}; ?>

<div class="w-full max-w-md mx-auto p-6 bg-white rounded-xl shadow-md border border-slate-100">
    <div class="mb-6 text-center">
        <h2 class="text-xl font-semibold text-slate-800">Lupa Kata Sandi?</h2>
        <p class="mt-2 text-sm text-slate-600">
            Masukkan email yang terdaftar. Kami akan mengirimkan tautan reset kata sandi ke email kamu.
        </p>
    </div>

    @if (session('status'))
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit="sendPasswordResetLink" class="space-y-4">
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">
                Alamat Email
            </label>
            <input
                wire:model="email"
                id="email"
                type="email"
                name="email"
                required
                autofocus
                placeholder="nama@email.com"
                class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none @error('email') border-red-500 @else border-slate-300 @enderror"
            />
            @error('email')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            wire:loading.attr="disabled"
            class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-lg shadow-sm transition duration-150 disabled:opacity-50"
        >
            <span wire:loading.remove wire:target="sendPasswordResetLink">
                Kirim Tautan Reset
            </span>
            <span wire:loading wire:target="sendPasswordResetLink">
                Mengirim...
            </span>
        </button>
    </form>
</div>
