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
 *
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

?>

<?php 
    pxaas_get_top_header();
?>
 
<section class="page-section-wrap page-sidebar-no-template" id="sec1">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12 display-page nosidebar">
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
        </div>
    </div>

</section>

<?php 
get_footer( );
