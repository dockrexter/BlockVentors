<?php
$theme = wp_get_theme();
define('CRYPTCIO_VERSION', $theme->get('Version'));
define('CRYPTCIO_LIB', get_template_directory() . '/inc');
define('CRYPTCIO_ADMIN', CRYPTCIO_LIB . '/admin');
define('CRYPTCIO_PLUGINS', CRYPTCIO_LIB . '/plugins');
define('CRYPTCIO_FUNCTIONS', CRYPTCIO_LIB . '/functions');
define('CRYPTCIO_METABOXES', CRYPTCIO_FUNCTIONS . '/metaboxes');
define('CRYPTCIO_CSS', get_template_directory_uri() . '/css');
define('CRYPTCIO_JS', get_template_directory_uri() . '/js');

require_once(CRYPTCIO_ADMIN . '/functions.php');
require_once(CRYPTCIO_FUNCTIONS . '/functions.php');
require_once(CRYPTCIO_METABOXES . '/functions.php');
require_once(CRYPTCIO_PLUGINS . '/functions.php');
// Set up the content width value based on the theme's design and stylesheet.
if (!isset($content_width)) {
    $content_width = 1140;
}
if (!function_exists('cryptcio_setup')) {

    function cryptcio_setup() {
        load_theme_textdomain('cryptcio', get_template_directory() . '/languages');
        add_editor_style( array( 'style.css' ) );
        add_theme_support( 'title-tag' );
        add_theme_support('automatic-feed-links');
        add_theme_support( 'post-formats', array(
            'image', 'video', 'audio', 'quote', 'link', 'gallery',
        ) );
        // register menus
        register_nav_menus( array(
            'primary' => esc_html__('Primary Menu', 'cryptcio'),
        ));

        add_theme_support( 'custom-header' );
        add_theme_support( 'custom-background' );
        add_theme_support( 'post-thumbnails' );

        add_image_size('cryptcio-blog-list', 1200, 412, true);
        add_image_size('cryptcio-blog-list-sidebar', 1200, 519, true);
        add_image_size('cryptcio-blog-grid', 570, 571, true);
        add_image_size('cryptcio-blog-packery-32', 445, 299, true);
        add_image_size('cryptcio-blog-grid-6', 790, 420, true);
        add_image_size('cryptcio-blog-list-shortcode', 528, 402, true);
        add_image_size('cryptcio-service-grid', 570, 386, true);
        add_image_size('cryptcio-project-grid', 634, 634, true);
        add_image_size('cryptcio-project-grid2', 951, 476, true);
        add_image_size('cryptcio-project-grid3', 951, 951, true);
        add_image_size('cryptcio-project-grid4', 576, 975, true);
        add_image_size('cryptcio-service-single', 1141, 561, true);
		add_image_size('cryptcio-shop', 556, 556, true);  
		add_image_size('cryptcio-shop-single', 660, 660, true);  
		add_image_size('cryptcio-shop-thumbnail', 204, 204, true);  
    }

}
add_action('after_setup_theme', 'cryptcio_setup');

add_action('admin_enqueue_scripts', 'cryptcio_admin_scripts_css');
function cryptcio_admin_scripts_css() {
    if(is_rtl()){
        wp_enqueue_style('cryptcio-admin-rtl-css', CRYPTCIO_CSS . '/admin-rtl.css', false);
    }
    else{
        wp_enqueue_style('cryptcio-admin-css', CRYPTCIO_CSS . '/admin.css', false);
    }
}
add_action('admin_enqueue_scripts', 'cryptcio_admin_scripts_js');
function cryptcio_admin_scripts_js() {

    wp_register_script('cryptcio-admin-js', CRYPTCIO_JS . '/un-minify/admin.js', array('common', 'jquery', 'media-upload', 'thickbox'), CRYPTCIO_VERSION, true);

    wp_enqueue_script('cryptcio-admin-js');

    wp_localize_script('cryptcio-admin-js', 'cryptcio_params', array(
        'cryptcio_version' => CRYPTCIO_VERSION,
    ));
}
function cryptcio_fonts_url() {
    $font_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';
    $cryptcio_breadcrumbs_font = get_post_meta(get_the_ID(),'breadcrumbs_font',true);
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'cryptcio' ) ) {
        $fonts[] = 'Open Sans'.':300,400,500,600,700,800,900';
        $fonts[] = 'Poppins'.':300,400,500,600,700,800,900';
        $fonts[] = 'Montserrat'.':300,400,500,600,700';
        $fonts[] = 'Raleway'.':100,400';
    }

    if(isset($cryptcio_breadcrumbs_font) && $cryptcio_breadcrumbs_font!=''){
        $fonts[] = esc_html($cryptcio_breadcrumbs_font).':300,400,500,600,700,800,900';
    }
    /*
     * Translators: To add an additional character subset specific to your language,
     * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
     */
    $subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'cryptcio' );

    if ( 'cyrillic' == $subset ) {
        $subsets .= ',cyrillic,cyrillic-ext';
    } elseif ( 'greek' == $subset ) {
        $subsets .= ',greek,greek-ext';
    } elseif ( 'devanagari' == $subset ) {
        $subsets .= ',devanagari';
    } elseif ( 'vietnamese' == $subset ) {
        $subsets .= ',vietnamese';
    }

    if ( $fonts ) {
        $font_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts ) ),
            'subset' => urlencode( $subsets ),
        ), '//fonts.googleapis.com/css' );
    }

    return $font_url;
}

