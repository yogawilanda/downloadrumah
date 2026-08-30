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
    public LoginForm $loginForm;
    public string $name = '';
    public string $email = '';
    public string $phone_number = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function login(): void
    {
        $this->validate();
        $this->loginForm->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

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
        $this->redirect(route('home', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-[calc(100vh-4rem)] bg-white flex flex-col justify-between p-6" x-data="{ mode: 'login' }">
    <div>
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('home') }}" wire:navigate class="p-2 -ml-2 rounded-full text-gray-600 hover:bg-gray-100 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <span class="text-xs font-bold text-gray-400 tracking-wider uppercase" x-text="mode === 'login' ? 'Masuk' : 'Daftar Baru'"></span>
            <div class="w-8"></div>
        </div>
        <div class="bg-gray-100 p-1 rounded-2xl flex items-center mb-8 relative">
            <button @click="mode = 'login'" :class="mode === 'login' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500'" class="w-1/2 py-2.5 text-xs font-bold rounded-xl transition-all duration-200">Masuk</button>
            <button @click="mode = 'register'" :class="mode === 'register' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500'" class="w-1/2 py-2.5 text-xs font-bold rounded-xl transition-all duration-200">Daftar Akun</button>
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="relative overflow-hidden">
            @include('livewire.pages.auth.partials.login-form')
            @include('livewire.pages.auth.partials.register-form')
        </div>
    </div>
    <div class="py-4 text-center">
        <p class="text-xs text-gray-500" x-show="mode === 'login'">Belum punya akun? <button @click="mode = 'register'" class="text-blue-600 font-bold hover:underline">Daftar Sekarang</button></p>
        <p class="text-xs text-gray-500" x-show="mode === 'register'" x-cloak">Sudah punya akun? <button @click="mode = 'login'" class="text-blue-600 font-bold hover:underline">Masuk Sekarang</button></p>
    </div>
</div>
