<?php
namespace Core;

/**
 * The Application class supports basic functional needs of the application.
 */
class Application {
    /**
     * Calls functions for reporting and unregister of globals.
     */
    public function __construct() {
        $this->_set_reporting();
        $this->_unregister_globals();
    }

    /**
     * Manages the displaying of error messages and other reporting for this 
     * application.
     *
     * @return void
     */
    private function _set_reporting(): void {
        if(DEBUG) {
            // error_reporting(E_ALL);
            error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);
            ini_set('display_errors', 1);
        } else {
            error_reporting(0);
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
            ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'errors.log');
        }
    }

    /**
     * Unregister global variables that are created by default in PHP prior 
     * to version 8.
     *
     * @return void
     */
    private function _unregister_globals(): void {
        if(ini_get('register_globals')) {
            $globalsArray = ['_SESSION', '_COOKIE', '_POST', '_GET' , '_REQUEST', '_SERVER', '_ENV', '_FILES'];
            foreach($globalsArray as $global) {
                foreach($GLOBALS[$global] as $key => $value) {
                    if($GLOBALS[$key] === $value) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }
}