import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import Sortable from 'sortablejs';

window.Alpine = Alpine;
window.Chart = Chart;
window.Sortable = Sortable;

Alpine.store('app', {
    sidebarOpen: false,
});

/**
 * Theme persistence (light / dark), toggled from the navbar.
 */
function applyTheme(theme) {
    const root = document.documentElement;
    const resolved = theme === 'system'
        ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
        : theme;

    root.classList.toggle('dark', resolved === 'dark');
    localStorage.setItem('theme', theme);
}

function initTheme() {
    const saved = localStorage.getItem('theme') ?? 'system';
    document.documentElement.dataset.theme = saved;
    document.documentElement.setAttribute('data-theme', saved);
    applyTheme(saved);
    window.__setTheme = (t) => applyTheme(t);
}

Alpine.data('dispatchBoard', () => ({
    selectedDriver: null,
    dragging: null,
    removeFrom(collection) {
        const items = collection ?? [];
        const index = items.findIndex((item) => item.id === this.dragging?.id);
        if (index !== -1) items.splice(index, 1);
    },
}));

Alpine.magic('theme', () => (value) => applyTheme(value));

initTheme();

export { Sortable };