<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Loomy
 */

?>

<footer id="colophon" class="site-footer bg-gray-900 text-gray-300 py-16">
	<div class="container mx-auto px-4 max-w-7xl">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
			<div class="footer-branding">
				<h2 class="text-white text-2xl font-bold mb-6"><?php bloginfo( 'name' ); ?></h2>
				<p class="text-sm leading-relaxed mb-6">
					<?php bloginfo( 'description' ); ?>
				</p>
			</div>

			<div class="footer-menu">
				<h3 class="text-white text-sm font-bold uppercase tracking-widest mb-6"><?php esc_html_e( 'Quick Links', 'loomy' ); ?></h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
						'container'      => false,
						'menu_class'     => 'space-y-4 text-sm',
					)
				);
				?>
			</div>

			<div class="footer-contact">
				<h3 class="text-white text-sm font-bold uppercase tracking-widest mb-6"><?php esc_html_e( 'Contact Us', 'loomy' ); ?></h3>
				<ul class="space-y-4 text-sm">
					<li><?php esc_html_e( 'Email: hello@example.com', 'loomy' ); ?></li>
					<li><?php esc_html_e( 'Support: 24/7 Available', 'loomy' ); ?></li>
				</ul>
			</div>

			<div class="footer-newsletter">
				<h3 class="text-white text-sm font-bold uppercase tracking-widest mb-6"><?php esc_html_e( 'Stay Updated', 'loomy' ); ?></h3>
				<p class="text-sm mb-4"><?php esc_html_e( 'Subscribe to our newsletter for the latest updates.', 'loomy' ); ?></p>
				<form class="flex">
					<input type="email" placeholder="<?php esc_attr_e( 'Your email', 'loomy' ); ?>" class="bg-gray-800 border-none rounded-l-lg px-4 py-2 text-sm w-full focus:ring-1 focus:ring-blue-600">
					<button class="bg-blue-600 text-white px-4 py-2 rounded-r-lg text-sm font-bold hover:bg-blue-700 transition-colors">
						<?php esc_html_e( 'Join', 'loomy' ); ?>
					</button>
				</form>
			</div>
		</div>

		<div class="mt-16 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4 text-xs">
			<p>
				&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. 
				<?php esc_html_e( 'All rights reserved.', 'loomy' ); ?>
			</p>
			<p>
				<?php
				printf(
					/* translators: 1: Name 2: URL */
					esc_html__( 'Designed by %1$s', 'loomy' ),
					'<a href="https://github.com/nazmunsakib" class="text-white hover:underline">Nazmun Sakib</a>'
				);
				?>
			</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
