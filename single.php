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

<?php get_template_part( 'template-parts/blog-wrapper' ); ?>

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

<?php get_template_part( 'template-parts/blog-wrapper-end' ); ?>

<?php
get_footer();
