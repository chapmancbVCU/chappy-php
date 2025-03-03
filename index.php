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
foreach (glob(ROOT . DS . 'config' . DS . '*.php') as $configFile) {
    require_once $configFile;
}

require_once __DIR__ . '/core/Lib/helpers.php';
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
    
    if($user) {
        if($user->inactive == 1) {
            $user->logout();
            Logger::log("Inactive user attempted auto-login: User ID {$user->id}", 'warning');
        } else {
            Session::set(CURRENT_USER_SESSION_NAME, $user->id);
            Logger::log("User auto-logged in via Remember Me: User ID {$user->id}", 'info');
        }
    }
}

// Initialize Whoops error handler
$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

// Create an array from our URL.
$requestPath = array_key_exists('PATH_INFO', $_SERVER) ? $_SERVER['PATH_INFO'] : $_SERVER['REQUEST_URI'];
$url = isset($requestPath) ? explode('/', ltrim($requestPath, '/')) : [];

// Route the request
try {
    Router::route($url, $requestPath);
} catch (Exception $e) {
    Logger::log("Unhandled Exception: " . $e->getMessage(), 'error');
    throw $e; // Let Whoops handle it
}