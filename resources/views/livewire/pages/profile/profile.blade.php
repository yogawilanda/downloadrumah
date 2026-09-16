{{--
loc: resources/views/livewire/pages/profile/profile.blade.php
usage: User profile settings page layout
--}}

<div class="min-h-screen bg-slate-50 pb-24 dark:bg-slate-950">

    <div class="mx-auto min-h-screen w-full max-w-5xl bg-white dark:bg-slate-900">

        {{-- Header / Top Nav --}}
        <header class="sticky top-0 z-30 border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-center justify-between px-5 py-4 sm:px-8 lg:px-10">

                <div>
                    <span class="block text-[9px] font-bold uppercase tracking-[0.18em] text-slate-400 dark:text-slate-500">
                        Account / Settings
                    </span>

                    <h1 class="mt-1 text-base font-bold tracking-tight text-slate-950 dark:text-white sm:text-lg">
                        Pengaturan Akun
                    </h1>
                </div>

                <a
                    href="{{ route('home') }}"
                    class="border border-slate-200 px-3 py-2 text-[9px] font-bold uppercase tracking-wide text-slate-600 transition hover:border-slate-950 hover:bg-slate-950 hover:text-white dark:border-slate-700 dark:text-slate-300 dark:hover:border-white dark:hover:bg-white dark:hover:text-slate-950"
                >
                    Ke Beranda
                </a>

            </div>
        </header>

        {{-- Main Content --}}
        <main class="px-5 py-6 sm:px-8 sm:py-8 lg:px-10">

            {{-- Profile Identity --}}
            <section class="mb-8 border border-slate-200 dark:border-slate-800">
                <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">

                    <div class="flex min-w-0 items-center gap-4">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center bg-slate-950 text-lg font-bold text-white dark:bg-white dark:text-slate-950">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">
                            <span class="block text-[9px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                                User Profile
                            </span>

                            <h2 class="mt-1 truncate text-sm font-bold text-slate-950 dark:text-white sm:text-base">
                                {{ auth()->user()->name }}
                            </h2>

                            <p class="mt-0.5 truncate text-[10px] text-slate-500 dark:text-slate-400 sm:text-xs">
                                {{ auth()->user()->email }}
                            </p>
                        </div>

                    </div>

                    <div class="hidden border-l border-slate-200 pl-5 text-right dark:border-slate-800 sm:block">
                        <span class="block text-[9px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
                            Account
                        </span>

                        <span class="mt-1 block text-[10px] font-semibold text-slate-700 dark:text-slate-300">
                            Active
                        </span>
                    </div>

                </div>
            </section>

            {{-- Settings Grid --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                {{-- Profile Information --}}
                <section class="border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-200 px-5 py-4 dark:border-slate-800">
                        <div class="flex items-center gap-3">
                            <span class="flex h-7 w-7 items-center justify-center bg-slate-950 text-[9px] font-bold text-white dark:bg-white dark:text-slate-950">
                                01
                            </span>

                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wide text-slate-950 dark:text-white">
                                    Informasi Pribadi
                                </h3>

                                <p class="mt-0.5 text-[9px] text-slate-400 dark:text-slate-500">
                                    Kelola informasi dasar akun.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5">
                        <livewire:pages.profile.partials.update-profile-information-form />
                    </div>

                </section>

                {{-- Password --}}
                <section class="border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-200 px-5 py-4 dark:border-slate-800">
                        <div class="flex items-center gap-3">
                            <span class="flex h-7 w-7 items-center justify-center bg-slate-950 text-[9px] font-bold text-white dark:bg-white dark:text-slate-950">
                                02
                            </span>

                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wide text-slate-950 dark:text-white">
                                    Keamanan & Sandi
                                </h3>

                                <p class="mt-0.5 text-[9px] text-slate-400 dark:text-slate-500">
                                    Perbarui kredensial keamanan akun.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5">
                        <livewire:pages.profile.partials.update-password-form />
                    </div>

                </section>

                {{-- Delete Account --}}
                <section class="border border-red-200 bg-red-50/30 dark:border-red-900/60 dark:bg-red-950/20 lg:col-span-2">

                    <div class="border-b border-red-200 px-5 py-4 dark:border-red-900/60">
                        <div class="flex items-center gap-3">
                            <span class="flex h-7 w-7 items-center justify-center bg-red-600 text-[9px] font-bold text-white">
                                03
                            </span>

                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wide text-red-700 dark:text-red-400">
                                    Zona Bahaya
                                </h3>

                                <p class="mt-0.5 text-[9px] text-red-500/70 dark:text-red-400/60">
                                    Tindakan di bagian ini bersifat permanen.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5">
                        <livewire:pages.profile.partials.delete-user-form />
                    </div>

                </section>

            </div>

        </main>

        {{-- Bottom Navigation --}}
        <x-layouts.navigation />

    </div>
</div>
