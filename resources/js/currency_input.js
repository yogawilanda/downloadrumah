/**
|--------------------------------------------------------------------------
| Alpine.js Custom Form Input Components
|--------------------------------------------------------------------------
| @path : resources/js/currency_input.js
| @usage : Global Alpine data helpers for Currency Masking & Multiline Auto-Resize
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
*/

export default (wireModelPath) => ({
    displayValue: '',

    init() {
        const initialVal = this.$wire.get(wireModelPath);
        if (initialVal) this.displayValue = this.format(initialVal);

        this.$watch(`$wire.${wireModelPath}`, (val) => {
            this.displayValue = this.format(val);
        });
    },

    format(val) {
        if (!val) return '';
        let clean = val.toString().replace(/\D/g, '');
        return clean.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    },

    update(e) {
        let raw = e.target.value.replace(/\D/g, '');
        this.displayValue = this.format(raw);
        this.$wire.set(wireModelPath, raw ? parseInt(raw, 10) : null);
    }
});
