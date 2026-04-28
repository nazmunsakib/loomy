<?php
/**
 * The template for displaying search forms
 *
 * @package Loomy
 */

?>
<form role="search" method="get" class="search-form relative flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only" for="s">
		<?php echo _x( 'Search for:', 'label', 'loomy' ); ?>
	</label>
	<div class="relative w-full group">
		<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
			<?php echo loomy_icon( 'search', 'h-5 w-5' ); ?>
		</div>
		<input type="search" id="s"
			class="search-field block w-full pl-11 pr-4 py-3 bg-gray-50 border-gray-100 rounded-xl text-sm placeholder-gray-400 focus:bg-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
			placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'loomy' ); ?>"
			value="<?php echo get_search_query(); ?>" name="s" />
	</div>
	<button type="submit" class="search-submit ml-2 px-6 py-3 bg-primary text-white text-sm font-bold rounded-xl hover:shadow-lg hover:brightness-110 transition-all duration-300">
		<?php echo esc_html_x( 'Search', 'submit button', 'loomy' ); ?>
	</button>
</form>
