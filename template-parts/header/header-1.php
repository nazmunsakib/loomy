<?php
/**
 * Header Layout: Header One (Logo Left, Menu Left)
 *
 * @package Loomy
 */
?>

<div class="flex items-center justify-between gap-12">
	<div class="site-branding shrink-0">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold tracking-tight text-gray-900">
				<?php bloginfo( 'name' ); ?>
			</a>
		<?php endif; ?>
	</div>

	<nav id="site-navigation" class="main-navigation hidden md:flex items-center mr-auto">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu-1',
				'container'      => 'ul',
				'menu_class'     => 'flex items-center gap-8 text-sm font-medium text-gray-500',
			)
		);
		?>
	</nav>

	<div class="header-actions flex items-center space-x-5">
		<?php get_template_part( 'template-parts/header/actions' ); ?>
	</div>
</div>
