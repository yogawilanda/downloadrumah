/**
|--------------------------------------------------------------------------
| Alpine.js Custom Form Input Components
|--------------------------------------------------------------------------
| @path : resources/js/currency_input.js
| @usage : Global Alpine data helpers for Currency Masking
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
*/

export default (wireModelPath) => ({
    displayValue: '',
    timeout: null,

    init() {
        const initialVal = this.$wire.get(wireModelPath);
        if (initialVal) this.displayValue = this.format(initialVal);

        // Hanya format ulang dari server jika nilainya berubah dari tempat lain
        this.$watch(`$wire.${wireModelPath}`, (val) => {
            const cleanVal = val ? val.toString().replace(/\D/g, '') : '';
            const currentRaw = this.displayValue.replace(/\D/g, '');

            if (cleanVal !== currentRaw) {
                this.displayValue = this.format(val);
            }
        });
    },

    format(val) {
        if (!val) return '';
        return val.toString().replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    },

    update(e) {
        const raw = e.target.value.replace(/\D/g, '');

        // 1. Update UI lokal secara INSTAN (60 FPS di HP)
        this.displayValue = this.format(raw);

        // 2. Debounce sync ke Livewire (tunggu 300ms setelah selesai ngetik baru kirim)
        clearTimeout(this.timeout);
        this.timeout = setTimeout(() => {
            const numericVal = raw ? parseInt(raw, 10) : null;
            this.$wire.set(wireModelPath, numericVal, false); // false = jangan re-render seluruh komponen jika tidak perlu
        }, 300);
    }
});
