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
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); 

$sb_w = pxaas_get_option('blog-sidebar-width','3');
?>
<section class="main-section-wrap home-template" id="sec1">
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
            <div class="col-md-12 display-posts nosidebar">
            <?php else:?>
            <div class="col-md-<?php echo (12 - $sb_w);?> col-wrap display-posts hassidebar">
            <?php endif;?>        
                <?php
                
                if (have_posts()) :
                    while (have_posts()) : the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        if(pxaas_get_option('blog_show_format', true ))
                            get_template_part( 'template-parts/post/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
                        else
                           get_template_part( 'template-parts/post/content' );

                    endwhile;
                    pxaas_pagination();
                    else :
                        get_template_part( 'template-parts/post/content', 'none' );

                    endif;
                    ?>
            </div>
            <!-- end display-posts col-md-8 -->
            <?php if( pxaas_get_option('blog_layout') === 'right_sidebar' && is_active_sidebar('sidebar-1')):?>
            <div class="col-md-<?php echo esc_attr($sb_w );?> blog-sidebar-column">
                <div class="blog-sidebar box-widget-wrap fl-wrap right-sidebar">
                    <?php 
                        get_sidebar(); 
                    ?>
      
                </div>
            <?php endif;?>

        </div>
    </div>
        <!-- end row -->
    </div>
    <!-- end container -->

</section>
<!-- section end -->

<?php get_footer();
