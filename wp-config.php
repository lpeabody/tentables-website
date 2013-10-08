<?php
/** Enable W3 Total Cache */
//define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
 //Added by WP-Cache Manager
define( 'WPCACHEHOME', 'C:\wamp\www\websites\tentables-website\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'belincol_tentables');

/** MySQL database username */
define('DB_USER', 'belincol_sadmin');

/** MySQL database password */
define('DB_PASSWORD', 'lush-douse');

/** MySQL hostname */
define('DB_HOST', 'aecworkshop.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '|[ %SI&d2PFraBd5aYuhtd)kru;GZ1<M2=4`=%,>E6PUKI^<Ro~bPpu*h&%/-/=I');
define('SECURE_AUTH_KEY',  'WwdLb+U|U]>SB-!b*ew(S0,Q%8=46`TY;^O,>^OFXRs9oq14JO D+7.8J6~0?`tu');
define('LOGGED_IN_KEY',    'lUkZqQsdr|`-^J+yj|qW}+d84PD5K<(-C,Oh2_9`F1wJ6lbbNMD!qt-S-|_P%$;]');
define('NONCE_KEY',        'I]()z}QNW5.M@juBNUH-I:JC,tM{HJ7{ eOkBDmO0oYeJ[U>65rND,S~j2QJ1-xf');
define('AUTH_SALT',        'cunqA2.{?5fmL3>|}H|k/RI-p_H*|eVIyAoQRW=r:8),^y}vvo2%<+_/>^ L!hZ.');
define('SECURE_AUTH_SALT', '>+WTvn!BL]eq+aC-xxFty2-zuSh6S^SO9.<JqBaj!*4)<w_X+|_)WfTd0-2|`1ff');
define('LOGGED_IN_SALT',   ',~4]1@^NsC4WwRlhO3l;|3REER+^B|1JJPJZzxEd|TGJ$xD#7tbmE2F:$5p:j(Cw');
define('NONCE_SALT',       '-BU*+Jq:}c.g~.fU{Kh1#qs4Tdmh{V-:~+PNkfi2WP`Aceiis@dg+3ugQ]x0?`WC');;

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_r3hz';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
