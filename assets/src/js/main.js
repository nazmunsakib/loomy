/**
 * Loomy Core UI
 * Vanilla ES6+ Event Delegation Pattern
 */

import './animations.js';

document.addEventListener('DOMContentLoaded', () => {
    // --- UI Interactions ---

    // Search Toggle Handler
    document.addEventListener('click', (e) => {
        const toggle = e.target.closest('[data-loomy-toggle="search"]');
        if (!toggle) return;

        e.preventDefault();
        const targetId = toggle.getAttribute('aria-controls') || 'search-overlay';
        const target = document.getElementById(targetId);
        
        if (target) {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', !isExpanded);
            target.classList.toggle('active');
            
            if (!isExpanded) {
                const input = target.querySelector('input');
                if (input) input.focus();
            }
        }
    });

    // --- Third-Party Integration Hooks ---

    // Elementor AJAX Support
    document.addEventListener('elementor/frontend/render', (event) => {
        // Re-init specific Vanilla modules here if needed
        console.log('Elementor content rendered:', event.detail.element);
    });

    // WooCommerce AJAX Support
    document.addEventListener('wc_fragments_refreshed', () => {
        console.log('WooCommerce fragments refreshed');
    });

    document.addEventListener('added_to_cart', (e, fragments) => {
        if (fragments) {
            // Update cart count or other UI elements
        }
    });
});
