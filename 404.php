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
			<div class="mb-12 inline-flex items-center justify-center p-8 bg-primary/10 text-primary rounded-full animate-bounce">
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
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="w-full sm:w-auto px-8 py-4 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:brightness-110 hover:-translate-y-1 transition-all duration-300">
					<?php esc_html_e( 'Back to Home', 'loomy' ); ?>
				</a>
				
				<button @click="searchOpen = true" class="w-full sm:w-auto px-8 py-4 bg-secondary text-white font-bold rounded-xl hover:brightness-110 transition-all duration-300">
					<?php esc_html_e( 'Search Site', 'loomy' ); ?>
				</button>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
