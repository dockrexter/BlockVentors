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
 * Template Name: No Sidebar
 * Template Post Type: post
 * 
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
<section class="sec-padding main-section-wrap single-no-template" id="sec1">
    <div class="container">
        <div class="row">

            <div class="col-md-12 display-post nosidebar">
            
                <div class="list-single-main-wrapper fl-wrap" id="sec2">
                
                    <?php
                    // global $wp_query;
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();
                        // set post view
                        if(function_exists('pxaas_addons_set_post_views')){
                            pxaas_addons_set_post_views(get_the_ID());
                        }

                        get_template_part( 'template-parts/single/content', get_post_format() );

                        if( pxaas_get_option('single_author_block', true ) && get_the_author_meta('description') !='' ) get_template_part( 'template-parts/single/author', 'block' );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        
                        if( pxaas_get_option('single_related', true ) ) get_template_part( 'template-parts/single/related', 'posts' );

                    endwhile; // End of the loop.
                    ?>

                </div>
                <!-- end list-single-main-wrapper -->
                
            </div>
            <!-- end display-posts col-md-8 -->

        </div>
        <!-- end row -->
    </div>
    <!-- end container -->

</section>
<!-- section end -->

<?php get_footer();
