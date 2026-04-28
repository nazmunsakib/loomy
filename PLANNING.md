# 🗓️ Project Planning — Loomy
*Status: 🟡 In Progress | Next Sprint: Foundation Setup*

## 🎯 Phase 0: Foundation (Week 1)
- [ ] Initialize repo with `.gitignore` (node_modules/, dist/, vendor/)
- [ ] Create `composer.json` with PSR-4: `"Loomy\\": "inc/"`
- [ ] Create `package.json` with exact versions: Vite 5, Tailwind 4, Alpine 3
- [ ] Set up Vite config: entries, manifest, WordPress-friendly paths
- [ ] Configure Tailwind: `@theme static`, `@source` directives, disable preflight
- [ ] Create `functions.php` + PSR-4 autoloader bootstrap
- [ ] Add `style.css` with Loomy theme header (WP requirement)

## 🧱 Phase 1: Core Theme Setup (Week 2)
- [ ] `inc/class-theme-setup.php`: 
  - [ ] `add_theme_support('woocommerce')` + gallery features
  - [ ] `add_theme_support('elementor')` + post-thumbnails
  - [ ] Register nav menus, image sizes, cleanup head
  - [ ] Set text domain: `load_theme_textdomain( 'loomy', ... )`
- [ ] `inc/class-enqueue.php`:
  - [ ] Vite manifest loader with fallback for dev/prod
  - [ ] Conditional loading: WC, Elementor, frontend-only assets
  - [ ] Add `wp_enqueue_style( 'loomy-style', ... )` with manifest mapping
- [ ] Create `assets/src/css/main.css` with `@tailwind` layers + scoped base
- [ ] Create `assets/src/js/main.js` with Alpine init + AJAX re-init hooks

## 🛒 Phase 2: WooCommerce Integration (Week 3)
- [ ] Copy & customize minimal WC templates to `/woocommerce/`:
  - [ ] `archive-product.php` (shop grid)
  - [ ] `single-product.php` (product detail)
  - [ ] `cart/cart.php` (cart table)
- [ ] `inc/woocommerce/hooks.php`:
  - [ ] Remove WC default CSS/JS if not needed
  - [ ] Add custom hooks for product badges, pricing display
- [ ] `inc/woocommerce/functions.php`:
  - [ ] Alpine cart count sync via `wc_fragments_refreshed`
  - [ ] Custom "Add to Cart" button with Alpine loading state
- [ ] Test checkout flow with Tailwind forms plugin

## 🧩 Phase 3: Elementor Compatibility (Week 4)
- [ ] `inc/elementor/class-manager.php`:
  - [ ] Register custom widgets only if Elementor active
  - [ ] Enqueue editor assets conditionally
- [ ] Create `template-parts/header/elementor.php` + `footer/elementor.php`
- [ ] Add `page-fullwidth.php` template for Elementor Canvas
- [ ] Test widget rendering: ensure Alpine components re-init after Elementor AJAX
- [ ] Scope Tailwind utilities to avoid `.elementor-widget` conflicts

## 🧪 Phase 4: Polish & Performance (Week 5)
- [ ] Lighthouse audit: target >90 mobile, >95 desktop
- [ ] Optimize images: `srcset`, AVIF/WebP fallbacks, lazy loading
- [ ] Add `loading="lazy"` + `decoding="async"` to all product images
- [ ] Implement Core Web Vitals fixes: CLS (image dimensions), INP (Alpine debouncing)
- [ ] Add `theme.json` partial for typography/colors (FSE compatibility layer)

## 🚀 Phase 5: Launch Prep (Week 6)
- [ ] Write `README.md` with setup instructions for other devs
- [ ] Add `CHANGELOG.md` with semantic versioning
- [ ] Create child theme example (`/child-theme/`)
- [ ] Test with: Elementor Pro, WC Subscriptions, WC Bookings
- [ ] Final security audit: nonces, sanitization, escaping

## 📊 Task Template for Loomy
```md
### [Task Name]
- **Goal**: 
- **Files**: 
- **Acceptance Criteria**:
  - [ ] 
  - [ ] 
- **Dependencies**: 
- **Estimated Tokens**: ~XXX (for AI context)
- **Loomy-Specific Notes**: 