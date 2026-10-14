<?php if ( post_password_required() ) return;?>

	<div id="comments" class="comments-area">
		<?php // You can start editing here -- including this comment! ?>
		<?php if ( have_comments() ) : ?>
		<ol class="comment-list">
			<h5 class="count-title">
				<?php comments_number(); ?>
			</h5>
			<?php
				wp_list_comments( array( 'callback' => 'ew_comments_callback' ) );
			?>
		</ol><!-- .comment-list -->
		<?php endif; // have_comments() ?>
		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'ew' ); ?></p>
		<?php endif; ?>
		<div class="comment-form-tm">
			<div id="respond" class="comment-respond">
				<h5><?php comment_form_title( ''.__('Your Comments','ew').'', '' ); ?></h5>
				<div class="cancel-comment-reply">
					<?php cancel_comment_reply_link(); ?>
				</div>
				<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
					<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
				<?php else : ?>

				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
					<div class='cm-form-info cm_show'>
						<div class='comment-author-field collapse in'>
							<?php if ( is_user_logged_in() ) : ?>
							<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
							<?php else : ?>
							<p class='comment-form-author'>
								<input type="text" name="author" id="author" placeholder="<?php echo __('Name','ew');?>" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
							</p>
							<p class='comment-form-email'>
								<input type="text" name="email" id="email" placeholder="<?php echo __('Email','ew');?>" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
							</p>
							<p class="comment-form-url">
								<input type="text" name="url" id="url" placeholder="<?php echo __('Website','ew');?>" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
							</p>
							<?php endif; ?>
							<p class='comment-form-comment'>
								<textarea placeholder="<?php echo __('Your comment','ew');?>" id="comment" class="trasition-all" name="comment" <?php if ($req) echo "aria-required='true'"; ?>></textarea>
							</p>
							<p class='form-submit form_heig'>
								<input name="submit" type="submit" id="submit" tabindex="5" value="<?php echo __('SUBMIT','ew');?>" />
								<?php comment_id_fields(); ?>
							</p>
						</div>
						<?php do_action('comment_form', $post->ID); ?>
					</div>
				</form>
				<?php endif; // If registration required and not logged in ?>
			</div>
		</div>
	</div><!-- #comments -->
