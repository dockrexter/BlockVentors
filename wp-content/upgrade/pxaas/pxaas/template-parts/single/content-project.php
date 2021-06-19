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
<!-- article> --> 
<article id="post-<?php the_ID(); ?>" <?php post_class('pro-single pformat-default fw-post tranform-main-img'); ?>>
    <?php 
        the_title( '<h4 class="mt-20px mb-10px entry-title"><a href="' . esc_url( get_permalink() ) . '" class="color-333 fw-600 color-blue-hvr" rel="bookmark">', '</a></h4>' );
    ?>
    <div class="row content-pro">
        <div class="pro-thumbnail"><?php the_post_thumbnail('pxaas-single-image',array('class'=>'resp-img') ); ?></div>
        <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">
            <div class="row">
                <div class="content-pro-left">
                    <?php echo the_content(); ?>
                </div>
                <div class="tags-pro">
                   <?php if( pxaas_get_option( 'single_tags' ) && get_the_tags( ) ) :?>
                    <div class="tags">
                        <span><i class="fa fa-tags" aria-hidden="true"></i><?php esc_html_e( 'Tags : ','pxaas' ) ?></span> <?php the_tags('' , ',  ' , '');?>
                    </div>
                    <?php endif;?>
                    <?php  if(function_exists('pxaas_addons_echo_socials_share')) pxaas_addons_echo_socials_share(); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
            <div class="row">
                <div class="content-pro-right">
                    <?php if( pxaas_get_option( 'single_date' )  || pxaas_get_option( 'single_cats' ) || pxaas_get_option( 'single_comments' )  ):?>
                        <?php pxaas_get_single_post_cart_metar(); ?>
                    <?php endif;?>
                </div>
                <div class="pro-socail-link">
                    <div class="socail-link">
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
                </div>
            </div>
        </div>
    </div>
</article>

<!-- article end -->       
<span class="section-separator"></span>

