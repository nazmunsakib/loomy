# 🗓️ Project Planning — Loomy
*Status: 🟡 In Progress | Next Sprint: Foundation Setup | Target: WordPress.org*

## 🎯 Phase 0: Foundation & Repo Setup (Week 1)
- [x] Initialize repo with `.gitignore` (ignore `node_modules/`, `vendor/`, `assets/src/`, `vite.config.js`; ✅ KEEP `dist/` for SVN)
- [x] Create `composer.json` with PSR-4: `"Loomy\\": "inc/"` + `composer install`
- [x] Create `package.json` with exact versions: Vite 5, Tailwind 4, Alpine 3
- [x] Set up `vite.config.js`: entries, `manifest: true`, `outDir: 'dist'`, WordPress paths
- [x] Configure `tailwind.config.js`: `@source` scanning, `preflight: false`, typography plugin
- [x] Create `functions.php` + PSR-4 autoloader bootstrap (logic only via `inc/`)
- [x] Add `style.css` with WP header + `License: GPLv2 or later` + `License URI:`
- [x] Add `readme.txt` skeleton (WP.org standard format)
- [x] Add `screenshot.png` placeholder (1200x900 PNG, sRGB)
- [x] ✅ Compliance Gate: `functions.php` has zero logic, only `require`/`include`

## 🧱 Phase 1: Core Theme Setup (Week 2)
- [x] `inc/class-theme-setup.php`:
  - [x] Always-loaded supports: `title-tag`, `post-thumbnails`, `html5`, `align-wide`, `responsive-embeds`
  - [ ] Conditional WC: `if (class_exists('WooCommerce')) add_theme_support('woocommerce' + gallery)`
  - [ ] Conditional Elementor: `if (defined('ELEMENTOR_PATH')) add_theme_support('elementor')`
  - [x] Register nav menus, image sizes, `wp_head()`/`wp_footer()` cleanup
  - [x] Set text domain: `load_theme_textdomain('loomy', get_theme_file_path('languages'))`
- [x] `inc/class-enqueue.php`:
  - [x] Vite manifest loader with `file_exists()` fallback for dev/prod
  - [x] Prefix all handles with `loomy-`
  - [x] Conditional asset loading: `is_woocommerce()`, `elementor-editor`, frontend-only
  - [x] Add `wp_script_add_data('loomy-scripts', 'strategy', 'defer')`
- [x] Create `assets/src/css/main.css` with `@tailwind` layers + scoped `@layer base`
- [x] Create `assets/src/js/main.js` with Alpine init + AJAX re-init hooks
- [x] ✅ Compliance Gate: Zero external URLs in enqueued assets. All paths use `get_theme_file_uri()`

## 🛒 Phase 2: WooCommerce Integration (Week 3)
- [ ] Copy & customize minimal WC templates to `/woocommerce/`:
  - [ ] `archive-product.php` (shop grid)
  - [ ] `single-product.php` (product detail)
  - [ ] `cart/cart.php` (cart table)
- [ ] `inc/woocommerce/hooks.php`:
  - [ ] Wrap all code in `if (class_exists('WooCommerce'))`
  - [ ] Remove default WC styles/scripts if replaced by Tailwind
  - [ ] Add custom hooks for product badges, pricing, gallery
- [ ] `inc/woocommerce/functions.php`:
  - [ ] Alpine cart count sync via `wc_fragments_refreshed` + `Alpine.initTree()`
  - [ ] Custom "Add to Cart" button with Alpine loading state & nonce verification
- [ ] Self-host Alpine.js in `assets/dist/js/alpine.min.js` (NO CDN)
- [ ] ✅ Compliance Gate: Theme works 100% when WooCommerce is deactivated

## 🧩 Phase 3: Elementor Compatibility & UI (Week 4)
- [ ] `inc/elementor/class-manager.php`:
  - [ ] Wrap all code in `if (defined('ELEMENTOR_PATH'))`
  - [ ] Register custom widgets via `elementor/widgets/register`
  - [ ] Enqueue editor assets conditionally
- [ ] Create `template-parts/header/elementor.php` + `footer/elementor.php`
- [ ] Add `page-fullwidth.php` & `page-canvas.php` templates
- [ ] Dequeue theme CSS in Elementor editor to prevent conflicts
- [ ] Test Alpine re-init after Elementor AJAX render (`elementor/frontend/render`)
- [ ] ✅ Compliance Gate: Zero `!important` overrides. Tailwind scoped to `.site-content`/`.entry-content`

## 🧪 Phase 4: WordPress.org Compliance & Validation (Week 5)
- [ ] Install & run `Theme Check` plugin → fix ALL `REQUIRED` errors
- [ ] Enable `WP_DEBUG` + `WP_DEBUG_LOG` + `SCRIPT_DEBUG` → zero PHP notices
- [ ] Verify `wp_add_inline_style()` used for ALL dynamic CSS (Customizer outputs)
- [ ] Test with ZERO plugins active (default WP install)
- [ ] Accessibility audit: keyboard nav, focus rings, ARIA labels, `prefers-reduced-motion`
- [ ] Translation prep: generate `languages/loomy.pot`, verify `'loomy'` text domain everywhere
- [ ] Self-hosted assets audit: confirm zero `https://` CDN links in `dist/`
- [ ] ✅ Compliance Gate: Theme passes Theme Check with 0 errors, <5 warnings

## 🚀 Phase 5: SVN Submission & Launch (Week 6)
- [ ] Final `npm run build` → verify `dist/` contains hashed CSS/JS + manifest
- [ ] Prepare SVN `trunk/`:
  - ✅ Include: `dist/`, `style.css`, `readme.txt`, `screenshot.png`, `functions.php`, `inc/`, `woocommerce/`, `template-parts/`, `languages/`, `fonts/`
  - ❌ Exclude: `assets/src/`, `node_modules/`, `vendor/`, `.git/`, `vite.config.js`, `package.json`
- [ ] Checkout theme SVN: `svn checkout https://themes.svn.wordpress.org/loomy/`
- [ ] Copy `trunk/` → `svn add trunk/*` → `svn commit -m "Initial Loomy v1.0.0 submission"`
- [ ] Submit to https://themes.trac.wordpress.org/
- [ ] Respond to review tickets point-by-point (code + explanation)
- [ ] ✅ Compliance Gate: Live preview on review server matches local build

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
- **WP.org Compliance**: ✅/❌ + Notes (CDN? Escaping? Conditional?)
- **Loomy-Specific Notes**: 

🛡️ WP.org Pre-Submit Checklist
readme.txt follows WP standard (tested with Theme Check)
screenshot.png is 1200x900, no misleading features
style.css header complete + GPL license declared
Zero REQUIRED errors in Theme Check
WP_DEBUG log empty of notices/warnings
Works standalone (WC/Elementor optional)
All inputs sanitized, all outputs escaped
Text domain 'loomy' used consistently
dist/ committed to SVN, src/ excluded
No plugin territory features (CPTs, shortcodes, admin pages)


---

### 🔑 Key Improvements Over Your Version:
1. **WP.org Gates per Phase** → Forces compliance validation before moving forward
2. **Explicit SVN Workflow** → Clear include/exclude rules for `trunk/`
3. **Conditional Dependencies** → `class_exists()`/`defined()` checks baked into planning
4. **Theme Check Integration** → Mandatory validation step before submission
5. **Self-Hosted Asset Audit** → Explicit CDN ban verification
6. **Updated Task Template** → Adds WP.org compliance field to every task

Replace your current `PLANNING.md` with this exact version. Your AI agent will now auto-generate tasks that respect WordPress.org review standards. 🧵✅