<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Loomy
 */

// Determine which sidebar ID to use.
$sidebar_id = is_home() || is_archive() || is_search() || is_single() ? 'loomy-blog-sidebar' : 'loomy-site-sidebar';

if ( ! is_active_sidebar( $sidebar_id ) ) {
	return;
}

$sidebar_pos = get_theme_mod( 'loomy_sidebar_position', 'right' );
$border_class = ( 'left' === $sidebar_pos ) ? 'lg:border-r lg:pr-12' : 'lg:border-l lg:pl-12';
?>

<aside id="secondary" 
	   class="widget-area w-full lg:w-1/3 border-gray-100 <?php echo esc_attr( $border_class ); ?>" 
	   role="complementary" 
	   style="order: var(--loomy-sidebar-order);"
	   aria-label="<?php esc_attr_e( 'Sidebar', 'loomy' ); ?>">
	
	<div class="sticky top-24 space-y-12">
		<?php 
		if ( is_single() ) {
			get_template_part( 'template-parts/components/toc' );
		}
		
		dynamic_sidebar( $sidebar_id ); 
		?>
	</div>
</aside>
