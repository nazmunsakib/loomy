/**
 * Blog Sidebar Module
 * Handles mobile toggle and sticky behavior interactions.
 */
export default function blogSidebar() {
    return {
        isOpen: false,
        
        init() {
            // Automatically open on desktop
            this.checkViewport();
            window.addEventListener('resize', () => this.checkViewport());
        },

        toggle() {
            this.isOpen = !this.isOpen;
        },

        checkViewport() {
            if (window.innerWidth >= 1024) {
                this.isOpen = true;
            }
        }
    }
}
