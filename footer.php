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

<?php
$footer_copyright = get_theme_mod( 'loomy_footer_copyright', '' );
?>

<footer id="colophon" class="site-footer bg-[#041a1a] text-[#8a9999] pt-24 pb-12 relative overflow-hidden">
	
	<!-- Decorative Element -->
	<div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-gradient-to-br from-primary/20 to-transparent rounded-full pointer-events-none blur-3xl"></div>

	<div class="container relative z-10">
		
		<!-- Top Section: Branding -->
		<div class="mb-16">
			<?php if ( has_custom_logo() ) : ?>
				<div class="footer-logo mb-6">
					<?php the_custom_logo(); ?>
				</div>
			<?php else : ?>
				<div class="flex items-center gap-2 mb-6">
					<div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
						<div class="w-4 h-4 bg-[#041a1a] rounded-full"></div>
					</div>
					<h2 class="text-white text-3xl font-black tracking-tighter"><?php bloginfo( 'name' ); ?></h2>
				</div>
			<?php endif; ?>
			<p class="max-w-md text-sm leading-relaxed">
				<?php bloginfo( 'description' ); ?>
				<?php if ( empty( get_bloginfo( 'description' ) ) ) : ?>
					<?php esc_html_e( "We're a creative agency transforming how companies connect and thrive through innovative design", 'loomy' ); ?>
				<?php endif; ?>
			</p>
		</div>

		<!-- Separator -->
		<div class="border-t border-[#1a2e2e] mb-12"></div>

		<!-- Middle Section: Links Grid -->
		<div class="grid grid-cols-2 md:grid-cols-4 gap-12 mb-16">
			
			<!-- Column 1: Service -->
			<div class="footer-col">
				<h3 class="text-white text-base font-bold mb-8"><?php esc_html_e( 'Service', 'loomy' ); ?></h3>
				<ul class="space-y-4 text-sm">
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'UI/UX Design', 'loomy' ); ?></a></li>
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Brand Design', 'loomy' ); ?></a></li>
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Web Development', 'loomy' ); ?></a></li>
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Mobile App Design', 'loomy' ); ?></a></li>
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Software Development', 'loomy' ); ?></a></li>
				</ul>
			</div>

			<!-- Column 2: Information -->
			<div class="footer-col">
				<h3 class="text-white text-base font-bold mb-8"><?php esc_html_e( 'Information', 'loomy' ); ?></h3>
				<ul class="space-y-4 text-sm">
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'FAQ', 'loomy' ); ?></a></li>
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Blog', 'loomy' ); ?></a></li>
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Support', 'loomy' ); ?></a></li>
				</ul>
			</div>

			<!-- Column 3: Quick Links -->
			<div class="footer-col">
				<h3 class="text-white text-base font-bold mb-8"><?php esc_html_e( 'Quick Links', 'loomy' ); ?></h3>
				<ul class="space-y-4 text-sm">
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'About Us', 'loomy' ); ?></a></li>
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Portfolio', 'loomy' ); ?></a></li>
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Career', 'loomy' ); ?></a></li>
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Blogs', 'loomy' ); ?></a></li>
					<li><a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Contact Us', 'loomy' ); ?></a></li>
				</ul>
			</div>

			<!-- Column 4: Contact Us -->
			<div class="footer-col">
				<h3 class="text-white text-base font-bold mb-8"><?php esc_html_e( 'Contact Us', 'loomy' ); ?></h3>
				<ul class="space-y-4 text-sm">
					<li class="flex items-center gap-3">
						<span class="text-white"><?php echo loomy_icon( 'mail', 'h-4 w-4' ); ?></span>
						<a href="mailto:hello@olynex.com" class="hover:text-primary transition-colors">hello@olynex.com</a>
					</li>
					<li class="flex items-center gap-3">
						<span class="text-white"><?php echo loomy_icon( 'phone', 'h-4 w-4' ); ?></span>
						<a href="tel:+8801540737487" class="hover:text-primary transition-colors">+880 1540-737487</a>
					</li>
				</ul>
			</div>

		</div>

		<!-- Bottom Bar Separator -->
		<div class="border-t border-[#1a2e2e] mb-8"></div>

		<!-- Bottom Bar -->
		<div class="flex flex-col md:flex-row justify-between items-center gap-8 text-xs font-medium">
			
			<!-- Social Icons -->
			<div class="flex items-center gap-4">
				<a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-[#1a2e2e] text-white hover:bg-primary hover:border-primary transition-all duration-300">
					<?php echo loomy_icon( 'behance', 'h-4 w-4' ); ?>
				</a>
				<a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-[#1a2e2e] text-white hover:bg-primary hover:border-primary transition-all duration-300">
					<?php echo loomy_icon( 'globe', 'h-4 w-4' ); ?>
				</a>
				<a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-[#1a2e2e] text-white hover:bg-primary hover:border-primary transition-all duration-300">
					<?php echo loomy_icon( 'facebook', 'h-4 w-4' ); ?>
				</a>
				<a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-[#1a2e2e] text-white hover:bg-primary hover:border-primary transition-all duration-300">
					<?php echo loomy_icon( 'instagram', 'h-4 w-4' ); ?>
				</a>
				<a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-[#1a2e2e] text-white hover:bg-primary hover:border-primary transition-all duration-300">
					<?php echo loomy_icon( 'linkedin', 'h-4 w-4' ); ?>
				</a>
			</div>

			<!-- Copyright -->
			<div class="text-[#5a6a6a]">
				<?php if ( ! empty( $footer_copyright ) ) : ?>
					<?php echo wp_kses_post( $footer_copyright ); ?>
				<?php else : ?>
					&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php esc_html_e( 'All rights reserved', 'loomy' ); ?> <?php bloginfo( 'name' ); ?>.
				<?php endif; ?>
			</div>

			<!-- Legal Links -->
			<div class="flex items-center gap-6 text-white">
				<a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Terms', 'loomy' ); ?></a>
				<a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Privacy', 'loomy' ); ?></a>
				<a href="#" class="hover:text-primary transition-colors"><?php esc_html_e( 'Cookies', 'loomy' ); ?></a>
			</div>

		</div>

	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
