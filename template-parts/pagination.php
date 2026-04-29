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
		'prev_text' => loomy_icon( 'chevron-left', 'h-5 w-5' ),
		'next_text' => loomy_icon( 'chevron-right', 'h-5 w-5' ),
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
				array( 'bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md shadow-primary/10', 'aria-current="page"' ),
				$link
			);
		} else {
			// Normal links.
			echo str_replace(
				'page-numbers',
				'bg-white border border-gray-100 text-gray-700 hover:border-primary hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 shadow-sm',
				$link
			);
		}
	}
	?>
</nav>

<!-- Scroll to Top Button -->
<div id="scroll-to-top-container" class="fixed bottom-8 right-8 z-50">
	<button 
		id="scroll-to-top"
		class="bg-secondary text-white p-3 rounded-full shadow-lg hover:brightness-110 hover:-translate-y-1 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-secondary/10 hidden [&.visible]:block"
		aria-label="<?php esc_attr_e( 'Scroll to top', 'loomy' ); ?>"
	>
		<?php echo loomy_icon( 'arrow-up', 'h-6 w-6' ); ?>
	</button>
</div>
