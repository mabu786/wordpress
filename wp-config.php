<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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
define( 'DB_NAME', 'wphippo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '!V<6IQ4.h^rPN)K,swK[DVX@-ZR.P[)XN|M/P$hN6p<@|C@v} Xc6Tzq/;(DZ[XS' );
define( 'SECURE_AUTH_KEY',  '7|/J*H1/@m^u.i[-7~E#cw~=PD>h&db5~!R;[ZP]Mp}+[~W&,9Aj|4*N+H!N@llc' );
define( 'LOGGED_IN_KEY',    'M4_RT#M/hR~PIjD:J75WC6at$#%DAG]qyey_@<KnIdrKQ4QelSt.?b:B@RT%~<+p' );
define( 'NONCE_KEY',        '4uDE%}_|qQ`H_/R0Y71D?<}um1Ta,0CNn(ph^wc<:sPhIw8g! JDsNjFkTY,kRA^' );
define( 'AUTH_SALT',        '`$<nO,KS^GVC&RW1X8r[fc@[I>1!]qk:;NM^<7TaeVk#[EjJN(<1:uQGl5yY{*):' );
define( 'SECURE_AUTH_SALT', 'qNI/Leul_hR&@&1*3#5n}|~0c=HJr6#eb.rD?W%R/)W~])I.SfPzKLsp|3TrR*9M' );
define( 'LOGGED_IN_SALT',   'v(Z&*FcmD+e(F?]Ie#[6C(,~pOg^L->[41NS_5zxdak)eCc8g%.*dHO=4ukj.!1U' );
define( 'NONCE_SALT',       '-j<K[.q6y(^n.|B>)KD5SIzCsHN/3,j`{3%rQ;utrRN|%zq[C@&I&s%N*-Riqn/b' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
