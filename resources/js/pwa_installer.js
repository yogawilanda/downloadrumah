/**
 * PWA Install Prompt & Environment Checker Store
 */
export default function pwaInstaller() {
    return {
        deferredPrompt: null,
        isInstalled: false,

        init() {
            // 1. Cek mode PWA Standalone
            const isStandalone = window.matchMedia('(display-mode: standalone)').matches ||
                                 window.navigator.standalone === true;

            if (isStandalone) {
                this.isInstalled = true;
            }

            // 2. Service Worker Registration
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js').catch(() => {});
                }, { once: true });
            }

            // 3. Tangkap Event Install Prompt Native Browser
            window.addEventListener('beforeinstallprompt', (event) => {
                event.preventDefault();
                this.deferredPrompt = event;
                this.isInstalled = false;
            });

            window.addEventListener('appinstalled', () => {
                this.deferredPrompt = null;
                this.isInstalled = true;
            });
        },

        // Tampilkan tombol jika BUKAN mode standalone PWA
        get canInstall() {
            return !this.isInstalled;
        },

        async installApp() {
            if (this.deferredPrompt) {
                this.deferredPrompt.prompt();
                const { outcome } = await this.deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    this.isInstalled = true;
                }
                this.deferredPrompt = null;
            } else {
                alert('Untuk menginstall, gunakan menu browser (Titik Tiga / Bagikan) lalu pilih "Tambahkan ke Layar Utama" / "Install Application".');
            }
        }
    };
}
