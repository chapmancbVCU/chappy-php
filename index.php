<?php
/**
 * Application execution begins here.
 */
use Core\Session;
use Core\Cookie;
use Core\Router;
use App\Models\Users;
use Dotenv\Dotenv;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once('vendor/autoload.php');
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Load configuration and helper functions.
$array =  array('config', 'database', 'session', 'password');

foreach ($array as $value) {
    require_once(ROOT . DS . 'config' . DS . $value . '.php');
}


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
require_once __DIR__ . '/core/lib/helpers.php';
session_start();

// Create an array from our URL.
$requestPath = array_key_exists('PATH_INFO', $_SERVER) ? $_SERVER['PATH_INFO'] : $_SERVER['REQUEST_URI'];
$url = isset($requestPath) ? explode('/', ltrim($requestPath, '/')) : [];

// Determine session and cooking status.  Log in user if appropriate cookie exists.
if(!Session::exists(CURRENT_USER_SESSION_NAME && Cookie::exists(REMEMBER_ME_COOKIE_NAME))) {
    $user = Users::loginUserFromCookie();
    if($user != null && $user->inactive == 1) {
        $user->logout();
    }
}

// Route the request
Router::route($url);