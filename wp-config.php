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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'lcwp_v1' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '786@Tritechteal' );

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
define( 'AUTH_KEY',         '3!P^ ,7S^+[!%Fc(My5z_QoR#OO79h=Y-1F1-xd^-Pr}g0}5DgB*BBA8w,-WgEk$' );
define( 'SECURE_AUTH_KEY',  'nFH{_028q/~4/*22!y8w#q7}*)E/ >BO4<tG~>8DfHOEAoJxs5gqZh?4u:l!kZl1' );
define( 'LOGGED_IN_KEY',    '0RDaXW.M`K%Yob#$bz><KtTZ.PY#,ZxG<;eI8Rlk+F=>),lt&bkl10qTx7XNfU=L' );
define( 'NONCE_KEY',        'SEh7Qj-z,R,/oXSkT#Wc<^O@NQ5 %bd^I3h6@QcHJ}xMx{0q<!F<A_?^{93C?8{M' );
define( 'AUTH_SALT',        'oG+Bs/=!*7eZ-d`,xdz@Fx6+gJ6w:n=2ZEc7}!-)!JE9$sI5t^LQF3VJe$`=%6vu' );
define( 'SECURE_AUTH_SALT', 'wFLL{@i90aOQK4nzJEB;f#U[^Ii*3m<&;LOA)0inGvsS}H5T?.*{;e1I_?=!.vg>' );
define( 'LOGGED_IN_SALT',   'j|PO*[&`[:3Ut{ V#w|0/i/`5PFg`sn?nip.FX;eR)kK]s{pk&uZ;{!({mb9[_<w' );
define( 'NONCE_SALT',       '_BDLc3sLZjI/_,LbJ49}v~z&4&jc|!F;.J;CO%408`gZhRuhbp_FcHcw6>hy}{K-' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
