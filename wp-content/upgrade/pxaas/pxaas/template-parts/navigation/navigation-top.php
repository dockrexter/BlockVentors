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
 * Displays navigation blogs
 *
 */
$nav_cls = 'collapse navbar-collapse';
if(pxaas_get_option('display_menu_phone')) $nav_cls .= ' phone-nav-menu';


if(is_page_template('home-landing-page.php' )):?>
    <nav id="main-navbar" class="landing-scroll-nav <?php echo esc_attr( $nav_cls ); ?>" aria-label="<?php esc_attr_e( 'Top Menu', 'pxaas' ); ?>">
        <?php 
            $defaults1= array(
                'theme_location'  => 'top-landing',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_id'            => 'top-menu',
                'menu_class'         => 'navbar-nav ml-auto'
            );
            
            if ( has_nav_menu( 'top-landing' ) ) {
                wp_nav_menu( $defaults1 );
            }
        ?>
    </nav><!-- #site-navigation -->
<?php else :?>
    <nav id="main-navbar" class="default-external-nav <?php echo esc_attr( $nav_cls ); ?>" aria-label="<?php esc_attr_e( 'Top Menu', 'pxaas' ); ?>">
        <?php 
            $defaults1= array(
                'theme_location'  => 'top',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_id'            => 'top-menu',
                'menu_class'         => 'navbar-nav ml-auto'
            );
            
            if ( has_nav_menu( 'top' ) ) {
                wp_nav_menu( $defaults1 );
            }
        ?>
    </nav><!-- #site-navigation -->
<?php endif; ?>

