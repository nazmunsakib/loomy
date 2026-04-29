<?php
/**
 * Header Action Icons Template Part
 *
 * @package Loomy
 */
?>

<div class="relative flex items-center h-full">
	<button 
		data-loomy-toggle="search"
		aria-controls="search-overlay"
		aria-expanded="false"
		class="text-gray-600 hover:text-primary transition-colors p-2" 
		aria-label="<?php esc_attr_e( 'Search', 'loomy' ); ?>"
	>
		<?php echo loomy_icon( 'search', 'h-5 w-5' ); ?>
	</button>

	<!-- Search Dropdown -->
	<div 
		id="search-overlay"
		class="absolute top-full right-0 mt-4 w-[28rem] bg-white rounded-3xl shadow-2xl border border-gray-100 p-6 z-[110] hidden [&.active]:block"
	>
		<button data-loomy-toggle="search" aria-controls="search-overlay" class="absolute top-4 right-4 text-gray-400 hover:text-gray-900 transition-colors p-1">
			<?php echo loomy_icon( 'close', 'h-4 w-4' ); ?>
		</button>
		<div class="mt-2">
			<?php get_search_form(); ?>
		</div>
	</div>
</div>

<?php if ( class_exists( 'WooCommerce' ) ) : ?>
	<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="relative group" title="<?php esc_attr_e( 'View your shopping cart', 'loomy' ); ?>">
		<?php echo loomy_icon( 'cart', 'h-6 w-6 text-gray-600 group-hover:text-primary transition-colors' ); ?>
		<?php
		$cart_count = WC()->cart->get_cart_contents_count();
		if ( $cart_count > 0 ) :
			?>
			<span class="absolute -top-2 -right-2 bg-primary text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">
				<?php echo esc_html( $cart_count ); ?>
			</span>
		<?php endif; ?>
	</a>
<?php endif; ?>

<button class="md:hidden text-gray-600 hover:text-gray-900 transition-colors" aria-label="<?php esc_attr_e( 'Toggle navigation', 'loomy' ); ?>">
	<?php echo loomy_icon( 'menu', 'h-6 w-6' ); ?>
</button>
