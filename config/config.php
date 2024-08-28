<?php
/**
 * Configuration for mvc framework.
 */

define('DEBUG', $_ENV['DEBUG']);
define('CONSOLE_LOGGING', $_ENV['CONSOLE_LOGGING']);            // JS console logging.

// this should be set to false for security reasons. If you need to run migrations from the browser you can set this to true, then run migrations, then set it back to false.
define('RUN_MIGRATIONS_FROM_BROWSER', $_ENV['RUN_MIGRATIONS_FROM_BROWSER']);

define('SERVER_TYPE', $_ENV['SERVER_TYPE']);
define('DEFAULT_CONTROLLER', $_ENV['DEFAULT_CONTROLLER']);      // Default controller if there isn't one defined in the URL.
define('DEFAULT_LAYOUT', $_ENV['DEFAULT_LAYOUT']);              // If no layout is set in the controller use this layout.

define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_HOST', $_ENV['DB_HOST']);

define('APP_DOMAIN', $_ENV['APP_DOMAIN']);                                // Set this to '/' for a live server.
define('VERSION', $_ENV['VERSION']);
define('SITE_TITLE', $_ENV['SITE_TITLE']);                      // This will be used if no site title is set.
define('MENU_BRAND', $_ENV['MENU_BRAND']);                      // Branding for menu.

define('CURRENT_USER_SESSION_NAME', $_ENV['CURRENT_USER_SESSION_NAME']);   // Session name for logged in user;
define('REMEMBER_ME_COOKIE_NAME', $_ENV['REMEMBER_ME_COOKIE_NAME']);       // Cookie name for logged in user remember me
define('REMEMBER_ME_COOKIE_EXPIRY', $_ENV['REMEMBER_ME_COOKIE_EXPIRY']);   // Expire after 30 days, value in seconds

define('ACCESS_RESTRICTED', $_ENV['ACCESS_RESTRICTED']);    //Controller name for the restricted redirect.

/* 
 *  ADD ADDITIONAL CONFIGURATION HERE.
 */