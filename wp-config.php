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
define('DB_NAME', 'espacioenarmonia');

/** MySQL database username */
define('DB_USER', 'test');

/** MySQL database password */
define('DB_PASSWORD', '841210lab');

/** MySQL hostname */
define('DB_HOST', 'lab841210.caou05eg0r7o.us-east-1.rds.amazonaws.com:3306');

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
define('AUTH_KEY',         '`,qM[c e61@JXx!9u~CR=JX6jrgh@ nj9`a?upH(.?S0UkAsA$*8j@6d<djmJL{U');
define('SECURE_AUTH_KEY',  '#P3]x]3%wP$I_iGsgTH=6^U0b2Q,r hz4_dDqJzF-_e3aP+G@;lWpHNYsGeO1Bt8');
define('LOGGED_IN_KEY',    'wY:jZ$EZE]olW}8YB?]-QwE~.R:7uUooU,eB(It1f3:VtkTjiceKmaDJZmrANm@^');
define('NONCE_KEY',        'Jt+vviF3A1k ~I6xvDP1)88xsdlDElKU@c!,z2}2e}~x$3eX2(*!n^*nF5z=7+l,');
define('AUTH_SALT',        '2O2W3F|9&^q7n0-!#;+ECVVMxLm[~e?#&+P^+b8pQrOUKIC[0qM!&Edi)YR/3Dl%');
define('SECURE_AUTH_SALT', ' ,Sd/Ht2mRPCn3B}06yqoJ;;Q0z8I--CpW,A4%ufV:}5pm{ZiFk/~r/;Sv;)*b)d');
define('LOGGED_IN_SALT',   '|$( (E9py//S-~<i[3KM?),hrGPT1u>U48$VrT}F`K.JX_,)I~@>f4cN#i/[@%>_');
define('NONCE_SALT',       '%L+[_F|-!}n*N/%R+kN3}hSv?-:cHqSwx=|jw3~{^uIbah@RRZ;}n,.KPr~XSP_F');

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

