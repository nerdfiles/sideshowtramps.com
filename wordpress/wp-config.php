<?php
/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 * (OucYdymZZ*#n)
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tramps_wpinstall');

/** MySQL database username */
define('DB_USER', 'tramps_dev');

/** MySQL database password */
define('DB_PASSWORD', 'f0xf0x0!6');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',        'emr0xlQpWhEz5N+;)2sq+:|V;!Dlzh^y1W#5+$t[A28xA2Mt]d3IJ/6$@F$QpF1a');
define('SECURE_AUTH_KEY', 'yd AhMVt0gtZo=5+R%@W{ =%6?2pZ.kF>i5+A-C6)Oe +e~`h0c4f5b^@%:y.-(W');
define('LOGGED_IN_KEY',   'fk+_z{D}sZUn+DYAkqf/aLJ-sVd(|%$Q|7#Bof=[a<|iFHcAL)6_il?W0J@Z6r+1');
define('NONCE_KEY',       '<r8v|A$-~jBj9V$fvDa6G>Kgj$py;w k1lcWB+ D0/:#=C%xjsNrEFdNytx=Mr;i');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
