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
	<div class="container mx-auto px-4 max-w-7xl">
		<?php if ( $show_sidebar ) : ?>
			<div class="flex flex-col lg:flex-row gap-12 xl:gap-16">
				<main id="primary" class="main-content w-full lg:w-2/3" style="order: var(--loomy-content-order);">
		<?php else : ?>
			<div class="max-w-3xl mx-auto">
				<main id="primary" class="main-content w-full">
		<?php endif; ?>
