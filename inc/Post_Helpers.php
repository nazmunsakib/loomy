<?php
/**
 * Post Helpers Class.
 *
 * @package Loomy
 */

declare( strict_types=1 );

namespace Loomy;

/**
 * Class Post_Helpers
 *
 * Provides utility methods for single post templates.
 *
 * @final
 */
final class Post_Helpers {

	/**
	 * Calculate estimated reading time for a post.
	 *
	 * @param string $content The post content.
	 * @return int Reading time in minutes.
	 */
	public static function get_reading_time( string $content ): int {
		$word_count = str_word_count( strip_tags( $content ) );
		$reading_time = ceil( $word_count / 200 ); // Average 200 words per minute.
		return (int) ( $reading_time > 0 ? $reading_time : 1 );
	}

	/**
	 * Extract H2 and H3 headings from content for TOC.
	 *
	 * @param string $content The post content.
	 * @return array List of headings with text and ID.
	 */
	public static function get_toc_headings( string $content ): array {
		$headings = array();
		preg_match_all( '/<h([2-3]).*?>(.*?)<\/h\1>/', $content, $matches, PREG_SET_ORDER );

		foreach ( $matches as $match ) {
			$text = strip_tags( $match[2] );
			$id   = sanitize_title( $text );
			$headings[] = array(
				'level' => (int) $match[1],
				'text'  => $text,
				'id'    => $id,
			);
		}

		return $headings;
	}

	/**
	 * Filter post content to add IDs to headings for TOC.
	 *
	 * @param string $content The post content.
	 * @return string Modified content.
	 */
	public static function add_ids_to_headings( string $content ): string {
		if ( ! is_single() ) {
			return $content;
		}

		return preg_replace_callback(
			'/<h([2-3])(.*?)>(.*?)<\/h\1>/',
			function ( $matches ) {
				$text = strip_tags( $matches[3] );
				$id   = sanitize_title( $text );
				return "<h{$matches[1]}{$matches[2]} id=\"{$id}\">{$matches[3]}</h{$matches[1]}>";
			},
			$content
		);
	}
}
