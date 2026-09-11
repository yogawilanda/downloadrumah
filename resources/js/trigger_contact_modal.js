// path: resources/js/trigger_contact_modal.js

export default function triggerWaModal() {
    return {
        checkAuthAndRedirect(loginRouteUrl, modalName = 'login-modal') {
            // 1. Opsi jika menggunakan Alpine event
            window.dispatchEvent(new CustomEvent('open-modal', { detail: modalName }));

            // 2. Opsi jika menggunakan Livewire dispatch
            if (typeof Livewire !== 'undefined') {
                Livewire.dispatch('open-modal', { name: modalName });
            }

            // 3. Fallback: Direct Redirect jika tidak ada modal handler
            // window.location.href = loginRouteUrl;
        }
    };
}
