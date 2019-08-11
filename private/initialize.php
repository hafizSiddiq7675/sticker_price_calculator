<?php

/*
 * Non-Error reporting ini settings
 * These settings are to protect php specific security issues
 */
ini_set('session.cookie_lifetime', 0);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.entropy_file', '/dev/urandom');

ob_start();
session_start();


/*
 * Assign file paths to PHP constants
 * __FILE__ returns the current path to this file
 * dirname() returns the path to the parent directory
 * MAIN_SITE returns the path to the parent WP site
 * ERROR_LOG_PATH returns the path to the error log
 */
define("PRIVATE_PATH", dirname(__FILE__)); // Refactor when ready
define("PROJECT_PATH", dirname(PRIVATE_PATH)); // Refactor when ready

const PUBLIC_PATH = PROJECT_PATH . '/site';
const SHARED_PATH = PRIVATE_PATH . '/shared';

/*
 * Assign the root URL to a PHP constant
 * Do not need to include the domain
 * Use same document root as web server
 * Can dynamically find everything in URL up to "/site"
 */
$site_end = strpos($_SERVER['SCRIPT_NAME'], '/site') + 5;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $site_end);
define("WWW_ROOT", $doc_root);

require_once('database.php');

ini_set('log_errors', 'On');

require_once __DIR__ . '/../vendor/autoload.php';


/**
 * Class Autoloader
 *
 * Only load the classes that a given php file asks for.
 *
 * @param string $class the name of the class you are looking for.
 *
 * @return void This method does not return anything.
 */
function my_autoload(string $class)
{
    if (preg_match('/\A\w+\Z/', $class)) {
        include 'class_library/' . $class . '.php';
    }
}

/**
 * Sanitize For HTML Output.
 *
 * This function is a shorthand version of htmlspecialchars().
 *
 * @param string $str The string needing to be sanitized.
 * @return string The santized string.
 */
function h($str = ""): string
{
    return htmlspecialchars($str);
}

spl_autoload_register('my_autoload');

/*
 * $db creates the database object
 * $errors allows for custom validation messages to be placed on pages
 * $common allows to use all functions within the common class
 */

$db = db_connect();
$errors = [];
DatabaseObject::set_database($db);