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
 * PXaas functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */


/**
 * PXaas only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

// delete_option( 'pxaas_options' );

if(!isset($pxaas_options)) $pxaas_options = get_option( 'pxaas_options', array() );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pxaas_setup() {
    
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'pxaas' , get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	pxaas_get_thumbnail_sizes();

	// Set the default content width.
	$GLOBALS['content_width'] = 730;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
        'top'    => esc_html__( 'Top Menu', 'pxaas' ),
		'top-landing'    => esc_html__( 'Landing Page - Top Menu', 'pxaas' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 162,
		'height'      => 34,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),

	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', pxaas_fonts_url() ) );

}
add_action( 'after_setup_theme', 'pxaas_setup' );

if(!function_exists('pxaas_get_thumbnail_sizes')){
    function pxaas_get_thumbnail_sizes(){
    	// options default must have these values
    	if(!pxaas_get_option('enable_custom_sizes')) return;
        $option_sizes = array(
        	'pxaas-fullscreen'=>'thumb_size_opt_1',
        	'pxaas-folio-carousel'=>'thumb_size_opt_2',
        	'pxaas-folio-list'=>'thumb_size_opt_3',
        	'pxaas-folio-one'=>'thumb_size_opt_4',
        	'pxaas-folio-second'=>'thumb_size_opt_5',
        	'pxaas-folio-three'=>'thumb_size_opt_6',
        	'pxaas_member_thumb'=>'thumb_size_opt_7',
        	'pxaas-service-thumb'=>'thumb_size_opt_8',
        	'pxaas-featured-image'=>'thumb_size_opt_9',
        	'pxaas-single-image'=>'thumb_size_opt_10',
        	'pxaas-landing-image'=>'thumb_size_opt_11',
            'pxaas-section-post-image'=>'thumb_size_opt_12'
        );

       	foreach ($option_sizes as $name => $opt) {
       		$option_size = pxaas_get_option($opt);
       		if($option_size !== false && is_array($option_size)){
       			$size_val = array(
       				'width' => (isset($option_size['width']) && !empty($option_size['width']) )? (int)$option_size['width'] : (int)'9999',
       				'height' => (isset($option_size['height']) && !empty($option_size['height']) )? (int)$option_size['height'] : (int)'9999',
       				'hard_crop' => (isset($option_size['hard_crop']) && !empty($option_size['hard_crop']) )? (bool)$option_size['hard_crop'] : (bool)'0',
       			);

       			add_image_size( $name, $size_val['width'], $size_val['height'], $size_val['hard_crop'] );
       		}
       	}
    }
}
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pxaas_content_width() {

	$content_width = $GLOBALS['content_width'];


	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 806;
	}

	/**
	 * Filter PXaas content width of the theme.
	 *
	 * @since PXaas 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'pxaas_content_width', $content_width );
}
add_action( 'template_redirect', 'pxaas_content_width', 0 );



/**
 * Add preconnect for Google Fonts.
 *
 * @since PXaas 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function pxaas_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'pxaas-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => '//fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'pxaas_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pxaas_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'pxaas' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'pxaas' ),
		'before_widget' => '<div id="%1$s" class="box-widget-item fl-wrap pxaas-mainsidebar-widget main-sidebar-widget %2$s">', 
        'before_title' => '<div class="box-widget-item-header"><h2 class="widget-title">', 
        'after_title' => '</h2></div>',
        'after_widget' => '</div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'pxaas' ),
		'id'            => 'sidebar-2',
		'description' => esc_html__('Appears in the sidebar section of the page template.', 'pxaas'), 
        'before_widget' => '<div id="%1$s" class="box-widget-item fl-wrap pxaas-pagesidebar-widget page-sidebar-widget %2$s">', 
        'before_title' => '<div class="box-widget-item-header"><h2 class="widget-title">', 
        'after_title' => '</h2></div>',
        'after_widget' => '</div>',
	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Shop Sidebar', 'pxaas' ),
        'id'            => 'sidebar-3',
        'description' => esc_html__('Appears in the sidebar section of woo shop.', 'pxaas'), 
        'before_widget' => '<div id="%1$s" class="box-widget-item fl-wrap pxaas-shopsidebar-widget shop-sidebar-widget %2$s">', 
        'before_title' => '<div class="box-widget-item-header"><h2 class="widget-title">', 
        'after_title' => '</h2></div>',
        'after_widget' => '</div>',
    ) );

	$footer_widgets = pxaas_get_option('footer_widgets',array());
	if ($footer_widgets) {
        foreach ($footer_widgets as  $widget) {
            if($widget['title']&&$widget['classes']){
                register_sidebar(
                    array(
                        'name' => $widget['title'], 
                        'id' => $widget['widid'],
                        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">', 
                        'after_widget' => '</div>', 
                        'before_title' => '<h2 class="widget-title">', 
                        'after_title' => '</h2>',
                    )
                );
            }
        }
    }
    $footer_widgets = pxaas_get_option('footer_widgets_bottom',array());
    if ($footer_widgets) {
        foreach ($footer_widgets as  $widget) {
            if($widget['title']&&$widget['classes']){
                register_sidebar(
                    array(
                        'name' => $widget['title'], 
                        'id' => $widget['widid'], 
                        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">', 
                        'after_widget' => '</div>', 
                        'before_title' => '<h2 class="widgets-titles">', 
                        'after_title' => '</h2>',
                    )
                );
            }
        }
    }



}
add_action( 'widgets_init', 'pxaas_widgets_init' );

function pxaas_widget_title_callback($title){
    $title = preg_replace('/-decor-/', '<span class="wt-decor"><span></span></span>', $title );

    return $title;
}
add_filter('widget_title', 'pxaas_widget_title_callback' );


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since PXaas 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function pxaas_excerpt_more( $link ) {
	
	return ' &hellip; ';
}
add_filter( 'excerpt_more', 'pxaas_excerpt_more' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function pxaas_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'pxaas_pingback_header' );


/**
 * Register custom fonts.
 */
