<?php
/**
 * The template for displaying comments
 *
 * @package Loomy
 */

if ( post_password_required() ) {
	return;
}
?>

<section id="comments" class="comments-area mt-16 pt-16 border-t border-gray-100">
	<?php if ( have_comments() ) : ?>
		<h3 class="text-2xl font-bold text-gray-900 mb-10">
			<?php
			$comment_count = get_comments_number();
			if ( '1' === $comment_count ) {
				esc_html_e( '1 Comment', 'loomy' );
			} else {
				printf(
					/* translators: 1: comment count number */
					esc_html( _n( '%s Comment', '%s Comments', $comment_count, 'loomy' ) ),
					number_format_i18n( $comment_count )
				);
			}
			?>
		</h3>

		<ol class="comment-list space-y-8 mb-16">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments text-gray-500 italic"><?php esc_html_e( 'Comments are closed.', 'loomy' ); ?></p>
	<?php endif; ?>

	<!-- Success Toast -->
	<div 
		x-show="success" 
		x-transition
		class="fixed bottom-8 left-8 bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg z-50 flex items-center gap-3"
	>
		<?php echo loomy_icon( 'check', 'h-5 w-5' ); ?>
		<?php esc_html_e( 'Comment submitted for moderation!', 'loomy' ); ?>
	</div>

	<?php
	comment_form(
		array(
			'class_form'         => 'comment-form space-y-6',
			'title_reply'        => esc_html__( 'Leave a Reply', 'loomy' ),
			'title_reply_to'     => esc_html__( 'Reply to %s', 'loomy' ),
			'comment_notes_before' => '',
			'comment_field'      => '
				<div class="comment-form-comment">
					<label for="comment" class="block text-sm font-medium text-gray-700 mb-2">' . esc_html__( 'Comment', 'loomy' ) . '</label>
					<textarea id="comment" name="comment" cols="45" rows="5" class="w-full bg-white border border-gray-100 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none" required></textarea>
				</div>',
			'submit_button'      => '
				<button 
					name="%1$s" 
					type="submit" 
					id="%2$s" 
					@click="loading = true"
					:disabled="loading"
					class="relative bg-primary text-white px-8 py-3 rounded-xl font-bold hover:brightness-110 transition-all shadow-md shadow-primary/10 disabled:opacity-70 disabled:cursor-not-allowed group"
				>
					<span :class="loading ? \'opacity-0\' : \'\'">%4$s</span>
					<div x-show="loading" class="absolute inset-0 flex items-center justify-center">
						<?php echo loomy_icon( \'spinner\', \'h-5 w-5 text-white\' ); ?>
					</div>
				</button>',
			'fields'             => array(
				'author' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
					<div class="comment-form-author">
						<label for="author" class="block text-sm font-medium text-gray-700 mb-2">' . esc_html__( 'Name', 'loomy' ) . '</label>
						<input id="author" name="author" type="text" class="w-full bg-white border border-gray-100 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none" required>
					</div>',
				'email'  => '
					<div class="comment-form-email">
						<label for="email" class="block text-sm font-medium text-gray-700 mb-2">' . esc_html__( 'Email', 'loomy' ) . '</label>
						<input id="email" name="email" type="email" class="w-full bg-white border border-gray-100 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none" required>
					</div>
				</div>',
			),
		)
	);
	?>
</section>
