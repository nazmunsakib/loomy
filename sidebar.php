<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Loomy
 */

if ( ! is_active_sidebar( 'loomy-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" 
	   class="widget-area lg:col-span-1" 
	   role="complementary" 
	   aria-label="<?php esc_attr_e( 'Sidebar', 'loomy' ); ?>"
	   x-data="blogSidebar()">
	
	<!-- Mobile Sidebar Toggle -->
	<button @click="toggle()" 
			class="lg:hidden w-full flex items-center justify-between p-4 bg-white border border-gray-100 rounded-xl mb-6 text-sm font-bold shadow-sm hover:bg-gray-50 transition-colors"
			:aria-expanded="isOpen">
		<span><?php esc_html_e( 'Show Filters & Search', 'loomy' ); ?></span>
		<svg xmlns="http://www.w3.org/2000/svg" 
			 class="h-5 w-5 transform transition-transform duration-200" 
			 :class="isOpen ? 'rotate-180' : ''"
			 fill="none" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
		</svg>
	</button>

	<div class="sticky top-24 space-y-8 bg-gray-50/50 backdrop-blur-sm p-6 lg:p-8 rounded-xl border border-gray-100 transition-all duration-300 overflow-hidden lg:block!"
		 x-show="isOpen"
		 x-collapse>
		<?php dynamic_sidebar( 'loomy-sidebar' ); ?>
	</div>
</aside>
