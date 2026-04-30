/**
 * Loomy GSAP Animation Manager
 * 
 * Handles theme-wide animations with lifecycle management,
 * accessibility checks, and editor isolation.
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register ScrollTrigger
gsap.registerPlugin(ScrollTrigger);

class LoomyAnimations {
    constructor() {
        this.ctx = null;
        this.init();
    }

    /**
     * Initialize animations
     */
    init() {
        // 1. Accessibility Check
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            console.warn('Loomy: Reduced motion detected. Animations disabled.');
            return;
        }

        // 2. Editor Guard
        if (this.isEditor()) {
            return;
        }

        // 3. Setup GSAP Context for easy cleanup
        this.ctx = gsap.context(() => {
            this.initScrollAnimations();
            this.initHoverEffects();
        });

        // 4. Cleanup on page change (for SPA/AJAX compatibility if needed)
        window.addEventListener('unload', () => this.destroy());
    }

    /**
     * Check if we are inside the WordPress Editor
     */
    isEditor() {
        return (
            document.body.classList.contains('wp-admin') ||
            document.querySelector('.block-editor-iframe__body') !== null ||
            window.wp?.blockEditor !== undefined
        );
    }

    /**
     * Initialize Scroll-based animations
     */
    initScrollAnimations() {
        const animateItems = document.querySelectorAll('.loomy-animate-on-scroll');

        if (!animateItems.length) return;

        animateItems.forEach((el) => {
            const animationType = el.dataset.animation || 'fade-up';
            
            let fromVars = { opacity: 0 };
            let toVars = { 
                opacity: 1, 
                duration: 1, 
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                    toggleActions: 'play none none none',
                    // markers: true, // Debugging
                }
            };

            switch(animationType) {
                case 'fade-up':
                    fromVars.y = 30;
                    toVars.y = 0;
                    break;
                case 'fade-in':
                    break;
                case 'slide-in-right':
                    fromVars.x = 50;
                    toVars.x = 0;
                    break;
            }

            gsap.fromTo(el, fromVars, toVars);
        });
    }

    /**
     * Initialize interactive hover effects
     */
    initHoverEffects() {
        const hoverCards = document.querySelectorAll('.loomy-hover-tilt');

        hoverCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                gsap.to(card, { scale: 1.02, duration: 0.3, ease: 'power1.out' });
            });
            card.addEventListener('mouseleave', () => {
                gsap.to(card, { scale: 1, duration: 0.3, ease: 'power1.out' });
            });
        });
    }

    /**
     * Global cleanup
     */
    destroy() {
        if (this.ctx) {
            this.ctx.revert(); // Reverts all GSAP animations created within this context
        }
        ScrollTrigger.getAll().forEach(t => t.kill());
    }
}

// Initialize on DOM Ready
document.addEventListener('DOMContentLoaded', () => {
    window.LoomyAnimations = new LoomyAnimations();
});
