{{-- ----------- Yoga Wilanda Documentation v1.1.6 -----------------
<meta_config>
    0. author________________: yogawilanda <eayogawilanda@gmail.com>
    1. path__________________: resources/views/livewire/pages/auth/auth-modal.blade.php
    2. usage_________________: DownloadRumah Authentication — Login & Registration Shell
    3. children______________: ./partials/login-form.blade.php & ./partials/register-form.blade.php
    4. controller____________: app/Livewire/Pages/Auth/AuthModal.php
    5. type__________________: Livewire Blade View
    6. purpose_______________: Provide the responsive authentication container and switch between login and registration modes.
    7. ruling________________: Authentication shell provides a calm, focused entry point without excessive decoration.
    8. ruling_ui_____________: Hard borders, slate structure, sky accent, no gradients or decorative shadows.
    9. ruling_motion_________: Modal-level motion only; login/register switching remains instant.
    10. ruling_responsive____: Desktop uses contextual branding; mobile prioritizes the authentication form.
    11. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

<div class="flex min-h-screen items-center justify-center bg-slate-100 px-0 dark:bg-slate-950 sm:px-4 sm:py-8 md:py-12">

    <div
        x-data="{
            mode: window.location.pathname.includes('register') ||
                new URLSearchParams(window.location.search).get('mode') === 'register' ?
                'register' :
                'login',
            showPassword: false
        }"
        x-init="$watch('mode', value => window.history.pushState({}, '', value === 'register' ? '/register' : '/login'))"
        class="grid h-auto w-full max-w-5xl grid-cols-1 overflow-hidden border border-slate-300
               bg-white dark:border-slate-800 dark:bg-slate-900 lg:grid-cols-12"
    >

        {{-- Desktop Context Panel --}}
        <aside
            class="relative hidden overflow-hidden border-r border-slate-300 bg-slate-950 p-8 text-white
                   dark:border-slate-800 lg:col-span-5 lg:flex lg:flex-col lg:justify-between"
        >
            <div class="relative z-10">

                <a
                    href="{{ route('home') }}"
                    wire:navigate
                    class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400
                           transition-colors duration-150 hover:text-white"
                >
                    <span aria-hidden="true">←</span>
                    <span>Kembali ke Beranda</span>
                </a>

                <div class="mt-16 max-w-sm">
                    <div class="mb-4 flex items-center gap-2">
                        <span class="h-1.5 w-1.5 bg-sky-500"></span>

                        <span class="text-[10px] font-semibold uppercase tracking-[0.18em] text-slate-400">
                            DownloadRumah
                        </span>
                    </div>

                    <h2 class="text-2xl font-bold leading-tight tracking-tight">
                        Temukan tempat yang masuk akal untukmu.
                    </h2>

                    <p class="mt-4 text-xs leading-6 text-slate-400">
                        Mulai dari kebutuhanmu, temukan properti yang relevan,
                        lalu lanjutkan percakapan ketika sudah siap.
                    </p>
                </div>
            </div>

            {{-- Structural Field --}}
            <div class="relative z-10 border-t border-slate-800 pt-5">
                <div class="grid grid-cols-3 border-l border-t border-slate-800">

                    <div class="border-b border-r border-slate-800 p-3">
                        <span class="block text-[9px] font-semibold uppercase tracking-wide text-slate-500">
                            01
                        </span>
                        <span class="mt-1 block text-[10px] font-semibold text-slate-300">
                            Kebutuhan
                        </span>
                    </div>

                    <div class="border-b border-r border-slate-800 p-3">
                        <span class="block text-[9px] font-semibold uppercase tracking-wide text-slate-500">
                            02
                        </span>
                        <span class="mt-1 block text-[10px] font-semibold text-slate-300">
                            Properti
                        </span>
                    </div>

                    <div class="border-b border-r border-slate-800 p-3">
                        <span class="block text-[9px] font-semibold uppercase tracking-wide text-slate-500">
                            03
                        </span>
                        <span class="mt-1 block text-[10px] font-semibold text-slate-300">
                            Percakapan
                        </span>
                    </div>

                </div>
            </div>

            <div
                aria-hidden="true"
                class="pointer-events-none absolute right-8 top-24 h-40 w-40 opacity-30"
                style="background-image: radial-gradient(circle, rgb(56 189 248 / 0.8) 1px, transparent 1px); background-size: 14px 14px;"
            ></div>
        </aside>

        {{-- Authentication Area --}}
        <main
            class="relative bg-white px-5 pb-20 pt-5 dark:bg-slate-900
                   sm:px-8 sm:pb-8 sm:pt-7 lg:col-span-7"
        >

            {{-- Mobile Header --}}
            <div class="mb-4 flex items-center justify-between lg:mb-5">

                <a
                    href="{{ route('home') }}"
                    wire:navigate
                    class="-ml-2 flex h-8 w-8 items-center justify-center text-slate-500
                           transition-colors duration-150 hover:text-slate-900
                           dark:text-slate-400 dark:hover:text-slate-100 lg:hidden"
                    aria-label="Kembali ke Beranda"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </a>

                <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">
                    <span x-text="mode === 'login' ? 'Masuk' : 'Daftar Baru'"></span>
                </span>

                <span class="w-8 lg:hidden"></span>
            </div>

            {{-- Mode Switcher --}}
            <div class="mb-5 grid grid-cols-2 border border-slate-300 dark:border-slate-700">

                <button
                    type="button"
                    @click="mode = 'login'"
                    :class="mode === 'login'
                        ? 'border-b-2 border-sky-500 bg-slate-50 text-slate-950 dark:bg-slate-800 dark:text-slate-100'
                        : 'text-slate-400 hover:bg-slate-50 hover:text-slate-700 dark:text-slate-500 dark:hover:bg-slate-800 dark:hover:text-slate-300'"
                    class="px-4 py-3 text-xs font-semibold transition-colors duration-150"
                >
                    Masuk
                </button>

                <button
                    type="button"
                    @click="mode = 'register'"
                    :class="mode === 'register'
                        ? 'border-b-2 border-sky-500 bg-slate-50 text-slate-950 dark:bg-slate-800 dark:text-slate-100'
                        : 'text-slate-400 hover:bg-slate-50 hover:text-slate-700 dark:text-slate-500 dark:hover:bg-slate-800 dark:hover:text-slate-300'"
                    class="border-l border-slate-300 px-4 py-3 text-xs font-semibold
                           transition-colors duration-150 dark:border-slate-700"
                >
                    Daftar Akun
                </button>

            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div
                    class="mb-4 flex items-start gap-2.5 border border-emerald-200 bg-emerald-50
                           px-3.5 py-3 text-xs font-medium text-emerald-700
                           dark:border-emerald-900/70 dark:bg-emerald-950/40 dark:text-emerald-400"
                >
                    <span class="mt-1 h-1.5 w-1.5 shrink-0 bg-emerald-500"></span>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            {{-- Auth Forms --}}
            <div class="relative">
                @include('livewire.pages.auth.partials.login-form')
                @include('livewire.pages.auth.partials.register-form')
            </div>

            {{-- Mode Footer --}}
            <div class="mt-5 border-t border-slate-200 pt-4 text-center dark:border-slate-800">

                <p
                    x-show="mode === 'login'"
                    class="text-xs text-slate-500 dark:text-slate-400"
                >
                    Belum punya akun?

                    <button
                        type="button"
                        @click="mode = 'register'"
                        class="ml-1 font-semibold text-sky-600 transition-colors duration-150
                               hover:text-sky-700 hover:underline dark:text-sky-400
                               dark:hover:text-sky-300"
                    >
                        Daftar Sekarang
                    </button>
                </p>

                <p
                    x-show="mode === 'register'"
                    x-cloak
                    class="text-xs text-slate-500 dark:text-slate-400"
                >
                    Sudah punya akun?

                    <button
                        type="button"
                        @click="mode = 'login'"
                        class="ml-1 font-semibold text-sky-600 transition-colors duration-150
                               hover:text-sky-700 hover:underline dark:text-sky-400
                               dark:hover:text-sky-300"
                    >
                        Masuk Sekarang
                    </button>
                </p>

            </div>

        </main>

    </div>

</div>
