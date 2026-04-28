# 🧠 Project Memories — Loomy
*Last updated: 2026-04-29 | Stack: WP 6.5+ • PHP 8.2+ • Vite 5 • Tailwind 4 • Alpine.js 3 • WC 9.x • Elementor 3.20+ • Target: WordPress.org*

---

## 🎯 Core Identity
- **Theme Name**: `Loomy`
- **Text Domain**: `loomy`
- **Purpose**: Custom, high-performance WooCommerce theme with Elementor page-builder support
- **Distribution Goal**: ✅ Submit to WordPress.org Theme Directory (strict compliance required)
- **License**: GPL v2 or later (all code + assets must be GPL-compatible)
- **Philosophy**: Lean, modular, developer-first. No bloat. Let Elementor handle layout; theme handles structure, styles, and WC integration.

---

## 🧱 Tech Stack (WordPress.org Compliant)
| Layer | Technology | Version | WP.org Notes |
|-------|-----------|---------|--------------|
| **Backend** | WordPress + PHP | 6.5+ / 8.2+ | Strict types, PSR-12, GPL v2+, no global functions |
| **Build** | Vite | 5.x | ✅ `dist/` MUST be committed to SVN. `assets/src/` is dev-only (gitignored). |
| **CSS** | Tailwind CSS | 4.x | Final `dist/css/*.css` must be <2MB after purge. Use `@plugin "@tailwindcss/typography"`. |
| **JS** | Alpine.js | 3.x | ✅ Self-hosted in `assets/dist/js/`. ❌ NO CDNs. Enqueue via `wp_enqueue_script()`. |
| **Fonts** | System Fonts / Self-hosted WOFF2 | - | ❌ NO Google Fonts CDN. Self-host or delegate to plugins. |
| **E-commerce** | WooCommerce | 9.x | ✅ Optional. Use `class_exists('WooCommerce')` checks everywhere. |
| **Page Builder** | Elementor | 3.20+ | ✅ Optional. Use `defined('ELEMENTOR_PATH')` checks. |

---

## 📁 SVN-Ready Folder Structure

1234567891011121314151617181920212223242526272829
loomy/
├── assets/
│ ├── src/ # Dev only (gitignored, NOT for SVN)
│ └── dist/ # ✅ MUST BE COMMITTED TO SVN
│ ├── css/ # Compiled Tailwind CSS (purged, <2MB)
│ └── js/ # Alpine.js (self-hosted) + theme scripts
├── fonts/ # ✅ Self-hosted WOFF2 files (if any)
├── inc/
│ ├── class-customizer.php # WP.org approved settings (Customizer only)
│ ├── class-enqueue.php # Local assets only, conditional loading, wp_add_inline_style()
│ ├── class-theme-setup.php # add_theme_support, image sizes, cleanups
│ ├── woocommerce/ # hooks.php, functions.php (wrapped in class_exists checks)
│ └── elementor/ # class-manager.php, widgets/ (wrapped in defined checks)
├── woocommerce/ # Optional template overrides
├── template-parts/ # header/, footer/, components/, content*.php
├── languages/ # .pot file for translations
├── composer.json # PSR-4: "Loomy\": "inc/" (dev only)
├── package.json # Dev dependencies only (not for SVN)
├── vite.config.js # Dev only (not for SVN)
├── functions.php # Bootstrap only: require composer + inc/
├── style.css # WP header + GPL license declaration
├── readme.txt # ✅ Required for WP.org (standard format)
└── screenshot.png # ✅ 1200x900 PNG, sRGB


---

