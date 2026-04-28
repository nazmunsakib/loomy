<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Loomy
 */

get_header();
?>

<main id="primary" class="site-main py-24 md:py-32">
	<div class="container text-center">
		<div class="max-w-2xl mx-auto">
			<div class="mb-12 inline-flex items-center justify-center p-8 bg-blue-50 text-blue-600 rounded-full animate-bounce">
				<?php echo loomy_icon( 'search', 'h-20 w-20' ); ?>
			</div>

			<h1 class="text-6xl md:text-8xl font-black text-gray-900 tracking-tight mb-6">
				<?php esc_html_e( '404', 'loomy' ); ?>
			</h1>

			<h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">
				<?php esc_html_e( 'Oops! Page not found.', 'loomy' ); ?>
			</h2>

			<p class="text-lg text-gray-500 mb-12 leading-relaxed">
				<?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'loomy' ); ?>
			</p>

			<div class="flex flex-col sm:flex-row items-center justify-center gap-4">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300">
					<?php esc_html_e( 'Back to Home', 'loomy' ); ?>
				</a>
				
				<form role="search" method="get" class="w-full sm:w-auto flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" class="w-full px-6 py-4 bg-gray-50 border-gray-100 rounded-l-xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'loomy' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
					<button type="submit" class="px-6 py-4 bg-gray-900 text-white font-bold rounded-r-xl hover:bg-black transition-colors">
						<?php echo loomy_icon( 'search', 'h-5 w-5' ); ?>
					</button>
				</form>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
