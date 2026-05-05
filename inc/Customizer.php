<?php
/**
 * Customizer Registration Class.
 *
 * @package Loomy
 */

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
		error_log( 'Loomy Customizer: Registering settings...' );

		// 1. Header Section.
		$wp_customize->add_section( 'loomy_header', array(
			'title'    => esc_html__( 'Header', 'loomy' ),
			'priority' => 30,
		) );

		$this->add_setting( $wp_customize, 'loomy_header_layout', 'header-3', 'sanitize_text_field', 'loomy_header', esc_html__( 'Header Style', 'loomy' ), 'select', array(
			'header-1' => esc_html__( 'Header One (Logo Left, Menu Left)', 'loomy' ),
			'header-2' => esc_html__( 'Header Two (Floating Pill — Logo Left, Nav Center, CTA Right)', 'loomy' ),
			'header-3' => esc_html__( 'Header Three (Logo Left, Menu Center)', 'loomy' ),
		) );

		$this->add_setting( $wp_customize, 'loomy_header_sticky', true, 'rest_sanitize_boolean', 'loomy_header', esc_html__( 'Sticky Header', 'loomy' ), 'checkbox' );

		// Header Two — CTA button.
		$this->add_setting( $wp_customize, 'loomy_header_cta_label', __( 'Book a Meeting', 'loomy' ), 'sanitize_text_field', 'loomy_header', esc_html__( 'CTA Button Label (Header Two)', 'loomy' ) );
		$this->add_setting( $wp_customize, 'loomy_header_cta_url', '#', 'esc_url_raw', 'loomy_header', esc_html__( 'CTA Button URL (Header Two)', 'loomy' ) );

		// 2. Blog Section.
		$wp_customize->add_section( 'loomy_blog', array(
			'title'    => esc_html__( 'Blog Layout', 'loomy' ),
			'priority' => 40,
		) );

		$this->add_setting( $wp_customize, 'loomy_blog_style', 'grid', 'sanitize_text_field', 'loomy_blog', esc_html__( 'Archive Style', 'loomy' ), 'select', array(
			'grid' => esc_html__( 'Grid', 'loomy' ),
			'list' => esc_html__( 'List', 'loomy' ),
		) );

		$this->add_setting( $wp_customize, 'loomy_sidebar_enabled', true, 'rest_sanitize_boolean', 'loomy_blog', esc_html__( 'Enable Sidebar', 'loomy' ), 'checkbox' );

		$this->add_setting( $wp_customize, 'loomy_sidebar_position', 'right', 'sanitize_text_field', 'loomy_blog', esc_html__( 'Sidebar Position', 'loomy' ), 'select', array(
			'left'  => esc_html__( 'Left', 'loomy' ),
			'right' => esc_html__( 'Right', 'loomy' ),
		) );

		// 3. Colors Section.
		$wp_customize->add_section( 'loomy_colors', array(
			'title'    => esc_html__( 'Colors', 'loomy' ),
			'priority' => 50,
		) );

		$this->add_setting( $wp_customize, 'loomy_primary_color', '#0d9488', 'sanitize_hex_color', 'loomy_colors', esc_html__( 'Primary Color', 'loomy' ), 'color' );
		$this->add_setting( $wp_customize, 'loomy_secondary_color', '#111827', 'sanitize_hex_color', 'loomy_colors', esc_html__( 'Secondary Color', 'loomy' ), 'color' );

		// 4. Page Settings Section.
		$wp_customize->add_section( 'loomy_pages', array(
			'title'    => esc_html__( 'Page Settings', 'loomy' ),
			'priority' => 55,
		) );

		$this->add_setting( $wp_customize, 'loomy_page_spacing', 'py-12 md:py-20', 'sanitize_text_field', 'loomy_pages', esc_html__( 'Vertical Spacing (Tailwind)', 'loomy' ) );
		$this->add_setting( $wp_customize, 'loomy_page_show_breadcrumbs', true, 'rest_sanitize_boolean', 'loomy_pages', esc_html__( 'Show Breadcrumbs', 'loomy' ), 'checkbox' );

		// 5. Layout & Footer Section.
		$wp_customize->add_section( 'loomy_layout_footer', array(
			'title'    => esc_html__( 'Layout & Footer', 'loomy' ),
			'priority' => 60,
		) );

		$this->add_setting( $wp_customize, 'loomy_footer_columns', '4', 'sanitize_text_field', 'loomy_layout_footer', esc_html__( 'Footer Columns', 'loomy' ), 'select', array(
			'1' => '1', '2' => '2', '3' => '3', '4' => '4'
		) );

		$this->add_setting( $wp_customize, 'loomy_footer_copyright', '', 'wp_kses_post', 'loomy_layout_footer', esc_html__( 'Copyright Text', 'loomy' ), 'textarea' );
	}

	/**
	 * Helper to add setting and control.
	 */
	private function add_setting( $wp, $id, $default, $sanitize, $section, $label, $type = 'text', $choices = array() ): void {
		$wp->add_setting( $id, array(
			'default'           => $default,
			'sanitize_callback' => $sanitize,
			'transport'         => 'refresh',
		) );

		if ( 'color' === $type ) {
			$wp->add_control( new \WP_Customize_Color_Control( $wp, $id, array(
				'label'   => $label,
				'section' => $section,
			) ) );
		} else {
			$wp->add_control( $id, array(
				'label'   => $label,
				'section' => $section,
				'type'    => $type,
				'choices' => $choices,
			) );
		}
	}
}
