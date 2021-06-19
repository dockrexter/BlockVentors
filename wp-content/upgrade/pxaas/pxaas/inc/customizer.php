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
 * PXaas: Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pxaas_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'pxaas_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'pxaas_customize_partial_blogdescription',
	) );

	/**
	 * Footer options.
	 */
// 	$wp_customize->add_section( 'header_options', array(
// 		'title'    => __( 'Header Options', 'pxaas' ),
// 		'priority' => 10, // Before Additional CSS.
// 	) );

// 	$wp_customize->add_setting( 'header_info', array(
// 		'default'           => '<ul>
//     <li><a href="#"> <span>Call :</span> +7(111)123456789</a></li>
//     <li><a href="#"> <span>Write :</span> yourmail@domain.com</a></li>
// </ul>',
// 		'type'       		=> 'option', //Is this an 'option' or a 'theme_mod'?
// 		'transport'         => 'postMessage',//refresh postMessage
// 	) );

// 	$wp_customize->add_control( 'header_info', array(
// 		'label'       => __( 'Header Contacts Info', 'pxaas' ),
// 		'section'     => 'header_options',
// 		'type'        => 'textarea',
// 		'description' => __( 'Enter header contacts info for your site. Notice: only visible on large screen.', 'pxaas' ),
// 	) );

