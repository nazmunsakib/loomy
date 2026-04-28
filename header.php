<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header py-4 bg-white border-b border-gray-100 sticky top-0 z-50">
	<div class="container mx-auto px-4 flex items-center justify-between">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold tracking-tight text-gray-900">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<nav id="site-navigation" class="main-navigation hidden md:block">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'menu_class'     => 'flex space-x-8 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors',
				)
			);
			?>
		</nav>

		<div class="header-actions flex items-center space-x-6">
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="relative group" title="<?php esc_attr_e( 'View your shopping cart', 'loomy' ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-gray-900 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
					</svg>
					<?php
					$cart_count = WC()->cart->get_cart_contents_count();
					if ( $cart_count > 0 ) :
						?>
						<span class="absolute -top-2 -right-2 bg-blue-600 text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">
							<?php echo esc_html( $cart_count ); ?>
						</span>
					<?php endif; ?>
				</a>
			<?php endif; ?>
			
			<button class="md:hidden text-gray-600 hover:text-gray-900 transition-colors" aria-label="<?php esc_attr_e( 'Toggle navigation', 'loomy' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
				</svg>
			</button>
		</div>
	</div>
</header>
