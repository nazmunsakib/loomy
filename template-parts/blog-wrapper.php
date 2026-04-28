<?php
/**
 * Blog Layout Wrapper Start.
 *
 * @package Loomy
 */

$sidebar_enabled  = get_theme_mod( 'loomy_sidebar_enabled', true );
$is_sidebar_active = is_active_sidebar( 'loomy-blog-sidebar' );
$show_sidebar     = $sidebar_enabled && $is_sidebar_active;
?>

<div class="site-main py-12 md:py-16">
	<div class="container">
		<div class="<?php echo $show_sidebar ? 'flex flex-col lg:flex-row gap-12 xl:gap-16' : 'max-w-3xl mx-auto'; ?>">
			<main id="primary" class="main-content w-full <?php echo $show_sidebar ? 'lg:w-2/3' : ''; ?>" style="order: var(--loomy-content-order);">
