<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Loomy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'group flex flex-col bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="aspect-video overflow-hidden">
			<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
				<?php
				the_post_thumbnail(
					'loomy-card',
					array(
						'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500',
						'alt'   => the_title_attribute( array( 'echo' => false ) ),
					)
				);
				?>
			</a>
		</div>
	<?php endif; ?>

	<div class="p-6 flex flex-col flex-grow">
		<header class="mb-4">
			<div class="flex items-center gap-4 text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">
				<span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-gray-100 text-gray-800">
					<?php the_category( ', ' ); ?>
				</span>
				<time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
			</div>
			
			<h2 class="text-2xl font-bold text-gray-900 group-hover:text-primary transition-colors leading-tight">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
		</header>

		<div class="prose prose-sm text-gray-600 line-clamp-3 mb-6">
			<?php the_excerpt(); ?>
		</div>

		<footer class="mt-auto flex items-center justify-between pt-4 border-t border-gray-50">
			<div class="flex items-center gap-3">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 32, '', '', array( 'class' => 'rounded-full border border-gray-100' ) ); ?>
				<span class="text-sm font-medium text-gray-700"><?php the_author(); ?></span>
			</div>
			<a href="<?php the_permalink(); ?>" class="text-sm font-bold text-gray-900 hover:text-primary flex items-center gap-1 group/link transition-colors">
				<?php esc_html_e( 'Read More', 'loomy' ); ?>
				<?php echo loomy_icon( 'arrow-right', 'h-4 w-4 transform group-hover/link:translate-x-1 transition-transform' ); ?>
			</a>
		</footer>
	</div>
</article>
