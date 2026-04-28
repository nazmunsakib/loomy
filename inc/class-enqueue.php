<?php

declare(strict_types=1);

namespace Loomy;

/**
 * Class Enqueue
 * 
 * Handles enqueuing of scripts and styles for the theme, 
 * integrating with the Vite manifest for production.
 *
 * @package Loomy
 */
final class Enqueue
{
    private string $dist_path;
    private string $dist_uri;

    /**
     * Initialize enqueue hooks.
     */
    public function __construct()
    {
        $this->dist_path = get_template_directory() . '/dist';
        $this->dist_uri  = get_template_directory_uri() . '/dist';

        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
    }

    /**
     * Register and enqueue theme assets.
     *
     * @return void
     */
    public function register_assets(): void
    {
        // Handle Vite Development Mode
        if ($this->is_dev()) {
            $this->enqueue_dev_assets();
            return;
        }

        // Handle Production Mode (Manifest)
        $this->enqueue_prod_assets();
    }

    /**
     * Enqueue assets during development.
     *
     * @return void
     */
    private function enqueue_dev_assets(): void
    {
        $vite_server = 'http://localhost:5173';

        // Vite client for HMR
        wp_enqueue_script('loomy-vite-client', "{$vite_server}/@vite/client", [], null, true);
        
        // Main JS entry
        wp_enqueue_script('loomy-main', "{$vite_server}/src/js/main.js", ['jquery'], null, true);
        
        // Main CSS entry
        wp_enqueue_style('loomy-style', "{$vite_server}/src/css/main.css", [], null);
        
        // Set script type to module
        add_filter('script_loader_tag', function ($tag, $handle) {
            if (in_array($handle, ['loomy-vite-client', 'loomy-main'], true)) {
                return str_replace(' src', ' type="module" src', $tag);
            }
            return $tag;
        }, 10, 2);
    }

    /**
     * Enqueue assets using the Vite manifest in production.
     *
     * @return void
     */
    private function enqueue_prod_assets(): void
    {
        $manifest_path = "{$this->dist_path}/.vite/manifest.json";

        if (!file_exists($manifest_path)) {
            return;
        }

        $manifest = json_decode(file_get_contents($manifest_path), true);

        if (empty($manifest)) {
            return;
        }

        // Enqueue JS
        if (isset($manifest['src/js/main.js'])) {
            $js_file = $manifest['src/js/main.js']['file'];
            wp_enqueue_script('loomy-main', "{$this->dist_uri}/{$js_file}", ['jquery'], null, true);

            // Add type="module" for production build
            add_filter('script_loader_tag', function ($tag, $handle) {
                if ('loomy-main' === $handle) {
                    return str_replace(' src', ' type="module" src', $tag);
                }
                return $tag;
            }, 10, 2);
        }

        // Enqueue CSS
        if (isset($manifest['src/css/main.css'])) {
            $css_file = $manifest['src/css/main.css']['file'];
            wp_enqueue_style('loomy-style', "{$this->dist_uri}/{$css_file}", [], null);
        }
    }

    /**
     * Check if we are in development mode.
     * 
     * @return bool
     */
    private function is_dev(): bool
    {
        // Check for .hot file or a dev constant
        return file_exists(get_template_directory() . '/assets/hot') || (defined('WP_DEBUG') && WP_DEBUG);
    }
}
