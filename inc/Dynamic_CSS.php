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
	 * Get Customizer values and generate CSS variables.
	 *
	 * @return string
	 */
	public static function get_css_variables(): string {
		// Typography.
		$body_font    = get_theme_mod( 'loomy_body_font', 'system-ui' );
		$heading_font = get_theme_mod( 'loomy_heading_font', 'system-ui' );
		$base_size    = get_theme_mod( 'loomy_base_font_size', '16' );
		$line_height  = get_theme_mod( 'loomy_line_height', '1.6' );

		// Colors.
		$primary   = get_theme_mod( 'loomy_primary_color', '#2563eb' );
		$secondary = get_theme_mod( 'loomy_secondary_color', '#64748b' );
		$bg_color  = get_theme_mod( 'loomy_bg_color', '#ffffff' );
		$text_color = get_theme_mod( 'loomy_text_color', '#0f172a' );

		// Header.
		$header_width = get_theme_mod( 'loomy_header_width', '1280' );

		return "
			:root {
				/* Typography */
				--loomy-font-body: {$body_font}, system-ui, sans-serif;
				--loomy-font-heading: {$heading_font}, system-ui, sans-serif;
				--loomy-base-size: {$base_size}px;
				--loomy-line-height: {$line_height};

				/* Colors */
				--loomy-primary: {$primary};
				--loomy-secondary: {$secondary};
				--loomy-bg: {$bg_color};
				--loomy-text: {$text_color};

				/* Layout */
				--loomy-header-width: {$header_width}px;
			}
		";
	}

	/**
	 * Hook into wp_enqueue_scripts to add inline style.
	 *
	 * @return void
	 */
	public static function inject_styles(): void {
		wp_add_inline_style( 'loomy-style', self::get_css_variables() );
	}
}
