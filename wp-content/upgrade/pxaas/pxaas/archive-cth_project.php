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
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); 


$show_header_project = pxaas_get_option('show_header_project');
$show_breadcrumbs_project = pxaas_get_option('show_breadcrumbs_project');
?>
<section class="sec-padding text-center p-relative o-hidden pxaas-top-section pxaas-home-page bg-gray">
        <div class="content-top-section sec-padding">
            <div class="container">
                <div class="row flex-center">
                    <?php if ($show_breadcrumbs_project) pxaas_breadcrumbs(); ?>

                    <div class="col-md-8">
                        <div class="img-top-section">
                            <img src="<?php echo esc_url( pxaas_get_option('project_header_image')); ?>" alt="<?php esc_attr_e( 'Header image', 'pxaas' ); ?>">
                        </div>
                    </div>

                </div>
            </div>
        </div>

    <div class="img-bot-sec" style="background-image: url(<?php echo esc_url( pxaas_get_option('project_header_image_bot')); ?>);"></div>
</section>
<section class="main-section-wrap home-project" id="sec1">
    <div class="container">    
        <div class="display-projects">
            <?php
            $args = array( 
                'hide_empty' => true,
                'taxonomy' => 'cth_project_cat',
            ); 
            $terms = get_terms( $args );
            $course_terms = 0;
            ?>
            <div class="filtering">
                <div class="filter-item nav-center">
                    <ul class="nav nav-pills cat" role="tablist" id="gallerytab">
                        <li><a class="active waves-effect waves-light waves-ripple background-f4f4f4 mb-10px mr-15px fw-400 radius-25px" href="javascript:void(0)" data-toggle="tab" data-filter="*"><?php esc_html_e( 'All', 'pxaas' ) ?></a></li>
                        <?php foreach ($terms as $term) { ?>
                            <li><a class="waves-effect waves-light waves-ripple background-f4f4f4 mb-10px mr-15px fw-400 radius-25px" href="javascript:void(0)" data-toggle="tab" data-filter="<?php echo '.cth_project_cat-'.$term->slug; ?>"><?php echo esc_html( $term->name );?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>


            <div class="our-galleries gal-col-2">
                <div class="our-sizer"></div>
                <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                    ?>
                    <div <?php post_class('gallery-item grid-item-wrap mt-30px') ?>>
                        <div class="work-image">
                            <?php the_post_thumbnail('project-grid'); ?>
                            <div class="overlay-bg transition-5 flex-center">

                                <div>
                                    <a href="<?php the_post_thumbnail_url(); ?>" class="img-magnifying d-inline-block radius-50 project-popup-image">
                                        <i class="icon-magnifying-glass"></i>
                                    </a>
                                    <a href="<?php the_permalink(); ?>" class="attachment d-inline-block radius-50">
                                        <i class="icon-attachment"></i>
                                    </a>
                                    <h5 class="transition-5 mt-10px mb-0px"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    <?php
                                    $terms = get_the_terms( get_the_ID(), 'cth_project_cat' );
                                    if ( $terms && ! is_wp_error( $terms ) ) : 
                                        foreach ( $terms as $term ) { ?>
                                        <p class="cat-prject"><?php echo esc_html( $term->name ); ?></p>
                                        <?php
                                        }
                                        ?>
                                    <?php endif; ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php  
                        endwhile;
                    endif;
                    ?>   
            </div>
            <div class="btn-wrap btn-bg-blue btn-center btn-prjct">
                <a href="#!" class="waves-effect waves-light waves-ripple"><?php esc_html_e( 'Load more', 'pxaas' ) ?></a>
            </div>
        </div>
        <!-- end display-posts col-md-8 -->
    </div>
    <!-- end container -->

</section>
<!-- section end -->

<?php get_footer();
