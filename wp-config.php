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
define( 'DB_NAME', 'wordpress_mi_plugin' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '7Ae~&89TdG$IE@i6FX!01z<:#2p9y9wuiK;IaW_EuIV(ng&@k:d)b=^mZzSZ}:D`' );
define( 'SECURE_AUTH_KEY',  '5_q?e^1sB?ZxR *%kq-I?qW]4vpAL9ELLfNu&&zM*Cucp|FO4y4jf>rJvU!N8r%S' );
define( 'LOGGED_IN_KEY',    'orZ=b D-6@rjJ.]{mU:vc>)#>-/rW@;~dfd]*3:rj^63E.%!C|.g`ccuEF>%0,,I' );
define( 'NONCE_KEY',        'm;qB9mGLN@jXxre?z6rZ7XZVN^MA5g9kY0E]L 0=kM4^j``$NZq1{yd-K,+4H]>c' );
define( 'AUTH_SALT',        'tS+5{CGz]y^3`9Rh!s7,BeaB&J70ZFpF=.eh]-pP[_eh)9[8:ebaqwSmznpL tSq' );
define( 'SECURE_AUTH_SALT', 'YHJ3r)+hlqbL5A[chQf8hY:WH`ksWj=*vZb3IYW7[2K;D7xL+7S~^OFBcps}r^9R' );
define( 'LOGGED_IN_SALT',   'Q:C&Ui4QK^sGmFsq]5OUq KW6o$#zl t-&b!3@O|^fBR:L(L19<FLyp{7E|XX].]' );
define( 'NONCE_SALT',       'BD]-+].5JQVVcd^rqL?P2=/0u#TTwKYW` PT4LG=]*=WieA~Mi{%dAJRc9gjaV!L' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_mp_';

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
define('FS_METHOD','direct');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
