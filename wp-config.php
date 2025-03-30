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
define( 'DB_NAME', 'arun_wordpressclass' );

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
define( 'AUTH_KEY',         'WmsyqI=+,E9?>&Z*(jXQ2-+oZYDR;U#Mh~dDvN34D/mNrT#V9<-V49P)MAivm0,9' );
define( 'SECURE_AUTH_KEY',  'tZ(9z#bNe}<8]QC Oz]/^Qda>ux8z)eOH2V$Q(_v#tOD])kOdg2knTZEK^a4 5[o' );
define( 'LOGGED_IN_KEY',    'APEtn[gGU#`BJ%JH|44uf1>v/p`R]u_Jn#/F6JNJU@!bbpgGGE-6Jgb{p!U!s<M5' );
define( 'NONCE_KEY',        'AMA%zdh5ghe@7W?0-v.-5.dB5..~f#)SH;9&+lKIc{*H-m!I4_<vUIVHhX$ xr2M' );
define( 'AUTH_SALT',        'pjxgy@l:2%@ukU)?C6mufbOtm991/]*i~q;)Vt,enhJ.@SmsPQvQE^jGpxql(&2`' );
define( 'SECURE_AUTH_SALT', '&Q0V**45[>&NNFWt/c>T6{8Sx}UR@~(SG6r;~31jKIMk:zW4HdH1y&3bENooCJ_&' );
define( 'LOGGED_IN_SALT',   '81hAK[IgDh)G6J&r(Ci.1;I*RN/=K-NBa-WCaL: !x^19USSjPx$01~c WSp&REF' );
define( 'NONCE_SALT',       '&:b,^-Vy|7K:eZJ^<2`&2c**0XC}$b)EZh8N0,p;zelT|aVQ=?@K<?%l<C)~n@PX' );

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