// 	$wp_customize->selective_refresh->add_partial( 'header_info', array(
// 		'selector' => '.pxaas-header .header-contacts',
// 		'render_callback' => 'pxaas_customize_partial_header_info',
// 	) );

	/**
	 * Custom colors.
	 */
	$wp_customize->add_setting( 'colorscheme', array(
		'default'           => 'light',
		'transport'         => 'postMessage',
		'type'       		=> 'option', //Is this an 'option' or a 'theme_mod'?
		'sanitize_callback' => 'pxaas_sanitize_colorscheme',
	) );

	$wp_customize->add_setting( 'colorscheme_hue', array(
		'default'           => 250,
		'type'       		=> 'option', //Is this an 'option' or a 'theme_mod'?
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint', // The hue is stored as a positive integer.
	) );

	$wp_customize->add_control( 'colorscheme', array(
		'type'    => 'radio',
		'label'    => __( 'Color Scheme', 'pxaas' ),
		'choices'  => array(
			'light'  => __( 'Light', 'pxaas' ),
			'dark'   => __( 'Dark', 'pxaas' ),
			'custom' => __( 'Custom', 'pxaas' ),
		),
		'section'  => 'colors',
		'priority' => 5,
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colorscheme_hue', array(
		'mode' => 'hue',
		'section'  => 'colors',
		'priority' => 6,
	) ) );

	/**
	 * Theme options.
	 */
	$wp_customize->add_section( 'theme_options', array(
		'title'    => __( 'Theme Options', 'pxaas' ),
		'priority' => 130, // Before Additional CSS.
	) );

	$wp_customize->add_setting( 'page_layout', array(
		'default'           => 'two-column',
		'sanitize_callback' => 'pxaas_sanitize_page_layout',
		'type'       		=> 'option', //Is this an 'option' or a 'theme_mod'?
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'page_layout', array(
		'label'       => __( 'Page Layout', 'pxaas' ),
		'section'     => 'theme_options',
		'type'        => 'radio',
		'description' => __( 'When the two-column layout is assigned, the page title is in one column and content is in the other.', 'pxaas' ),
		'choices'     => array(
			'one-column' => __( 'One Column', 'pxaas' ),
			'two-column' => __( 'Two Column', 'pxaas' ),
		),
		'active_callback' => 'pxaas_is_view_with_layout_option',
	) );

	/**
	 * Footer options.
	 */
	// $wp_customize->add_section( 'footer_options', array(
	// 	'title'    => __( 'Footer Options', 'pxaas' ),
	// 	'priority' => 130, // Before Additional CSS.
	// ) );

	// $wp_customize->add_setting( 'footer_copyright', array(
	// 	'default'           => '<span class="ft-copy">&#169; PXaas 2017  /  All rights reserved. </span>',
	// 	'type'       		=> 'option', //Is this an 'option' or a 'theme_mod'?
	// 	'transport'         => 'postMessage',//refresh postMessage
	// ) );

	// $wp_customize->add_control( 'footer_copyright', array(
	// 	'label'       => __( 'Copyright Text', 'pxaas' ),
	// 	'section'     => 'footer_options',
	// 	'type'        => 'textarea',
	// 	'description' => __( 'Enter footer copyright text for your site.', 'pxaas' ),
	// 	//'active_callback' => 'pxaas_is_view_with_layout_option',
	// ) );

	// $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
	// 	'selector' => '.pxaas-footer .policy-box',
	// 	'render_callback' => 'pxaas_customize_partial_footer_copyright',
	// ) );

	

// 	$wp_customize->add_setting( 'footer_socials', array(
// 		'default'           => '<ul>
//     <li><a href="#" target="_blank" ><i class="fa fa-facebook"></i><span>facebook</span></a></li>
//     <li><a href="#" target="_blank"><i class="fa fa-twitter"></i><span>twitter</span></a></li>
//     <li><a href="#" target="_blank" ><i class="fa fa-instagram"></i><span>instagram</span></a></li>
//     <li><a href="#" target="_blank" ><i class="fa fa-pinterest"></i><span>pinterest</span></a></li>
//     <li><a href="#" target="_blank" ><i class="fa fa-tumblr"></i><span>tumblr</span></a></li>
// </ul>',
		
// 		'transport'         => 'postMessage',//refresh postMessage
// 	) );

// 	$wp_customize->add_control( 'footer_socials', array(
// 		'label'       => __( 'Socials', 'pxaas' ),
// 		'section'     => 'footer_options',
// 		'type'        => 'textarea',
// 		'description' => __( 'Enter footer socials text for your site.', 'pxaas' ),
// 		//'active_callback' => 'pxaas_is_view_with_layout_option',
// 	) );

// 	$wp_customize->selective_refresh->add_partial( 'footer_socials', array(
// 		'selector' => '.pxaas-footer .footer-social',
// 		'render_callback' => 'pxaas_customize_partial_footer_socials',
// 	) );

	/**
	 * Filter number of front page sections in PXaas.
	 *
	 * @since PXaas 1.0
	 *
	 * @param int $num_sections Number of front page sections.
	 */
	$num_sections = apply_filters( 'pxaas_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'absint',
			'type'       		=> 'option', //Is this an 'option' or a 'theme_mod'?
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'pxaas' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'pxaas' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'pxaas_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'pxaas_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
//add_action( 'customize_register', 'pxaas_customize_register' );

/**
 * Sanitize the page layout options.
 *
 * @param string $input Page layout.
 */
function pxaas_sanitize_page_layout( $input ) {
	$valid = array(
		'one-column' => __( 'One Column', 'pxaas' ),
		'two-column' => __( 'Two Column', 'pxaas' ),
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/**
 * Sanitize the colorscheme.
 *
 * @param string $input Color scheme.
 */
function pxaas_sanitize_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'custom' );

	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'light';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since PXaas 1.0
 * @see pxaas_customize_register()
 *
 * @return void
 */
function pxaas_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since PXaas 1.0
 * @see pxaas_customize_register()
 *
 * @return void
 */
function pxaas_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the site footer copyright for the selective refresh partial.
 *
 * @since PXaas 1.0
 * @see pxaas_customize_register()
 *
 * @return void
 */
function pxaas_customize_partial_footer_copyright() {
	echo pxaas_get_option( 'footer_copyright' );
}

/**
 * Render the site footer socials for the selective refresh partial.
 *
 * @since PXaas 1.0
 * @see pxaas_customize_register()
 *
 * @return void
 */
function pxaas_customize_partial_footer_socials() {
	echo pxaas_get_option( 'footer_socials' );
}

/**
 * Render the site header infos for the selective refresh partial.
 *
 * @since PXaas 1.0
 * @see pxaas_customize_register()
 *
 * @return void
 */
function pxaas_customize_partial_header_info() {
	echo pxaas_get_option( 'header_info' );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 */
function pxaas_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function pxaas_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function pxaas_customize_preview_js() {
	wp_enqueue_script( 'pxaas-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'pxaas_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function pxaas_panels_js() {
	wp_enqueue_script( 'pxaas-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'pxaas_panels_js' );
