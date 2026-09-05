/**
 * <meta_config>
 * @path : resources/js/app.js | usage: Main JavaScript Entry & Global Telemetry Helper
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : JS Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

import photoUploader from './photo_uploads';
import kprApp from './kpr_app';
import botNavBar from './bot_nav_bar';

/**
 * Step 1.1: Global Telemetry Tracker Helper (Fire-and-Forget)
 */
window.trackEvent = function (module, eventName, payloadData = {}) {
    if (!window.navigator.onLine) return;

    fetch('/api/v1/log-activity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({
            module: module,
            event_name: eventName,
            payload: payloadData
        })
    }).catch(err => {
        /**
         * Fail-safe Exception Handling (agar UI/UX tetap berjalan normal)
         */
        console.warn('[Analytics Telemetry Error]', err);
    });
};

/**
 * Step 1.2: Alpine Component Registration
 */
document.addEventListener('alpine:init', () => {
    Alpine.data('photoUploader', photoUploader);
    Alpine.data('kprApp', kprApp);
    Alpine.data('botNavBar', botNavBar);
});

/**
 * Step 1.3: Livewire Global Exception & Rate Limit Handler
 */
document.addEventListener('livewire:init', () => {
    Livewire.hook('request', ({ fail }) => {
        fail(({ status, preventDefault }) => {
            if (status === 429) {
                preventDefault();
                alert('Aksi terlalu cepat. Silakan tunggu beberapa detik.');
            }
        });
    });
});
