<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Loomy
 */

get_header();

get_template_part( 'template-parts/components/reading-progress' );
?>

<div class="site-main container mx-auto px-4 max-w-7xl py-12 md:py-20">
	<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 xl:gap-20">
		
		<!-- Main Content -->
		<main id="primary" class="lg:col-span-8">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content-single' );

				get_template_part( 'template-parts/components/author-box' );

				get_template_part( 'template-parts/components/post-nav' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template( '/template-parts/comments.php' );
				endif;

			endwhile;
			?>
		</main>

		<!-- Sidebar Area -->
		<aside class="lg:col-span-4 hidden lg:block">
			<div class="sticky-sidebar space-y-12">
				<?php get_template_part( 'template-parts/components/toc' ); ?>
				<?php get_sidebar(); ?>
			</div>
		</aside>

	</div>
</div>

<?php
get_footer();
