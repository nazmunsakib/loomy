<?php
/**
 * Header Layout: Header Three (Logo Left, Menu Center)
 *
 * @package Loomy
 */
?>

<div class="flex items-center justify-between gap-6">
	<div class="site-branding w-1/4">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold tracking-tight text-gray-900">
				<?php bloginfo( 'name' ); ?>
			</a>
		<?php endif; ?>
	</div>

	<nav id="site-navigation" class="main-navigation hidden md:flex flex-1 items-center justify-center">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu-3',
				'container'      => 'ul',
				'menu_class'     => 'flex items-center gap-8 text-sm font-medium text-gray-500',
			)
		);
		?>
	</nav>

	<div class="header-actions flex items-center justify-end space-x-5 w-1/4">
		<?php get_template_part( 'template-parts/header/actions' ); ?>
	</div>
</div>
