<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Loomy
 */

get_header();
?>

<div class="bg-white border-b border-gray-100 py-12 md:py-16">
	<div class="container mx-auto px-4 max-w-7xl">
		<h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight">
			<?php
			if ( is_home() && ! is_front_page() ) {
				single_post_title();
			} else {
				esc_html_e( 'Our Blog', 'loomy' );
			}
			?>
		</h1>
		<p class="mt-4 text-lg text-gray-500 max-w-2xl">
			<?php esc_html_e( 'Explore the latest insights, stories, and updates from the Loomy team.', 'loomy' ); ?>
		</p>
	</div>
</div>

<?php get_template_part( 'template-parts/blog-wrapper' ); ?>
		
	<?php if ( have_posts() ) : ?>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			?>
		</div>

		<div class="mt-16">
			<?php get_template_part( 'template-parts/pagination' ); ?>
		</div>

	<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; ?>

<?php get_template_part( 'template-parts/blog-wrapper-end' ); ?>

<?php
get_footer();
