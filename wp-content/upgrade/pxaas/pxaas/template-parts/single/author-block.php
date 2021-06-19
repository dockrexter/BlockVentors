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
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

?>
<!-- post-author-block -->   
<div class="post-author-block fl-wrap">
     <div class="author-block-image">
        <?php 
            echo get_avatar(get_the_author_meta('user_email'),$size='80',$default='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80' );
        ?> 
    </div>
    <div class="author-block-content">
        
        <h3><?php echo sprintf( __( 'Author: %s', 'pxaas' ), get_the_author_meta('nickname') );?></h3>
        <p><?php echo get_the_author_meta('description');?></p>
        <?php if ( 'no' !== esc_html_x( 'yes', 'Show author socials on single post page: yes or no', 'pxaas' ) ) : ?>
        <div class="author-socials">
            <ul>
                <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_twitterurl' ,true)!=''){ ?>
                    <li><a title="<?php esc_attr_e('Follow on Twitter','pxaas');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_twitterurl' ,true)); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <?php } ?>
                <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_facebookurl' ,true)!=''){ ?>
                    <li><a title="<?php esc_attr_e('Like on Facebook','pxaas');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_facebookurl' ,true)); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <?php } ?>
                <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_googleplusurl' ,true)!=''){ ?>
                    <li><a title="<?php esc_attr_e('Circle on Google Plus','pxaas');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_googleplusurl' ,true)) ;?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                <?php } ?>
                <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_linkedinurl' ,true)!=''){ ?>
                    <li><a title="<?php esc_attr_e('Be Friend on Linkedin','pxaas');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_linkedinurl' ,true) ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                <?php } ?>
                <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_instagramurl' ,true)!=''){ ?>
                    <li><a title="<?php esc_attr_e('Follow on Instagram','pxaas');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_instagramurl' ,true) ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                <?php } ?>
                <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_tumblrurl' ,true)!=''){ ?>
                    <li><a title="<?php esc_attr_e('Follow on  Tumblr','pxaas');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_tumblrurl' ,true) ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
                <?php } ?>  
            </ul>
        </div>
        <?php endif; ?>  
    </div>
</div>
<!-- post-author-block end -->   
