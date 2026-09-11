import photoUploader from "./photo_uploads";
import kprApp from "./kpr_app";
import botNavBar from "./bot_nav_bar";
import currencyInput from "./currency_input";
import pwaInstaller from "./pwa_installer";
import triggerWaModal from './trigger_contact_modal';

window.trackEvent = function (module, eventName, payloadData = {}) {
    if (!window.navigator.onLine) return;
    const url = "/api/v1/log-activity";
    const data = JSON.stringify({ module, event_name: eventName, payload: payloadData });

    if (navigator.sendBeacon) {
        navigator.sendBeacon(url, new Blob([data], { type: "application/json" }));
        return;
    }
    window.requestIdleCallback(() => {
        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || "",
            },
            body: data,
        }).catch(() => {});
    });
};

// --- Registrasi Alpine Data ---
const registerAlpineComponents = () => {
    Alpine.data("photoUploader", photoUploader);
    Alpine.data("kprApp", kprApp);
    Alpine.data("botNavBar", botNavBar);
    Alpine.data("currencyInput", currencyInput);
    Alpine.data("triggerWaModal", triggerWaModal);
    Alpine.store("pwa", pwaInstaller());
};

if (window.Alpine) {
    registerAlpineComponents();
} else {
    document.addEventListener("alpine:init", registerAlpineComponents);
}

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
