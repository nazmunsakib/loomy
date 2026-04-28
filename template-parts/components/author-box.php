<?php
/**
 * Component: Author Box
 *
 * @package Loomy
 */

?>

<section class="author-box bg-white border border-gray-100 rounded-2xl p-8 my-12 flex flex-col md:flex-row items-center md:items-start gap-8 shadow-sm">
	<div class="flex-shrink-0">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 120, '', '', array( 'class' => 'rounded-full border-4 border-gray-50 shadow-inner' ) ); ?>
	</div>
	
	<div class="flex-grow text-center md:text-left">
		<span class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-2 block">
			<?php esc_html_e( 'About the Author', 'loomy' ); ?>
		</span>
		<h3 class="text-2xl font-bold text-gray-900 mb-4">
			<?php the_author_posts_link(); ?>
		</h3>
		<p class="text-gray-600 leading-relaxed mb-6 max-w-2xl">
			<?php the_author_meta( 'description' ); ?>
		</p>
		
		<div class="flex flex-wrap items-center justify-center md:justify-start gap-4">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="text-sm font-bold text-gray-900 hover:text-blue-600 transition-colors flex items-center gap-2 group">
				<?php esc_html_e( 'View all posts', 'loomy' ); ?>
				<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
				</svg>
			</a>
		</div>
	</div>
</section>
