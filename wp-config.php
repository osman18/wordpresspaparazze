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
define('DB_NAME', 'mysql');

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
define('AUTH_KEY',         '/4(rBFdQV$ST6pTzQ|op!~r@J%h >nPLJcbzmzyKbI)?H,C9:kS8OD37RZn-jg!9');
define('SECURE_AUTH_KEY',  'KfKr&]Js)6dJMX^3P]#7CAS=]8a4!Bt)lqJ9/`Fc}v.Rm A[;yTq)ki`[I)f8-C=');
define('LOGGED_IN_KEY',    'yw4d&-}{VkRM8z83<F0;GFZ}3 H}.LqvZ<W`D7]jQSU?O>p3h1,ubg(>E?^`;Ens');
define('NONCE_KEY',        'Knkxs}p`.EY>J]X9=&,o-s84OCc-b0wu)he4r$UcfU!t0RSV HA=>Udq;uS?+Y7M');
define('AUTH_SALT',        '#$;51j?CZlUsoX6M.#rt-5^LPRAxXSh4z/^@G6iM$qTR&i9<^$)&_X|&[6yzm;jL');
define('SECURE_AUTH_SALT', '!(=V7OqdyD4~#AK:/yq&2-yQZMkJCVUY8#U,j=}B-ad&,u)`%V*d*xa3WK~@B+TJ');
define('LOGGED_IN_SALT',   'D1~T&$?Tu2s&eeJ>QBC67 _^P=L^.d l:A]zVgF~IeH.J8Z(R(H]7*C~tev(J ,G');
define('NONCE_SALT',       'rKSjTT72$HN$?<EYPUVu__J5Q1|qe a*=zy`0r@d0Qw5]]:?!TYB=.y,6W~,0Eh>');

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
