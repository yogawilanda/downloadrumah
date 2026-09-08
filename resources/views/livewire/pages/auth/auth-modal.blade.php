{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path : resources/views/livewire/pages/auth/auth-modal.blade.php
| @usage : Main Container View for Auth Modal (Login & Register Toggle)
| @children : ./partials/login-form.blade.php & ./partials/register-form.blade.php
| @controller : app/Livewire/Pages/Auth/AuthModal.php
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div
    class="min-h-[calc(100vh-4rem)] bg-white flex flex-col justify-between p-6"
    x-data="{
        mode: window.location.pathname.includes('register') || new URLSearchParams(window.location.search).get('mode') === 'register' ? 'register' : 'login',
        showPassword: false
    }"
    x-init="$watch('mode', value => window.history.pushState({}, '', value === 'register' ? '/register' : '/login'))"
>
    <div>
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('home') }}" wire:navigate class="p-2 -ml-2 rounded-full text-gray-600 hover:bg-gray-100 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <span class="text-xs font-bold text-gray-400 tracking-wider uppercase" x-text="mode === 'login' ? 'Masuk' : 'Daftar Baru'"></span>
            <div class="w-8"></div>
        </div>

        <div class="bg-gray-100 p-1 rounded-2xl flex items-center mb-6 relative">
            <button @click="mode = 'login'" :class="mode === 'login' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500'" class="w-1/2 py-2.5 text-xs font-bold rounded-xl transition-all duration-200">Masuk</button>
            <button @click="mode = 'register'" :class="mode === 'register' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500'" class="w-1/2 py-2.5 text-xs font-bold rounded-xl transition-all duration-200">Daftar Akun</button>
        </div>

        @if (session('status'))
            <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        {{-- Form Login & Register --}}
        <div class="relative overflow-hidden p-1 -m-1">
            @include('livewire.pages.auth.partials.login-form')
            @include('livewire.pages.auth.partials.register-form')
        </div>

        {{-- Divider --}}
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
            <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-3 text-gray-400 font-medium">Atau masuk dengan</span></div>
        </div>

        {{-- Placeholder Google Sign-In --}}
        <div>
            <a href="#" class="w-full flex items-center justify-center gap-3 py-2.5 px-4 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                <span>Lanjutkan dengan Google</span>
            </a>
        </div>
    </div>

    <div class="py-4 text-center">
        <p class="text-xs text-gray-500" x-show="mode === 'login'">Belum punya akun? <button @click="mode = 'register'" class="text-blue-600 font-bold hover:underline">Daftar Sekarang</button></p>
        <p class="text-xs text-gray-500" x-show="mode === 'register'" x-cloak>Sudah punya akun? <button @click="mode = 'login'" class="text-blue-600 font-bold hover:underline">Masuk Sekarang</button></p>
    </div>
</div>
