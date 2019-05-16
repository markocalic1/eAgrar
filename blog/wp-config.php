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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u787477827_ynuru' );

/** MySQL database username */
define( 'DB_USER', 'u787477827_ydagu' );

/** MySQL database password */
define( 'DB_PASSWORD', 'yDytuneLeh' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ']N[5u6f+)~<]<:iz==|+4K2BU*. w%gtM--#ZNxe0Ocv1A9q++JT.%c2~g3p++.u');
define('SECURE_AUTH_KEY',  'OaC[Gk7PtdMj=Xn-@UsE{V1+0}v{HOL+pP^6a-pBWZDP%|(akd2!%.B+WF4OD#+.');
define('LOGGED_IN_KEY',    'Sm,`7c>n}y-OZ1TYMYdVhV.A>bA[FYAc qF3?>=Ld>NXXD#M{e;8)?.Pde-m0rAv');
define('NONCE_KEY',        'tW29k6zweWs: tEhm6rwjICJ43Vz{kd &?V8pd,!G#gx@}X&<8^dQPcdosce>+B3');
define('AUTH_SALT',        '(C`bJ`TE4-3~O05R,*O+ /fD]kIhQ~6h2z.b^-$gTj7k |P52dDO`=0Sm%,ha4S7');
define('SECURE_AUTH_SALT', '_+nKat*+(XAF{?*Vy1`a!PE-s9IfG1X# DHP+K_cKl0|%#&73A(-ei/3tNkmlO1r');
define('LOGGED_IN_SALT',   'wBGG0StgR[VCVEI8[0{4q;E/[JGjs*E+#6WY1[xb(N-=0%CcE-5~;{JD7 w|Dy85');
define('NONCE_SALT',       '9Sl40vI|[aVv>#sa:7V>`.HCVSKn}[74W.0>`E3+x>mYLQ`kgg.tAX_KB7XaR$?I');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
