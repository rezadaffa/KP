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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'y$eF^zP8.XFvp/pvW85p!ZhW^U3%x<IYDQi18Dn8U[U<qs:WGVr||RQ-Dj[I0)wF');
define('SECURE_AUTH_KEY',  'Fw<>_*MKv{ZL,l1zEBuTsd5C|zq0z(J&K(>CF$Souh ^,Ela3tDdnBQJv=l#<~}6');
define('LOGGED_IN_KEY',    '3zO$#HUh1F 7;&$.t5b|I(*m{>z}5xY2<e[>P#&;8YrcqqmtKln3v=(}DzWXY@8[');
define('NONCE_KEY',        '+3d3M<|z8N0j9=;`cM(eSIvR%~H&WH#M[Y(n1neY+D-$;BnPc~%kVi3On <~w$lH');
define('AUTH_SALT',        'IQ [].qw;A-;A}]i`F`;^/%fovD1gXi KML|2t*%oV=>{3Y*t++0:QsMGk@77.N;');
define('SECURE_AUTH_SALT', '{yQG&dcmaw?UR-rdARg&bynH5Z5Nx8Rk(u^xLIT<2E/LvA-.S,@|QVwsWM6BAuiG');
define('LOGGED_IN_SALT',   '50tZ[dmxp+Y*5x.$+;Fs0_]XH t4Aw9s+cjgSo>?==K.8)S!tOWP$!aQhP,#+2Vi');
define('NONCE_SALT',       'L9j#rT6~LQr98 CsE+n_jRf$FEtIL[S!l PYS~tlr~if9x|E0,q!sm{e%Zy$/itt');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
