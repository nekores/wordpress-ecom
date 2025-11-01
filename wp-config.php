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
define( 'DB_NAME', 'ecomdb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'Sy;2Rr6&Zp5T:,zv+UUtC[Rk=>-g ^@6hl.6o_ {OEKHgnVb~sT]4(T/9 YAqLCb' );
define( 'SECURE_AUTH_KEY',  'rn;u5O 9&.yjdXa9U`pRu&k7.W@3,MWH@ou/d{Hsnm>&l}NEXdP)Yh4}[P}>h2$z' );
define( 'LOGGED_IN_KEY',    '~>LsG*U8v$L|8FX`%D/WE/Rn(i3$E 9G`_S,}kqhrRHKD-V~=4warEX!~/D@7z.C' );
define( 'NONCE_KEY',        'x|+&OLy;{CSD*`FmIhV[sGT?fI|[N<;:|j2S.Yi<I2]h14 _[xKLDa{cw6oMgIv<' );
define( 'AUTH_SALT',        '*S[eM248cV3GjcV)AIH?N&t}g/3>o.M=./}2FNXEsyp1s7hj7JjcYYEXgGBmi0XS' );
define( 'SECURE_AUTH_SALT', 'l@J%n7n{+J1j;^E*aZd{AFEpv%6@Z;$$YNIOLVify&B>s!/vp0T)uR YVcU4)UP~' );
define( 'LOGGED_IN_SALT',   '_8(1moJzq44E>fqf4W%yXkL<kWTE}riUsT}~Nc EyN77nmQ!HC_-JE`pWqw> 6Ma' );
define( 'NONCE_SALT',       '5%BpstSHVzc*x~o<d_~s675V6Dd-^Z-3XA3#|2mCdJmp<j6Kk{[gJ!2FWfo!sp()' );

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
