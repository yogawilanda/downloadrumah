///
// location: resources\js\bot_nav_bar.js
// used in appJS : botNavBar
// Usage : Bottom Navbar front end handler

export default (initialTab = '') => ({
    openMenu: false,
    activeTab: initialTab,

    init() {
        document.addEventListener('livewire:navigated', () => {
            this.updateActiveTabFromRoute();
        });
    },

    setTab(tab) {
        this.activeTab = tab;
    },

    updateActiveTabFromRoute() {
        const path = window.location.pathname;
        if (path === '/' || path.includes('home')) this.activeTab = 'home';
        else if (path.includes('mortgage') || path.includes('kpr')) this.activeTab = 'kpr';
        else if (path.includes('listings')) this.activeTab = 'listings';
        else if (path.includes('dashboard') || path.includes('profile') || path.includes('login')) this.activeTab = 'menu';
    }
});
