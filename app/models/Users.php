<?php
namespace App\Models;
use Core\Cookie;
use Core\Validators\EmailValidator;
use Core\Validators\LowerCharValidator;
use Core\Validators\MaxValidator;
use Core\Validators\MatchesValidator;
use Core\Validators\MinValidator;
use Core\Model;
use Core\Validators\NumberCharValidator;
use Core\Validators\RequiredValidator;
use Core\Session;
use Core\Validators\SpecialCharValidator;
use Core\Validators\UniqueValidator;
use Core\Validators\UpperCharValidator;
use App\Models\UserSessions;
use Core\Helper;

/**
 * Extends the Model class.  Supports functions for the Users model.
 */
class Users extends Model {
    public $acl;
    private $changePassword = false;
    private $_confirm;
    private $_cookieName;
    public static $currentLoggedInUser = null;
    public $deleted = 0;                // Set default value for db field.
    public $description;
    public $email;
    public $fname;
    public $id;
    public $lname;
    public $password;
    public $profileImage;
    private $_sessionName;
    public $username;
    
    /**
     * Builds instance of Users model class.
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
                foreach($u as $key => $value) {
                    $this->$key = $value;
                }
            }
        }     
    }

    /**
     * Returns an array containing access control list information.  When the 
     * $acl instance variable is empty an empty array is returned.
     *
     * @return array The array containing access control list information.
     */
    public function acls(): array {
        if(empty($this->acl)) return [];
        return json_decode($this->acl, true);

    }

