<?php
/**
 * Component: Post Navigation
 *
 * @package Loomy
 */

$prev_post = get_previous_post();
$next_post = get_next_post();

if ( ! $prev_post && ! $next_post ) {
	return;
}
?>

<nav class="post-navigation grid grid-cols-1 md:grid-cols-2 gap-6 my-16" aria-label="<?php esc_attr_e( 'Post navigation', 'loomy' ); ?>">
	<?php if ( $prev_post ) : ?>
		<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="group p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
			<span class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 block group-hover:text-blue-600 transition-colors">
				<?php esc_html_e( 'Previous Post', 'loomy' ); ?>
			</span>
			<h4 class="text-lg font-bold text-gray-900 line-clamp-2">
				<?php echo esc_html( get_the_title( $prev_post->ID ) ); ?>
			</h4>
		</a>
	<?php else : ?>
		<div></div>
	<?php endif; ?>

	<?php if ( $next_post ) : ?>
		<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="group p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 text-right">
			<span class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 block group-hover:text-blue-600 transition-colors">
				<?php esc_html_e( 'Next Post', 'loomy' ); ?>
			</span>
			<h4 class="text-lg font-bold text-gray-900 line-clamp-2">
				<?php echo esc_html( get_the_title( $next_post->ID ) ); ?>
			</h4>
		</a>
	<?php endif; ?>
</nav>
