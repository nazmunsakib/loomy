<?php
/**
 * Header Layout: Header Two (Floating Pill — Logo Left, Nav Center, CTA Right)
 *
 * @package Loomy
 */
?>

<div class="max-w-[1140px] mx-auto loomy-header-2 flex items-center justify-between gap-6 bg-white rounded-full shadow-lg shadow-gray-100/80 border border-gray-100 px-6 py-2.5">

	<!-- Logo — Left -->
	<div class="site-branding shrink-0">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-xl font-extrabold tracking-tight text-gray-900">
				<?php bloginfo( 'name' ); ?>
			</a>
		<?php endif; ?>
	</div>

	<!-- Navigation — Center -->
	<nav id="site-navigation-2" class="main-navigation hidden md:flex flex-1 items-center justify-center" aria-label="<?php esc_attr_e( 'Primary Navigation', 'loomy' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu-2',
				'container'      => 'ul',
				'menu_class'     => 'flex items-center gap-8 text-sm font-medium text-gray-500',
			)
		);
		?>
	</nav>

	<!-- CTA Button — Right -->
	<div class="shrink-0 flex items-center gap-3">
		<?php
		$cta_label = get_theme_mod( 'loomy_header_cta_label', __( 'Book a Meeting', 'loomy' ) );
		$cta_url   = get_theme_mod( 'loomy_header_cta_url', '#' );
		if ( $cta_label && $cta_url ) :
			?>
			<a
				href="<?php echo esc_url( $cta_url ); ?>"
				class="loomy-pill-cta inline-flex items-center gap-1.5 text-sm font-semibold text-gray-900 hover:text-primary transition-colors whitespace-nowrap"
			>
				<?php echo esc_html( $cta_label ); ?>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3.5 h-3.5 -rotate-45" aria-hidden="true">
					<path fill-rule="evenodd" d="M8.22 2.97a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06l2.97-2.97H3.75a.75.75 0 0 1 0-1.5h7.44L8.22 4.03a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
				</svg>
			</a>
		<?php endif; ?>

		<!-- Mobile hamburger -->
		<button
			class="md:hidden p-2 text-gray-600 hover:text-gray-900 transition-colors"
			aria-label="<?php esc_attr_e( 'Toggle navigation', 'loomy' ); ?>"
			aria-controls="site-navigation-2"
			aria-expanded="false"
		>
			<?php echo loomy_icon( 'menu', 'h-5 w-5' ); ?>
		</button>
	</div>

</div>
