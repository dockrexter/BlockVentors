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
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
if ( post_password_required() ) {
    get_template_part( 'template-parts/page/protected', 'page' );
    return;
}

get_header(); 
$sb_w = pxaas_get_option('blog-single-sidebar-width','4');
?>

<?php pxaas_get_top_header() ?>

<!--section -->   
<section class="sec-padding main-section-wrap single-template" id="sec1">
    <div class="container">
        <div class="row">
            <?php if( pxaas_get_option('blog_layout') ==='left_sidebar' && is_active_sidebar('sidebar-1')):?>
            <div class="col-md-<?php echo esc_attr($sb_w );?> blog-sidebar-column">
                <div class="blog-sidebar box-widget-wrap fl-wrap left-sidebar">
                    <?php 
                        get_sidebar(); 
                    ?>                 
                </div>
            </div>
            <?php endif;?>

            <?php if( pxaas_get_option('blog_layout') ==='fullwidth' || !is_active_sidebar('sidebar-1')):?>
            <div class="col-md-12 display-post nosidebar"></div>
            <?php else:?>
                <div class="col-md-<?php echo (12 - $sb_w);?> col-wrap display-post hassidebar">
            <?php endif;?>
                    <div class="list-single-main-wrapper fl-wrap" id="sec2">
                    
                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) : the_post();
                            // set post view
                            if(function_exists('pxaas_addons_set_post_views')){
                                pxaas_addons_set_post_views(get_the_ID());
                            }

                            get_template_part( 'template-parts/single/content', get_post_format() );

                            if( pxaas_get_option('single_author_block', true ) && get_the_author_meta('description') !='' )
                                get_template_part( 'template-parts/single/author', 'block' );
                         
                            //get nav next and previous post
                            if( pxaas_get_option('single_post_nav', true) ) { pxaas_post_nav(); }
                            
                            //get list relate post
                            if( pxaas_get_option('single_related', true ) ) get_template_part( 'template-parts/single/related', 'posts' );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;


                        endwhile; // End of the loop.
                        ?>

                    </div>
                    <!-- end list-single-main-wrapper -->
                </div>
            <!-- end display-posts col-md-8 -->
            <?php if( pxaas_get_option('blog_layout') === 'right_sidebar' && is_active_sidebar('sidebar-1')):?> 
                <div class="col-md-<?php echo esc_attr($sb_w);?> blog-sidebar-column">
                    <div class="blog-sidebar box-widget-wrap fl-wrap right-sidebar">
                        <?php 
                             get_sidebar(); 
                        ?>                 
                    </div> 
                </div>
            <?php endif;?> 

        </div>
        <!-- end row -->
    </div>
    <!-- end container -->

</section>
<!-- section end -->
<div class="container">
    <hr>
</div>

<?php get_footer();
