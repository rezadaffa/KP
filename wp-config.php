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
define('DB_NAME', 'wordpress3');

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
define('AUTH_KEY',         'L^9b%|R,_zUV@q!_qO>.H(;(|[RQBL[jk:2N&<AMMvqJ;7Dh eNIgu8cs>FQko~N');
define('SECURE_AUTH_KEY',  '_Vr|c)D^z:G(4XE*j]-5;txn0R/39:d;O;ahIZx[%WT^K]rU!]b:x=$B /YJgyYy');
define('LOGGED_IN_KEY',    '5Us3O>ORFAVOu@p(B{Pcx{nJbHgG~j=x{{u^,:mUNe_wqhl`bM&Xh$99c3Hs-#Sj');
define('NONCE_KEY',        'sIKNUIW{c.<8$TIrnW5kGdV_FFQ[>(twl07F5V5;TTZ?jiwP}.V|5owj-+mq1JXp');
define('AUTH_SALT',        '2dWhQ_I<v7~ZS<*#$yr}ZpD0u~JdL^k2YfANmHJZ[=TAU`C[!6;SQ.k?II_2fP$;');
define('SECURE_AUTH_SALT', 'h/<Va[8zbHO-(p*b.4bB>08@Abp8O`^Yp3:qF;; [.3WksY)!ICqjP[QM*3n%^BU');
define('LOGGED_IN_SALT',   '_>Ph h_X*~YTc]`^-2?^g+b3!eu068ri,;#0<1A<<SJcY+14U<]$y-Bq,rIGN`WY');
define('NONCE_SALT',       '`~lzI|;b^ts>?r#[i2I[Zy&F/EKM^$_sV8.0NCX!w&LceR(bA5t ;/4S: jv]F%P');

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
