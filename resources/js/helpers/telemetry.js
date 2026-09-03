/**
 * <meta_config>
 * @path : resources/js/kpr_app.js | usage: Alpine.js KPR Calculator Component
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : JS Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

import { trackDebouncedEvent } from './helpers/telemetry';

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
     * Step 1.1: Buyer Calculation & Full Input Telemetry
     */
    calculateBuyer() {
        const dbr = (this.jobOptions.find(j => j.id === this.buyer.jobType) || {}).dbr || 0.30;
        const maxInstallment = (this.buyer.income || 0) * dbr;
        const i = ((this.buyer.interest || 0) / 100) / 12;
        const n = (this.buyer.tenure || 0) * 12;

        if (i === 0 || n === 0) return { maxMonthlyInstallment: 0, maxPlafon: 0, maxPropertyPrice: 0 };

        const maxPlafon = maxInstallment * ((Math.pow(1 + i, n) - 1) / (i * Math.pow(1 + i, n)));
        const maxPropertyPrice = maxPlafon + (this.buyer.dp || 0);

        trackDebouncedEvent('tools', 'kpr_buyer_calculated', {
            mode: 'buyer', income: this.buyer.income, job_type: this.buyer.jobType,
            interest: this.buyer.interest, tenure_years: this.buyer.tenure, dp_amount: this.buyer.dp,
            location: this.buyer.location, result_max_price: Math.round(maxPropertyPrice),
            result_max_installment: Math.round(maxInstallment)
        });

        return {
            maxMonthlyInstallment: Math.round(maxInstallment),
            maxPlafon: Math.round(maxPlafon),
            maxPropertyPrice: Math.round(maxPropertyPrice)
        };
    },

    /**
     * Step 1.2: Agent Property Estimator & Telemetry
     */
    calculateAgent() {
        const dpAmount = ((this.agent.propertyPrice || 0) * (this.agent.dpPercent || 0)) / 100;
        const plafon = (this.agent.propertyPrice || 0) - dpAmount;
        const i = ((this.agent.interest || 0) / 100) / 12;
        const n = (this.agent.tenure || 0) * 12;
        const feePercent = this.agent.condition === 'new' ? 0.05 : 0.08;

        if (i === 0 || n === 0 || plafon <= 0) return { dpAmount: 0, plafon: 0, monthlyInstallment: 0, estimatedLegalFee: 0 };

        const monthlyInstallment = plafon * (i * Math.pow(1 + i, n)) / (Math.pow(1 + i, n) - 1);

        trackDebouncedEvent('tools', 'kpr_agent_calculated', {
            mode: 'agent', property_price: this.agent.propertyPrice, condition: this.agent.condition,
            dp_percent: this.agent.dpPercent, interest: this.agent.interest, tenure_years: this.agent.tenure,
            result_monthly_installment: Math.round(monthlyInstallment)
        });

        return {
            dpAmount: Math.round(dpAmount), plafon: Math.round(plafon),
            monthlyInstallment: Math.round(monthlyInstallment),
            estimatedLegalFee: Math.round((this.agent.propertyPrice || 0) * feePercent)
        };
    },

    getSearchUrl() {
        const price = this.calculateBuyer().maxPropertyPrice;
        return `/?max_price=${price}` + (this.buyer.location ? `&location=${this.buyer.location}` : '');
    },

    formatRupiah(number) {
        if (isNaN(number) || number === null) return "Rp 0";
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
    }
});
