<?php
/**
 * Theme Setup Class.
 *
 * @package Loomy
 */

declare( strict_types=1 );

namespace Loomy;

/**
 * Class Theme_Setup
 *
 * Handles core WordPress theme setup, including features like WooCommerce,
 * Elementor support, and localization.
 *
 * @final
 */
final class Theme_Setup {

	/**
	 * Initialize theme setup hooks.
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'register_supports' ) );
		add_action( 'after_setup_theme', array( $this, 'register_menus' ) );
		add_action( 'after_setup_theme', array( $this, 'register_image_sizes' ) );
		add_action( 'init', array( $this, 'cleanup_head' ) );
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
		add_filter( 'the_content', array( '\Loomy\Post_Helpers', 'add_ids_to_headings' ) );
	}

	/**
	 * Registers all required theme supports and localization.
	 *
	 * @return void
	 */
	public function register_supports(): void {
		// Localization support.
		load_theme_textdomain( 'loomy', get_template_directory() . '/languages' );

		// Enable post thumbnails.
		add_theme_support( 'post-thumbnails' );

		// WooCommerce Support & Features.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Elementor Support.
		add_theme_support( 'elementor' );

		// Standard Theme Supports.
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}

	/**
	 * Register navigation menus.
	 *
	 * @return void
	 */
	public function register_menus(): void {
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'loomy' ),
				'footer'  => esc_html__( 'Footer Menu', 'loomy' ),
			)
		);
	}

	/**
	 * Register custom image sizes.
	 *
	 * @return void
	 */
	public function register_image_sizes(): void {
		add_image_size( 'loomy-hero', 1920, 1080, true );
		add_image_size( 'loomy-card', 600, 400, true );
	}

	/**
	 * Cleanup WordPress head from unnecessary bloat.
	 *
	 * @return void
	 */
	public function cleanup_head(): void {
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}

	/**
	 * Register widget areas (sidebars).
	 *
	 * @return void
	 */
	public function register_sidebars(): void {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Loomy Sidebar', 'loomy' ),
				'id'            => 'loomy-sidebar',
				'description'   => esc_html__( 'Main sidebar for blog and archive pages.', 'loomy' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s mb-10 last:mb-0">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title text-sm font-bold uppercase tracking-widest text-gray-400 mb-4">',
				'after_title'   => '</h2>',
			)
		);
	}
}
