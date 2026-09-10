{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/auth/forgot-password.blade.php
| @usage      : Responsive Container View for Forgot Password Modal
| @controller : Livewire Volt Component
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
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
                    <h2 class="text-2xl font-black tracking-tight leading-tight">Lupa Kata Sandi Akunmu?</h2>
                    <p class="text-xs text-blue-100/90 leading-relaxed">Jangan khawatir, kami akan mengirimkan instruksi pemulihan langsung ke alamat email kamu.</p>
                </div>
            </div>

            <!-- Aesthetic Badge -->
            <div class="relative z-10 bg-white/10 backdrop-blur-md p-4 rounded-md border border-white/15">
                <p class="text-xs font-medium text-blue-50">Paham kok rasanya jadi pelupa, emailnya inget kan?</p>
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
                <span class="text-xs font-bold text-gray-400 tracking-wider uppercase">Reset Kata Sandi</span>
                <div class="w-8 lg:hidden"></div>
            </div>

            <div class="mb-5">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Lupa Kata Sandi?</h2>
                <p class="mt-1 text-xs text-gray-500 leading-relaxed">
                    Masukkan email yang terdaftar. Kami akan mengirimkan tautan pemulihan kata sandi.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form Wrapper (Auto Height) -->
            <form wire:submit="sendPasswordResetLink" class="space-y-4">
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 mb-1.5">
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
                        class="w-full px-3.5 py-2.5 border rounded-md text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none transition @error('email') border-red-500 @else border-gray-200 @enderror"
                    />
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-md shadow-sm transition duration-150 disabled:opacity-50"
                >
                    <span wire:loading.remove wire:target="sendPasswordResetLink">
                        Kirim Tautan Reset
                    </span>
                    <span wire:loading wire:target="sendPasswordResetLink">
                        Mengirim...
                    </span>
                </button>
            </form>

            <!-- Bottom Action: Menempel rapat tepat di bawah form -->
            <div class="pt-4 border-t border-gray-100 mt-4 text-center">
                <p class="text-xs text-gray-500">
                    Ingat kata sandi kamu?
                    <a href="{{ route('login') }}" wire:navigate class="text-blue-600 font-bold hover:underline">
                        Kembali ke Masuk
                    </a>
                </p>
            </div>
        </div>

    </div>
</div>
