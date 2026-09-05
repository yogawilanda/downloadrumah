<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', 'Download Rumah') }}</title>

    <!-- Favicon & Icons -->
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}?v=20260905" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}?v=20260905" />
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}?v=20260905" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}?v=20260905" />

    <!-- Manifest PWA -->
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}?v=20260905" />

    <!-- Meta PWA -->
    <meta name="theme-color" content="#2563eb">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Download Rumah" />

    @if (app()->environment('production'))
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-white font-sans antialiased selection:bg-blue-500 selection:text-white">

    <main class="max-w-md mx-auto min-h-screen bg-white relative pb-16">
        {{ $slot }}

        <!-- Modal/Banner Install PWA Popup -->
        <div id="pwa-install-banner"
            class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm items-center justify-center p-4">
            <div class="bg-white rounded-2xl p-5 max-w-sm w-full shadow-2xl relative border border-gray-100">
                <div class="text-center">
                    <div
                        class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-base">Install Aplikasi</h3>
                    <p class="text-xs text-gray-500 mt-1">Dapatkan akses lebih cepat dan pengalaman terbaik dengan
                        menginstall Download Rumah di HP kamu.</p>
                </div>

                <div class="mt-4 space-y-2">
                    <button id="pwa-install-btn"
                        class="w-full bg-blue-600 text-white font-semibold py-2.5 rounded-xl text-xs hover:bg-blue-700 transition">
                        Install Sekarang
                    </button>
                    <button id="pwa-close-btn"
                        class="w-full bg-gray-100 text-gray-600 font-medium py-2 rounded-xl text-xs hover:bg-gray-200 transition">
                        Nanti Saja
                    </button>
                </div>

                <!-- Checklist Jangan Ingatkan Hari Ini -->
                <div class="mt-3 flex items-center justify-center gap-2">
                    <input type="checkbox" id="pwa-dont-show-today"
                        class="w-3.5 h-3.5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <label for="pwa-dont-show-today" class="text-[11px] text-gray-500 select-none">Jangan ingatkan lagi
                        hari ini</label>
                </div>
            </div>
        </div>
    </main>

    <x-layouts.navigation />

    @livewireScripts

    <script>
        // 1. Register Service Worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').catch(() => {});
            });
        }

        // 2. Logic Pop-up & LocalStorage "Jangan Ingatkan Hari Ini"
        let deferredPrompt;
        const installBanner = document.getElementById('pwa-install-banner');
        const installBtn = document.getElementById('pwa-install-btn');
        const closeBtn = document.getElementById('pwa-close-btn');
        const dontShowCheckbox = document.getElementById('pwa-dont-show-today');

        function isDismissedToday() {
            const dismissedTimestamp = localStorage.getItem('pwa_dismissed_time');
            if (!dismissedTimestamp) return false;

            const now = new Date().getTime();
            const oneDayInMs = 24 * 60 * 60 * 1000;

            // Cek apakah belum lewat 24 jam
            if (now - parseInt(dismissedTimestamp) < oneDayInMs) {
                return true;
            } else {
                localStorage.removeItem('pwa_dismissed_time');
                return false;
            }
        }

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;

            // Tampilkan popup HANYA jika pengguna tidak mencentang "Jangan ingatkan hari ini"
            if (installBanner && !isDismissedToday()) {
                installBanner.classList.remove('hidden');
                installBanner.classList.add('flex');
            }
        });

        // Handle tombol Install
        if (installBtn) {
            installBtn.addEventListener('click', async () => {
                if (!deferredPrompt) return;

                deferredPrompt.prompt();
                const {
                    outcome
                } = await deferredPrompt.userChoice;

                if (outcome === 'accepted') {
                    hideBanner();
                }
                deferredPrompt = null;
            });
        }

        // Handle tombol Nanti Saja / Tutup
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                if (dontShowCheckbox && dontShowCheckbox.checked) {
                    // Simpan timestamp saat ini ke LocalStorage
                    localStorage.setItem('pwa_dismissed_time', new Date().getTime().toString());
                }
                hideBanner();
            });
        }

        function hideBanner() {
            if (installBanner) {
                installBanner.classList.add('hidden');
                installBanner.classList.remove('flex');
            }
        }

        window.addEventListener('appinstalled', () => {
            deferredPrompt = null;
            hideBanner();
        });
    </script>
</body>

</html>
