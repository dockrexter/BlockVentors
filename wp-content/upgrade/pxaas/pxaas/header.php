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
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg" itemscope> 
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="//gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>> 
    <?php if(pxaas_get_option('show_loader', true )) : 
            if(pxaas_get_option('image_loader')!='') { ?>  
                <div id="preloader">
                    <div id="status">
                        <img src="<?php echo esc_url(pxaas_get_option('img_loader') );?>" id="preloader_image" alt="loader">
                    </div>
                </div>
            <?php } else {?>
            <div class="load-wrapp">
                  <div class="wrap">
                      <ul class="dots-box">
                        <li class="dot"><span></span></li>
                        <li class="dot"><span></span></li>
                        <li class="dot"><span></span></li>
                        <li class="dot"><span></span></li>
                        <li class="dot"><span></span></li>
                      </ul>
                  </div>
              </div> 
            <?php }
            endif;
            ?>
    <?php  
    get_template_part('template-parts/navigation/default');
     ?> 
    <main role="main">
