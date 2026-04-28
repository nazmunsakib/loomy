<?php
require_once get_theme_file_path( 'vendor/autoload.php' );
new \Loomy\Theme_Setup();
new \Loomy\Enqueue();
new \Loomy\Widget_Styles();

/**
 * Global helper to render an icon.
 * This is a wrapper for \Loomy\Helpers::icon() for ease of use in templates.
 */
function loomy_icon( string $name, string $class = 'h-5 w-5', string $extra_attr = '' ): string {
	return \Loomy\Helpers::icon( $name, $class, $extra_attr );
}
