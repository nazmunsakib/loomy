<?php
/**
 * Blog Layout Wrapper End.
 *
 * @package Loomy
 */

$sidebar_enabled  = get_theme_mod( 'loomy_sidebar_enabled', true );
$is_sidebar_active = is_active_sidebar( 'loomy-blog-sidebar' );
$show_sidebar     = $sidebar_enabled && $is_sidebar_active;
?>

				</main>

				<?php if ( $show_sidebar ) : ?>
					<?php get_sidebar(); ?>
				<?php endif; ?>

		<?php if ( $show_sidebar ) : ?>
			</div><?php /* .flex */ ?>
		<?php else : ?>
			</div><?php /* .max-w-3xl */ ?>
		<?php endif; ?>
	</div><?php /* .container */ ?>
</div><?php /* .site-main */ ?>
