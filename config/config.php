<?php
/**
 * Configuration for mvc framework.
 */

define('DEBUG', true);
define('CONSOLE_LOGGING', true);                // JS console logging.

define('DEFAULT_CONTROLLER', 'Home');           // Default controller if there isn't one defined in the URL.
define('DEFAULT_LAYOUT', 'default');            // If no layout is set in the controller use this layout.

define('PROOT', '/custom-php-mvc-framework/');  // Set this to '/' for a live server.

define('SITE_TITLE', 'MVC Framework');          // This will be used if no site title is set.
define('MENU_BRAND', 'PHP MVC Tutorial');       // Branding for menu.

define('CURRENT_USER_SESSION_NAME', 'afEafFefafDFD');   // Session name for logged in user;
define('REMEMBER_ME_COOKIE_NAME', 'ADF4R4affa43fFF');   // Cookie name for logged in user remember me
define('REMEMBER_ME_COOKIE_EXPIRY', 2592000);   // Expire after 30 days, value in seconds

define('ACCESS_RESTRICTED', 'Restricted');      //Controller name for the restricted redirect.

/* 
 *  ADD ADDITIONAL CONFIGURATION HERE.
 */