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

		// 1. Typography Section.
		$wp_customize->add_section(
			'loomy_typography',
			array(
				'title'    => esc_html__( 'Typography', 'loomy' ),
				'priority' => 30,
			)
		);

		$this->add_setting( $wp_customize, 'loomy_body_font', 'system-ui', 'sanitize_text_field', 'loomy_typography', esc_html__( 'Body Font Family', 'loomy' ) );
		$this->add_setting( $wp_customize, 'loomy_heading_font', 'system-ui', 'sanitize_text_field', 'loomy_typography', esc_html__( 'Heading Font Family', 'loomy' ) );
		$this->add_setting( $wp_customize, 'loomy_base_font_size', '16', 'absint', 'loomy_typography', esc_html__( 'Base Font Size (px)', 'loomy' ), 'number' );
		$this->add_setting( $wp_customize, 'loomy_line_height', '1.6', 'sanitize_text_field', 'loomy_typography', esc_html__( 'Base Line Height', 'loomy' ), 'text' );

		// 2. Colors Section.
		$wp_customize->add_section(
			'loomy_colors',
			array(
				'title'    => esc_html__( 'Colors', 'loomy' ),
				'priority' => 40,
			)
		);

		$this->add_color_setting( $wp_customize, 'loomy_primary_color', '#2563eb', esc_html__( 'Primary Color', 'loomy' ), 'loomy_colors' );
		$this->add_color_setting( $wp_customize, 'loomy_secondary_color', '#64748b', esc_html__( 'Secondary Color', 'loomy' ), 'loomy_colors' );
		$this->add_color_setting( $wp_customize, 'loomy_bg_color', '#ffffff', esc_html__( 'Background Color', 'loomy' ), 'loomy_colors' );
		$this->add_color_setting( $wp_customize, 'loomy_text_color', '#0f172a', esc_html__( 'Text Color', 'loomy' ), 'loomy_colors' );

		// 3. Header Section.
		$wp_customize->add_section(
			'loomy_header',
			array(
				'title'    => esc_html__( 'Header', 'loomy' ),
				'priority' => 50,
			)
		);

		$wp_customize->add_setting(
			'loomy_header_layout',
			array(
				'default'           => 'minimal',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'loomy_header_layout',
			array(
				'label'   => esc_html__( 'Header Layout', 'loomy' ),
				'section' => 'loomy_header',
				'type'    => 'select',
				'choices' => array(
					'minimal'     => esc_html__( 'Minimal', 'loomy' ),
					'centered'    => esc_html__( 'Centered', 'loomy' ),
					'transparent' => esc_html__( 'Transparent', 'loomy' ),
				),
			)
		);

		$this->add_setting( $wp_customize, 'loomy_header_width', '1280', 'absint', 'loomy_header', esc_html__( 'Header Max Width (px)', 'loomy' ), 'number' );
		$this->add_setting( $wp_customize, 'loomy_header_sticky', true, 'rest_sanitize_boolean', 'loomy_header', esc_html__( 'Sticky Header', 'loomy' ), 'checkbox' );

		// 4. Content & Footer Section.
		$wp_customize->add_section(
			'loomy_layout_footer',
			array(
				'title'    => esc_html__( 'Layout & Footer', 'loomy' ),
				'priority' => 60,
			)
		);

		$wp_customize->add_setting(
			'loomy_blog_layout',
			array(
				'default'           => 'grid',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'loomy_blog_layout',
			array(
				'label'   => esc_html__( 'Blog Archive Layout', 'loomy' ),
				'section' => 'loomy_layout_footer',
				'type'    => 'select',
				'choices' => array(
					'grid'           => esc_html__( 'Grid', 'loomy' ),
					'list'           => esc_html__( 'List', 'loomy' ),
					'featured-first' => esc_html__( 'Featured First', 'loomy' ),
				),
			)
		);

		$wp_customize->add_setting(
			'loomy_footer_columns',
			array(
				'default'           => '4',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			'loomy_footer_columns',
			array(
				'label'   => esc_html__( 'Footer Columns', 'loomy' ),
				'section' => 'loomy_layout_footer',
				'type'    => 'select',
				'choices' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
			)
		);

		$wp_customize->add_setting(
			'loomy_footer_copyright',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'loomy_footer_copyright',
			array(
				'label'   => esc_html__( 'Footer Copyright Text', 'loomy' ),
				'section' => 'loomy_layout_footer',
				'type'    => 'textarea',
			)
		);
	}

	/**
	 * Helper to add setting and control.
	 */
	private function add_setting( $wp, $id, $default, $sanitize, $section, $label, $type = 'text' ) {
		$wp->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => $sanitize, 'transport' => 'refresh' ) );
		$wp->add_control( $id, array( 'label' => $label, 'section' => $section, 'type' => $type ) );
	}

	/**
	 * Helper to add color setting and control.
	 */
	private function add_color_setting( $wp, $id, $default, $label, $section ) {
		$wp->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ) );
		$wp->add_control( new \WP_Customize_Color_Control( $wp, $id, array( 'label' => $label, 'section' => $section ) ) );
	}
}
