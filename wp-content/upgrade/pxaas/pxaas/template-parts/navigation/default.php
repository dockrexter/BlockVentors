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
?>
<?php 
$type_header = get_post_meta(get_the_ID(),'_cth_header_style',true );
if($type_header !== 'default') {
    $css_type_header = "navbar-".$type_header;
}else {
    $css_type_header = "navbar-default-style";
}
?>
<header class="navbar navbar-expand-lg <?php echo esc_attr( $css_type_header ); ?>">
    <div class="container">
        <div class="logo-holder navbar-brand">
            <?php 
            if(has_custom_logo()) the_custom_logo(); 
            else echo '<a class="custom-logo-link logo-text" href="'.esc_url( home_url('/' ) ).'"><h2>'.get_bloginfo( 'name' ).'</h2></a>'; 
            ?>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
        </button>
        <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
        <?php echo do_shortcode( pxaas_check_shortcode('[pxaas_login]', 'pxaas_login') );?>
    </div>
</header>