<?php

use App\Models\User;
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] class extends Component
{
    // Form Login Bawaan
    public LoginForm $loginForm;

    // State Form Register
    public string $name = '';
    public string $email = '';
    public string $phone_number = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle Login
     */
    public function login(): void
    {
        $this->validate();

        $this->loginForm->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Handle Register
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-[calc(100vh-4rem)] bg-white flex flex-col justify-between p-6" x-data="{ mode: 'login' }">
    <div>
        <!-- Top Navigation -->
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('home') }}" wire:navigate class="p-2 -ml-2 rounded-full text-gray-600 hover:bg-gray-100 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="text-xs font-bold text-gray-400 tracking-wider uppercase" x-text="mode === 'login' ? 'Masuk' : 'Daftar Baru'"></span>
            <div class="w-8"></div>
        </div>

        <!-- Slide Toggle Header Button -->
        <div class="bg-gray-100 p-1 rounded-2xl flex items-center mb-8 relative">
            <button @click="mode = 'login'"
                :class="mode === 'login' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500'"
                class="w-1/2 py-2.5 text-xs font-bold rounded-xl transition-all duration-200">
                Masuk
            </button>
            <button @click="mode = 'register'"
                :class="mode === 'register' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500'"
                class="w-1/2 py-2.5 text-xs font-bold rounded-xl transition-all duration-200">
                Daftar Akun
            </button>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Container Form dengan Transisi Slide -->
        <div class="relative overflow-hidden">

            <!-- FORM LOGIN -->
            <div x-show="mode === 'login'"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="-translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-200 transform absolute top-0 w-full"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="-translate-x-full opacity-0">

                <div class="mb-6">
                    <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Selamat Datang! 👋</h1>
                    <p class="text-xs text-gray-500 mt-1">Masuk untuk mengelola dan menemukan hunian di DownloadRumah.</p>
                </div>

                <form wire:submit="login" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Email</label>
                        <input wire:model="loginForm.email" type="email" required
                            placeholder="nama@email.com"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition outline-none">
                        <x-input-error :messages="$errors->get('loginForm.email')" class="mt-1 text-xs" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-semibold text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs text-indigo-600 font-semibold hover:underline" href="{{ route('password.request') }}" wire:navigate>
                                    Lupa Password?
                                </a>
                            @endif
                        </div>
                        <input wire:model="loginForm.password" type="password" required
                            placeholder="••••••••"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition outline-none">
                        <x-input-error :messages="$errors->get('loginForm.password')" class="mt-1 text-xs" />
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="inline-flex items-center cursor-pointer">
                            <input wire:model="loginForm.remember" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ms-2 text-xs text-gray-600">Ingat Saya</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white font-bold py-3.5 px-4 rounded-2xl shadow-lg shadow-indigo-100 transition duration-150 flex items-center justify-center">
                            <span class="text-sm">Masuk Sekarang</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- FORM REGISTER -->
            <div x-show="mode === 'register'"
                x-cloak
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-200 transform absolute top-0 w-full"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="translate-x-full opacity-0">

                <div class="mb-6">
                    <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Buat Akun Baru 🚀</h1>
                    <p class="text-xs text-gray-500 mt-1">Daftar sekarang sebagai pembeli atau agen properti.</p>
                </div>

                <form wire:submit="register" class="space-y-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input wire:model="name" type="text" required
                            placeholder="Contoh: Budi Santoso"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition outline-none">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Email</label>
                        <input wire:model="email" type="email" required
                            placeholder="nama@email.com"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition outline-none">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor WhatsApp</label>
                        <input wire:model="phone_number" type="tel" required
                            placeholder="081234567890"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition outline-none">
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-1 text-xs" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Password</label>
                        <input wire:model="password" type="password" required
                            placeholder="Minimal 8 karakter"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition outline-none">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                        <input wire:model="password_confirmation" type="password" required
                            placeholder="Ulangi password"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition outline-none">
                    </div>

                    <div class="pt-3">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white font-bold py-3.5 px-4 rounded-2xl shadow-lg shadow-indigo-100 transition duration-150 flex items-center justify-center">
                            <span class="text-sm">Daftar Akun Baru</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Footer Dynamic Switcher Link -->
    <div class="py-4 text-center">
        <p class="text-xs text-gray-500" x-show="mode === 'login'">
            Belum punya akun?
            <button @click="mode = 'register'" class="text-indigo-600 font-bold hover:underline">
                Daftar Sekarang
            </button>
        </p>
        <p class="text-xs text-gray-500" x-show="mode === 'register'" x-cloak>
            Sudah punya akun?
            <button @click="mode = 'login'" class="text-indigo-600 font-bold hover:underline">
                Masuk Sekarang
            </button>
        </p>
    </div>
</div>
