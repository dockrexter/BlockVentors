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

$posttags = get_the_tags();
$posttags_arr = array();
if ($posttags) {
  foreach($posttags as $tag) {
    $posttags_arr[] = $tag->term_id;
  }
}
if(empty($posttags_arr)) return;
$dataArr['items'] = 2;
$dataArr['loop'] = true;
$dataArr['margin'] = 20;
$dataArr['dots'] = false;
$dataArr['nav'] = true;
?>
<div class="container-fuilt">
    <div class="related-post-name">
        <h4 class="mb-30px"><?php esc_html_e( 'Related post', 'pxaas' ) ?></h4>
    </div>
    <div class="row related-post">
        <?php 
        $args=array(
            'post_type' => 'post',
            'post__not_in' => array(get_the_ID()),
            'tag__in' => $posttags_arr,
            'showposts'=> 2,
            );
            $my_query = new WP_Query($args);
            if( $my_query->have_posts() ) :
                while ($my_query->have_posts()) :
                    $my_query->the_post();

                        $slider_images = get_post_meta( get_the_ID(), '_cth_post_slider_images', true);
                        $video = get_post_meta( get_the_ID(), '_cth_embed_video', true); ?>
                        <div class="col-md-6">
                            <?php if( !empty($slider_images) && pxaas_get_option('blog_show_format', true ) && get_post_format( ) == 'gallery' ) { ?>
                                <div class="post-media-wrap fl-wrap"> 
                                    <div class="single-slider owl-carousel owl-theme dis-owl-dot nav-betwen"> 
                                        <?php 
                                        foreach ( (array) $slider_images as $img_id => $img_url ) {
                                            echo '<div class="item">';
                                            echo wp_get_attachment_image($img_id, 'pxaas-featured-image', false,array('class'=>'resp-img') );
                                            echo '</div>';
                                        }
                                        ?>
                                    </div> 
                                </div>
                            <?php } elseif(has_post_thumbnail()) { ?>
                                <div class="post-media-wrap fl-wrap tranform-img">
                                    <?php the_post_thumbnail('pxaas-featured-image',array('class'=>'resp-img') ); ?>
                                    <?php if($video != '' && get_post_format() == 'video' ) : ?>
                                        <a href="<?php echo esc_url( $video); ?>" class="play-trigger"><span><i class="fa fa-play"></i></span></a>
                                    <?php endif; ?>
                                </div>
                            <?php } ?>

                            <div class="item-list">
                                <h5 class="mt-10px mb-15px"><a href="<?php the_permalink() ?>" class="color-333 fw-600 color-blue-hvr" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
                                <?php pxaas_get_blog_post_cart_metar(); ?>
                                <div class="post-excerpt">
                                    <?php the_excerpt();?>
                                </div>
                                <a class="read transition-5 o-hidden d-inline-block p-relative pl-20px mt-10px mr-15px color-aaa color-blue-hvr" href="<?php echo get_permalink();?>">
                                    <span class="line transition-4 p-absolute d-inline-block bg-333"></span>
                                    <?php esc_html_e( 'Read more', 'pxaas' ); ?>
                                </a>
                            </div>
                        </div>
        <?php
                endwhile;
            endif;

            wp_reset_postdata();
        ?>
    </div>
    <hr class="mt-50px mb-50px">
</div>
