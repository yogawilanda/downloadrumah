/**
 * <meta_config>
 * @path : resources/js/kpr_app.js | usage: Alpine.js KPR Calculator Component & Telemetry
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : JS Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

export default () => ({
    mode: 'buyer',
    jobOptions: [
        { id: 'pns', label: 'PNS / BUMN', dbr: 0.40 },
        { id: 'swasta', label: 'Karyawan', dbr: 0.35 },
        { id: 'wiraswasta', label: 'Wiraswasta', dbr: 0.30 }
    ],
    buyer: { income: 15000000, jobType: 'swasta', location: '', interest: 7.5, tenure: 15, dp: 50000000 },
    agent: { propertyPrice: 650000000, condition: 'new', dpPercent: 10, interest: 7.5, tenure: 15 },

    /**
     * Step 1.1: Helper Calculation Methods
     */
    getDbrPercentage() {
        const selected = this.jobOptions.find(j => j.id === this.buyer.jobType);
        return selected ? selected.dbr : 0.30;
    },

    /**
     * Step 1.2: Buyer Affordability Calculator & Telemetry
     */
    calculateBuyer() {
        const maxInstallment = (this.buyer.income || 0) * this.getDbrPercentage();
        const i = ((this.buyer.interest || 0) / 100) / 12;
        const n = (this.buyer.tenure || 0) * 12;

        if (i === 0 || n === 0) return { maxMonthlyInstallment: 0, maxPlafon: 0, maxPropertyPrice: 0 };

        const maxPlafon = maxInstallment * ((Math.pow(1 + i, n) - 1) / (i * Math.pow(1 + i, n)));
        const maxPropertyPrice = maxPlafon + (this.buyer.dp || 0);

        return {
            maxMonthlyInstallment: Math.round(maxInstallment),
            maxPlafon: Math.round(maxPlafon),
            maxPropertyPrice: Math.round(maxPropertyPrice)
        };
    },

    /**
     * Step 1.3: Agent Property Estimator
     */
    calculateAgent() {
        const dpAmount = ((this.agent.propertyPrice || 0) * (this.agent.dpPercent || 0)) / 100;
        const plafon = (this.agent.propertyPrice || 0) - dpAmount;
        const i = ((this.agent.interest || 0) / 100) / 12;
        const n = (this.agent.tenure || 0) * 12;
        const feePercent = this.agent.condition === 'new' ? 0.05 : 0.08;

        if (i === 0 || n === 0 || plafon <= 0) return { dpAmount: 0, plafon: 0, monthlyInstallment: 0, estimatedLegalFee: 0 };

        const monthlyInstallment = plafon * (i * Math.pow(1 + i, n)) / (Math.pow(1 + i, n) - 1);

        return {
            dpAmount: Math.round(dpAmount),
            plafon: Math.round(plafon),
            monthlyInstallment: Math.round(monthlyInstallment),
            estimatedLegalFee: Math.round((this.agent.propertyPrice || 0) * feePercent)
        };
    },

    /**
     * Step 1.4: Search URL Generator with Telemetry Event
     */
    getSearchUrl() {
        const price = this.calculateBuyer().maxPropertyPrice;
        let url = `/?max_price=${price}`;
        if (this.buyer.location) url += `&location=${this.buyer.location}`;

        /**
         * Telemetry: Record when user triggers search from KPR tool
         */
        if (typeof window.trackEvent === 'function') {
            window.trackEvent('tools', 'kpr_search_triggered', {
                mode: this.mode,
                max_price: price,
                income: this.buyer.income
            });
        }

        return url;
    },

    formatRupiah(number) {
        if (isNaN(number) || number === null) return "Rp 0";
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(number);
    }
});
