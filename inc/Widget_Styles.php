<?php
/**
 * Widget Styles Class.
 *
 * @package Loomy
 */

declare( strict_types=1 );

namespace Loomy;

/**
 * Class Widget_Styles
 *
 * Injects Tailwind CSS classes into default WordPress widgets.
 *
 * @final
 */
final class Widget_Styles {

	/**
	 * Initialize widget style hooks.
	 */
	public function __construct() {
		add_filter( 'get_search_form', array( $this, 'search_form_classes' ) );
		add_filter( 'wp_list_categories', array( $this, 'list_widget_classes' ) );
		add_filter( 'get_archives_link', array( $this, 'list_widget_classes' ) );
		add_filter( 'widget_tag_cloud_args', array( $this, 'tag_cloud_classes' ) );
	}

	/**
	 * Styles the default WordPress search form.
	 *
	 * @param string $form The search form HTML.
	 * @return string Modified search form HTML.
	 */
	public function search_form_classes( string $form ): string {
		$form = str_replace(
			'class="search-form"',
			'class="search-form relative"',
			$form
		);
		$form = str_replace(
			'class="search-field"',
			'class="search-field w-full bg-white border border-gray-100 rounded-lg py-3 px-4 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all outline-none"',
			$form
		);
		$form = str_replace(
			'class="search-submit"',
			'class="search-submit absolute right-2 top-1/2 -translate-y-1/2 bg-gray-900 text-white p-1.5 rounded-md hover:bg-blue-600 transition-colors"',
			$form
		);

		return $form;
	}

	/**
	 * Styles category and archive lists.
	 *
	 * @param string $output The list HTML.
	 * @return string Modified list HTML.
	 */
	public function list_widget_classes( string $output ): string {
		// Style the list items and links.
		$output = str_replace(
			'<li class="cat-item',
			'<li class="cat-item mb-2 last:mb-0',
			$output
		);
		
		$output = str_replace(
			'<a ',
			'<a class="flex items-center justify-between text-sm text-gray-600 hover:text-blue-600 transition-colors py-1 group" ',
			$output
		);

		// Style the counts if they exist.
		$output = str_replace(
			'(',
			'<span class="text-xs bg-gray-100 text-gray-400 px-2 py-0.5 rounded-full group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">',
			$output
		);
		$output = str_replace(
			')',
			'</span>',
			$output
		);

		return $output;
	}

	/**
	 * Styles the tag cloud widget.
	 *
	 * @param array $args Tag cloud arguments.
	 * @return array Modified arguments.
	 */
	public function tag_cloud_classes( array $args ): array {
		$args['smallest'] = 0.75;
		$args['largest']  = 0.75;
		$args['unit']     = 'rem';
		$args['format']   = 'flat';
		$args['separator'] = "\n";
		
		// We use a filter on the final output to add classes.
		add_filter( 'wp_generate_tag_cloud', function( $tag_cloud ) {
			return str_replace(
				'<a ',
				'<a class="inline-block bg-white border border-gray-100 text-gray-600 px-3 py-1.5 rounded-md text-xs font-medium hover:border-blue-600 hover:text-blue-600 hover:bg-blue-50 transition-all mb-2 mr-2" ',
				$tag_cloud
			);
		});

		return $args;
	}
}
