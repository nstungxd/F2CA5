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
define('AUTH_KEY',         'wQ$?)QCMm[]EvY7=XWmaZKprS7.2<nvb1)zc-dbgn8|n-)u||B:6bL^~-5eiYP+3');
define('SECURE_AUTH_KEY',  '1); ?W$q^`@hMB{9`K+|wt}R,Ap8+-$m][>qs@$>xPIp!:)A#O)qb74MjM@A&j^&');
define('LOGGED_IN_KEY',    'Y/X#|zID)4PK3Ivmf<{a]S()pygrjx|_$vNV)twJdxwy]4esV=Jp{OUmCs6n^,-f');
define('NONCE_KEY',        '+%Rj|]>+GpcHM:c2wp{_<?+@wWMY7s&}Z7T;S[@ka*xN^xrYKgUi:f_~3;*xB1x.');
define('AUTH_SALT',        '|VCq^E+h.%[Cv?ONw+WK*8|6zqYNR=<T+yf@7a#cF^onZ+x(L*yasTNXgo$<BE[4');
define('SECURE_AUTH_SALT', 'ne>{zg.C].9,wFeaG-RGI V.P;`Sg)+U:{-QV=#O?-b.+{KQ[/C/2#bL{!^C-1kz');
define('LOGGED_IN_SALT',   '6_$#Q_]|*EXNAx#}]$/u;pL1I|qSF|TG@rS|IY*+=%+LHcqzvnhAH2W!3^8ezC*^');
define('NONCE_SALT',       'k<b?H<wyBTD:V{qw(kxlIDTDO[9R$~ 2x9a J_uwqtvL?hOPcbzhQ!`hGu|Uo/x9');

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
