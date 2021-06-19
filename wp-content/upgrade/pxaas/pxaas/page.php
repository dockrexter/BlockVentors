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
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

if ( post_password_required() ) {
    get_template_part( 'template-parts/page/protected', 'page' );
    return;
}
get_header(); 

$sb_w = pxaas_get_option('blog-sidebar-width','3');

?>

<?php 
    pxaas_get_top_header();
?>

<!--section -->   
<section class="page-section-wrap page-template sec-padding" id="sec1">
    <div class="container">
        <div class="row">
            <?php if( pxaas_get_option('blog_layout') ==='left_sidebar' && is_active_sidebar('sidebar-2')):?>
            <div class="col-md-<?php echo esc_attr($sb_w );?> page-sidebar-column mt-25px mb-25px">
                <div class="blog-sidebar box-widget-wrap fl-wrap left-sidebar">
                    <?php 
                        get_sidebar('page'); 
                    ?>                 
                </div>
            </div>
            <?php endif;?>
            <?php if( pxaas_get_option('blog_layout') ==='fullwidth' || !is_active_sidebar('sidebar-2')):?>
            <div class="col-md-12 display-page nosidebar">
            <?php else:?>
            <div class="col-md-<?php echo (12 - $sb_w);?> col-wrap display-page hassidebar mt-25px mb-25px">
            <?php endif;?>
                <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/page/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>
            </div>
            <!-- end display-posts col-md-8 -->
            <?php if( pxaas_get_option('blog_layout') === 'right_sidebar' && is_active_sidebar('sidebar-2')):?>
            <div class="col-md-<?php echo esc_attr($sb_w );?> page-sidebar-column mt-25px mb-25px">
                <div class="blog-sidebar box-widget-wrap fl-wrap right-sidebar">
                    <?php 
                        get_sidebar('page'); 
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

<?php 
get_footer( );
