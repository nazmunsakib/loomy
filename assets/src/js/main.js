import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import blogSidebar from './modules/blog-sidebar';

// Register plugins
Alpine.plugin(collapse);

// Register modules
Alpine.data('blogSidebar', blogSidebar);

Alpine.start();
document.addEventListener('elementor/frontend/render', () => Alpine.initTree(document));
document.addEventListener('wc_fragments_refreshed', () => Alpine.initTree(document));
