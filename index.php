<?php
/**
 * Application execution begins here.
 */
use Core\Cookie;
use Core\Lib\Logger;
use Core\Router;
use Core\Session;
use App\Models\Users;
use Dotenv\Dotenv;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

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

// Initialize Whoops error handler
$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

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

// Global Exception Handler: Log all uncaught exceptions
set_exception_handler(function ($exception) {
    Logger::log("Uncaught Exception: " . $exception->getMessage() . " | File: " . $exception->getFile() . " | Line: " . $exception->getLine(), 'error');
});

// Global Error Handler: Catch fatal errors
set_error_handler(function ($severity, $message, $file, $line) {
    Logger::log("Fatal Error: [$severity] $message | File: $file | Line: $line", 'error');
});

// Shutdown Function to Catch Fatal Errors
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR])) {
        Logger::log("Fatal Shutdown Error: {$error['message']} | File: {$error['file']} | Line: {$error['line']}", 'critical');
    }
});

// Determine session and cooking status.  Log in user if appropriate cookie exists.
if(!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
    $user = Users::loginUserFromCookie();
    
    if ($user) {
        if ($user->inactive == 1) {
            $user->logout();
            Logger::log("Inactive user attempted auto-login: User ID {$user->id}", 'warning');
        } else {
            Session::set(CURRENT_USER_SESSION_NAME, $user->id);
            Logger::log("User auto-logged in via Remember Me: User ID {$user->id}", 'info');
        }
    }
}

// Create an array from our URL.
$requestPath = array_key_exists('PATH_INFO', $_SERVER) ? $_SERVER['PATH_INFO'] : $_SERVER['REQUEST_URI'];
$url = isset($requestPath) ? explode('/', ltrim($requestPath, '/')) : [];

// Route the request
try {
    Router::route($url);
} catch (Exception $e) {
    Logger::log("Unhandled Exception: " . $e->getMessage(), 'error');
    throw $e; // Let Whoops handle it
}