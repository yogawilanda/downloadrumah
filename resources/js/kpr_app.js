/**
 * <meta_config>
 * @path : resources/js/kpr_app.js | usage: Alpine.js KPR Calculator Component
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : JS Docblock
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

export default () => ({
    mode: 'buyer',
    buyer: { monthlyBudget: 5000000, location: '', interest: 7.5, tenure: 15, dp: 50000000 },
    agent: { propertyPrice: 650000000, condition: 'new', dpPercent: 10, interest: 7.5, tenure: 15 },
    debounceTimer: null,

    /**
     * Parse raw numeric string to integer safely.
     */
    parseNumber(val) {
        return Number(String(val || 0).replace(/\D/g, '')) || 0;
    },

    /**
     * Format number to short Indonesian textual representation.
     */
    formatTerbilangShort(number) {
        const num = this.parseNumber(number);
        if (!num) return '0 Rupiah';
        if (num >= 1e9) return `${(num / 1e9).toFixed(2).replace(/\.00$/, '').replace('.', ',')} Miliar`;
        if (num >= 1e6) return `${(num / 1e6).toFixed(2).replace(/\.00$/, '').replace('.', ',')} Juta`;
        if (num >= 1e3) return `${(num / 1e3).toFixed(0)} Ribu`;
        return `${num} Rupiah`;
    },

    /**
     * Compute Buyer KPR calculations without direct side-effects.
     */
    get calcBuyer() {
        const installment = this.parseNumber(this.buyer.monthlyBudget);
        const i = ((Number(this.buyer.interest) || 0) / 100) / 12;
        const n = (Number(this.buyer.tenure) || 0) * 12;
        const dp = this.parseNumber(this.buyer.dp);

        if (!i || !n || !installment) return { maxMonthlyInstallment: 0, maxPlafon: 0, maxPropertyPrice: 0 };

        const pow = Math.pow(1 + i, n);
        const maxPlafon = Math.round(installment * ((pow - 1) / (i * pow)));
        const maxPrice = Math.round(maxPlafon + dp);

        this.trackDebouncedEvent('kpr_buyer_calculated', {
            mode: 'buyer', monthly_budget: installment, interest: this.buyer.interest,
            tenure_years: this.buyer.tenure, dp_amount: dp, location: this.buyer.location,
            result_max_price: maxPrice, result_max_installment: installment
        });

        return { maxMonthlyInstallment: installment, maxPlafon, maxPropertyPrice: maxPrice };
    },

    /**
     * Compute Agent KPR calculations without direct side-effects.
     */
    get calcAgent() {
        const price = this.parseNumber(this.agent.propertyPrice);
        const dpPercent = Number(this.agent.dpPercent) || 0;
        const dpAmount = (price * dpPercent) / 100;
        const plafon = price - dpAmount;
        const i = ((Number(this.agent.interest) || 0) / 100) / 12;
        const n = (Number(this.agent.tenure) || 0) * 12;

        if (!i || !n || plafon <= 0) return { dpAmount: 0, plafon: 0, monthlyInstallment: 0, estimatedLegalFee: 0 };

        const pow = Math.pow(1 + i, n);
        const installment = Math.round(plafon * (i * pow) / (pow - 1));
        const fee = Math.round(price * (this.agent.condition === 'new' ? 0.05 : 0.08));

        this.trackDebouncedEvent('kpr_agent_calculated', {
            mode: 'agent', property_price: price, condition: this.agent.condition,
            dp_percent: dpPercent, interest: this.agent.interest, tenure_years: this.agent.tenure,
            result_monthly_installment: installment
        });

        return { dpAmount: Math.round(dpAmount), plafon: Math.round(plafon), monthlyInstallment: installment, estimatedLegalFee: fee };
    },

    /**
     * Fire-and-forget telemetry with debounce protection.
     */
    trackDebouncedEvent(eventName, payloadData) {
        clearTimeout(this.debounceTimer);
        this.debounceTimer = setTimeout(() => {
            if (typeof window.trackEvent === 'function') {
                window.trackEvent('tools', eventName, payloadData);
            }
        }, 1500);
    },

    /**
     * Get search query string for buyer mode.
     */
    get searchUrl() {
        const price = this.calcBuyer.maxPropertyPrice;
        return `/?max_price=${price}${this.buyer.location ? `&location=${this.buyer.location}` : ''}`;
    },

    /**
     * Format raw number to IDR Currency format.
     */
    formatRupiah(num) {
        if (!num || isNaN(num)) return 'Rp 0';
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(num);
    }
});
