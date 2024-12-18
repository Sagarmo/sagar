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
define( 'DB_NAME', 'ascent' );

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

define( 'FS_METHOD', 'direct' );

define( 'WP_MEMORY_LIMIT', '1024M' );

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

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
define( 'AUTH_KEY',         'Mg>LCQeXnXr[jEIy?B?(W5tlb#n;@}&>ofJy95oql=+8f#$&Q]dL)/bp70U.l%h_' );
define( 'SECURE_AUTH_KEY',  '@|h0!To1[Jn c.$<ry`SP{ein3^4$A/dC#(DvHu>#Guict;`YD/ /[6BiM)|2oR-' );
define( 'LOGGED_IN_KEY',    'JcB)]#LTIj;m_[ 2R@JpID4c{v`w9zYsArX*C7,zw$35Hh|}9kTr~}.6>q)dV;6*' );
define( 'NONCE_KEY',        '~/+#%t_##Ub2qAgWpfzdiw]bEiAZ<nCzevM1]lRatv6@RFvI$~+(tH#}/1Sr-*E<' );
define( 'AUTH_SALT',        '%e(|Gc]f]Ujm)UaFpXMBTFVsQ748 7M;{^3.D(U@^clmKSbgq7@S^=1|hB{PA`bo' );
define( 'SECURE_AUTH_SALT', 'w2.0{@dE=-X,Bl<~07pD4Brnj[-.I`9>3?1Znr{%*54RZ0>h%r`Kv+.%PI~tb:^O' );
define( 'LOGGED_IN_SALT',   'BUB7jzHW+S{dAgivh,{SUEC}m+c#8moa*xayNPirbt7iGV]@c-aRpy^e{IA/S>EQ' );
define( 'NONCE_SALT',       'Qm1thE/v{5i,jp~F=zkW-QOQl Qcunzf akRIs00{Aus2M%q4-OZNHzk42#r45j>' );

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
