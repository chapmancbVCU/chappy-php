<?php
namespace Core;

use Core\Lib\Logger;
use App\Models\Users;
use Core\Cookie;
use Core\Session;
/**
 * Supports session management
 */
class SessionManager {
    /**
     * Checks if session exists and logs user in.  Logs user out if account 
     * status is inactive.
     *
     * @return void
     */
    public static function initialize(): void {
        if (!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
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
    }
}
