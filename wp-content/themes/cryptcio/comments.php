<?php

if ( post_password_required() ) {
	return;
}
?>
<?php 
?>
<div class="post-comments">
	<div id="comments" class="comments-area">

		<?php if ( have_comments() ) : ?>
			<h2 class="number-comments widget-title">
			<?php 			printf( _n( '<span>1</span> Comment ', '<span>%1$s</span> Comments ', get_comments_number(), 'cryptcio' ),
					number_format_i18n( get_comments_number() ) );
			?>
			</h2>

			<ul class="commentlist">
				<?php
					wp_list_comments( array(
						'reply_text'       => esc_html__('Reply','cryptcio'),
						'style'  => 'ul',
						'short_ping' => true,
						'avatar_size' => 100,
						'callback' => 'cryptcio_comment_body_template',
						'max_depth' => 5,
					) );			
				?>			
			</ul>

			<?php cryptcio_comment_nav(); ?>
		
		<?php endif; ?>

		<?php
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'cryptcio' ); ?></p>
		<?php endif; ?>

		<div class="comment-form">
			<?php 

			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$comment_login='';
			if ( is_user_logged_in() ) {$comment_login="comment-field-login";}
			
			$comment_args = array( 
				'class_form' => 'commentform row',
				'fields' => apply_filters( 'comment_form_default_fields', array(
				    'author' => '<div class="col-md-12 col-sm-12 col-xs-12"> 
				    	<div class="comment-field fields row">
						    <p class="col-md-4 col-sm-4 col-xs-12 comment-form-author form-row"><input placeholder="' .esc_attr__('Your Name*', 'cryptcio' ) . '" id="author" class="required" name="author" type="text" value="' .
						                esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
						    '</p>',
						    'email'  => '<p class="col-md-4 col-sm-4 col-xs-12 comment-form-email form-row"><input placeholder="' .esc_attr__('Your Email*', 'cryptcio' ) . '" id="email" class="required email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
							'</p>',
							'website'  => '<p class="col-md-4 col-sm-4 col-xs-12 comment-form-website form-row"><input placeholder="' .esc_attr__('Website', 'cryptcio' ) . '" id="website" class="website" name="website" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30"' . $aria_req . ' />' .
							'</p>
						</div>
					</div>',
				    'url'    => '' ) ),
				'comment_field' => '<div class="col-md-12 col-sm-12 col-xs-12 comment-textarea"><div class="comment-right-field'.$comment_login.' "><p class="comment-form-comment form-row form-row-wide">' .
			       		'<textarea id="comment" class="required" name="comment" cols="45" rows="4" aria-required="true" placeholder="' .esc_attr__('Comment', 'cryptcio' ) . '"></textarea>' .
			   		'</p></div></div>',
				'title_reply'  => '<span>'.esc_html__( 'Leave your thought here','cryptcio' ).'</span>',
				'cancel_reply_link' => esc_html__('Cancel reply','cryptcio'),
			    
			   	'logged_in_as' => '',
			    'comment_notes_before' => '',
			    'class_submit'         => 'hidden',
			    'label_submit'		=> esc_html__('send comment','cryptcio'),
			    'comment_notes_after' => '',
			);
			?>

			<?php comment_form($comment_args); ?>
		<?php
		?> 
		</div>
	</div>
</div>
