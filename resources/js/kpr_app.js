/**
 * <meta_config>
 * @path : resources/js/kpr_app.js | usage: Alpine.js KPR Calculator Component & Formatted Inputs
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

    // Format & Parse Helpers untuk Input Live
    parseNumber(val) {
        if (!val) return 0;
        return Number(String(val).replace(/\D/g, '')) || 0;
    },

    formatInput(e, targetObj, key) {
        const raw = this.parseNumber(e.target.value);
        targetObj[key] = raw;
        e.target.value = raw ? raw.toLocaleString('id-ID') : '';
    },

    formatTerbilangShort(number) {
        const num = this.parseNumber(number);
        if (!num || num <= 0) return '0 Rupiah';

        if (num >= 1000000000) {
            const val = (num / 1000000000).toFixed(2).replace(/\.00$/, '').replace('.', ',');
            return `${val} Miliar`;
        }
        if (num >= 1000000) {
            const val = (num / 1000000).toFixed(2).replace(/\.00$/, '').replace('.', ',');
            return `${val} Juta`;
        }
        if (num >= 1000) {
            const val = (num / 1000).toFixed(0);
            return `${val} Ribu`;
        }
        return `${num} Rupiah`;
    },

    calculateBuyer() {
        const maxInstallment = this.parseNumber(this.buyer.monthlyBudget);
        const i = ((Number(this.buyer.interest) || 0) / 100) / 12;
        const n = (Number(this.buyer.tenure) || 0) * 12;
        const dp = this.parseNumber(this.buyer.dp);

        if (i === 0 || n === 0 || maxInstallment <= 0) return { maxMonthlyInstallment: 0, maxPlafon: 0, maxPropertyPrice: 0 };

        const maxPlafon = maxInstallment * ((Math.pow(1 + i, n) - 1) / (i * Math.pow(1 + i, n)));
        const maxPropertyPrice = maxPlafon + dp;

        this.trackDebouncedEvent('kpr_buyer_calculated', {
            mode: 'buyer',
            monthly_budget: maxInstallment,
            interest: this.buyer.interest,
            tenure_years: this.buyer.tenure,
            dp_amount: dp,
            location: this.buyer.location,
            result_max_price: Math.round(maxPropertyPrice),
            result_max_installment: Math.round(maxInstallment)
        });

        return {
            maxMonthlyInstallment: Math.round(maxInstallment),
            maxPlafon: Math.round(maxPlafon),
            maxPropertyPrice: Math.round(maxPropertyPrice)
        };
    },

    calculateAgent() {
        const price = this.parseNumber(this.agent.propertyPrice);
        const dpPercent = Number(this.agent.dpPercent) || 0;
        const dpAmount = (price * dpPercent) / 100;
        const plafon = price - dpAmount;
        const i = ((Number(this.agent.interest) || 0) / 100) / 12;
        const n = (Number(this.agent.tenure) || 0) * 12;
        const feePercent = this.agent.condition === 'new' ? 0.05 : 0.08;

        if (i === 0 || n === 0 || plafon <= 0) return { dpAmount: 0, plafon: 0, monthlyInstallment: 0, estimatedLegalFee: 0 };

        const monthlyInstallment = plafon * (i * Math.pow(1 + i, n)) / (Math.pow(1 + i, n) - 1);

        this.trackDebouncedEvent('kpr_agent_calculated', {
            mode: 'agent',
            property_price: price,
            condition: this.agent.condition,
            dp_percent: dpPercent,
            interest: this.agent.interest,
            tenure_years: this.agent.tenure,
            result_monthly_installment: Math.round(monthlyInstallment)
        });

        return {
            dpAmount: Math.round(dpAmount),
            plafon: Math.round(plafon),
            monthlyInstallment: Math.round(monthlyInstallment),
            estimatedLegalFee: Math.round(price * feePercent)
        };
    },

    trackDebouncedEvent(eventName, payloadData) {
        clearTimeout(this.debounceTimer);
        this.debounceTimer = setTimeout(() => {
            if (typeof window.trackEvent === 'function') {
                window.trackEvent('tools', eventName, payloadData);
            }
        }, 1500);
    },

    getSearchUrl() {
        const price = this.calculateBuyer().maxPropertyPrice;
        let url = `/?max_price=${price}`;
        if (this.buyer.location) url += `&location=${this.buyer.location}`;
        return url;
    },

    formatRupiah(number) {
        if (isNaN(number) || number === null) return "Rp 0";
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
    }
});
