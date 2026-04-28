<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Loomy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'group flex flex-col h-full bg-white rounded-3xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1 transition-all duration-300' ); ?>>
	<div class="p-8 flex flex-col h-full">
		<header class="entry-header mb-4">
			<div class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-blue-600 mb-4">
				<span class="px-2 py-1 bg-blue-50 rounded">
					<?php echo esc_html( get_post_type() ); ?>
				</span>
				<span class="text-gray-300">&bull;</span>
				<time datetime="<?php echo get_the_date( 'c' ); ?>" class="text-gray-400">
					<?php echo get_the_date(); ?>
				</time>
			</div>
			
			<?php the_title( sprintf( '<h2 class="entry-title text-xl md:text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-tight mb-4"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header>

		<div class="entry-summary text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3">
			<?php the_excerpt(); ?>
		</div>

		<footer class="mt-auto pt-6 border-t border-gray-50">
			<a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-sm font-bold text-gray-900 group/link">
				<?php esc_html_e( 'View Result', 'loomy' ); ?>
				<span class="group-hover/link:translate-x-1 transition-transform">
					<?php echo loomy_icon( 'arrow-right', 'h-4 w-4' ); ?>
				</span>
			</a>
		</footer>
	</div>
</article>
