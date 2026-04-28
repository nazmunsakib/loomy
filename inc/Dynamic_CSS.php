<?php
/**
 * Dynamic CSS Generation Class.
 *
 * @package Loomy
 */

declare( strict_types=1 );

namespace Loomy;

/**
 * Class Dynamic_CSS
 */
final class Dynamic_CSS {

	/**
	 * Generate layout-related CSS variables.
	 *
	 * @return string
	 */
	public static function get_layout_css(): string {
		$sidebar_pos = get_theme_mod( 'loomy_sidebar_position', 'right' );
		$order_sidebar = ( 'left' === $sidebar_pos ) ? '-1' : '1';
		$order_content = ( 'left' === $sidebar_pos ) ? '1' : '-1';

		return "
			:root {
				--loomy-sidebar-order: {$order_sidebar};
				--loomy-content-order: {$order_content};
			}
		";
	}

	/**
	 * Inject styles via wp_add_inline_style.
	 */
	public static function inject_styles(): void {
		wp_add_inline_style( 'loomy-style', self::get_layout_css() );
	}
}
