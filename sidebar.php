<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Loomy
 */

if ( ! is_active_sidebar( 'loomy-blog-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" 
	   class="widget-area w-full lg:w-1/3" 
	   role="complementary" 
	   style="order: var(--loomy-sidebar-order);"
	   aria-label="<?php esc_attr_e( 'Sidebar', 'loomy' ); ?>">
	


	<div class="sticky top-24 space-y-12">
		<?php dynamic_sidebar( 'loomy-blog-sidebar' ); ?>
	</div>
</aside>
