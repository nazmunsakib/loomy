# 🧠 Project Memories — Loomy
*Last updated: {{DATE}} | Stack: WP 6.5+ • PHP 8.2+ • Vite 5 • Tailwind 4 • Alpine.js 3 • WC 9.x • Elementor 3.20+*

## 🎯 Core Identity
- **Theme Name**: `Loomy`
- **Text Domain**: `loomy`
- **Purpose**: Custom, high-performance WooCommerce theme with Elementor page-builder support
- **Philosophy**: Lean, modular, developer-first. No bloat. Let Elementor handle layout; theme handles structure, styles, and WC integration.

## 🧱 Tech Stack (Non-Negotiable)
| Layer | Technology | Version | Notes |
|-------|-----------|---------|-------|
| **Backend** | WordPress + PHP | 6.5+ / 8.2+ | Strict types, PSR-12, no global functions |
| **Build** | Vite | 5.x | Manifest-based asset loading, HMR for dev |
| **CSS** | Tailwind CSS | 4.x | `@theme static`, `@source` scanning `**/*.php`, `**/*.js` |
| **JS** | Alpine.js | 3.x | Lightweight reactivity, no Vue/React overhead |
| **E-commerce** | WooCommerce | 9.x | Template overrides in `/woocommerce/`, hooks in `inc/woocommerce/` |
| **Page Builder** | Elementor | 3.20+ | Hybrid theme support, custom widgets in `inc/elementor/widgets/` |

## 📁 Canonical Structure

---

## 📁 Folder Structure

```
loomy/
├── assets/src/css/ # Tailwind: base/, components/, woocommerce/, main.css
├── assets/src/js/ # Alpine: modules/, main.js (init + Alpine plugins)
├── assets/dist/ # Vite output (gitignored)
├── inc/
│ ├── class-theme-setup.php # add_theme_support, image sizes, cleanups
│ ├── class-enqueue.php # Vite manifest loader, conditional loading
│ ├── woocommerce/ # hooks.php, functions.php
│ └── elementor/ # class-manager.php, widgets/
├── woocommerce/ # Only overridden templates
├── template-parts/ # header/, footer/, components/
├── composer.json # PSR-4: "Loomy\": "inc/"
├── vite.config.js # Entries: main.js + main.css → dist/
└── functions.php # Bootstrap only: require composer + inc/
```

---

## 🔌 Theme Supports

```php
add_theme_support('woocommerce', [...]);
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');
```

---

## 🔧 Dev Environment

| Tool | Purpose |
|------|---------|
| **LocalWP / DDEV** | Local WordPress environment |
| **WP-CLI** | WordPress command line |
| **PHPCS** | Code quality + WP coding standards |
| **Git + GitHub** | Version control |

---

## 🗒️ Session Log

| Date | Topic | Output |
|------|-------|--------|
| Session 1 | Stack + structure | Finalized stack, folder structure |
| Session 1 | Project docs | Created MEMORIES.md, PLANNING.md, Rules.md |

---

## ⚠️ Important Notes

- Vite manifest.json must be read for correct asset enqueue in WordPress
- WooCommerce template overrides go in `/woocommerce/` at theme root
- `functions.php` should only require files — no logic directly inside it
- Always check Elementor is active before loading custom widgets

---


## 🔑 Critical Patterns
- **Asset Loading**: Vite manifest → `class-enqueue.php` → conditional `wp_enqueue_*`
- **Alpine Init**: `Alpine.start()` on load + `Alpine.initTree()` after WC/Elementor AJAX
- **Tailwind Scope**: `preflight: false` + `body:not(.elementor-editor-active):not(.wp-admin)` for base styles
- **Elementor Safety**: Dequeue theme CSS in editor; use `x-ignore` on dynamic widgets
- **WC Templates**: Override only what you customize; use hooks first, templates second

## 🚫 Hard Avoids
- ❌ No jQuery (unless WC core requires it)
- ❌ No global CSS resets that break Elementor/WP admin
- ❌ No inline styles or `!important` unless absolutely necessary
- ❌ No direct DB queries — use `WC_Product_Query`, `WP_Query`, REST API
- ❌ No `npm run build` skipped before deploy

## 🔗 Key References
- [Tailwind WP Integration Guide](https://tailwindcss.com/docs/installation/using-vite#wordpress)
- [Elementor Theme Developer Docs](https://developers.elementor.com/docs/)
- [WooCommerce Template Hierarchy](https://woocommerce.com/document/template-structure/)


*Update this file at the end of every AI session.*
