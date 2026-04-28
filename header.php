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

		<div class="header-actions flex items-center space-x-5">
			<button class="text-gray-600 hover:text-blue-600 transition-colors" aria-label="<?php esc_attr_e( 'Search', 'loomy' ); ?>">
				<?php echo loomy_icon( 'search', 'h-5 w-5' ); ?>
			</button>

			<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="text-gray-600 hover:text-blue-600 transition-colors" title="<?php esc_attr_e( 'My Account', 'loomy' ); ?>">
				<?php echo loomy_icon( 'user', 'h-5 w-5' ); ?>
			</a>

			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="relative group" title="<?php esc_attr_e( 'View your shopping cart', 'loomy' ); ?>">
					<?php echo loomy_icon( 'cart', 'h-6 w-6 text-gray-600 group-hover:text-blue-600 transition-colors' ); ?>
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
				<?php echo loomy_icon( 'menu', 'h-6 w-6' ); ?>
			</button>
		</div>
	</div>
</header>
