<?php
/**
 * Icons Class.
 *
 * @package Loomy
 */

declare( strict_types=1 );

namespace Loomy;

/**
 * Class Icons
 *
 * Handles the centralized SVG icon system using Direct Inlining.
 *
 * @final
 */
final class Icons {

	/**
	 * Icon directory path.
	 *
	 * @var string
	 */
	private static string $icon_dir;

	/**
	 * Cache key prefix.
	 *
	 * @var string
	 */
	private static string $cache_prefix = 'loomy_icon_';

	/**
	 * Get an icon HTML string (Inlined).
	 *
	 * @param string $name       Icon name (filename without .svg).
	 * @param string $class      Additional CSS classes.
	 * @param string $extra_attr Additional raw HTML attributes (e.g. Alpine.js bindings).
	 * @return string The SVG markup.
	 */
	public static function render( string $name, string $class = 'h-5 w-5', string $extra_attr = '' ): string {
		if ( empty( self::$icon_dir ) ) {
			self::$icon_dir = get_template_directory() . '/assets/icons';
		}

		$cache_key = self::$cache_prefix . $name;
		$svg_raw   = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? false : get_transient( $cache_key );

		if ( false === $svg_raw ) {
			$file_path = self::$icon_dir . '/' . $name . '.svg';
			
			if ( ! file_exists( $file_path ) ) {
				return '<!-- Icon ' . esc_html( $name ) . ' not found -->';
			}

			$svg_raw = file_get_contents( $file_path );
			
			if ( ! empty( $svg_raw ) ) {
				set_transient( $cache_key, $svg_raw, DAY_IN_SECONDS );
			}
		}

		if ( empty( $svg_raw ) ) {
			return '';
		}

		// Clean the SVG and inject classes/attributes.
		return self::clean_and_inject( $svg_raw, $class, $extra_attr );
	}

	/**
	 * Clean SVG and inject classes/attributes.
	 *
	 * @param string $svg        Raw SVG content.
	 * @param string $class      CSS classes.
	 * @param string $extra_attr Extra attributes.
	 * @return string
	 */
	private static function clean_and_inject( string $svg, string $class, string $extra_attr ): string {
		// Remove XML declaration and doctype.
		$svg = preg_replace( '/<\?xml.*\?>/i', '', $svg );
		$svg = preg_replace( '/<!DOCTYPE.*?>/i', '', $svg );

		// Find the opening <svg tag.
		if ( preg_match( '/<svg[^>]*>/i', $svg, $matches ) ) {
			$old_tag = $matches[0];
			
			// Build new attributes.
			$new_attrs = sprintf( ' class="icon %s" aria-hidden="true" role="img" %s ', esc_attr( $class ), $extra_attr );
			
			// Replace existing class/width/height with our controlled ones.
			$new_tag = preg_replace( '/\s(class|width|height|aria-hidden|role)="[^"]*"/i', '', $old_tag );
			$new_tag = str_replace( '<svg', '<svg' . $new_attrs, $new_tag );
			
			$svg = str_replace( $old_tag, $new_tag, $svg );
		}

		// Normalize colors.
		$svg = preg_replace( '/stroke="(?!none)[^"]+"/', 'stroke="currentColor"', $svg );
		$svg = preg_replace( '/fill="(?!none)[^"]+"/', 'fill="currentColor"', $svg );

		return trim( $svg );
	}
}
