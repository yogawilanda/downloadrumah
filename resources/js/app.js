/**
 * <meta_config>
 * @path : resources/js/app.js | usage: Main JavaScript Entry & Global Telemetry Helper
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

import photoUploader from "./photo_uploads";
import kprApp from "./kpr_app";
import botNavBar from "./bot_nav_bar";
import currencyInput from "./currency_input";
import pwaInstaller from "./pwa_installer";

/**
 * Step 1.1: Global Telemetry Tracker Helper (Fire-and-Forget)
 */
window.trackEvent = function (module, eventName, payloadData = {}) {
    if (!window.navigator.onLine) return;

    const url = "/api/v1/log-activity";
    const data = JSON.stringify({
        module: module,
        event_name: eventName,
        payload: payloadData,
    });

    // Gunakan sendBeacon jika didukung browser HP
    if (navigator.sendBeacon) {
        const blob = new Blob([data], { type: "application/json" });
        navigator.sendBeacon(url, blob);
        return;
    }

    // Fallback ke fetch saat CPU idle
    window.requestIdleCallback(() => {
        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN":
                    document.querySelector('meta[name="csrf-token"]')
                        ?.content || "",
            },
            body: data,
        }).catch(() => {});
    });
};

/**
 * Step 1.2: Alpine Component & Global Store Registration
 */
document.addEventListener("alpine:init", () => {
    Alpine.data("photoUploader", photoUploader);
    Alpine.data("kprApp", kprApp);
    Alpine.data("botNavBar", botNavBar);
    Alpine.data("currencyInput", currencyInput);

    // Register PWA sebagai Global Alpine Store ($store.pwa)
    Alpine.store("pwa", pwaInstaller());
});

/**
 * Step 1.3: Livewire Global Exception & Rate Limit Handler
 */
document.addEventListener("livewire:init", () => {
    Livewire.hook("request", ({ fail }) => {
        fail(({ status, preventDefault }) => {
            if (status === 429) {
                preventDefault();
                alert("Aksi terlalu cepat. Silakan tunggu beberapa detik.");
            }
        });
    });
});
