<?php
/**
 * Enqueue Class.
 *
 * @package Loomy
 */

declare( strict_types=1 );

namespace Loomy;

/**
 * Class Enqueue
 *
 * Handles enqueuing of scripts and styles for the theme,
 * integrating with the Vite manifest for production.
 *
 * @final
 */
final class Enqueue {

	/**
	 * Path to the distribution directory.
	 *
	 * @var string
	 */
	private string $dist_path;

	/**
	 * URI to the distribution directory.
	 *
	 * @var string
	 */
	private string $dist_uri;

	/**
	 * Initialize enqueue hooks.
	 */
	public function __construct() {
		$this->dist_path = get_template_directory() . '/dist';
		$this->dist_uri  = get_template_directory_uri() . '/dist';

		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'register_editor_assets' ) );
	}

	/**
	 * Register and enqueue theme assets.
	 *
	 * @return void
	 */
	public function register_assets(): void {
		// Enqueue GSAP Core.
		$this->enqueue_gsap_core();

		// Handle Vite Development Mode.
		if ( $this->is_dev() ) {
			$this->enqueue_dev_assets();
			return;
		}

		// Handle Production Mode (Manifest).
		$this->enqueue_prod_assets();
	}

	/**
	 * Enqueue assets during development.
	 *
	 * @return void
	 */
	private function enqueue_dev_assets(): void {
		$vite_server = 'http://localhost:5173';

		// Vite client for HMR.
		wp_enqueue_script( 'loomy-vite-client', "{$vite_server}/@vite/client", array(), null, true );

		// Main JS entry.
		wp_enqueue_script( 'loomy-main', "{$vite_server}/assets/src/js/main.js", array( 'jquery', 'gsap-core' ), null, true );

		// Main CSS entry.
		wp_enqueue_style( 'loomy-style', "{$vite_server}/assets/src/css/main.css", array(), null );

		// Set script type to module.
		add_filter(
			'script_loader_tag',
			function ( $tag, $handle ) {
				if ( in_array( $handle, array( 'loomy-vite-client', 'loomy-main' ), true ) ) {
					return str_replace( ' src', ' type="module" src', $tag );
				}
				return $tag;
			},
			10,
			2
		);
	}

	/**
	 * Enqueue assets using the Vite manifest in production.
	 *
	 * @return void
	 */
	private function enqueue_prod_assets(): void {
		$manifest_path = get_theme_file_path( 'dist/.vite/manifest.json' );

		if ( ! file_exists( $manifest_path ) ) {
			return;
		}

		$manifest = json_decode( file_get_contents( $manifest_path ), true );

		if ( empty( $manifest ) ) {
			return;
		}

		// Enqueue JS.
		if ( isset( $manifest['assets/src/js/main.js'] ) ) {
			$js_file = $manifest['assets/src/js/main.js']['file'];
			$js_path = "{$this->dist_path}/{$js_file}";
			$version = file_exists( $js_path ) ? (string) filemtime( $js_path ) : '1.0.0';

			wp_enqueue_script( 'loomy-main', "{$this->dist_uri}/{$js_file}", array( 'jquery', 'gsap-core' ), $version, true );

			// Add type="module" for production build.
			add_filter(
				'script_loader_tag',
				function ( $tag, $handle ) {
					if ( 'loomy-main' === $handle ) {
						return str_replace( ' src', ' type="module" src', $tag );
					}
					return $tag;
				},
				10,
				2
			);
		}

		// Enqueue CSS.
		if ( isset( $manifest['assets/src/css/main.css'] ) ) {
			$css_file = $manifest['assets/src/css/main.css']['file'];
			$css_path = "{$this->dist_path}/{$css_file}";
			$version  = file_exists( $css_path ) ? (string) filemtime( $css_path ) : '1.0.0';

			wp_enqueue_style( 'loomy-style', "{$this->dist_uri}/{$css_file}", array(), $version );
		}
	}

	/**
	 * Register and enqueue editor-only assets.
	 *
	 * @return void
	 */
	public function register_editor_assets(): void {
		// Handle Vite Development Mode.
		if ( $this->is_dev() ) {
			$vite_server = 'http://localhost:5173';
			wp_enqueue_style( 'loomy-editor-style', "{$vite_server}/assets/src/css/main.css", array(), null );
			return;
		}

		// Handle Production Mode (Manifest).
		$manifest_path = get_theme_file_path( 'dist/.vite/manifest.json' );
		if ( ! file_exists( $manifest_path ) ) {
			return;
		}

		$manifest = json_decode( file_get_contents( $manifest_path ), true );
		if ( isset( $manifest['assets/src/css/main.css'] ) ) {
			$css_file = $manifest['assets/src/css/main.css']['file'];
			$css_path = "{$this->dist_path}/{$css_file}";
			$version  = file_exists( $css_path ) ? (string) filemtime( $css_path ) : '1.0.0';

			wp_enqueue_style( 'loomy-editor-style', "{$this->dist_uri}/{$css_file}", array(), $version );
		}
	}

	/**
	 * Enqueue GSAP Core (Self-Hosted).
	 *
	 * @return void
	 */
	private function enqueue_gsap_core(): void {
		if ( is_admin() || is_customize_preview() ) {
			return;
		}

		wp_enqueue_script(
			'gsap-core',
			get_template_directory_uri() . '/assets/dist/js/gsap.min.js',
			array(),
			'3.12.5',
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
	}

	/**
	 * Check if we are in development mode.
	 *
	 * @return bool
	 */
	private function is_dev(): bool {
		// Check for .hot file, dev constant, or query parameter.
		return file_exists( get_template_directory() . '/assets/hot' )
			|| ( defined( 'WP_DEBUG' ) && WP_DEBUG )
			|| isset( $_GET['vite_dev'] );
	}
}
