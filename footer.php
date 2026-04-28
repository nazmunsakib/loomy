<footer id="colophon" class="site-footer py-12 bg-brand-secondary mt-auto">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="footer-about">
                <h3 class="text-lg font-bold mb-4"><?php bloginfo( 'name' ); ?></h3>
                <p class="text-sm text-gray-600"><?php bloginfo( 'description' ); ?></p>
            </div>
            <div class="footer-menu">
                <h3 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-4"><?php esc_html_e( 'Quick Links', 'loomy' ); ?></h3>
                <?php
                wp_nav_menu( [
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'space-y-2 text-sm',
                ] );
                ?>
            </div>
        </div>
        <div class="footer-bottom border-t border-gray-200 mt-12 pt-8 text-center text-xs text-gray-500">
            <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'loomy' ); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
