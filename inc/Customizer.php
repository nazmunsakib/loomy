<?php
/**
 * Customizer Registration Class.
 *
 * @package Loomy
 */

declare( strict_types=1 );

namespace Loomy;

/**
 * Class Customizer
 */
final class Customizer {

	/**
	 * Register Customizer settings.
	 *
	 * @param \WP_Customize_Manager $wp_customize Customizer manager.
	 */
	public function register( \WP_Customize_Manager $wp_customize ): void {

		// 1. Header Section.
		$wp_customize->add_section( 'loomy_header', array( 'title' => esc_html__( 'Header', 'loomy' ), 'priority' => 30 ) );
		$this->add_setting( $wp_customize, 'loomy_header_layout', 'split', 'sanitize_text_field', 'loomy_header', esc_html__( 'Header Layout', 'loomy' ), 'select', array(
			'left'   => esc_html__( 'Left Aligned', 'loomy' ),
			'center' => esc_html__( 'Centered', 'loomy' ),
			'split'  => esc_html__( 'Split (Logo Left, Menu Right)', 'loomy' ),
		) );
		$this->add_setting( $wp_customize, 'loomy_header_sticky', true, 'rest_sanitize_boolean', 'loomy_header', esc_html__( 'Sticky Header', 'loomy' ), 'checkbox' );

		// 2. Blog Section.
		$wp_customize->add_section( 'loomy_blog', array( 'title' => esc_html__( 'Blog Layout', 'loomy' ), 'priority' => 40 ) );
		$this->add_setting( $wp_customize, 'loomy_blog_style', 'grid', 'sanitize_text_field', 'loomy_blog', esc_html__( 'Archive Style', 'loomy' ), 'select', array(
			'grid' => esc_html__( 'Grid', 'loomy' ),
			'list' => esc_html__( 'List', 'loomy' ),
		) );
		$this->add_setting( $wp_customize, 'loomy_sidebar_enabled', true, 'rest_sanitize_boolean', 'loomy_blog', esc_html__( 'Enable Sidebar', 'loomy' ), 'checkbox' );
		$this->add_setting( $wp_customize, 'loomy_sidebar_position', 'right', 'sanitize_text_field', 'loomy_blog', esc_html__( 'Sidebar Position', 'loomy' ), 'select', array(
			'left'  => esc_html__( 'Left', 'loomy' ),
			'right' => esc_html__( 'Right', 'loomy' ),
		) );

		// 4. Page Settings Section.
		$wp_customize->add_section( 'loomy_pages', array( 'title' => esc_html__( 'Page Settings', 'loomy' ), 'priority' => 55 ) );
		$this->add_setting( $wp_customize, 'loomy_page_spacing', 'py-12 md:py-20', 'sanitize_text_field', 'loomy_pages', esc_html__( 'Vertical Spacing (Tailwind classes)', 'loomy' ) );
		$this->add_setting( $wp_customize, 'loomy_page_show_breadcrumbs', true, 'rest_sanitize_boolean', 'loomy_pages', esc_html__( 'Show Breadcrumbs', 'loomy' ), 'checkbox' );

		// 5. Content & Footer Section.
		$wp_customize->add_section( 'loomy_layout_footer', array( 'title' => esc_html__( 'Layout & Footer', 'loomy' ), 'priority' => 60 ) );
		$this->add_setting( $wp_customize, 'loomy_footer_columns', '4', 'absint', 'loomy_footer', esc_html__( 'Footer Columns', 'loomy' ), 'select', array(
			'1' => '1', '2' => '2', '3' => '3', '4' => '4'
		) );
		$this->add_setting( $wp_customize, 'loomy_footer_copyright', '', 'wp_kses_post', 'loomy_footer', esc_html__( 'Copyright Text', 'loomy' ), 'textarea' );
	}

	private function add_setting( $wp, $id, $default, $sanitize, $section, $label, $type = 'text', $choices = array() ) {
		$wp->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => $sanitize, 'transport' => 'refresh' ) );
		$wp->add_control( $id, array( 'label' => $label, 'section' => $section, 'type' => $type, 'choices' => $choices ) );
	}
}
