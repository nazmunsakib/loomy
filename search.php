<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Loomy
 */

get_header();
?>

<header class="page-header bg-gray-50 border-b border-gray-100 py-16 md:py-24">
	<div class="container text-center">
		<h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight mb-6">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'loomy' ), '<span class="text-primary">&ldquo;' . get_search_query() . '&rdquo;</span>' );
			?>
		</h1>
		<div class="max-w-xl mx-auto mt-8">
			<?php get_search_form(); ?>
		</div>
	</div>
</header>

<?php get_template_part( 'template-parts/blog-wrapper' ); ?>

	<?php if ( have_posts() ) : ?>
		<div class="search-results-meta mb-10 text-sm text-gray-500 font-medium">
			<?php
			global $wp_query;
			printf(
				esc_html( _n( 'Found %d result', 'Found %d results', $wp_query->found_posts, 'loomy' ) ),
				(int) $wp_query->found_posts
			);
			?>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
			<?php
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;
			?>
		</div>

		<div class="mt-16">
			<?php get_template_part( 'template-parts/pagination' ); ?>
		</div>

	<?php else : ?>
		<div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
			<div class="mb-6 inline-flex p-4 bg-gray-50 text-gray-400 rounded-full">
				<?php echo loomy_icon( 'search', 'h-10 w-10' ); ?>
			</div>
			<h2 class="text-2xl font-bold text-gray-900 mb-4"><?php esc_html_e( 'Nothing Found', 'loomy' ); ?></h2>
			<p class="text-gray-500 max-w-sm mx-auto">
				<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'loomy' ); ?>
			</p>
		</div>
	<?php endif; ?>

<?php get_template_part( 'template-parts/blog-wrapper-end' ); ?>

<?php
get_footer();