//Disable all woocommerce styles
add_filter('woocommerce_enqueue_styles', '__return_false');

function cryptcio_scripts_js() {
    global $cryptcio_settings, $wp_query;

    $cat = $wp_query->get_queried_object();
    if(isset($cat->term_id)){
        $woo_cat = $cat->term_id;
    }else{
        $woo_cat = '';
    }
    $cryptcio_woo_enable = $cryptcio_fancybox_enable = $cryptcio_rtl = $post_content = $shop_list = $cryptcio_slick_enable = $cryptcio_valid_form = $cryptcio_animation = '';

    if(get_the_ID()!=''){
        $post = get_post(get_the_ID());
        $post_content = $post->post_content;
    } 
    
    if ( class_exists( 'WooCommerce' ) ) {
        $shop_list = is_product_category();
        $cryptcio_woo_enable = 'yes';
    }

    $crypto_body_classes = get_body_class();

    if(stripos($post_content,'fancybox') || stripos($post_content,'arrowpress_member') || get_post_type()=='post' || get_post_type()=='product' || in_array('fancybox-on',$crypto_body_classes) ){
        $cryptcio_fancybox_enable = 'yes';
    }

    if(stripos($post_content,'arrowpress_instagram_feed')|| stripos($post_content,'cate-archive') || stripos($post_content,'thumbs_list')|| get_post_type()=='product' || get_post_type()=='post' || get_post_type()=='service' || stripos($post_content, 'blog-grid-5') || stripos($post_content, 'arrowpress_blog') || stripos($post_content, 'arrowpress_slider_wrap') || stripos($post_content, 'arrowpress_event_list')){
        $cryptcio_slick_enable = 'yes';
    }

    if(stripos($post_content,'item_delay')){
        $cryptcio_animation = 'yes';
    }

    if(is_rtl()){
        $cryptcio_rtl = 'yes';
    }

	$blog_id =  'blog_id-'.wp_rand();

    $product_list_mode = get_metadata('product_cat', $woo_cat, 'list_mode_product', true);
    $cryptcio_number_cate = (isset($cryptcio_settings['number-cate']) && $cryptcio_settings['number-cate'] != '') ? $cryptcio_settings['number-cate'] : '';
    $header_sticky_mobile = isset($cryptcio_settings['header-sticky-mobile'])? $cryptcio_settings['header-sticky-mobile'] : '';   
    $cryptcio_coming_subcribe_text = (isset($cryptcio_settings['coming_subcribe_text']) && $cryptcio_settings['coming_subcribe_text'] != '') ? $cryptcio_settings['coming_subcribe_text'] : ''; 

    // comment reply
    if ( is_singular() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    global $wp_scripts;
    $cryptcio_scripts = array_map('basename', (array) wp_list_pluck($wp_scripts->registered, 'src') );
    $cryptcio_suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
   
    // Loads our main js.
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), CRYPTCIO_VERSION, true);

    if ( in_array('isotope.pkgd.min.js', $cryptcio_scripts) || in_array('isotope.pkgd.js', $cryptcio_scripts)  ) {
        wp_deregister_style('isotope'); 
        wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), CRYPTCIO_VERSION, true);   
    } else {
        wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), CRYPTCIO_VERSION, true);  
    }       
    wp_enqueue_script('isotope-packery', get_template_directory_uri() . '/js/packery-mode.pkgd.min.js', array('jquery'), CRYPTCIO_VERSION, true);
    
    if(stripos($post_content,'particles-on')){
        wp_enqueue_script('particles', get_template_directory_uri() . '/js/particles.min.js', array('jquery'), CRYPTCIO_VERSION, true);
        wp_enqueue_script('cryptcio-particles', get_template_directory_uri() . '/js/particles/theme-particles.js', array('jquery'), CRYPTCIO_VERSION, true);
        wp_localize_script('cryptcio-particles', 'cryptcio_particles_param', array(
            'cryptcio_path' => esc_js(get_template_directory_uri()),
        ));
    }
    

    if($cryptcio_fancybox_enable=='yes'){
        wp_enqueue_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array('jquery'), CRYPTCIO_VERSION, true);
    }
    
    if($cryptcio_slick_enable=='yes'){
        if ( in_array('slick.min.js', $cryptcio_scripts) || in_array('slick.js', $cryptcio_scripts)  ) {
            wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), CRYPTCIO_VERSION, true);           
        } else {
            wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), CRYPTCIO_VERSION, true);
        }        
    }

    if($cryptcio_animation == 'yes'){
        wp_enqueue_script('appear', get_template_directory_uri() . '/js/un-minify/appear.js', array('jquery'), CRYPTCIO_VERSION, true); 
    }

    wp_enqueue_script( 'jquery-ui-autocomplete' );
	
    if(get_post_type() == 'product'){
        wp_enqueue_script('sticky-kit', get_template_directory_uri() . '/js/sticky-kit.min.js', array('jquery'), CRYPTCIO_VERSION, true);   
    }

    if( post_type_supports( get_post_type(), 'comments' ) ) {
        if( comments_open() ) {
            $cryptcio_valid_form = 'yes';
            wp_enqueue_script('validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), CRYPTCIO_VERSION);
        }
    }
    wp_enqueue_script('cryptcio-script', get_template_directory_uri() . '/js/un-minify/cryptcio_theme'.$cryptcio_suffix.'.js', array('jquery'), CRYPTCIO_VERSION, true); 
    wp_localize_script('cryptcio-script', 'cryptcio_params', array(
        'ajax_url' => esc_js(admin_url( 'admin-ajax.php' )),
        'ajax_loader_url' => esc_js(str_replace(array('http:', 'https'), array('', ''), CRYPTCIO_CSS . '/images/ajax-loader.gif')),
        'ajax_cart_added_msg' => esc_html__('A product has been added to cart.', 'cryptcio'),
        'ajax_compare_added_msg' => esc_html__('A product has been added to compare', 'cryptcio'),
        'type_product' => $product_list_mode,
        'shop_list' => $shop_list,
        'cryptcio_number_cate' => esc_js($cryptcio_number_cate),
        'cryptcio_woo_enable'=> esc_js($cryptcio_woo_enable),
        'cryptcio_fancybox_enable' => esc_js($cryptcio_fancybox_enable),
        'cryptcio_slick_enable' => esc_js($cryptcio_slick_enable),
        'cryptcio_valid_form' => esc_js($cryptcio_valid_form),
        'cryptcio_animation' => esc_js($cryptcio_animation),
        'cryptcio_rtl' => esc_js($cryptcio_rtl),
        'cryptcio_search_no_result' => esc_js(__('Search no result','cryptcio')),
        'cryptcio_coming_subcribe_text' => esc_js($cryptcio_coming_subcribe_text),
        'cryptcio_like_text' => esc_js(__('Like','cryptcio')),
        'cryptcio_unlike_text' => esc_js(__('Unlike','cryptcio')),
        'cryptcio_coming_subcribe_text' => esc_js($cryptcio_coming_subcribe_text),
        'header_sticky' => esc_js(isset($cryptcio_settings['header-sticky'])?$cryptcio_settings['header-sticky']:''),
        'header_sticky_mobile' => esc_js($header_sticky_mobile),
        'request_error' => esc_js(__('The requested content cannot be loaded.<br/>Please try again later.', 'cryptcio')),
        'popup_close' => esc_js(__('Close', 'cryptcio')),
        'popup_prev' => esc_js(__('Previous', 'cryptcio')),
        'popup_next' => esc_js(__('Next', 'cryptcio')),
    ));

}
add_action('wp_enqueue_scripts', 'cryptcio_scripts_js');
function cryptcio_override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
} 
add_filter('tiny_mce_before_init', 'cryptcio_override_mce_options');