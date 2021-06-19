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
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header(); ?>

<section class="protected-sec-wrap sec-padding pb-150px pt-200px text-center p-relative o-hidden">
    <div class="container page-404">
        <div class="row welcome-text sec-padding flex-center">
            <div class="col-md-7 text-center">
                <h4 class="protected-title"><?php the_title( );?></h4>
                <?php echo get_the_password_form(); ?>
            </div>
        </div>
    </div>
</section>
<!--  section  end--> 


<?php     
get_footer();
