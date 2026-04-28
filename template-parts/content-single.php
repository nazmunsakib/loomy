<?php
/**
 * Template part for displaying single posts
 *
 * @package Loomy
 */

$reading_time = \Loomy\Post_Helpers::get_reading_time( get_the_content() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<!-- Hero Section -->
	<header class="post-header mb-12">
		<div class="flex items-center gap-4 mb-6">
			<span class="bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full">
				<?php the_category( ', ' ); ?>
			</span>
			<span class="text-xs text-gray-400 font-medium flex items-center gap-1">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
				<?php printf( esc_html__( '%d min read', 'loomy' ), $reading_time ); ?>
			</span>
		</div>

		<h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 leading-tight tracking-tight mb-8">
			<?php the_title(); ?>
		</h1>

		<div class="flex items-center justify-between py-6 border-y border-gray-100 mb-10">
			<div class="flex items-center gap-4">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 48, '', '', array( 'class' => 'rounded-full border-2 border-white shadow-sm' ) ); ?>
				<div>
					<span class="block text-sm font-bold text-gray-900"><?php the_author(); ?></span>
					<time datetime="<?php echo get_the_date( 'c' ); ?>" class="text-xs text-gray-500"><?php echo get_the_date(); ?></time>
				</div>
			</div>

			<div class="flex items-center gap-2" x-data="{ copied: false }">
				<button 
					@click="if (navigator.clipboard) { navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000) }"
					class="p-2 text-gray-400 hover:text-blue-600 transition-colors relative"
					:class="copied ? 'text-green-500' : ''"
					aria-label="<?php esc_attr_e( 'Copy link', 'loomy' ); ?>"
				>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 012-2v-8a2 2 0 01-2-2h-8a2 2 0 01-2 2v8a2 2 0 012 2z" />
					</svg>
					<span x-show="copied" x-transition class="absolute -top-10 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-[10px] py-1 px-2 rounded whitespace-nowrap">
						<?php esc_html_e( 'Link Copied!', 'loomy' ); ?>
					</span>
				</button>
			</div>
		</div>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="featured-image rounded-3xl overflow-hidden aspect-video shadow-2xl shadow-gray-200">
				<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover' ) ); ?>
			</div>
		<?php endif; ?>
	</header>

	<!-- Content Area -->
	<div class="post-content prose prose-lg md:prose-xl max-w-none prose-headings:font-black prose-headings:text-gray-900 prose-a:text-blue-600 hover:prose-a:text-blue-700 prose-img:rounded-3xl prose-blockquote:border-l-4 prose-blockquote:border-blue-600 prose-blockquote:bg-blue-50/30 prose-blockquote:py-2 prose-blockquote:px-6 prose-blockquote:italic"
		 x-data>
		<?php the_content(); ?>
	</div>

	<!-- Footer -->
	<footer class="post-footer mt-16 pt-8 border-t border-gray-100">
		<div class="flex flex-wrap gap-2">
			<?php the_tags( '<span class="text-xs font-bold text-gray-400 uppercase tracking-widest mr-2">' . esc_html__( 'Tags:', 'loomy' ) . '</span>', ' ', '' ); ?>
		</div>
	</footer>

</article>
