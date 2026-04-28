<?php
/**
 * Helpers Class.
 *
 * @package Loomy
 */

declare( strict_types=1 );

namespace Loomy;

/**
 * Class Helpers
 *
 * Provides general utility methods for the theme templates.
 *
 * @final
 */
final class Helpers {

	/**
	 * Renders an icon using the Icons system.
	 *
	 * @param string $name       Icon name.
	 * @param string $class      CSS classes.
	 * @param string $extra_attr Extra HTML attributes.
	 * @return string
	 */
	public static function icon( string $name, string $class = 'h-5 w-5', string $extra_attr = '' ): string {
		return \Loomy\Icons::render( $name, $class, $extra_attr );
	}

	/**
	 * Formats a reading time string.
	 *
	 * @param int $minutes Minutes.
	 * @return string
	 */
	public static function format_reading_time( int $minutes ): string {
		return sprintf(
			/* translators: %d: number of minutes */
			esc_html( _n( '%d min read', '%d mins read', $minutes, 'loomy' ) ),
			$minutes
		);
	}
}
