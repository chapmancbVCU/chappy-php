<?php
/**
 * Application execution begins here.
 */
use Core\Session;
use Core\Cookie;
use Core\Router;
use App\Models\Users;

// Boiler plate imports.
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

// Load configuration and helper functions.
require_once(ROOT . DS . 'config' . DS . 'config.php');
//require_once(ROOT . DS . 'config' . DS . 'dbConfig.php');

/*
 * MIDDLE WARES
 */
require_once('vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
/**
 * Auto-loading of classes using PSR-4 Support.
 *
 * @param string $className Path to file we will used for auto-loading 
 * classes that are used by this application.
 * @return void
 */
function autoload($className) {
    $classArray = explode('\\', $className);
    $class = array_pop($classArray);
    $subPath = strtolower(implode(DS, $classArray));

    $path = ROOT . DS . $subPath . DS . $class . '.php';
    if(file_exists($path)) {
        require_once($path);
    }
}
spl_autoload_register('autoload');

session_start();

// Create an array from our URL.
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

// Determine session and cooking status.  Log in user if appropriate cookie exists.
if(!Session::exists(CURRENT_USER_SESSION_NAME && Cookie::exists(REMEMBER_ME_COOKIE_NAME))) {
    Users::loginUserFromCookie();
}

// Route the request
Router::route($url);