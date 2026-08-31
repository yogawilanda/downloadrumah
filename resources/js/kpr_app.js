export default () => ({
    mode: 'buyer',
    jobOptions: [
        { id: 'pns', label: 'PNS / BUMN', dbr: 0.40 },
        { id: 'swasta', label: 'Karyawan', dbr: 0.35 },
        { id: 'wiraswasta', label: 'Wiraswasta', dbr: 0.30 }
    ],
    buyer: {
        income: 15000000,
        jobType: 'swasta',
        location: '',
        interest: 7.5,
        tenure: 15,
        dp: 50000000
    },
    agent: {
        propertyPrice: 650000000,
        condition: 'new',
        dpPercent: 10,
        interest: 7.5,
        tenure: 15
    },
    getDbrPercentage() {
        const selected = this.jobOptions.find(j => j.id === this.buyer.jobType);
        return selected ? selected.dbr : 0.30;
    },
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
    calculateAgent() {
        const dpAmount = ((this.agent.propertyPrice || 0) * (this.agent.dpPercent || 0)) / 100;
        const plafon = (this.agent.propertyPrice || 0) - dpAmount;
        const i = ((this.agent.interest || 0) / 100) / 12;
        const n = (this.agent.tenure || 0) * 12;

        const feePercent = this.agent.condition === 'new' ? 0.05 : 0.08;
        const estimatedLegalFee = (this.agent.propertyPrice || 0) * feePercent;

        if (i === 0 || n === 0 || plafon <= 0) return { dpAmount: 0, plafon: 0, monthlyInstallment: 0, estimatedLegalFee: 0 };

        const monthlyInstallment = plafon * (i * Math.pow(1 + i, n)) / (Math.pow(1 + i, n) - 1);

        return {
            dpAmount: Math.round(dpAmount),
            plafon: Math.round(plafon),
            monthlyInstallment: Math.round(monthlyInstallment),
            estimatedLegalFee: Math.round(estimatedLegalFee)
        };
    },
    getSearchUrl() {
        const price = this.calculateBuyer().maxPropertyPrice;
        let url = `/?max_price=${price}`;
        if (this.buyer.location) {
            url += `&location=${this.buyer.location}`;
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
