<?php
namespace Core;
/**
 * Supports functions for user sessions.  This class never gets instantiated.
 */
class Session {

    /**
     * Adds a session alert message.
     *
     * @param string $type Can be info, success, warning, or danger.
     * @param string $message The message you want to display in the alert.
     * @return void
     */
    public static function addMessage(string $type, string $message): void {
        $sessionName = 'alert-' . $type;
        self::set($sessionName, $message);
    }

    /**
     * Removes CURRENT_USER_SESSION_NAME from th $_SESSION superglobal array 
     * when a user logs out of a user session.
     *
     * @param string $name The CURRENT_USER_SESSION_NAME associated with the 
     * current user session.
     * @return void
     */
    public static function delete(string $name): void {
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Displays messages related to actions a user may perform.
     *
     * @return string  A HTML element containing a message along with a button 
     * button to dismiss the message.
     */
    public static function displayMessage(): string {
        $alerts = ['alert-info', 'alert-success', 'alert-warning', 'alert-danger'];
        $html = "";
        foreach($alerts as $alert) {
            if(self::exists($alert)) {
                $html .= '<div class="alert '.$alert.' alert-dismissible" role="alert">';
                $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                $html .= self::get($alert);
                $html .= '</div>';
                self::delete($alert);
            }
        }
        return $html;
    }

    /**
     * Checks if a session by user name exists.
     *
     * @param string $name The id of the user associated with a particular 
     * session.
     * @return bool True if the session exists.  Otherwise we return false.
     */
    public static function exists(string $name): bool {
        return (isset($_SESSION[$name])) ? true : false;
    }

    /**
     * Getter function that returns the $_SESSION superglobal associative 
     * array.
     *
     * @param string $name The user_id of the user associated with a 
     * particular session.
     * @return int Element in the $_SESSION superglobal array for 
     * CURRENT_USER_SESSION_NAME set as id for current logged in user.
     */
    public static function get(string $name): int {
        return $_SESSION[$name];
    }

    /**
     * Sets value to $_SESSION name key.
     *
     * @param string $name The current user session name.
     * @param int $value The id of the user associated with a particular 
     * session.
     * @return int Element in the $_SESSION superglobal array for 
     * CURRENT_USER_SESSION_NAME set as id for current logged in user.
     */
    public static function set(string $name, int $value): int {
        return $_SESSION[$name] = $value;
    }

    /**
     * Don't store browser version numbers so we don't break session during 
     * end user software updates.
     * 
     * @return string User agent information with the browser version removed.
     */
    public static function uagent_no_version(): string {
        $uagent = $_SERVER['HTTP_USER_AGENT'];
        $regex = '/\/[a-zA-z0-9.]+/';
        $newString = preg_replace($regex, '', $uagent);
        return $newString;
    }
}