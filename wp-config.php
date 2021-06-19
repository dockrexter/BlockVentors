<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'texus' );

/** MySQL database password */
define( 'DB_PASSWORD', 'texus@2323' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '5JR^r<Quh-fYQ%bq)RTiUL3hm5ZRT`:<7>E*DgZJ`^VjwV->?zIle$nt/*<7#h=m' );
define( 'SECURE_AUTH_KEY',  'mYVzo~d?Y:[9}_/uDjxM&Z$Wi6nRBBn`%sq<U?qljo/_JKU-lG4{)gR9`yEu)$t@' );
define( 'LOGGED_IN_KEY',    'O`FISsbgbTxyFF?>),d64emG}GpMzku|E+/#lg%TP,B]{7]~hIp;LDsv?frKE[]D' );
define( 'NONCE_KEY',        'RvgnuhQ-t=&)cvNfREd&:zL3w[XCT#8n@ ):%vc-s1!:+Lmn#51J_`nJUBXxjkD>' );
define( 'AUTH_SALT',        'tLeE|b#8=$E<L],cF[Yj/~yYvb!NIEYtAY^L;suvwZB6~&?HYO7U?HyOm5sqTMS)' );
define( 'SECURE_AUTH_SALT', '>VMhSoa;Q5NRno4-v[njqGx%#gs>|o#(36/XKwJ,zk[p}!&}[5hYXy(u~iP$4G#j' );
define( 'LOGGED_IN_SALT',   '1#Bt*z1D1N%B~Y@>$`KFEda!/(Sc=U)gd<*,ObdJxZQm{8{qM<5NAC.qLCx>D-VW' );
define( 'NONCE_SALT',       '7dkK?=#xPF^#-/&JFb4- KwS!(NzkRSu*%DjD[j,@x`Y-6JiAIBl;3}s`{{/|iO}' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
