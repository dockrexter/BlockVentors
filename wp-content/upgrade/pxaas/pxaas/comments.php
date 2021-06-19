<?php
/**
 * @package PXaas - Saas & Software Landing Page Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 23-09-2019
 * @since 1.0.6
 * @version 1.0.6
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<?php if ( have_comments() ) : ?>
<div class="comments-wrapper">
	<div class="comment-number">
        <h2><?php echo sprintf( _n( 'Comment (<span>%s</span>)', 'Comments <span>( %s )</span>',  get_comments_number() < 2 ? 1 : get_comments_number() , 'pxaas' ), number_format_i18n( get_comments_number() ) );?><span class="dots-right"></span></h2>
    </div>

    <?php 
	$args = array(
		'walker'            => null,
		'max_depth'         => '',
		'style'             => 'div',
		'callback'          => 'pxaas_comments',
		'end-callback'      => null,
		'type'              => 'all',
		'reply_text'        => esc_html__(' Reply','pxaas'),
		'page'              => '',
		'per_page'          => '',
		'avatar_size'       => 50,
		'reverse_top_level' => null,
		'reverse_children'  => '',
		'format'            => 'html5', //or xhtml if no HTML5 theme support
		'short_ping'        => false, // @since 3.6,
	    'echo'     			=> true, // boolean, default is true
	);
	?>

    <div class="comments-wrap">
        <?php wp_list_comments($args);?>
    </div>
    <?php
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<div class="comments-nav">
		<ul class="pager clearfix">
			<li class="previous"><?php previous_comments_link( wp_kses(__( '<i class="fa fa-angle-left"></i> Previous Comments', 'pxaas' ), array('i'=>array('class'=>array())) ) ); ?></li>
			<li class="next"><?php next_comments_link( wp_kses(__( 'Next Comments <i class="fa fa-angle-right"></i>', 'pxaas' ), array('i'=>array('class'=>array())) ) ); ?></li>
		</ul>
	</div>
	<?php endif; // Check for comment navigation ?>

  	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'pxaas' ); ?></p>
	<?php endif; ?>
</div><!-- end comments-wrapper -->
<hr class="mt-50px mb-50px">
<?php endif; ?>


<?php if(comments_open( )) : ?>
<div class="comment-form-wrapper">
	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$char_req = ( $req ? '*' : '' );

		$comment_args = array(
		'title_reply'=> esc_html__('Leave A Comment','pxaas'),
		'fields' => apply_filters( 'comment_form_default_fields', 
		array(                     
				'author' => '<div class="row">
                    <div class="col-md-6">
                        <div class="has-icon form-group p-relative">
                            <input type="text" class="comment-input d-block w-100" id="author" name="author" placeholder="'.esc_attr__('Your Name ','pxaas'). $char_req .'" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' size="40">
                            <i class="fa fa-user-o fs-20 color-blue p-absolute"></i>
                        </div>
                    </div>',
				'email' =>'
                    <div class="col-md-6">
                        <div class="has-icon form-group p-relative">
                            <input class="comment-input d-block w-100" id="email" name="email" type="email" placeholder="'.esc_attr__('Your Email ','pxaas'). $char_req .'" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" ' . $aria_req . ' size="40">
                            <i class="fa fa-envelope-o fs-20 color-blue p-absolute"></i>
                        </div>
                    </div>
                </div>',
				) 
			),
		'comment_field' => '<div class="row"><div class="col-md-12 form-group p-relative"><textarea name="comment" id="comment" class="d-block w-100 pt-15px" rows="6" placeholder="'.esc_attr__('Your comment','pxaas').'" '.$aria_req.'></textarea><i class="fa fa-comments-o i-texta fs-20 color-blue p-absolute"></i></div></div>',
		'id_form'=>'commentform',
		'class_form'=>'add-comment custom-form',
		'id_submit' => 'submit',
		'class_submit'=>'main-btn btn-3',
		'label_submit' => esc_html__('Post Comment','pxaas'),
		'must_log_in'=> '<p class="not-empty">' .  sprintf( wp_kses(__( 'You must be <a href="%s">logged in</a> to post a comment.' ,'pxaas'),array('a'=>array('href'=>array(),'title'=>array(),'target'=>array())) ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'logged_in_as' => '<p class="not-empty">' . sprintf( wp_kses(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','pxaas' ),array('a'=>array('href'=>array(),'title'=>array(),'target'=>array())) ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="text-center">'.esc_html__('Your email is safe with us.','pxaas').'</p>',
		'comment_notes_after' => '',
		);
	?>
	<?php comment_form($comment_args); ?>
</div><!-- end comment-form-wrapper -->
<?php endif;?>




