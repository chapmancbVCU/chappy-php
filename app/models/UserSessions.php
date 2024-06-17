<?php
namespace App\Models;
use Core\Model;
use Core\Session;
use Core\Cookie;

/**
 * Supports operations of the User Session model.  Extends the Model class.
 */
class UserSessions extends Model{
    public $id;
    public $session;
    public $user_agent;
    public $user_id;
    
    /**
     * Creates new instance of UserSessions model.
     */
    public function __construct() {
        $table = 'user_sessions';
        parent::__construct($table);
    }

    /**
     * Retrieves User Session information from cookie.
     *
     * @return bool|UserSessions An object containing information about the 
     * current user's session.  If a user session does not exist false is 
     * returned.
     */
    public static function getFromCookie() {
        $userSession = new self();
        if(Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
            $userSession = $userSession->findFirst([
                'conditions' => "user_agent = ? AND session = ?",
                'bind' => [Session::uagent_no_version(), Cookie::get(REMEMBER_ME_COOKIE_NAME)]
            ]);
        }

        if(!$userSession) return false;
        return $userSession;
    }
}