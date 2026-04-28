import Alpine from 'alpinejs';
Alpine.start();
document.addEventListener('elementor/frontend/render', () => Alpine.initTree(document));
document.addEventListener('wc_fragments_refreshed', () => Alpine.initTree(document));
