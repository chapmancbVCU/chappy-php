<?php
namespace App\Models;
use Core\Model;
//use App\Models\Users;
use App\Models\UserSessions;
use Core\Cookie;
use Core\Session;
use Core\Validators\MinValidator;
use Core\Validators\MaxValidator;
use Core\Validators\RequiredValidator;
use Core\Validators\EmailValidator;
use Core\Validators\MatchesValidator;
use Core\Validators\UniqueValidator;


class Users extends Model {
    private $_isLoggedIn;
    private $_sessionName;
    private $_cookieName;
    private $_confirm;
    public static $currentLoggedInUser = null;

    public $id;
    public $username;
    public $email;
    public $password;
    public $fname;
    public $lname;
    public $acl;
    public $deleted = 0;

    public function __construct($user = '') {
        $table = 'users';
        parent::__construct($table);

        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        $this->_cookieName = REMEMBER_ME_COOKIE_NAME;

        // Do not delete users from db.
        $this->_softDelete = true;

        if($user != '') {
            if(is_int($user)) {
                $u = $this->_db->findFirst('users', ['conditions' => 'id = ?', 'bind' => [$user]], 'App\Models\Users');
            } else {
                $u = $this->_db->findFirst('users', ['conditions' => 'username = ?', 'bind' => [$user]], 'App\Models\Users');
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

    public function beforeSave() {
        if($this->isNew()) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }
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

    public function getConfirm() {
        return $this->_confirm;
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
        
        if($userSession && $userSession->user_id != '') {
            $user = new self((int)$userSession->user_id);
            if($user) { 
                $user->login();
            }
            return $user;
        }
        return $user;
    }

    public function setConfirm($value) {
        $this->_confirm = $value;
    }

    public function validator() {
        $this->runValidation(new RequiredValidator($this, ['field' => 'fname', 'msg' => 'First Name is required.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'lname', 'msg' => 'Last Name is required.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => 'Email is required.']));
        $this->runValidation(new MaxValidator($this, ['field' => 'email', 'rule' => '150', 'msg' => 'Email must be less than 155 characters.']));
        $this->runValidation(new EmailValidator($this, ['field' => 'email', 'msg' => 'You must provide a valid email address.']));

        $this->runValidation(new MinValidator($this, ['field' => 'username', 'rule' => '6', 'msg' => 'Username must be at least 6 characters.']));
        $this->runValidation(new MaxValidator($this, ['field' => 'username', 'rule' => '150', 'msg' => 'Username must be less than 155 characters.']));
        $this->runValidation(new UniqueValidator($this, ['field' => 'username', 'msg' => 'That username already exists.  Please chose a new one.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'msg' => 'Password is required.']));
        $this->runValidation(new MinValidator($this, ['field' => 'password', 'rule' => '6', 'msg' => 'Password must be at least 6 characters.']));
        if($this->isNew()) {
            $this->runValidation(new MatchesValidator($this, ['field' => 'password', 'rule' => $this->_confirm, 'msg' => 'Passwords must match.']));
        }
    }
}