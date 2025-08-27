<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'renewer' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'o{,MYpZx(CKj)dhU)v5;oE}Uj&Ivq(w|WkPD389c.90~*z&#V)N}a=ZF)@uR6O~T' );
define( 'SECURE_AUTH_KEY',  'V,r^oRIK(M)k4kh5?z%[4AYj8O,!r[HzL>-%{eR!ScQTH~,j8ie^Vj=YI3Cszb/U' );
define( 'LOGGED_IN_KEY',    '%; b`c0yzZUZgZKA#V50g3v>e:l}&IZzBN|KJhnK`9o/[ wwSA{mx$d-D~[SX/G?' );
define( 'NONCE_KEY',        'sVKHLTJQAF~<q RyXz4ZXFEykkK@Qg,&f6d@N6*lNB+{tuvqa5$rk_eAgx,hT`}f' );
define( 'AUTH_SALT',        '!(FF=Z4-1o?(=E3hp,IOkqAZ5-2dRR3z|[3Rt9Y~9CD&(HM:>=0uS1C6I:d-MX&i' );
define( 'SECURE_AUTH_SALT', ' ;Od{=T!%P6:IPU;8LPenI3jKY?H*67wWJ,:xeo]DBB7GWo/;L|AUf+w}Kes=@]x' );
define( 'LOGGED_IN_SALT',   'GYVSJHa8gc-2WbtX~wx[cL:-ZF}[Sf`54VX55Zjb0 L7,ig3D2y<W`VDMDWcJy2T' );
define( 'NONCE_SALT',       '.@v(&<Xm0C=6/y#{,XW]^Wd frR<gX+w77gM0SF&in-ZOBY/,=`h=K|7U72{?+Q6' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
