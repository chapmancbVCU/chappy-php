<?php
namespace Core;

/**
 * Manages cookies used by this application.  The $_COOKIE superglobal 
 * variable is an associative array.
 */
class Cookie {
    /**
     * The name of the cookie we want to work with that is found in the 
     * $_COOKIE superglobal.  
     *
     * @param string $name The name of the cookie we want to retrieve from 
     * the $_COOKIE superglobal.
     * @return string The name of the cookie specified in the $name parameter.
     */
    public static function get($name) {
        return $_COOKIE[$name];
    }

    /**
     * Checks if a particular cookie exists in the $_COOKIE superglobal 
     * variable.
     *
     * @param string $name The name of the cookie we want to check if
     * it exists in the $_COOKIE superglobal variable.
     * @return bool True if the cookie exists.  Otherwise false.
     */
    public static function exists($name) {
        return isset($_COOKIE[$name]);
    }

    /**
     * Sets a cookie to the $_COOKIE superglobal variable.  Information that 
     * it needs are its name, a value, and the amount of time we want this 
     * cookie to exist.
     *
     * @param string $name The name of the cookie we want to set.
     * @param string $value The value of the cookie
     * @param int $expiry The amount of time we want this cookie to exist 
     * before it expires.
     * @return void True if the cookie is successfully set.  Otherwise it 
     * returns false.
     */
    public static function set($name, $value, $expiry) {
        if(setCookie($name, $value, time() + $expiry, '/')) {
            return true;
        }
        return false;
    }

    /**
     * Deletes a cookie from the $_COOKIE superglobal variable.
     *
     * @param string $name The name of the cookie we want to remove.
     * @return void
     */
    public static function delete($name) {
        self::set($name, '', time() - 1);
    }

    
}