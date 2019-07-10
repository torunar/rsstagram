<?php
/**
 * This file contains RSS-Bridge configuration.
 */

/** Path to the root folder of RSS-Bridge (where index.php is located) */
define('PATH_ROOT', __DIR__ . '/../vendor/rss-bridge/rss-bridge/');

/** Path to the core library */
define('PATH_LIB', PATH_ROOT . 'lib/');

/** Path to the vendor library */
define('PATH_LIB_VENDOR', PATH_ROOT . 'vendor/');

/** Path to the bridges library */
define('PATH_LIB_BRIDGES', __DIR__ . '/Bridge/');

/** Path to the formats library */
define('PATH_LIB_FORMATS', PATH_ROOT . 'formats/');

/** Path to the caches library */
define('PATH_LIB_CACHES', PATH_ROOT . 'caches/');

/** Path to the actions library */
define('PATH_LIB_ACTIONS', PATH_ROOT . 'actions/');

/** Path to the cache folder */
define('PATH_CACHE', PATH_ROOT . 'cache/');

/** Path to the whitelist file */
define('WHITELIST', __DIR__ . '/data/whitelist.txt');

/** Path to the default whitelist file */
define('WHITELIST_DEFAULT', __DIR__ . '/data/whitelist.txt');

/** Path to the configuration file */
define('FILE_CONFIG', PATH_ROOT . 'config.ini.php');

/** Path to the default configuration file */
define('FILE_CONFIG_DEFAULT', PATH_ROOT . 'config.default.ini.php');

/* Allow larger files for simple_html_dom */
define('MAX_FILE_SIZE', 10000000);

/** User agent used for network queries */
define('USER_AGENT', 'Mozilla/5.0 (X11; Linux x86_64; rv:30.0) Gecko/20121202 Firefox/30.0(rsstagram)');

ini_set('user_agent', USER_AGENT);
