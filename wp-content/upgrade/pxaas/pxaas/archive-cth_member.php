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
?>
<?php
$show_header_member = pxaas_get_option('show_header_member');
$show_breadcrumbs_member = pxaas_get_option('show_breadcrumbs_member');
$title_header = pxaas_get_option('member_head_title');
$url_img = pxaas_get_option('member_header_image');
$url_img_bot = pxaas_get_option('member_header_image_bot');
$mem_width = pxaas_get_option('member-width');
$number_mem = pxaas_get_option('number_mem');

?>

<section class="sec-padding text-center p-relative o-hidden pxaas-top-section pxaas-home-page bg-gray">
    <div class="content-top-section sec-padding">
        <div class="container">
            <div class="row flex-center">
                <h1 class="color-blue"><?php echo esc_html( $title_header ); ?></h1>
                <div class="col-md-8">
                    <div class="img-top-section">
                        <img src="<?php echo esc_url( $url_img ); ?>" alt="<?php esc_attr_e( 'Header image', 'pxaas' ); ?>">
                    </div>
                </div>
            </div>
        </div>
    <div class="img-bot-sec" style="background-image: url(<?php echo esc_url( $url_img_bot ); ?>);"></div>       
        
</section>



<?php if ($show_header_member || $show_breadcrumbs_member) : ?>
    <section class="pxaas-top-section pxaas-home">
        <?php if ($show_breadcrumbs_member) : ?>
            <div class="content-breadcrumb">
                <div class="container">
                    <div class="row ">
                        <?php pxaas_breadcrumbs(); ?>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php if($show_header_member) { ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="left-heading">
                            <h1 class="heading-top-section"><?php echo esc_html(pxaas_get_option('member_head_title')) ?></h1>
                            <p class="desc-top-section"><?php echo esc_html(pxaas_get_option('member_head_desc')) ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="img-top-section">
                            <img src="<?php echo esc_url( pxaas_get_option('member_header_image')); ?>" alt="<?php esc_attr_e( 'Header image', 'pxaas' ); ?>">
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
<?php endif ?>

<section class="main-section-wrap home-member" id="sec1">
    <div class="container">
        <div class="row">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'cth_member',
                'paged' => $paged,
                'posts_per_page' => 4,
                'showposts' => $number_mem,
            );
            $course = new \WP_Query($args);
            if ($course -> have_posts()) :
                while ($course -> have_posts()) : $course -> the_post();
            ?>
            <div class="<?php echo 'col-md-'.$mem_width; ?> mt-25px">
                <div class="mem-item-wrapper text-center">
                    <div class="mem-content">
                        <?php 
                        if(has_post_thumbnail()): ?>
                            <div class="mem-image">
                                <a class="mem-link" href="<?php esc_url( get_permalink() ); ?>" rel="bookmark">
                                    <div class="sp_img_box_overlay"></div>
                                    <?php the_post_thumbnail( 'chef-thumb', array('class'=>'chef-img') );?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mem-content-center">
                        <h5 class="mb-0px mt-10px"><?php the_title(); ?></h5>
                        <span class="color-orange fs-15 d-block mb-15px"><?php echo get_post_meta( get_the_ID(), P_META_PREFIX.'member_job', true ); ?></span>
                        <div class="mem-socials">
                            <?php 
                            $facebook = get_post_meta( get_the_ID(), P_META_PREFIX.'facebookurl', true );
                            $twitter = get_post_meta( get_the_ID(), P_META_PREFIX.'twitterurl', true );
                            $linkedi = get_post_meta( get_the_ID(), P_META_PREFIX.'linkedinurl', true );
                            $pinterest = get_post_meta( get_the_ID(), P_META_PREFIX.'pinteresturl', true );

                            $googleplus = get_post_meta( get_the_ID(), P_META_PREFIX.'googleplusurl', true );
                            $instagram = get_post_meta( get_the_ID(), P_META_PREFIX.'instagramurl', true );
                            $youtube = get_post_meta( get_the_ID(), P_META_PREFIX.'youtubeurl', true );
                            $tumblr = get_post_meta( get_the_ID(), P_META_PREFIX.'tumblrurl', true );
                            ?>
                            <?php if(!empty($facebook)): ?><a href="<?php echo esc_url( $facebook); ?>" target="_blank" class="color-blue fs-14 d-inline-block radius-50 bg-orange-hvr color-fff-hvr transition-2 mr-2px ml-2px"><i class="fa fa-facebook-f"></i></a><?php endif; ?>
                            <?php if(!empty($twitter)): ?><a href="<?php echo esc_url( $twitter); ?>" target="_blank" class="color-blue fs-14 d-inline-block radius-50 bg-orange-hvr color-fff-hvr transition-2 mr-2px ml-2px"><i class="fa fa-twitter"></i></a><?php endif; ?>
                            <?php if(!empty($googleplus)): ?><a href="<?php echo esc_url( $googleplus); ?>" target="_blank" class="color-blue fs-14 d-inline-block radius-50 bg-orange-hvr color-fff-hvr transition-2 mr-2px ml-2px"><i class="fa fa-google-plus"></i></a><?php endif; ?>
                            <?php if(!empty($instagram)): ?><a href="<?php echo esc_url( $instagram); ?>" target="_blank" class="color-blue fs-14 d-inline-block radius-50 bg-orange-hvr color-fff-hvr transition-2 mr-2px ml-2px"><i class="fa fa-instagram"></i></a><?php endif; ?>
                            <?php if(!empty($linkedi)): ?><a href="<?php echo esc_url( $linkedi); ?>" target="_blank" class="color-blue fs-14 d-inline-block radius-50 bg-orange-hvr color-fff-hvr transition-2 mr-2px ml-2px"><i class="fa fa-linkedin"></i></a><?php endif; ?>
                            <?php if(!empty($pinterest)): ?><a href="<?php echo esc_url( $pinterest); ?>" target="_blank" class="color-blue fs-14 d-inline-block radius-50 bg-orange-hvr color-fff-hvr transition-2 mr-2px ml-2px"><i class="fa fa-pinterest"></i></a><?php endif; ?>
                            <?php if(!empty($youtube)): ?><a href="<?php echo esc_url( $youtube); ?>" target="_blank" class="color-blue fs-14 d-inline-block radius-50 bg-orange-hvr color-fff-hvr transition-2 mr-2px ml-2px"><i class="fa fa-youtube"></i></a><?php endif; ?>
                            <?php if(!empty($tumblr)): ?><a href="<?php echo esc_url( $tumblr); ?>" target="_blank" class="color-blue fs-14 d-inline-block radius-50 bg-orange-hvr color-fff-hvr transition-2 mr-2px ml-2px"><i class="fa fa-tumblr"></i></a><?php endif; ?>
                        </div>
                        <a class="main-btn btn-3 mt-10px" href="<?php echo get_permalink(); ?>" target="_blank"><?php esc_html_e( 'Read More', 'pxaas' ) ?></a>
                    </div>
                </div>    
            </div>
            <?php  
                endwhile;
            endif;
            ?>   
        </div>
    </div>
    <!-- end container -->

</section>
<!-- section end -->
<div class="container">
    <hr>
</div>

<?php get_footer();