    /**
     * Implements beforeSave function described in Model parent class.  
     * Ensures password is not in plain text but a hashed one.
     *
     * @return void
     */
    public function beforeSave(): void {
        if($this->isNew()) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }
    }

    /**
     * Checks if a user is logged in.
     *
     * @return object|null An object containing information about current 
     * logged in user from users table.
     */
    public static function currentUser() {
        if(!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $user = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
            self::$currentLoggedInUser = $user;
        }
        return self::$currentLoggedInUser;
    }
    
    /**
     * Finds user by username in the Users table.
     *
     * @param string $username The username we want to find in the Users table. 
     * @return bool|object An object containing information about a user from 
     * the Users table.
     */
    public function findByUserName(string $username) {
        return $this->findFirst(['conditions' => 'username = ?', 'bind' => [$username]]);
    }

    /**
     * Getter function for $_confirm instance variable.
     *
     * @return mixed The value for $_confirm.
     */
    public function getConfirm(): mixed {
        return $this->_confirm;
    }

    /**
     * Creates a session when the user logs in.  A new record is added to the 
     * user_sessions table and a cookie is created if remember me is 
     * selected.
     *
     * @param bool $rememberMe Value obtained from remember me checkbox 
     * found in login form.  Default value is false.
     * @return void
     */
    public function login(bool $rememberMe = false): void {
        Session::set($this->_sessionName, $this->id);
        if($rememberMe) {
            $hash = md5(uniqid() + rand(0, 100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];

            // Clean up database in case expired sessions still exists.
            $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
            
            // Finally insert new session into user_sessions table.
            $this->_db->insert('user_sessions', $fields);
        }
    }

    /**
     * Perform logout operation on current logged in user.  The record for the 
     * current logged in user is removed from the user_session table and the 
     * corresponding cookie is deleted.
     *
     * @return bool Returns true if operation is successful.
     */
    public function logout(): bool {
        $userSession = UserSessions::getFromCookie();
        if($userSession) {
            $userSession->delete();
        }

        Session::delete(CURRENT_USER_SESSION_NAME);

        if(Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
            Cookie::delete(REMEMBER_ME_COOKIE_NAME);
        }
        self::$currentLoggedInUser = null;
        return true;
    }

    /**
     * Logs in user from cookie.
     *
     * @return Users The user associated with previous session.
     */
    public static function loginUserFromCookie() {
        $userSession = UserSessions::getFromCookie();
        
        if($userSession && $userSession->user_id != '') {
            $user = new self((int)$userSession->user_id);
            if($user) { 
                $user->login();
            }
            return $user;
        }
        return;
    }

    /**
     * Setter function for $_confirm instance variable.
     *
     * @param string $value The value we will use to set $_confirm instance 
     * variable.
     * @return void
     */
    public function setConfirm(string $value): void {
        $this->_confirm = $value;
    }

    public function setChangePassword(bool $value): void {
        $this->changePassword = $value;
    }

    /**
     * Performs validation on the user registration form.
     *
     * @return void
     */
    public function validator(): void {
        // Validate first name
        $this->runValidation(new RequiredValidator($this, ['field' => 'fname', 'message' => 'First Name is required']));
        $this->runValidation(new MaxValidator($this, ['field' => 'fname', 'rule' => 150, 'message' => 'First name must be less than 150 characters.']));

        // Validate last name
        $this->runValidation(new RequiredValidator($this, ['field' => 'lname', 'message' => 'Last Name is required.']));
        $this->runValidation(new MaxValidator($this, ['field' => 'lname', 'rule' => 150, 'message' => 'Last name must be less than 150 characters.']));

        // Validate E-mail
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'message' => 'Email is required.']));
        $this->runValidation(new MaxValidator($this, ['field' => 'email', 'rule' => 150, 'message' => 'Email must be less than 150 characters.']));
        $this->runValidation(new EmailValidator($this, ['field' => 'email', 'message' => 'You must provide a valid email address.']));

        // Validate username
        $this->runValidation(new MinValidator($this, ['field' => 'username', 'rule' => 6, 'message' => 'Username must be at least 6 characters.']));
        $this->runValidation(new MaxValidator($this, ['field' => 'username', 'rule' => 150, 'message' => 'Username must be less than 150 characters.']));
        $this->runValidation(new UniqueValidator($this, ['field' => 'username', 'message' => 'That username already exists.  Please chose a new one.']));

        // Validate password
        $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'message' => 'Password is required.'])); 
        
        if(!$this->isNew()) {
            $this->runValidation(new UpperCharValidator($this, ['field' => 'password', 'message' => '1 or more complex password requirements is not satisfied.']));
            $this->runValidation(new LowerCharValidator($this, ['field' => 'password', 'message' => '1 or more complex password requirements is not satisfied.']));
            $this->runValidation(new NumberCharValidator($this, ['field' => 'password', 'message' => '1 or more complex password requirements is not satisfied.']));
            $this->runValidation(new SpecialCharValidator($this, ['field' => 'password', 'message' => '1 or more complex password requirements is not satisfied.'])); 
            if($this->changePassword) {
                $this->runValidation(new MinValidator($this, ['field' => 'password', 'rule' => 12, 'message' => 'Password must be at least 12 characters.']));
                $this->runValidation(new MaxValidator($this, ['field' => 'password', 'rule' => 50, 'message' => 'Password must be less than 30 characters.']));
                $this->runValidation(new MatchesValidator($this, ['field' => 'password', 'rule' => $this->_confirm, 'message' => 'Passwords must match.']));
            }
        }
        
        if($this->isNew()) {
            $this->runValidation(new MinValidator($this, ['field' => 'password', 'rule' => 12, 'message' => 'Password must be at least 12 characters.']));
            $this->runValidation(new MaxValidator($this, ['field' => 'password', 'rule' => 50, 'message' => 'Password must be less than 30 characters.']));
            $this->runValidation(new UpperCharValidator($this, ['field' => 'password', 'message' => '1 or more complex password requirements is not satisfied.']));
            $this->runValidation(new LowerCharValidator($this, ['field' => 'password', 'message' => '1 or more complex password requirements is not satisfied.']));
            $this->runValidation(new NumberCharValidator($this, ['field' => 'password', 'message' => '1 or more complex password requirements is not satisfied.']));
            $this->runValidation(new SpecialCharValidator($this, ['field' => 'password', 'message' => '1 or more complex password requirements is not satisfied.'])); 
            $this->runValidation(new MatchesValidator($this, ['field' => 'password', 'rule' => $this->_confirm, 'message' => 'Passwords must match.']));
        }
    }
}