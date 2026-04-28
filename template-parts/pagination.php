<?php
/**
 * Template part for displaying pagination
 *
 * @package Loomy
 */

$pagination = paginate_links(
	array(
		'type'      => 'array',
		'prev_next' => true,
		'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>',
		'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>',
	)
);

if ( ! $pagination ) {
	return;
}
?>

<nav class="flex items-center justify-center gap-2 mt-16 pt-8 border-t border-gray-100" role="navigation" aria-label="<?php esc_attr_e( 'Posts navigation', 'loomy' ); ?>">
	<?php
	foreach ( $pagination as $link ) {
		// Active state.
		if ( strpos( $link, 'current' ) !== false ) {
			echo str_replace(
				array( 'page-numbers current', 'aria-current="page"' ),
				array( 'bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md shadow-blue-100', 'aria-current="page"' ),
				$link
			);
		} else {
			// Normal links.
			echo str_replace(
				'page-numbers',
				'bg-white border border-gray-100 text-gray-700 hover:border-blue-600 hover:text-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 shadow-sm',
				$link
			);
		}
	}
	?>
</nav>

<!-- Scroll to Top Button -->
<div x-data="{ 
		show: false,
		scrollToTop() {
			window.scrollTo({ top: 0, behavior: 'smooth' });
		}
	}"
	x-init="window.addEventListener('scroll', () => { show = window.scrollY > 500 })"
	class="fixed bottom-8 right-8 z-50">
	
	<button 
		x-show="show"
		x-transition:enter="transition ease-out duration-300"
		x-transition:enter-start="opacity-0 translate-y-10"
		x-transition:enter-end="opacity-100 translate-y-0"
		x-transition:leave="transition ease-in duration-300"
		x-transition:leave-start="opacity-100 translate-y-0"
		x-transition:leave-end="opacity-0 translate-y-10"
		@click="scrollToTop()"
		class="bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-100"
		aria-label="<?php esc_attr_e( 'Scroll to top', 'loomy' ); ?>">
		
		<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
		</svg>
	</button>
</div>
