<?php
namespace App\Models;
use Core\Model;
use App\Models\UserSessions;
use Core\Cookie;
use Core\Session;
use Core\Validators\MinValidator;
use Core\Validators\MaxValidator;
use Core\Validators\RequiredValidator;
use Core\Validators\EmailValidator;
use Core\Validators\MatchesValidator;
use Core\Validators\UniqueValidator;

/**
 * Extends the Model class.  Supports functions for the Users model.
 */
class Users extends Model {
    public $acl;
    public $email;
    private $_confirm;
    private $_cookieName;
    public static $currentLoggedInUser = null;
    public $deleted = 0;
    public $fname;
    public $id;
    private $_isLoggedIn;
    public $lname;
    public $password;
    private $_sessionName;
    public $username;
    
    /**
     * Builds instance of Users model c.ass
     *
     * @param string $user The name of the user.  Default value is an empty 
     * string.
     */
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

    /**
     * Performs validation on the user registration form.
     *
     * @return void
     */
    public function validator() {
        // Validate first name
        $this->runValidation(new RequiredValidator($this, ['field' => 'fname', 'message' => 'First Name is required.']));
        $this->runValidation(new MaxValidator($this, ['field' => 'fname', 'rule' => '150', 'message' => 'Email must be less than 155 characters.']));

        // Validate last name
        $this->runValidation(new RequiredValidator($this, ['field' => 'lname', 'message' => 'Last Name is required.']));
        $this->runValidation(new MaxValidator($this, ['field' => 'lname', 'rule' => '150', 'message' => 'Email must be less than 155 characters.']));

        // Validate E-mail
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'message' => 'Email is required.']));
        $this->runValidation(new MaxValidator($this, ['field' => 'email', 'rule' => '150', 'message' => 'Email must be less than 155 characters.']));
        $this->runValidation(new EmailValidator($this, ['field' => 'email', 'message' => 'You must provide a valid email address.']));

        // Validate username
        $this->runValidation(new MinValidator($this, ['field' => 'username', 'rule' => '6', 'message' => 'Username must be at least 6 characters.']));
        $this->runValidation(new MaxValidator($this, ['field' => 'username', 'rule' => '150', 'message' => 'Username must be less than 155 characters.']));
        $this->runValidation(new UniqueValidator($this, ['field' => 'username', 'message' => 'That username already exists.  Please chose a new one.']));

        // Validate password
        $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'message' => 'Password is required.']));
        $this->runValidation(new MinValidator($this, ['field' => 'password', 'rule' => '6', 'message' => 'Password must be at least 6 characters.']));
        if($this->isNew()) {
            $this->runValidation(new MatchesValidator($this, ['field' => 'password', 'rule' => $this->_confirm, 'message' => 'Passwords must match.']));
        }
    }
}