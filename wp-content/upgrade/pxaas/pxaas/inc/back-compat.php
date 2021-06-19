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
 * PXaas back compat functionality
 *
 * Prevents PXaas from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 */

/**
 * Prevent switching to PXaas on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since PXaas 1.0
 */
function pxaas_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'pxaas_upgrade_notice' );
}
add_action( 'after_switch_theme', 'pxaas_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * PXaas on WordPress versions prior to 4.7.
 *
 * @since PXaas 1.0
 *
 * @global string $wp_version WordPress version.
 */
function pxaas_upgrade_notice() {
	$message = sprintf( esc_html__( 'PXaas requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'pxaas' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since PXaas 1.0
 *
 * @global string $wp_version WordPress version.
 */
function pxaas_customize() {
	wp_die( sprintf( esc_html__( 'PXaas requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'pxaas' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'pxaas_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since PXaas 1.0
 *
 * @global string $wp_version WordPress version.
 */
function pxaas_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_html__( 'PXaas requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'pxaas' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'pxaas_preview' );
