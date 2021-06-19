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
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */


get_header(); 



?>
<section class="error-wrap sec-padding pb-150px text-center p-relative o-hidden bg-gray">
    <div class="container page-404">
        <div class="row welcome-text sec-padding flex-center">
            <div class="col-md-12 mb-20px z-index-1">
                <?php $title_404 = pxaas_get_option('error404_title') ?>
                <?php if(!empty($title_404)): ?>
                    <h1 class="color-blue"><?php echo esc_html( $title_404 ); ?></h1>
                <?php endif; ?>
            </div>
            <div class="col-md-7 text-center">
                <img alt="img" src="<?php echo pxaas_get_option('error404_bg');?>" class="ml-auto mr-auto mb-10px">
                <?php $text_404 = pxaas_get_option('error404_text') ?>
                <?php if(!empty($text_404)): ?>
                    <h4><?php echo esc_html( $text_404 ); ?></h4>
                <?php endif ?>
                <p class="mb-30px"><?php echo pxaas_get_option('error404_msg');?></p>
                <?php if(pxaas_get_option('error404_form')) : get_search_form(); endif;?>
            </div>
        </div>
    </div>
    <div class="pattern p-absolute" style="background-image: url(<?php echo pxaas_get_option('error404_img_bt');?>)">
</section>

<?php get_footer();
