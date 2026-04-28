<?php

declare(strict_types=1);

namespace Loomy;

/**
 * Class Theme_Setup
 * 
 * Handles core WordPress theme setup, including features like WooCommerce, 
 * Elementor support, and localization.
 *
 * @package Loomy
 */
final class Theme_Setup
{
    /**
     * Initialize theme setup hooks.
     */
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'register_supports']);
        add_action('after_setup_theme', [$this, 'register_menus']);
        add_action('after_setup_theme', [$this, 'register_image_sizes']);
        add_action('init', [$this, 'cleanup_head']);
    }

    /**
     * Registers all required theme supports and localization.
     *
     * @return void
     */
    public function register_supports(): void
    {
        // Localization support
        load_theme_textdomain('loomy', get_template_directory() . '/languages');

        // Enable post thumbnails
        add_theme_support('post-thumbnails');

        // WooCommerce Support & Features
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        // Elementor Support
        add_theme_support('elementor');

        // Standard Theme Supports
        add_theme_support('title-tag');
        add_theme_support('automatic-feed-links');
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ]);
    }

    /**
     * Register navigation menus.
     *
     * @return void
     */
    public function register_menus(): void
    {
        register_nav_menus([
            'primary' => esc_html__('Primary Menu', 'loomy'),
            'footer'  => esc_html__('Footer Menu', 'loomy'),
        ]);
    }

    /**
     * Register custom image sizes.
     *
     * @return void
     */
    public function register_image_sizes(): void
    {
        add_image_size('loomy-hero', 1920, 1080, true);
        add_image_size('loomy-card', 600, 400, true);
    }

    /**
     * Cleanup WordPress head from unnecessary bloat.
     *
     * @return void
     */
    public function cleanup_head(): void
    {
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }
}
