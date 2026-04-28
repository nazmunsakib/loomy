import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import intersect from '@alpinejs/intersect';
import blogSidebar from './modules/blog-sidebar';

// Register plugins
Alpine.plugin(collapse);
Alpine.plugin(intersect);

// Register modules
Alpine.data('blogSidebar', blogSidebar);

Alpine.start();
document.addEventListener('elementor/frontend/render', () => Alpine.initTree(document));
document.addEventListener('wc_fragments_refreshed', () => Alpine.initTree(document));
