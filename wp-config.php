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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'k>nxu7ne.29H*{aJU{c?eOmq$V}N>Q]]W/ a`c$ej!We  ZIzh`&hW?euEE]t5Kx' );
define( 'SECURE_AUTH_KEY',  '#,8g0r&1x?|TKi66*.omY:A${:tGKcEA$fB&:l[ZO9?-]oQJcbbnARt=>]UKn7V2' );
define( 'LOGGED_IN_KEY',    'HU2Z yc8TB=Y579?&K$m|@9C,QzDNWlfsOK>p}JR1ODStp0})f!^br,B3nikI}r#' );
define( 'NONCE_KEY',        'q)8/GpL:O1m{%J@dC96yMobJZi%*(I4u[UszUCpv1E>q>>doc7EvQ*40+Ni6rNTa' );
define( 'AUTH_SALT',        '?h];9ZuL+r[Nlu#0/nnadZ9rz^ +-YE^2iCfqJd}4~wqQo{2@~Y9bY<&,SX#I6fF' );
define( 'SECURE_AUTH_SALT', 'ooT90b|98+:M-P0g2@[qY!wqN~S))L0r28;8OrHw8Iii:G,E$5)N-Jr*Zl<F>5D4' );
define( 'LOGGED_IN_SALT',   '1T(#.E(z=xHro{z2 EZzxt!@0Ri}lpc{/VkR5k+D!$[tz_I3R3`9AW0:fV@pipFj' );
define( 'NONCE_SALT',       'i{_SewNwe<^uFj@=s!{_Z7Isrw@rHN2+ZQ{y,PJwu1-,CZg-~ )ACwuVTckSUxc6' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
