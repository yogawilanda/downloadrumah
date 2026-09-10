{{--
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path       : resources/views/livewire/pages/auth/auth-modal.blade.php
| @usage      : Responsive Container View for Auth Modal with Compact Layout
| @children   : ./partials/login-form.blade.php & ./partials/register-form.blade.php
| @controller : app/Livewire/Pages/Auth/AuthModal.php
| @ruling     : max line of code 80%, max doc 20% | max total lines = 100
| @author     : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
--}}

<div class="min-h-screen bg-gray-50/50 sm:py-8 md:py-12 px-0 sm:px-4 flex items-center justify-center">

    <!-- Container Card (Height mengikuti isi konten) -->
    <div class="w-full max-w-full sm:max-w-lg md:max-w-2xl lg:max-w-4xl xl:max-w-5xl bg-white sm:rounded-md sm:shadow-lg sm:border sm:border-gray-100 overflow-hidden grid grid-cols-1 lg:grid-cols-12 h-auto"
        x-data="{
            mode: window.location.pathname.includes('register') || new URLSearchParams(window.location.search).get('mode') === 'register' ? 'register' : 'login',
            showPassword: false
        }"
        x-init="$watch('mode', value => window.history.pushState({}, '', value === 'register' ? '/register' : '/login'))"
    >

        <!-- LEFT COLUMN: Desktop Visual Branding Hero -->
        <div class="hidden lg:flex lg:col-span-5 bg-gradient-to-br from-blue-600 to-blue-800 p-8 text-white flex-col justify-between relative overflow-hidden">
            <div class="relative z-10">
                <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-2 text-white/80 hover:text-white text-xs font-semibold transition">
                    <span>← Kembali ke Beranda</span>
                </a>
                <div class="mt-10 space-y-3">
                    <h2 class="text-2xl font-black tracking-tight leading-tight">Temukan & Pasang Properti Impianmu.</h2>
                    <p class="text-xs text-blue-100/90 leading-relaxed">Akses ribuan listing rumah, apartemen, dan tanah di seluruh Indonesia langsung dalam satu platform.</p>
                </div>
            </div>

            <!-- Aesthetic Badge -->
            <div class="relative z-10 bg-white/10 backdrop-blur-md p-4 rounded-md border border-white/15">
                <p class="text-xs font-medium text-blue-50">⚡ "Proses cari rumah jadi jauh lebih cepat dan transparan di DownloadRumah."</p>
            </div>

            <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-blue-500/30 rounded-full blur-2xl pointer-events-none"></div>
        </div>

        <!-- RIGHT COLUMN: Auth Form Area (Mobile, Tab, Desktop konsisten tanpa flex-between) -->
        <div class="lg:col-span-7 p-5 sm:p-8 pb-20 sm:pb-8 flex flex-col justify-start bg-white relative">
            <!-- Top Navigation Header -->
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <a href="{{ route('home') }}" wire:navigate class="p-2 -ml-2 rounded-full text-gray-600 hover:bg-gray-100 transition lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <span class="text-xs font-bold text-gray-400 tracking-wider uppercase" x-text="mode === 'login' ? 'Masuk' : 'Daftar Baru'"></span>
                <div class="w-8 lg:hidden"></div>
            </div>

            <!-- Mode Switcher Tabs -->
            <div class="bg-gray-100 p-1 rounded-md flex items-center mb-4 sm:mb-6 relative">
                <button @click="mode = 'login'" :class="mode === 'login' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="w-1/2 py-2.5 text-xs font-bold rounded-md transition-all duration-200">Masuk</button>
                <button @click="mode = 'register'" :class="mode === 'register' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="w-1/2 py-2.5 text-xs font-bold rounded-md transition-all duration-200">Daftar Akun</button>
            </div>

            @if (session('status'))
                <div class="mb-3 sm:mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form Wrapper (Auto Height di semua breakpoint) -->
            <div class="relative h-auto">
                @include('livewire.pages.auth.partials.login-form')
                @include('livewire.pages.auth.partials.register-form')
            </div>

            <!-- Bottom Action: Menempel rapat tepat di bawah form (Mobile, Tab, Desktop) -->
            <div class="space-y-3 pt-4 border-t border-gray-100 mt-4">
                <!-- Google Sign-In -->
                <a href="#" class="w-full flex items-center justify-center gap-3 py-2.5 px-4 border border-gray-200 rounded-md text-xs font-semibold text-gray-700 hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span>Lanjutkan dengan Google</span>
                </a>

                <div class="text-center">
                    <p class="text-xs text-gray-500" x-show="mode === 'login'">Belum punya akun? <button @click="mode = 'register'" class="text-blue-600 font-bold hover:underline">Daftar Sekarang</button></p>
                    <p class="text-xs text-gray-500" x-show="mode === 'register'" x-cloak>Sudah punya akun? <button @click="mode = 'login'" class="text-blue-600 font-bold hover:underline">Masuk Sekarang</button></p>
                </div>
            </div>
        </div>

    </div>
</div>
