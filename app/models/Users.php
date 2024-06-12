<?php

class Users extends Model {
    private $_isLoggedIn;
    private $_sessionName;
    private $_cookieName;

    public static $currentLoggedInUser = null;

    public $id;
    public $username;
    public $email;
    public $password;
    public $fname;
    public $lname;
    public $acl;
    public $delete = 0;

    public function __construct($user = '') {
        $table = 'users';
        parent::__construct($table);

        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        $this->_cookieName = REMEMBER_ME_COOKIE_NAME;

        // Do not delete users from db.
        $this->_softDelete = true;

        if($user != '') {
            if(is_int($user)) {
                $u = $this->_db->findFirst('users', ['conditions' => 'id = ?', 'bind' => [$user]], 'Users');
            } else {
                $u = $this->_db->findFirst('users', ['conditions' => 'username = ?', 'bind' => [$user]], 'Users');
            }

            if($u) {
                foreach($u as $key => $val) {
                    $this->$key = $val;
                }
            }
        }     
    }

    public function acls() {
        if(empty($this->acl)) return [];
        return json_decode($this->acl, true);

    }
    public function findByUserName($username) {
        return $this->findFirst(['conditions' => 'username = ?', 'bind' => [$username]]);
    }

    public static function currentUser() {
        if(!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $u = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
            self::$currentLoggedInUser = $u;
        }
        return self::$currentLoggedInUser;
    }

    public function login($rememberMe = false) {
        Session::set($this->_sessionName, $this->id);
        if($rememberMe) {
            $hash = md5(uniqid() + rand(0, 100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];
            $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);

            $this->_db->insert('user_sessions', $fields);
        }
    }

    public function logout() {
        $userSession = UserSessions::getFromCookie();
        if($userSession) $userSession->delete();
        Session::delete(CURRENT_USER_SESSION_NAME);
        if(Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
            Cookie::delete(REMEMBER_ME_COOKIE_NAME);
        }
        self::$currentLoggedInUser = null;
        return true;
    }

    public static function loginUserFromCookie() {
        $userSession = UserSessions::getFromCookie();
        
        if($userSession->user_id != '') {
            $user = new self((int)$userSession->user_id);
        }
     
        if($user) $user->login();
        return $user;
    }

    public function registerNewUser($params) {
        $this->assign($params);
        $this->deleted = 0;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->save();
    }
}