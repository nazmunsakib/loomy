<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Loomy
 */

get_header();

/**
 * Handle Elementor Header/Footer Locations
 * If Elementor is taking over the content location, we bypass our default wrapper.
 */
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) :
	get_template_part( 'template-parts/page-content' );
endif;

get_footer();
