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
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pxaas_body_classes( $classes ) {
	// Add class for fullscreen and fixed footer

	$classes[] = 'folio-archive-'.pxaas_get_option('folio_layout');


    if(post_password_required()) $classes[] = 'is-protected-page';

	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'pxaas-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'pxaas-front-page';
	}

    if (is_singular( 'page' )) {
        $col_theme = get_post_meta(get_the_ID(),'_cth_theme_color',true);
        if ($col_theme !== 'theme-color') {
            $classes[] = $col_theme.'-theme';
        }
    }

	return $classes;
}
add_filter( 'body_class', 'pxaas_body_classes' );

function pxaas_pre_get_posts( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'portfolio' )||is_tax( 'portfolio_cat' ) ) {
        $query->set('posts_per_page', pxaas_get_option( 'folio_posts_per_page', '12') );
        $query->set('orderby', pxaas_get_option( 'folio_orderby', 'date') );
        $query->set('order', pxaas_get_option( 'folio_order', 'DESC') );
        
        return;
    }
}
add_action( 'pre_get_posts', 'pxaas_pre_get_posts', 1 );



/**
 * Return attachment image link by using wp_get_attachment_image_src function
 *
 */
function pxaas_get_attachment_thumb_link( $id, $size = 'thumbnail' ){
    $image_attributes = wp_get_attachment_image_src( $id, $size, false );
    if ( $image_attributes ) {
        return $image_attributes[0];
    }
    return '';
}


if(!function_exists('pxaas_get_template_part')){
    /**
     * Load a template part into a template
     *
     * Makes it easy for a theme to reuse sections of code in a easy to overload way
     * for child themes.
     *
     * Includes the named template part for a theme or if a name is specified then a
     * specialised part will be included. If the theme contains no {slug}.php file
     * then no template will be included.
     *
     * The template is included using require, not require_once, so you may include the
     * same template part multiple times.
     *
     * For the $name parameter, if the file is called "{slug}-special.php" then specify
     * "special".
      * For the var parameter, simple create an array of variables you want to access in the template
     * and then access them e.g. 
     * 
     * array("var1=>"Something","var2"=>"Another One","var3"=>"heres a third";
     * 
     * becomes
     * 
     * $var1, $var2, $var3 within the template file.
     *
     *
     * @param string $slug The slug name for the generic template.
     * @param string $name The name of the specialised template.
     * @param array $vars The list of variables to carry over to the template
     * @author CTHthemes 
     * @ref http://www.zmastaa.com/2015/02/06/php-2/wordpress-passing-variables-get_template_part
     * @ref http://keithdevon.com/passing-variables-to-get_template_part-in-wordpress/
     */
    function pxaas_get_template_part( $slug, $name = null, $vars = null ) {
        $template_name = "{$slug}.php";
        $name      = (string) $name;
        if ( '' !== $name ) {
            $template_name = "{$slug}-{$name}.php";
        }
        $located = locate_template($template_name, false);
        if($located !== ''){
            /*
             * This use of extract() cannot be removed. There are many possible ways that
             * templates could depend on variables that it creates existing, and no way to
             * detect and deprecate it.
             *
             * Passing the EXTR_SKIP flag is the safest option, ensuring globals and
             * function variables cannot be overwritten.
             */
            // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
            if(isset($vars)) extract($vars, EXTR_SKIP);
            include $located;
        }
    }
}
/**
 * Load a template part into a template
 *
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialised template.
 * @param array $params Any extra params to be passed to the template part.
 */
// https://core.trac.wordpress.org/ticket/21676#comment:56
function pxaas_get_template_part_extended( $slug, $name = null, $params = array() ) {
    if ( ! empty( $params ) ) {
        foreach ( (array) $params as $key => $param ) {
            set_query_var( $key, $param );
        }
    }
    get_template_part( $slug, $name );
}
if(!function_exists('pxaas_get_the_password_form')){
    function pxaas_get_the_password_form($post = 0){
        $post = get_post( $post );
        $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
        $output = '<form action="' . esc_url( home_url( 'wp-login.php?action=postpass') ) . '" class="post-password-form" method="post">
        <p>' . esc_html__( 'This content is password protected. To view it please enter your password below:' , 'pxaas') . '</p>
        <p class="post-password-fields"><label for="' . esc_attr( $label ) . '"><span class="screen-reader-text">' . esc_html__( 'Password:', 'pxaas' ) . '</span><input name="post_password" id="' . esc_attr( $label ) . '" type="password" size="20" /></label><input type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form', 'pxaas' ) . '" /></p></form>
        ';

        return $output ;
    }
}
add_filter('the_password_form','pxaas_get_the_password_form' );

if(!function_exists('pxaas_get_kirki_dynamic_css')){
    function pxaas_get_kirki_dynamic_css($styles){
        if(pxaas_get_option('use_custom_color', false)){
            return $styles;
        }else{
            return '';
        }
    }
}
add_filter('kirki/pxaas_configs/dynamic_css','pxaas_get_kirki_dynamic_css' );


/**
 * Modify category count format
 *
 * @since PXaas 1.0
 */
function pxaas_custom_category_count_widget($output) {
    return preg_replace("/<\/a>\s*([\s(\d)]*)\s*</", '</a><span>$1</span><', $output);
}
add_filter('wp_list_categories', 'pxaas_custom_category_count_widget');

/**
 * Modify archive count format
 *
 * @since PXaas 1.0
 */
function pxaas_custom_archives_count_widget($link_html) {
    return preg_replace("/&nbsp;([\s(\d)]*)/", '<span>$1</span>', $link_html);
}
add_filter('get_archives_link', 'pxaas_custom_archives_count_widget');

function pxaas_relative_protocol_url(){
    return is_ssl() ? 'https' : 'http';
}





