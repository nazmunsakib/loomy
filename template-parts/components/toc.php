<?php
/**
 * Component: Table of Contents (Vanilla Version)
 *
 * @package Loomy
 */

$headings = \Loomy\Post_Helpers::get_toc_headings( get_the_content() );

if ( empty( $headings ) ) {
	return;
}
?>

<nav 
	id="toc-container"
	class="toc-container bg-gray-50/50 backdrop-blur-sm rounded-xl border border-gray-100 p-6 sticky top-24"
	aria-label="<?php esc_attr_e( 'Table of Contents', 'loomy' ); ?>"
>
	<div class="flex items-center justify-between mb-4">
		<h3 class="text-sm font-bold uppercase tracking-widest text-gray-900">
			<?php esc_html_e( 'On This Page', 'loomy' ); ?>
		</h3>
		<button data-loomy-toggle="toc" class="lg:hidden text-gray-500">
			<?php echo loomy_icon( 'chevron-down', 'h-5 w-5 transition-transform' ); ?>
		</button>
	</div>

	<ul id="toc-list" class="space-y-3 lg:block">
		<?php foreach ( $headings as $heading ) : ?>
			<li class="<?php echo $heading['level'] === 3 ? 'ml-4' : ''; ?>">
				<a 
					href="#<?php echo esc_attr( $heading['id'] ); ?>" 
					class="toc-link text-sm transition-all duration-200 block py-1 text-gray-500 hover:text-gray-900"
					data-target="<?php echo esc_attr( $heading['id'] ); ?>"
				>
					<?php echo esc_html( $heading['text'] ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
