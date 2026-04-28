<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package Loomy
 */

$sidebar_enabled  = get_theme_mod( 'loomy_sidebar_enabled', true );
$is_sidebar_active = is_active_sidebar( 'loomy-site-sidebar' );
$show_sidebar     = $sidebar_enabled && $is_sidebar_active;
$spacing          = get_theme_mod( 'loomy_page_spacing', 'py-12 md:py-20' );
$show_breadcrumbs = get_theme_mod( 'loomy_page_show_breadcrumbs', true );
?>

<main id="content" class="site-main <?php echo esc_attr( $spacing ); ?>">
	<div class="container">
		<div class="<?php echo $show_sidebar ? 'flex flex-col lg:flex-row gap-12 xl:gap-16' : 'max-w-3xl mx-auto'; ?>">
			
			<div class="main-content w-full <?php echo $show_sidebar ? 'lg:w-2/3' : ''; ?>" style="order: var(--loomy-content-order);">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="page-header mb-10">
						<?php if ( $show_breadcrumbs && function_exists( 'yoast_breadcrumb' ) ) : ?>
							<div class="breadcrumbs text-xs text-gray-400 mb-4">
								<?php yoast_breadcrumb(); ?>
							</div>
						<?php endif; ?>

						<?php the_title( '<h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight mb-4">', '</h1>' ); ?>
						
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="page-featured-image mt-8 rounded-2xl overflow-hidden shadow-lg">
								<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto object-cover' ) ); ?>
							</div>
						<?php endif; ?>
					</header>

					<div class="entry-content prose prose-lg max-w-none prose-blue">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'loomy' ),
								'after'  => '</div>',
							)
						);
						?>
					</div>
				</article>
			</div>

			<?php if ( $show_sidebar ) : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>

		</div>
	</div>
</main>
