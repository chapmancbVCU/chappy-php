<?php
/**
 * Configuration for mvc framework.
 */

define('DEBUG', $_ENV['DEBUG']);

// this should be set to false for security reasons. If you need to run migrations from the browser you can set this to true, then run migrations, then set it back to false.
define('RUN_MIGRATIONS_FROM_BROWSER', $_ENV['RUN_MIGRATIONS_FROM_BROWSER']);

define('SERVER_TYPE', $_ENV['SERVER_TYPE']);
define('DEFAULT_CONTROLLER', $_ENV['DEFAULT_CONTROLLER']);      // Default controller if there isn't one defined in the URL.
define('DEFAULT_LAYOUT', $_ENV['DEFAULT_LAYOUT']);              // If no layout is set in the controller use this layout.

define('APP_DOMAIN', $_ENV['APP_DOMAIN']);                                // Set this to '/' for a live server.
define('VERSION', $_ENV['VERSION']);
define('SITE_TITLE', $_ENV['SITE_TITLE']);                      // This will be used if no site title is set.
define('MENU_BRAND', $_ENV['MENU_BRAND']);                      // Branding for menu.

define('ACCESS_RESTRICTED', $_ENV['ACCESS_RESTRICTED']);    //Controller name for the restricted redirect.

define('MAX_LOGIN_ATTEMPTS', $_ENV['MAX_LOGIN_ATTEMPTS']);
define('S3_BUCKET', $_ENV['S3_BUCKET']);

define('TIME_ZONE', $_ENV['TIME_ZONE']);

/* 
 *  ADD ADDITIONAL CONFIGURATION HERE.
 */