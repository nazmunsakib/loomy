<?php
/**
 * Header Layout: Header Two (Centered Logo & Menu)
 *
 * @package Loomy
 */
?>

<div class="flex flex-col items-center gap-6 text-center">
	<div class="site-branding">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold tracking-tight text-gray-900">
				<?php bloginfo( 'name' ); ?>
			</a>
		<?php endif; ?>
	</div>

	<div class="flex items-center justify-center w-full border-t border-gray-50 pt-4">
		<nav id="site-navigation" class="main-navigation hidden md:block">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu-2',
					'container'      => false,
					'menu_class'     => 'flex space-x-10 text-sm font-medium text-gray-500 hover:text-primary transition-colors',
				)
			);
			?>
		</nav>
	</div>

	<div class="header-actions absolute top-1/2 right-0 -translate-y-1/2 flex items-center space-x-5 px-4 sm:px-6 lg:px-8">
		<?php get_template_part( 'template-parts/header/actions' ); ?>
	</div>
</div>