function pxaas_fonts_url() {
	$fonts_url = '';
    $font_families     = array();
    if ( 'off' !== esc_html_x( 'on', 'Fira Sans font: on or off', 'pxaas' ) ) {
        $font_families[] = 'Fira+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=vietnamese';
    }

    if ( 'off' !== esc_html_x( 'on', 'Lato font: on or off', 'pxaas' ) ) {
        $font_families[] = 'Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
    }

    if ( $font_families ) {
    	$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'cyrillic,cyrillic-ext,latin-ext,vietnamese' ),
		);

        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );

}

/**
 * Enqueue scripts and styles.
 */
function pxaas_scripts() {
	// Add custom fonts, used in the main stylesheet.
    
    wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/assets/css/vendor/font-awesome.min.css' ), array(  ), null );
	wp_enqueue_style( 'pxaas-fonts', pxaas_fonts_url(), array(), null );
    wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/assets/css/vendor/owl.carousel.min.css' ), array(  ), null );
    wp_enqueue_style( 'owl-theme-default', get_theme_file_uri( '/assets/css/vendor/owl.theme.default.min.css' ), array(  ), null );
    wp_enqueue_style( 'swiper', get_theme_file_uri( '/assets/css/vendor/swiper.min.css' ), array(  ), null );
    wp_enqueue_style( 'animate', get_theme_file_uri( '/assets/css/vendor/animate.css' ), array(  ), null );
    wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/vendor/bootstrap.min.css' ), array(  ), null );
    wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/assets/css/vendor/magnific-popup.css' ), array(  ), null );

    // Theme stylesheet.
    wp_enqueue_style( 'pxaas-style', get_stylesheet_uri(), array( 'font-awesome', 'pxaas-fonts', 'owl-carousel', 'owl-theme-default', 'swiper', 'animate', 'bootstrap' , 'magnific-popup'), null );
    
    wp_enqueue_style( 'pxaas-color', get_theme_file_uri( '/assets/css/color.css' ), array(  ), null );
    
    if(pxaas_get_option('use_custom_color', false) && pxaas_get_option('theme-color') != '#e38612'){
        wp_add_inline_style( 'pxaas-color', pxaas_overridestyle() );
    }


	
    wp_enqueue_script( 'popper', get_theme_file_uri( '/assets/js/vendor/popper.min.js' ), array( 'jquery' ), null, true );
    wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/js/vendor/bootstrap.min.js' ), array(  ), null, true );
    wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/assets/js/vendor/owl.carousel.min.js' ), array(  ), null, true );
    wp_enqueue_script( 'swiper', get_theme_file_uri( '/assets/js/vendor/swiper.min.js' ), array(  ), null, true );
    wp_enqueue_script( 'wow', get_theme_file_uri( '/assets/js/vendor/wow.min.js' ), array(  ), null, true );
    wp_enqueue_script( 'magnific-popup', get_theme_file_uri( '/assets/js/vendor/jquery.magnific-popup.js' ), array(  ), null, true );
    wp_enqueue_script( 'singlepagenav', get_theme_file_uri( '/assets/js/vendor/jquery.singlePageNav.min.js' ), array(  ), null , true );
    wp_enqueue_script( 'pxaas-scripts', get_theme_file_uri( '/assets/js/scripts.js' ), array( ), null , true );
    


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pxaas_scripts');


add_filter('body_class', function($classes){
    $classes[] = 'pxaas-body';
    return $classes;
});
/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/include-kirki.php' );
require get_parent_theme_file_path( '/inc/cththemes-kirki.php' );
require get_parent_theme_file_path( '/inc/kirki-customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );
require get_parent_theme_file_path( '/inc/color-pattern.php' );

/**
 * Implement the One Click Demo Import plugin
 *
 * @since PXaas 1.0
 */
require_once get_parent_theme_file_path( '/inc/one-click-import-data.php' );


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_parent_theme_file_path( '/lib/class-tgm-plugin-activation.php' );

add_action('tgmpa_register', 'pxaas_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function pxaas_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' => esc_html__('Elementor Page Builder','pxaas'),
             // The plugin name.
            'slug' => 'elementor',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(pxaas_relative_protocol_url().'://wordpress.org/plugins/elementor/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'elementor_load_plugin_textdomain',
            'class_to_check'            => '\Elementor\Plugin'
        ), 

        array(
            'name' => esc_html__('Contact Form 7','pxaas'),
             // The plugin name.
            'slug' => 'contact-form-7',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(pxaas_relative_protocol_url().'://wordpress.org/plugins/contact-form-7/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'wpcf7',
            'class_to_check'            => 'WPCF7'
        ), 

        array(
            'name' => esc_html__('CMB2','pxaas'),
             // The plugin name.
            'slug' => 'cmb2',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(pxaas_relative_protocol_url().'://wordpress.org/support/plugin/cmb2'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'cmb2_bootstrap',
            'class_to_check'            => 'CMB2_Base'
        ),

        array(
            'name' => esc_html__('Kirki','pxaas'),
             // The plugin name.
            'slug' => 'kirki',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(pxaas_relative_protocol_url().'://wordpress.org/plugins/kirki/'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => '',
            'class_to_check'            => 'Kirki'
        ),

        array(
            'name' => esc_html__('PXaas Add-Ons','pxaas' ),
             // The plugin name.
            'slug' => 'pxaas-add-ons',
             // The plugin slug (typically the folder name).
            'source' => 'pxaas-add-ons.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            // 'force_activation' => true,

            'function_to_check'         => '',
            'class_to_check'            => 'PXaas_Addons'
        ), 

        array(
            'name' => esc_html__('Loco Translate','pxaas'),
             // The plugin name.
            'slug' => 'loco-translate',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(pxaas_relative_protocol_url().'://wordpress.org/plugins/loco-translate/'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'loco_autoload',
            'class_to_check'            => 'Loco_Locale'
        ),

        
        array(
            'name' => esc_html__('Envato Market','pxaas' ),
             // The plugin name.
            'slug' => 'envato-market',
             // The plugin slug (typically the folder name).
            'source' => esc_url(pxaas_relative_protocol_url().'://envato.github.io/wp-envato-market/dist/envato-market.zip' ),
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(pxaas_relative_protocol_url().'://envato.github.io/wp-envato-market/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'envato_market',
            'class_to_check'            => 'Envato_Market'
        ),

        array('name' => esc_html__('One Click Demo Import','pxaas'),
             // The plugin name.
            'slug' => 'one-click-demo-import',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(pxaas_relative_protocol_url().'://wordpress.org/plugins/one-click-demo-import/'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => '',
            'class_to_check'            => 'OCDI_Plugin'
        ),

        array('name' => esc_html__('Regenerate Thumbnails','pxaas'),
             // The plugin name.
            'slug' => 'regenerate-thumbnails',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(pxaas_relative_protocol_url().'://wordpress.org/plugins/regenerate-thumbnails/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'RegenerateThumbnails',
            'class_to_check'            => 'RegenerateThumbnails'
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'pxaas',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => get_template_directory() . '/lib/plugins/',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

        
    );

    tgmpa( $plugins, $config );
}


