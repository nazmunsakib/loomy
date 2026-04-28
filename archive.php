<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Loomy
 */

get_header();
?>

<div class="bg-white border-b border-gray-100 py-12 md:py-16">
	<div class="container mx-auto px-4 max-w-7xl">
		<div class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">
			<?php esc_html_e( 'Browsing Archive', 'loomy' ); ?>
		</div>
		<h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight">
			<?php the_archive_title(); ?>
		</h1>
		<?php the_archive_description( '<p class="mt-4 text-lg text-gray-500 max-w-2xl">', '</p>' ); ?>
	</div>
</div>

<div class="container mx-auto px-4 max-w-7xl py-12 md:py-16">
	<div class="grid grid-cols-1 lg:grid-cols-3 gap-12 xl:gap-16">
		
		<main id="primary" class="site-main lg:col-span-2">
			<?php if ( have_posts() ) : ?>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile;
					?>
				</div>

				<div class="mt-16 pt-8 border-t border-gray-100">
					<?php
					the_posts_pagination(
						array(
							'mid_size'  => 2,
							'prev_text' => '<span class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg> ' . esc_html__( 'Previous', 'loomy' ) . '</span>',
							'next_text' => '<span class="flex items-center gap-2">' . esc_html__( 'Next', 'loomy' ) . ' <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></span>',
						)
					);
					?>
				</div>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</main>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php
get_footer();