## 🔌 Theme Supports (Conditional)
```php
// Always loaded
add_theme_support('automatic-feed-links');
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script']);
add_theme_support('customize-selective-refresh-widgets');
add_theme_support('align-wide');
add_theme_support('responsive-embeds');

// WooCommerce (only if plugin active)
if (class_exists('WooCommerce')) {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

// Elementor (only if plugin active)
if (defined('ELEMENTOR_PATH')) {
    add_theme_support('elementor');
}

🔧 Dev Environment
Tool
Purpose
WP.org Note
LocalWP / DDEV
Local WordPress environment
Test with default plugins only
WP-CLI
WordPress command line
Use for wp theme check validation
PHPCS + WordPress-CS
Code quality + WP coding standards
Mandatory before SVN commit
Theme Check Plugin
Automated theme review
Must pass with 0 REQUIRED errors
Git + GitHub
Version control
Keep dist/ in Git for SVN sync

⚠️ Important Notes
Vite manifest.json must be read for correct asset enqueue in WordPress
WooCommerce template overrides go in /woocommerce/ at theme root
functions.php should only require files — no logic directly inside it
Always check Elementor is active before loading custom widgets: if (defined('ELEMENTOR_PATH'))
Always check WooCommerce is active: if (class_exists('WooCommerce'))
All dynamic CSS must use wp_add_inline_style(), not raw <style> tags
All enqueued assets must use get_theme_file_uri() + version from theme or manifest
Text domain 'loomy' must be used in ALL translation functions


🔑 Critical Patterns
Asset Loading

Vite manifest → class-enqueue.php → wp_enqueue_* + wp_add_inline_style()

Load dist/.vite/manifest.json
Map development paths → production hashed filenames
Prefix all handles with loomy-: wp_enqueue_style('loomy-style', ...)
Add defer strategy for JS: wp_script_add_data('loomy-scripts', 'strategy', 'defer')
Conditional loading: is_woocommerce(), elementor-editor, frontend-only
Alpine.js Init + AJAX Re-init

import Alpine from 'alpinejs';
Alpine.start();

// Re-init after dynamic content for Loomy:
document.addEventListener('elementor/frontend/render', () => Alpine.initTree(document));
document.addEventListener('wc_fragments_refreshed', () => Alpine.initTree(document.querySelector('.cart-fragments')));
document.addEventListener('loaded_cart_fragments', () => Alpine.initTree(document));

Tailwind Scoping (Prevent Admin/Editor Breakage)
/* assets/src/css/main.css */
@layer base {
  body:not(.elementor-editor-active):not(.wp-admin) {
    @apply antialiased text-gray-900;
    /* Only apply resets to Loomy frontend */
  }
}

Elementor Safety
Dequeue theme CSS in editor: add_action('elementor/editor/before_enqueue_scripts', fn() => wp_dequeue_style('loomy-style'))
Use x-ignore on dynamic Elementor widgets that conflict with Alpine
Scope custom styles to .site-content, .entry-content, not global body
WooCommerce Integration
Override only templates you customize in /woocommerce/
Use hooks/filters first (inc/woocommerce/hooks.php), templates second
Wrap all WC code in if (class_exists('WooCommerce'))
Dynamic Settings (Customizer → CSS Vars)

Customizer UI → get_theme_mod() → :root CSS vars → wp_add_inline_style() → Tailwind @theme static

Limit to 5-7 core settings (brand color, heading font, base font size)
Output via wp_add_inline_style('loomy-style', $css) in wp_enqueue_scripts
Map in tailwind.config.js: colors: { brand: 'var(--loomy-primary)' }

### Dynamic Search Interaction (Alpine.js)
- **Pattern**: Localized Dropdown with Close Button
- **Trigger**: `header.php` → `x-data="{ searchOpen: false }"`
- **Interaction**: 
    - Toggle via header icon (`@click="searchOpen = !searchOpen"`)
    - Auto-close via click-away (`@click.away="searchOpen = false"`)
    - Manual close via "X" button inside dropdown
- **Visuals**: `backdrop-blur-md` for overlay (if used), `shadow-2xl` + `rounded-3xl` for dropdown.
- **WP.org**: Uses `get_search_form()` for accessibility and hook compliance.

### Modular Customizer Logic
- **Pattern**: `inc/Customizer.php` using a static `register` method.
- **Method**: `add_setting($manager, $id, $default, $sanitize, $section, $label, $control_type)`
- **Native Sync**: Uses `WP_Customize_Color_Control` for brand colors to ensure native picker UI.
- **Dynamic CSS Integration**: Customizer values → `Dynamic_CSS::get_theme_css()` → `:root` variables → `wp_add_inline_style()`.

📜 WordPress.org Compliance Rules (NON-NEGOTIABLE)
No External CDNs: All JS/CSS/fonts must be bundled locally in dist/ or fonts/. Zero https:// in enqueued URLs.
Dynamic CSS: Use wp_add_inline_style() instead of raw <style> tags in <head>.
Optional Dependencies: Theme must work 100% standalone. WC/Elementor are enhancements, not requirements. Wrap all optional code in class_exists() / defined() checks.
Sanitization/Escaping: sanitize_*() on ALL input, esc_*() on ALL output. Zero exceptions. Use wp_kses_post() for post content.
Text Domain: 'loomy' in all __(), _e(), _n(), esc_html__(), _x() calls.
Theme Check: Must pass with 0 REQUIRED errors, minimal RECOMMENDED warnings. Run before every SVN commit.
Debug Mode: Zero PHP notices/warnings/errors with WP_DEBUG and WP_DEBUG_LOG enabled.
No Plugin Territory: No shortcodes, CPTs, taxonomies, custom post meta UI, or settings that belong in a plugin.
Customizer Only: Settings UI via customize_register. No custom admin pages or options panels.
GPL License: All code/assets must be GPL v2+ compatible. No MIT-only JS libs without dual-license confirmation.
Accessibility: Semantic HTML5, ARIA labels where needed, keyboard navigation, focus states, prefers-reduced-motion support.
Performance: Final CSS <2MB, JS deferred, images lazy-loaded, no render-blocking resources.

## 🚫 Hard Avoids
- ❌ No jQuery (unless WC core requires it)
- ❌ No global CSS resets that break Elementor/WP admin
- ❌ No inline styles or `!important` unless absolutely necessary
- ❌ No direct DB queries — use `WC_Product_Query`, `WP_Query`, REST API
- ❌ No `npm run build` skipped before deploy
+ ❌ No external CDNs (fonts, jQuery, Alpine, Tailwind, etc.)
+ ❌ No `eval()`, `base64_decode()`, obfuscated code, or `curl` to external APIs
+ ❌ No custom admin pages/settings panels (use Customizer only)
+ ❌ No plugin territory features (CPTs, shortcodes, widget areas beyond sidebar/footer)
+ ❌ No unescaped output or unsanitized input
+ ❌ No hardcoded `wp-content` paths or direct DB queries
+ ❌ No skipping `Theme Check` validation before SVN commit

## 📦 SVN Submission Workflow
1. **Build**: `npm run build` → generates `dist/` with hashed assets
2. **Validate**: Run `Theme Check` plugin → fix all `REQUIRED` errors
3. **Test**: Enable `WP_DEBUG` + `SCRIPT_DEBUG` → zero PHP notices
4. **Commit to SVN**:
   - ✅ Include: `dist/`, `style.css`, `readme.txt`, `screenshot.png`, `functions.php`, `inc/`, `woocommerce/`, `template-parts/`, `fonts/`
   - ❌ Exclude: `assets/src/`, `node_modules/`, `vendor/`, `.git/`, `vite.config.js`, `package.json`, `composer.json`
5. **Submit**: Upload to https://themes.trac.wordpress.org/ → respond to review tickets point-by-point


svn checkout https://themes.svn.wordpress.org/loomy/
cp -r loomy/* /path/to/svn/loomy/trunk/
svn add trunk/*
svn commit -m "Initial submission: Loomy v1.0.0"

Submit for Review: Upload to https://themes.trac.wordpress.org/ → respond to each review ticket point-by-point with code changes + explanations.

## 🔗 Key References
- [Tailwind WP Integration Guide](https://tailwindcss.com/docs/installation/using-vite#wordpress)
- [Elementor Theme Developer Docs](https://developers.elementor.com/docs/)
- [WooCommerce Template Hierarchy](https://woocommerce.com/document/template-structure/)
+ - [WP Theme Review Handbook](https://make.wordpress.org/themes/handbook/)
+ - [Theme Check Plugin](https://wordpress.org/plugins/theme-check/)
+ - [WP Coding Standards](https://developer.wordpress.org/coding-standards/)
+ - [GPL License Guide](https://wordpress.org/about/gpl/)