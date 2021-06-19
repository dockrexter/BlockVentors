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
 * Template part for displaying image posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */


?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-single fw-post tranform-main-img'); ?>>
    <?php 
    if(pxaas_get_option('single_featured' )): ?>
        <?php
        if(has_post_thumbnail( )){ ?>
        <div class="post-media-wrap fl-wrap">
            <?php the_post_thumbnail('pxaas-single-image',array('class'=>'resp-img') ); ?>
        </div>
        <?php } 
        ?>
    <?php 
    endif; ?>
    <div class="post-content-wrap single-page fl-wrap"> 
        <div class="post-content-wrap-title fl-wrap">
            <?php 
            the_title( '<h4 class="mt-20px mb-10px entry-title color-333 fw-600">', '</h4>' );
            ?>
        </div>
        
        <?php pxaas_get_single_post_cart_metar(); ?>
               
        <?php the_content();?>

        <div class="clearfix"></div>

        <?php
            wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'pxaas' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            ) );
        ?>

        <?php if( pxaas_get_option( 'single_tags' ) && get_the_tags( ) ) :?>
            <div class="tags-socials">
                <div class="tags">
                    <?php the_tags('','&nbsp;','');?>                                                                          
                </div>
                <?php  if(function_exists('pxaas_addons_echo_socials_share')) pxaas_addons_echo_socials_share(); ?>
            </div>
        <?php endif;?>

        <hr class="mt-50px mb-50px">
        <!-- <span class="fw-separator"></span> -->
    </div>
</article>
<!-- <span class="section-separator"></span> -->

